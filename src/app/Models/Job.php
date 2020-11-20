<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

    use HasFactory;

    const STATUS_ACTIVE = 'Active';
    const STATUS_CANCELLEd = 'Cancelled';
    const STATUS_COMPLETED = 'Completed';

    protected $fillable = ['title', 'description', 'status', 'salary', 'workplace'];
    public $timestamp = true;

}
