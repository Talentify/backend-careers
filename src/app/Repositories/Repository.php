<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getByID($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function insert($data)
    {
        $this->model->fill($data);
        return $this->model->save();
    }

    public function create($data)
    {
        $result = $this->model->create($data);
        return $result;
    }

    public function update($id, $data)
    {
        $this->model->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        $this->model->where('id', $id)->delete();
    }

}
