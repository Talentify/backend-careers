<?php

namespace App\Domain\Vacancies\Model;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{

    protected $fillable = [
        'id',
        'title',
        'descripton',
        'status',
        'address',
        'salary',
        'company',
        'recruiter_id'
    ];

    protected $cast = [
        'status' => 'bolean'
    ];
    
    /**
     * filterSearch
     *
     * @param  mixed $filter
     * @return void
     */
    public function filterSearch(array $filter)
    {
        if (isset($filter['company'])) {
            $this->where('company', 'ilike', $filter['company']);
        }

        if (isset($filter['address'])) {
            $this->where('address', 'ilike', $filter['address']);
        }
    }
}