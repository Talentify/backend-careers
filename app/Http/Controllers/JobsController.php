<?php

namespace App\Http\Controllers;


use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Rules\Double;
use App\Services\JobsService;
use Illuminate\Validation\Rule;
use App\Services\UsersService;

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

    /**
     * @param $id
     * @param JobsService $jobsService
     * @return mixed
     */
    public function get($id, JobsService $jobsService)
    {
        return $jobsService->get($id);
    }

    /**
     * @param $id
     * @param JobsService $jobsService
     * @return mixed
     */
    public function delete($id, JobsService $jobsService)
    {
        $jobsService->delete($id);
        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @param Request $request
     * @param JobsService $jobsService
     * @return JsonResponse
     */
    public function getAll(Request $request, JobsService $jobsService)
    {
        return new JsonResponse($jobsService->getAll($request->all()), Response::HTTP_OK);
    }

    /**
     * @param $id
     * @param Request $request
     * @param UsersService $usersService
     * @return JsonResponse
     */
    public function apply($id, Request $request, UsersService $usersService)
    {
        return new JsonResponse($usersService->apply($id), Response::HTTP_OK);
    }
}
