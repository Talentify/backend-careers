<?php

namespace App\Services;

use App\Enums\JobStatus;
use App\Models\Job;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class JobService extends AbstractService
{
    protected $model;

    public function __construct() {
        $this->model = new Job();
    }

    public function loadAll() {

        $query = Job::query();
        $query = $this->buildFilters($query, request());

        return $query->where('status', JobStatus::OPEN)
            ->paginate(request()->query('limit') ?? Job::RECORDS_PER_PAGE, ['*'], 'page', request()->query('page') ?? 1);
    }

    public function save(Request $request, Model $job = null) {

        // only owner can update his post
        if ($job && (int) optional(auth()->user()->recruiter)->id !== (int) $job->recruiter_id) {
            throw new UnauthorizedException("Only the owner can update this job.");
        }

        if (!is_null($job) && !empty($job->id)) {

            if (!$job->update($request->all())) {
                throw new \Exception("Fail on update Job with values: "
                    . collect($request->all())->toJson());
            }

        } else {
            if (!$job = Job::create($request->all())) {
                throw new \Exception("Fail on create Job with values: "
                    . collect($request->all())->toJson());
            }

        }

        return $job;
    }

    private function buildFilters(Builder $query, Request $request): Builder {

        $query->when($request->query('keyword'), function ($q) use ($request) {
            return $q->where('title', 'LIKE', '%' . $request->query('keyword') . '%')
                ->orWhere('description', 'LIKE', '%' . $request->query('keyword') . '%')
                ->orWhere('address', 'LIKE', '%' . $request->query('keyword') . '%')
                ->orWhere('salary', $request->query('keyword'))
                ->orWhere('company', 'LIKE', '%' . $request->query('keyword') . '%')
                ->orWhere('status', $request->query('keyword'));
        });

        $query->when($request->query('address'), function ($q) use ($request) {
            return $q->where('address',  'LIKE', '%' . $request->query('address') . '%');
        });

        $query->when($request->query('min_salary'), function ($q) use ($request) {
            return $q->where('salary',  '>=', (float) $request->query('min_salary'));
        });

        $query->when($request->query('max_salary'), function ($q) use ($request) {
            return $q->where('salary',  '<=', (float) $request->query('max_salary'));
        });

        $query->when($request->query('company'), function ($q) use ($request) {
            return $q->where('company',  'LIKE', '%' . $request->query('company') . '%');
        });

        return $query;
    }
}
