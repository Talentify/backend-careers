<?php

namespace App\Domain\Recruiters\Service;

use App\Domain\Recruiters\Model\Recruiter;

class RecruiterService
{

    private $model;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Recruiter(); 
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
    
        
    /**
     * getByEmail
     *
     * @param  mixed $email
     * @return void
     */
    public function getByEmail($email)
    {
        return $this->model->where([
            'email' => $email
        ])->first();
    }
}