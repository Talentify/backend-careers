<?php

namespace App\Domain\ValuesObjects;

use App\Core\Contracts\CollectionContract;
use App\Domain\Entity\Vacancy;
use Exception;

class VacancyList implements CollectionContract
{
    protected $vacancies;

    public function __construct(array $vacancies = [])
    {
        $this->vacancies = $vacancies;
    }

    /**
     * @param Vacancy $vacancy
     * @param string|null $key
     * @return $this
     * @throws Exception
     */
    public function add($vacancy, string $key = null): VacancyList
    {
        if(is_null($key)) {
            $this->vacancies[] = $vacancy;
            return $this;
        }
        if(isset($this->vacancies[$key])) {
            throw new Exception("Key $key already in use.");
        }
        $this->vacancies[$key] = $vacancy;
    }

    /**
     * @param $key
     * @return $this
     * @throws Exception
     */
    public function delete($key): VacancyList
    {
        if(isset($this->vacancies[$key])){
            unset($this->vacancies[$key]);
            return $this;
        }
        if(!isset($this->vacancies[$key])){
            throw new Exception("Invalid key $key");
        }
    }

    /**
     * @param $key
     * @return mixed
     * @throws Exception
     */
    public function get($key)
    {
        if(isset($this->vacancies[$key])) {
            return $this->vacancies[$key];
        }
        if(!isset($this->vacancies[$key])) {
            throw new Exception("Invalid key $key");
        }
    }

    public function all(): array
    {
        return $this->vacancies;
    }
}
