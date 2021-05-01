<?php

namespace App\Domain\Companies\Service;

use App\Domain\Companies\Model\Company;

class CompanyService
{

    private $model;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Company(); 
    }
    
    /**
     * getAll
     *
     * @param  mixed $filters
     * @return void
     */
    public function getAll($filters = [])
    {
        return $this->model->all();
    }
    
    /**
     * create
     *
     * @param  mixed $data
     * @return void
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }
}