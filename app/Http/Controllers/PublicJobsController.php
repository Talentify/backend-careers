<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Job;

class PublicJobsController
{
    public static function index(Request $request)
    {
        $list = (new Job())->all();

        return view('job_list', ['jobs' => $list]);
    }
}
