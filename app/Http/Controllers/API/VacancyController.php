<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\CommonController;
use App\Models\Vacancy;

class VacancyController extends CommonController
{
    public function __construct(Vacancy $model)
    {
        $this->model = $model;
        $this->resource = "\App\Http\Resources\VacancyResource";
    }
}
