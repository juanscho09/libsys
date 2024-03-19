<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\NotFoundException;

class BaseRepository
{
    protected $model;
    private $relations;

    public function __construct(Model $model, array $relations = [])
    {
        $this->model = $model;
        $this->relations = $relations;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function paginate($limit = 10)
    {
        $query = $this->model;
        if( !empty($this->relations) )
            $query = $query->with($this->relations);
        return $query->paginate($limit);
    }

    public function find($id)
    {
        $query = $this->model;
        if( !empty($this->relations) )
            $query = $query->with($this->relations);
        $model_found = $query->find($id);
        if( is_null($model_found) )
            throw new NotFoundException("No se encontró el elemento buscado.");
        return $model_found;
    }

    public function create(array $data)
    {
        $model_created = $this->model->create($data);
        return $this->find($model_created->id);
    }

    public function update(array $data, $id)
    {
        $this->model->where('id', $id)->update($data);
        return $this->find($id);
    }

    public function delete(Model $model)
    {
        $model->delete();
        return $model;
    }

    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
