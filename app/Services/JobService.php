<?php

namespace App\Services;

use App\Models\Job;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class JobService extends AbstractService
{
    protected $model;

    public function __construct() {
        $this->model = new Job();
    }

    public function loadAll() {

        $query = Job::query();
        $query = $this->buildFilters($query, request());

        return $query->paginate(request()->query('limit') ?? Job::RECORDS_PER_PAGE, ['*'], 'page', request()->query('page') ?? 1);
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
            return $q->where('salary',  '>=', $request->query('min_salary'));
        });

        $query->when($request->query('max_salary'), function ($q) use ($request) {
            return $q->where('salary',  '<=', $request->query('max_salary'));
        });

        $query->when($request->query('company'), function ($q) use ($request) {
            return $q->where('company',  'LIKE', '%' . $request->query('company') . '%');
        });

        return $query;
    }
}
