<?php


namespace App\Repositories\Contracts;


interface RepositoryInterface
{
    public function getAll();
    public function select();
    public function findById($id);
    public function findWhere($column, $valor);
    public function findWhereFirst($column, $valor);
    public function paginate($totalPage = 15);
    public function store(array $data);
    public function update($id, array $data);
    public function updateSingle($id, $field, $value);
    public function delete($id);
    public function orderBy($column, $order = 'DESC');
}
