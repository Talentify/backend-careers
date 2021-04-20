<?php

namespace App\Services;

use App\Models\Match;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MatchService extends AbstractService
{
    protected $model;

    public function __construct() {
        $this->model = new Match();
    }

    public function loadAll() {

        $query = Match::query();
        $query = $this->buildFilters($query, request());

        return $query->get();
    }

    private function buildFilters(Builder $query, Request $request): Builder {

        $query->when($request->query('date'), function ($q) use ($request) {
            return $q->where('date', $request->query('date'));
        });

        $query->when($request->query('home_team_id'), function ($q) use ($request) {
            return $q->where('home_team_id', $request->query('home_team_id'));
        });

        $query->when($request->query('visitor_team_id'), function ($q) use ($request) {
            return $q->where('visitor_team_id', $request->query('visitor_team_id'));
        });

        $query->when($request->filled('sort'),
            function ($q) use ($request) {
                return $q->orderBy($request->query('sort'),
                    $request->query('order', 'asc') === 'asc' ? 'asc' : 'desc');
            });

        return $query;
    }
}
