<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder as EloquentQueryBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Pagination\AbstractPaginator as Paginator;

abstract class AbstractRepository
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Application constructor
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    protected function buildQuery()
    {
        return $this->app->make($this->model)->newQuery();
    }

    protected function runQuery($query = null, $records = 15, $paginate = true)
    {
        if (is_null($query)) {
            $query = $this->buildQuery();
        }

        if ($paginate == true) {
            return $query->paginate($records);
        }

        if ($records > 0 || $records !== false) {
            $query->take($records);
        }

        return $query->get();
    }

    public function findAll($records = 15, $paginate = true)
    {
        return $this->runQuery(null, $records, $paginate);
    }

    public function create(array $data)
    {
        return $this->buildQuery()->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->buildQuery()->find($id);
        
        $record->fill($data);
        
        return $record->save();
    }

    public function delete($id)
    {
        $record = $this->buildQuery()->find($id);
        
        return $record->delete();
    }

    public function pluck($column, $key = null)
    {
        return $this->buildQuery()->pluck($column, $key);
    }

    public function findById($id, $fail = true)
    {
        if ($fail == true) return $this->buildQuery()->findOrFail($id);

        return $this->buildQuery()->find($id);
    }
}