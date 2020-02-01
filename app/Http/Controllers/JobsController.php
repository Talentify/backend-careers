<?php

namespace App\Http\Controllers;


use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Rules\Double;
use App\Services\JobsService;
use Illuminate\Validation\Rule;

/**
 * Class JobsController
 * @package App\Http\Controllers
 */
class JobsController extends Controller
{

    /**
     * @param Request $request
     * @param JobsService $jobsService
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request, JobsService $jobsService)
    {
        $rules = [
            'title'       => 'required|string|min:1|max:256',
            'description' => 'required|string|min:1|max:1000',
            'status'      => [
                'required',
                Rule::in(['enable', 'disable'])
            ],
            'workplace'   => [
                'nullable',
                'json'
            ],
            'salary'      => [
                'nullable',
                new Double(15, 2)
            ]
        ];


        $this->validate($request, $rules);

        $job = $jobsService->create($request->all(array_keys($rules)));

        return new JsonResponse($job->toArray(), Response::HTTP_CREATED);
    }
}
