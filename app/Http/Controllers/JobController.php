<?php

namespace App\Http\Controllers;

use App\Http\Services\JwtService;
use App\Models\Job\CreateJob;
use App\Models\Job\DeleteJob;
use App\Models\Job\GetJob;
use App\Models\Job\UpdateJob;
use Illuminate\Http\Request;
use App\Models\Job\SearchHandler;
use Tests\Feature\Http\Models\Job\ValidateSearchKey;

class JobController extends Controller
{
    public function create(Request $request)
    {
        try {
            $token = $request->header('Authorization');
            $decodeToken = JwtService::decodeToken($token);

            $job = CreateJob::store($request, $decodeToken->id);

            return response()->json($job, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function read(string $id)
    {
        try {
            $job = GetJob::getJobById($id);

            return response()->json($job, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $job = UpdateJob::update($request, $id);

            return response()->json($job, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function delete(string $id)
    {
        try {
            DeleteJob::delete($id);

            return response()->json(null, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function getAllOpenJobs()
    {
        try {
            $jobs = GetJob::getAllOpenJobs();

            return response()->json($jobs, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function search(Request $request)
    {
        try {
            $queryStrings = $request->query();

            SearchHandler::validate($queryStrings);
            $key = SearchHandler::extractQueryKey($queryStrings);

            $jobs = GetJob::getJobBySearch($key, $queryStrings[$key]);

            return response()->json($jobs, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

}
