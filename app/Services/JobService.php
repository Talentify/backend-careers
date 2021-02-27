<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Repositories\Contracts\JobRepositoryInterface;
use App\Validators\JobValidator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class JobService
{
    protected $repository;
    protected $jobValidator;


    public function __construct(JobRepositoryInterface $repository, JobValidator $jobValidator)
    {
        $this->repository = $repository;
        $this->jobValidator = $jobValidator;
    }

    public function find(int $id)
    {
        try {
            if (Gate::denies('job-view')) {
                return [
                    'success' => false,
                    'message' => 'Unauthorized access.',
                ];
            }
            $job = $this->repository->find($id);
            return [
                'success' => true,
                'message' => 'Job found.',
                'data' => $job
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function create(Request $request)
    {
        try {
            if (Gate::denies('job-create')) {
                return [
                    'success' => false,
                    'message' => 'Unauthorized access.',
                ];
            }
            $result = Helper::validatePayload($request);

            if (!$result['success']) {
                return $result;
            }
            $validator = Validator::make(
                $request->all(),
                $this->jobValidator->rule,
                $this->jobValidator->customMessage
            );

            if ($validator->fails()) {
                return [
                    'success' => false,
                    'message' => $validator->errors(),
                ];
            }
            $job = $this->repository->create($request->all());

            return [
                'success' => true,
                'message' => 'Job created successfully.',
                'data' => $job
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if (Gate::denies('job-update')) {
                return [
                    'success' => false,
                    'message' => 'Unauthorized access.',
                ];
            }
            $result = Helper::validatePayload($request);

            if (!$result['success']) {
                return $result;
            }
            $validator = Validator::make(
                $request->all(),
                $this->jobValidator->rule,
                $this->jobValidator->customMessage
            );

            if ($validator->fails()) {
                return [
                    'success' => false,
                    'message' => $validator->errors(),
                ];
            }
            $job = $this->repository->update($id, $request->all());

            return [
                'success' => true,
                'message' => 'Job updated successfully.',
                'data' => $job
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function destroy(int $id)
    {
        if (Gate::denies('job-destroy')) {
            return [
                'success' => false,
                'message' => 'Unauthorized access.',
            ];
        }
        try {
            $this->repository->destroy($id);
            return [
                'success' => true,
                'message' => 'Successfully deleted.',
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
