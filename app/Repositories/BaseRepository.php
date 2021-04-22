<?php


namespace App\Repositories;


use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Exceptions\NotModelDefined;

class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function first()
    {
        $this->model = $this->model->first();

        return $this;
    }

    public function select(...$fields)
    {
        return $this->model
            ->select($fields)
            ->get();
    }

    public function selectFields(...$fields)
    {
        $this->model = $this->model->select($fields);

        return $this;
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function findWhereField($column, $field)
    {
        $this->model = $this->model->where($column, $field);

        return $this;
    }

    public function findWhere($column, $valor)
    {
        return $this->model
            ->where($column, $valor)
            ->get();
    }

    public function findWhereNoGet($column, $valor)
    {
        return $this->model
            ->where($column, $valor);
    }

    public function findWhereFirst($column, $valor)
    {
        return $this->model
            ->where($column, $valor)
            ->first();
    }

    public function paginate($totalPage = 15)
    {
        return $this->model->paginate($totalPage);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $request)
    {
        $model = $this->findById($id);

        if(!$model) {
            return false;
        }

        return $model->update($request);
    }

    public function updateSingle($id, $field, $value)
    {
        $model = $this->findById($id);

        if(!$model) {
            return false;
        }

        $data[$field] = $value;
        return $model->update($data);
    }

    public function delete($id)
    {
        $model = $this->findById($id);

        if(!$model) {
            return false;
        }

        return $this->model->find($id)->delete();
    }

    public function relationships(...$relationships)
    {
        $this->model = $this->model->with($relationships);

        return $this;
    }

    public function orderBy($column, $order = 'DESC')
    {
        $this->model = $this->model->orderBy($column, $order);

        return $this;
    }

    public function resolveModel()
    {
        if (!method_exists($this, 'model')) {
            throw new NotModelDefined();
        }

        //Cria objeto do Model informado
        return app($this->model());
    }
}
