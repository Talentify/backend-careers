<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Requests\JobRequest;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jobs = (new Job)->where('status', 'opened');

        if (isset($request->page) && $request->page != "") {
            $jobs = $jobs->paginate($request->paginate ?? 10);

            return response()->json($jobs);
        }

        return response()->json($jobs->get());
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\JobRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        try {
            $job = (new Job)->create($request->all());

            return response()->json(['message' => 'Job created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'A error ocurred while inserting'], 500);
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $jobId
     * @return \Illuminate\Http\Response
     */
    public function show($jobId)
    {
        $job = (new Job)->findOrFail($jobId);
        return response()->json($job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\JobRequest  $request
     * @param  integer $jobId
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, $jobId)
    {
        try {
            $job = (new Job)->findOrFail($jobId);

            $job->fill($request->all())->save();

            return response()->json(['message' => 'Job updated successfully'], 200);
        } catch (\Exception $e) {
            // dd($e);
            return response()->json(['message' => 'A error ocurred while updating'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $jobId
     * @return \Illuminate\Http\Response
     */
    public function destroy($jobId)
    {
        try {
            $job = (new Job)->findOrFail($jobId);
            
            $job->delete();
            return response()->json(['message' => 'Job deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' =>  'A error ocurred while deleting'], 500);
        }
    }
}
