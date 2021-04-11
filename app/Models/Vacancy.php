<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'status', 'address', 'salary', 'keyword', 'user_id', 'company_id'];

    public function getResult($filter, $columns = ['*'], $total)
    {
        return $this->where(function($w) use ($filter){
                if(isset($filter) && !is_numeric($filter)){
                    $w->where('title', 'LIKE', "%{$filter}%");
                    $w->orWhere('address', 'LIKE', "%{$filter}%");
                    $w->orWhere('keyword', 'LIKE', "%{$filter}%");
                    $w->orWhere('companies.name', 'LIKE', "%{$filter}%");
                }

                if(is_numeric($filter)){
                    $w->where('salary', $filter);
                }

            })
            ->select($columns)
            ->join('companies', 'companies.id', '=', 'vacancies.company_id')
            ->paginate($total);
    }


    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
