<?php

namespace App\Repositories;

use App\Model\Jobs;
use Illuminate\Support\Collection;

class JobsEloquentRepository implements Contracts\JobsInterface
{

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return Jobs::create($data);
    }

    /**
     * @param string $status
     * @return Collection
     */
    public function findByStatus(string $status): Collection
    {
        return Jobs::where('status', $status)->get();
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return Jobs::all();
    }

    /**
     * @param int $jobId
     * @return mixed
     */
    public function find(int $jobId)
    {
        return Jobs::find($jobId);
    }

    /**
     * @param array $jobData
     * @return mixed
     */
    public function update(array $jobData)
    {
        return Jobs::where('id', $jobData['id'])
            ->update(current($jobData));
    }

    /**
     * @param int $jobId
     * @return int
     */
    public function delete(int $jobId)
    {
        return Jobs::destroy($jobId);
    }
}