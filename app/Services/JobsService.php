<?php

namespace App\Services;

use App\Models\Jobs;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class JobsService
 * @package App\Services
 */
class JobsService
{
    /**
     * @param int $totalPerPage
     * @return mixed
     */
    public function getJobsActiveWithPaginate(int $totalPerPage): LengthAwarePaginator
    {
        $jobs = Jobs::where('status', 'active')
            ->orderBy('id', 'desc')
            ->paginate($totalPerPage);

        if (!$jobs instanceof LengthAwarePaginator) {
            throw new \RuntimeException('Não foi possível obter as vagas disponíveis!');
        }

        return $jobs;
    }

    public function getTotalActiveJobs(): int
    {
        $totalActiveJobs = Jobs::where('status', 'active')->get()->count();

        if (!is_int($totalActiveJobs)) {
            throw new \RuntimeException('Não foi possível obter o total de vagas ativas!');
        }

        return $totalActiveJobs;
    }

    public function getTotalInactiveJobs(): int
    {
        $totalInactiveJobs = Jobs::where('status', 'inactive')->get()->count();

        if (!is_int($totalInactiveJobs)) {
            throw new \RuntimeException('Não foi possível obter o total de vagas inativas!');
        }

        return $totalInactiveJobs;
    }

    public function getAllJobs(): Collection
    {
        $jobs = Jobs::all();

        if (!$jobs instanceof Collection) {
            throw new \RuntimeException('Não foi possível acessar as vagas cadastradas!');
        }
        return $jobs;
    }

    public function createJob(array $job): Jobs
    {
        if (!is_array($job)) {
            throw new \RuntimeException('É necessário informar todos os dados para efetuar o cadastro da vaga.');
        }

        $jobCreate = Jobs::create($job);

        if (!$jobCreate instanceof Jobs) {
            throw new \RuntimeException('Erro ao cadastrar nova vaga.');
        }

        return $jobCreate;
    }

    public function getJobByUuid(string $uuid): Jobs
    {
        try {
            $job = Jobs::where('uuid', $uuid)->firstOrFail();

            return $job;
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
}
