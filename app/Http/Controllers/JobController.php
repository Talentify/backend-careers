<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as Response;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    /**
     * Show jobs.
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $jobs = Job::where('status', true)->get();

        return $this->createApiResponse($jobs, Response::HTTP_OK);
    }

    /**
     * Create a new job.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $user = User::where('token', $request->get('token'))->first();

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:256',
            'description' => 'required|max:10000',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return $this->createApiResponseErrors($validator->errors()->toArray(), Response::HTTP_BAD_REQUEST);
        }

        $job = Job::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'status' => $request->get('status'),
            'workplace' => $request->get('workplace'),
            'salary' => $request->get('salary'),
            'user_id' => $user->id
        ]);

        return $this->createApiResponse($job, Response::HTTP_CREATED);
    }
}
