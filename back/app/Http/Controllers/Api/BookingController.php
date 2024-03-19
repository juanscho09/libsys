<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Repositories\BookingRepository;
use App\Http\Requests\Booking\StoreBookingRequest;
use App\Http\Requests\Booking\UpdateBookingRequest;
use App\Exceptions\NotFoundException;

class BookingController extends BaseController
{
    
    /**
     * The repository instance.
     */
    protected $bookingRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\BookingRepository  $bookingRepository
     * @return void
     */
    function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
        //$this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bookings = $this->bookingRepository->list($request->all());
        return $this->successPaginateResponse($bookings);
    }
    
    /**
     * Display a listing of the resource filtered by reservation_date.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPendingReservations(Request $request)
    {
        $bookings = $this->bookingRepository->listPendingReservations($request->all());
        return $this->successPaginateResponse($bookings);
    }

    /**
     * Display a listing of the resource filtered by loans.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexLoans(Request $request)
    {
        $bookings = $this->bookingRepository->listLoans($request->all());
        return $this->successPaginateResponse($bookings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a loan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeLoan(Request $request)
    {
        try{
            $book_saved = $this->bookingRepository->storeLoan($request->all());
        }catch(NotFoundException $ex){
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }catch(\Exception $ex){
            return $this->errorResponse("Error al crear el prestamo.".$ex->getMessage(), 500);
        }

        return $this->successResponse($book_saved, 201);
    }

    /**
     * Store a booking.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBooking(Request $request)
    {
        try{
            $book_saved = $this->bookingRepository->storeBooking($request->all());
        }catch(NotFoundException $ex){
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }catch(\Exception $ex){
            return $this->errorResponse("Error al crear la reserva.".$ex->getMessage(), 500);
        }

        return $this->successResponse($book_saved, 201);
    }

    /**
     * Return a book.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function returned(Request $request, $booking)
    {
        try{
            $book_saved = $this->bookingRepository->returnedBook($booking);
        }catch(NotFoundException $ex){
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }catch(\Exception $ex){
            return $this->errorResponse("Error al procesar la tarea.".$ex->getMessage(), 500);
        }

        return $this->successResponse($book_saved, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking = $this->bookingRepository->delete($booking);
        return $this->successResponse($booking, 204);
    }
}
