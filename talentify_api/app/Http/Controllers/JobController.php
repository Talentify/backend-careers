<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function getall()
    {
        return Job::all();
    }

    public function getopen()
    {
        return Job::where('status', 'O')
        ->orderBy('created_at')
        ->get();
    }

    public function show(Job $job)
    {   
        return $job;
    }

    public function store(Request $request)
    {   
        $job = Job::create([
            'id_recruiters_creator' => 1,
            'title' => $request->title,
            'description' => $request->description,
            'address' => $request->address,
            'salary' => $request->salary,
            'company' => $request->company,     
        ]);
        
        return response()->json($job, 201);
    }   
    
    public function update(Request $request, Job $job)
    {   
        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'address' => $request->address,
            'salary' => $request->salary,
            'company' => $request->company,
        ]);
        
        return response()->json($job, 200);
    }

    public function delete(Job $job)
    {
        $job->delete();
        
        return response()->json(null, 204);
    }

    public function filter(Request $request)
    {   
        return Job::where('status', 'O')
                ->where(function ($query) {
                $query->where('title', 'LIKE', '%'.$request->keyword.'%')
                ->orWhere('description', 'LIKE', '%'.$request->keyword.'%')
                ->orWhere('address', 'LIKE', '%'.$request->keyword.'%')
                ->orWhere('salary', 'LIKE', '%'.$request->keyword.'%')
                ->orWhere('company', 'LIKE', '%'.$request->keyword.'%')
                ->orWhere('address', 'LIKE', '%'.$request->address.'%')
                ->orWhere('salary', 'LIKE', '%'.$request->salary.'%')
                ->orWhere('company', 'LIKE', '%'.$request->company.'%');                
            })
            ->get();
    }
}
