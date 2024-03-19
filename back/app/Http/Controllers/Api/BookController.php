<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Repositories\BookRepository;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Exceptions\NotFoundException;

class BookController extends BaseController
{
    /**
     * The repository instance.
     */
    protected $bookRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\BookRepository  $bookRepository
     * @return void
     */
    function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
        //$this->middleware('auth:api');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$books = $this->bookRepository->paginate($request->perPage);
        $books = $this->bookRepository->list($request->all());
        return $this->successPaginateResponse($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        try{
            $book_saved = $this->bookRepository->store($request->all());
        }catch(NotFoundException $ex){
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }catch(\Exception $ex){
            return $this->errorResponse("Error al crear el libro.".$ex->getMessage(), 500);
        }

        return $this->successResponse($book_saved, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        try{
            $book_found = $this->bookRepository->find($book->id);
        }catch(NotFoundException $ex){
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }catch(\Exception $ex){
            return $this->errorResponse("Error al buscar el libro: ".$ex->getMessage(), 500);
        }

        return $this->successResponse($book_found);
    }

    /**
     * Check availability
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function availability(Book $book)
    {
        try{
            $book_found = $this->bookRepository->checkAvailability($book->id);
        }catch(NotFoundException $ex){
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }catch(\Exception $ex){
            return $this->errorResponse("Error al buscar el libro: ".$ex->getMessage(), 500);
        }

        return $this->successResponse($book_found);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        try{
            $book_updated = $this->bookRepository->update($request->all(), $book->id);
        }catch(NotFoundException $ex){
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }catch(\Exception $ex){
            return $this->errorResponse("Error al editar el libro: ".$ex->getMessage(), 500);
        }

        return $this->successResponse($book_updated, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book = $this->bookRepository->delete($book);
        return $this->successResponse($book, 204);
    }

}
