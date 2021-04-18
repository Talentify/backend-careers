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
        
        $jobList = Job::where('status', 'O')                
                ->when($request->address != null && $request->address != "", 
                function ($query) use ($request) {
                    return $query->where('address', 'LIKE', '%'.$request->address.'%');
                })
                ->when($request->salary != null && $request->salary != "", 
                function ($query) use ($request) {
                    return $query->where('salary', 'LIKE', '%'.$request->salary.'%');
                })
                ->when($request->company != null && $request->company != "", 
                function ($query) use ($request) {
                    return $query->where('company', 'LIKE', '%'.$request->company.'%');
                })               
                ->when($request->keyword != null && $request->keyword != "", 
                function ($query) use ($request) {
                    return $query->where('title', 'LIKE', '%'.$request->keyword.'%')
                        ->orWhere('description', 'LIKE', '%'.$request->keyword.'%')
                        ->orWhere('address', 'LIKE', '%'.$request->keyword.'%')
                        ->orWhere('salary', 'LIKE', '%'.$request->keyword.'%')
                        ->orWhere('company', 'LIKE', '%'.$request->keyword.'%');
                });

            
            return $jobList->get();
            
    }
}
