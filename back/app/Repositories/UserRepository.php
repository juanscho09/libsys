<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    const RELATIONS = [];

    public function __construct(User $model)
    {
        parent::__construct($model, self::RELATIONS);
    }

    public function store(array $array){
        $array['password'] = Hash::make($array['password']);
        return parent::create($array);
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