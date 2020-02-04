<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jobs = (new User);

        if (isset($request->page) && $request->page != "") {
            $jobs = $jobs->paginate($request->paginate ?? 10);

            return response()->json($jobs);
        }

        return response()->json($jobs->get());
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $job = (new User)->create($request->all());

            return response()->json(['message' => 'User created successfully'], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
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
        try {
            $job = (new User)->findOrFail($jobId);
            return response()->json($job);
        } catch (Exception $e) {
            return response()->json(['message' => 'Not Found'], 404);
        }        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  integer $jobId
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $jobId)
    {
        try {
            $job = (new User)->findOrFail($jobId);

            $job->fill($request->all())->save();

            if (!$job) {
                return response()->json(['message' => 'An error ocurred while updating'], 422);
            }

            return response()->json(['message' => 'User updated successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Not Found'], 404);
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
            $job = (new User)->findOrFail($jobId);
            
            $job->delete();

            if (!$job) {
                return response()->json(['message' => 'An error ocurred while deleting'], 422);
            }

            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
