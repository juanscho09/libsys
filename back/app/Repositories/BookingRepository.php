<?php

namespace App\Repositories;

use App\Models\Booking;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertBookAvailable;

class BookingRepository extends BaseRepository
{
    const RELATIONS = ['user:id,name,email', 'book:id,title,category,author'];
    protected $bookRepository;

    public function __construct(
        Booking $model, 
        BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
        parent::__construct($model, self::RELATIONS);
    }

    public function list(Array $request){
        $limit = isset($request['limit']) ? $request['limit'] : 10;
        $query = $this->orderingAndFiltering($request);
        
        return $query->paginate($limit);
    }

    public function listPendingReservations(Array $request){
        $limit = isset($request['limit']) ? $request['limit'] : 10;
        $query = $this->orderingAndFiltering($request);
        
        return $query->whereNull('returned_book_at')
            ->whereNull('borrowed_book_at')
            ->whereNotNull('reservation_date')
            ->paginate($limit);
    }

    public function listLoans(Array $request){
        $search = isset($request['search']) ? $request['search'] : ""; 
        $limit = isset($request['limit']) ? $request['limit'] : 10;
        $query = $this->orderingAndFiltering($request);
        
        switch($search){
            case "pending":
                $query = $query->whereNotNull('borrowed_book_at')
                    ->whereNull('returned_book_at');
                break;
            case "returned":
                $query = $query->whereNotNull('borrowed_book_at')
                    ->whereNotNull('returned_book_at');
                break;
            default:
                break;
        }

        return $query->paginate($limit);
    }

    public function storeLoan(Array $request){
        $user_id = $request['user_id'];
        $book_id = $request['book_id'];

        if( $this->canBorrowBooks($user_id) ){
            if( $this->bookRepository->checkAvailability($book_id) ){
                $this->model->user_id = $user_id;
                $this->model->book_id = $book_id;
                $this->model->borrowed_book_at = date('Y-m-d H:i:s');
                $this->model->save();

                return "Se guardo el préstamo correctamente.";
            } else {
                return "El libro no esta disponible para el préstamo.";
            }
        } else {
            return "El usuario no puede tener mas de 5 libros";
        }

    }

    public function storeBooking(Array $request){
        $user_id = $request['user_id'];
        $book_id = $request['book_id'];

        if( !$this->bookRepository->checkAvailability($book_id) ){
            $this->model->user_id = $user_id;
            $this->model->book_id = $book_id;
            $this->model->reservation_date = date('Y-m-d H:i:s');
            $this->model->save();

            return "Se guardo la reserva correctamente.";
        } else {
            return "El libro debe estar disponible para el préstamo.";
        }
    }

    public function returnedBook($booking_id){
        // manejarlo con transacciones
        $borrowed = false;

        $booking = $this->model->where('id', $booking_id)->first();
        $booking->returned_book_at = date('Y-m-d H:i:s');
        //$booking->save();

        if( $booking->save() ){
            $bookings = $this->model->whereNull('borrowed_book_at')
                ->whereNull('returned_book_at')
                ->whereNotNull('reservation_date')
                ->where('book_id', $booking->book_id)
                ->orderBy('reservation_date')
                ->get();
            if( $bookings->count() > 0 ){
                foreach( $bookings as $booking ){
                    if( $this->canBorrowBooks($booking->user_id) &&
                        $this->bookRepository->checkAvailability($booking->book_id) 
                    ){
                        $booking->borrowed_book_at = date('Y-m-d H:i:s');
                        $booking->save();
                        $borrowed = true;
                        break;
                    } else {
                        $borrowed = true;
                        // el usuario tiene la cantidad maxima de libros para ser reservada para él
                        continue;
                    }
                }
            } else {
                $borrowed = true;
            // no hay reserva para asignar el libro
            }
        } else {
            // sólo fallaria en este caso
            return false;
        }
        
        if( $borrowed ){
            //Mail::to($booking->book->email)->send(new AlertBookAvailable($booking->book->title));
            return Mail::to($booking->user->email)
                    ->send(new AlertBookAvailable($booking->book->title, $booking->user->name));
        }

        return $borrowed;
    }

    // tienen un límite de 5 libros pro usuario
    private function canBorrowBooks($user_id){
        return $this->model->where('user_id', $user_id)
                    ->whereNotNull('borrowed_book_at')
                    ->whereNull('returned_book_at')
                    ->get()
                    ->count() < 5;
    }

    private function orderingAndFiltering(Array $request){
        $query = $this->model->query();
        /*if( isset($request['search']) ){
            $query = $query->where('title', "like", "%".$request['search']."%");
        }*/
        if( isset($request['orderby']) && isset($request['sort']) ){
            $query = $query->orderBy($request['sort'], $request['orderby']);
        }

        return $query;
    }

}