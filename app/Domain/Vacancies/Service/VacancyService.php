<?php

namespace App\Domain\Vacancies\Service;

use App\Domain\Vacancies\Model\Vacancy;

class VacancyService
{

    private $model;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Vacancy(); 
    }
    
    /**
     * getAll
     *
     * @param  mixed $filters
     * @return void
     */
    public function getAll($filters = [])
    {
        return $this->model->filterSearch($filters)->get();
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
     * update
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function update(array $data, $id)
    {
        $recruterId = auth()->user()->id;

        $vacancy = $this->model->find($id);
        if ($vacancy->recruiter_id != $recruterId) {
            throw new \Exception("Don't permit this operation!");
        }

        $vacancy->fill($data);
        $vacancy->update();
        return $vacancy;
    }
    
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $recruterId = auth()->user()->id;

        $vacancy = $this->model->find($id);
        if ($vacancy->recruiter_id != $recruterId) {
            throw new \Exception("Don't permit this operation!");
        }
        
        $vacancy->delete();
        return $vacancy;
    }
}