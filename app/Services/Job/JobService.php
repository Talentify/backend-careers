<?php

namespace App\Services\Job;


use App\Models\Job;
use App\Services\Recruiter\RecruiterService;

class JobService
{
    protected RecruiterService $recruiterService;

    public function __construct(RecruiterService $recruiterService)
    {
        $this->recruiterService = $recruiterService;
    }

    public function create(array $params): array
    {
        $job = Job::create($params);

        return [
            'job' => $job
        ];
    }

    public function find(int $jobId): ?Job
    {
        return Job::find($jobId);
    }

    public function update(int $jobId, int $recruiterId, array $params): array
    {
        $recruiter = $this->recruiterService->find($recruiterId);
        $job = $this->find($jobId);
        if (!$job || $recruiter->company_id != $job->company_id) {
            return [
                'error' => 'Você não tem permissão para editar essa vaga.',
            ];
        }
        $job->update($params);

        return [
            'job' => $job,
        ];
    }

    public function search($query)
    {
        $model = Job::query();
        if(isset($query['company_id'])) {
            $model->orWhere('company_id', $query['company_id']);
        }
        if(isset($query['address'])) {
            $model->orWhere('address', 'like', '%' . $query['address'] . '%');
        }
        if(isset($query['salary'])) {
            $model->orWhere('salary', '>=', $query['salary']);
        }
        if(isset($query['keywords'])) {
            $keywords = explode(',', $query['keywords']);
            foreach($keywords as $keyword) {
                $model->orWhere('title', 'like', '%' . $keyword . "%");
                $model->orWhere('description', 'like', '%' . $keyword . "%");
            }
        }

        $model->with('company');

        return ['jobs' => $model->get()];
    }
}
