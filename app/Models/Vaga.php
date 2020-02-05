<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaga extends Model {

    public $timestamps = false;
    protected $fillable = ['titulo', 'descricao', 'situacao', 'salario'];

}
