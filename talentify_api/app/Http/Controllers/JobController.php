<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiResponseController as ApiResponseController;


class JobController extends ApiResponseController
{
    public function getall()
    {   
        $jobs = Job::all();           
        return $this->sendResponse($jobs, 'All jobs retrieved successfully!');
    }

    public function getopen()
    {   
        $openJobs = Job::where('status', 'O')
        ->orderBy('created_at')
        ->get();

        return $this->sendResponse($openJobs, 'All open jobs retrieved successfully!');
    }

    public function show(Job $job)
    {                
        return $this->sendResponse([$job], 'Job retrieved successfully!'); 
    }

    public function store(Request $request)
    {   
        $loggedRecruiter = auth()->user();
        
        $fields = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'string',
            'address' => 'string',
            'salary' => 'required',
            'company' => 'required',
        ]);
        
        $job = Job::create([
            'id_recruiters_creator' => $loggedRecruiter->id,
            'title' => $fields['title'],
            'description' => $fields['description'],
            'address' => $fields['address'],
            'salary' => $fields['salary'],
            'company' => $fields['company'],
        ]);
        
        return $this->sendResponse($job, 'Job created successfully!', 201);
    }   
    
    public function update(Request $request, Job $job)
    {   
        $loggedRecruiter = auth()->user();
        
        if($job->id_recruiters_creator != $loggedRecruiter->id){
            return $this->sendError('Unauthorized user',[], 401);            
        }

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'address' => 'string',
            'salary' => 'required',
            'company' => 'required',
        ]);
        
        $job->update($request->all());
        
        return $this->sendResponse($job, 'Job updated successfully!', 201);
    }

    public function delete(Job $job)
    {
        $loggedRecruiter = auth()->user();

        if($job->id_recruiters_creator != $loggedRecruiter->id){
            return $this->sendError('Unauthorized user',[], 401);            
        }

        $job->delete();
        
        return $this->sendResponse($job, 'Job deleted successfully!');
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

        
        return $this->sendResponse($jobList->get(), 'All jobs retrieved successfully!');                
    }
}
