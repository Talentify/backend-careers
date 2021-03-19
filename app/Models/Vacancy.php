<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $table = 'vacancy_tb';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];
    protected $filleable = [
        'title',
        'description',
        'status',
        'address',
        'salary',
        'company'
    ];

    public function rules(){
        return [
        'title'=>'required',
        'description'=>'required',
        'status'=>'required',
        'address'=>'required',
        'salary'=>'required',
        'company'=>'required'
        ];
    }
}
