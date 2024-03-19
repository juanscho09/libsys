<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Booking;
use Exception;
use Carbon\Carbon;

class BookRepository extends BaseRepository
{
    const RELATIONS = [];

    public function __construct(
        Book $model
    ){
        parent::__construct($model, self::RELATIONS);
    }

    public function store(Array $request){
        $request['publication_date'] = date('Y-m-d H:i:s', strtotime($request['publication_date']));
        return $this->model->create($request);
    }

    public function update(array $request, $id){
        $request['publication_date'] = date('Y-m-d H:i:s', strtotime($request['publication_date']));
        return parent::update($request, $id);
    }

    public function checkAvailability($id){
        return Booking::where('book_id', $id)
            ->whereNotNull('borrowed_book_at')
            ->whereNull('returned_book_at')
            ->get()->count() == 0;
    }

    public function list(Array $request){
        $limit = isset($request['limit']) ? $request['limit'] : 10;

        $query = $this->model->query();
        if( isset($request['search']) ){
            $query = $query->where('title', "like", "%".$request['search']."%");
        }
        if( isset($request['orderby']) && isset($request['sort']) ){
            $query = $query->orderBy($request['sort'], $request['orderby']);
        }

        return $query->paginate($limit);
    }
}