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
            'title'             => 'required|string|min:1|max:256',
            'description'       => 'required|string|min:1|max:1000',
            'status'            => [
                'required',
                Rule::in(['enable', 'disable'])
            ],
            'workplace'         => 'nullable',
            'workplace.street'  => 'required_with:workplace|min:1|max:256',
            'workplace.number'  => 'required_with:workplace|numeric',
            'workplace.city'    => 'required_with:workplace|min:1|max:256',
            'workplace.state'   => 'required_with:workplace|min:1|max:256',
            'workplace.country' => 'required_with:workplace|min:1|max:256',
            'salary'            => [
                'nullable',
                new Double(15, 2)
            ]
        ];

        $this->validate($request, $rules);

        $job = $jobsService->create(
            $request->all(
                [
                    'title',
                    'description',
                    'status',
                    'salary',
                    'workplace'
                ]
            )
        );

        return new JsonResponse($job->toArray(), Response::HTTP_CREATED);
    }

    /**
     * @param $id
     * @param Request $request
     * @param JobsService $jobsService
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($id, Request $request, JobsService $jobsService)
    {
        $rules = [
            'title'             => 'string|min:1|max:256',
            'description'       => 'string|min:1|max:1000',
            'status'            => [
                Rule::in(['enable', 'disable'])
            ],
            'workplace'         => 'nullable',
            'workplace.street'  => 'required_with:workplace|min:1|max:256',
            'workplace.number'  => 'required_with:workplace|numeric',
            'workplace.city'    => 'required_with:workplace|min:1|max:256',
            'workplace.state'   => 'required_with:workplace|min:1|max:256',
            'workplace.country' => 'required_with:workplace|min:1|max:256',
            'salary'            => [
                'nullable',
                new Double(15, 2)
            ]
        ];

        $this->validate($request, $rules);

        $job = $jobsService->update(
            $id,
            $request->all()
        );

        return new JsonResponse($job->toArray(), Response::HTTP_OK);
    }
}
