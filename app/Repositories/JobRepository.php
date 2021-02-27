<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Job;
use App\Repositories\Contracts\JobRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class JobRepository implements JobRepositoryInterface
{
    protected $modeljob;
    protected $modelAddress;

    public function __construct(Job $modeljob, Address $address)
    {
        $this->modeljob = $modeljob;
        $this->modelAddress = $address;
    }

    public function all(): Collection
    {
        return $this->modeljob->all();
    }

    public function create(array $data): Model
    {
        DB::beginTransaction();
        try {
            $job = [
                'title' => $data['title'],
                'description' => $data['description'],
                'status' => $data['status'],
                'salary' => isset($data['salary']) ? $data['salary'] : null,
            ];
            $mJob = $this->modeljob->create($job);

            if (isset($data['workplace']) && count($data['workplace']) > 0) {
                $mAddress = $this->modelAddress->create($data['workplace']);
                $mJob->address()->save($mAddress);
            }
            DB::commit();
            return $mJob;
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception($e->getMessage());
        }
    }

    public function find(int $id): Model
    {
        try {
            return $this->modeljob->findOrFail($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $job = $this->modeljob->findOrFail($id);
            $job->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(int $id, array $data): Model
    {
        DB::beginTransaction();
        try {
            $mJob = $this->modeljob->findOrFail($id);

            if (isset($data['workplace']) && count($data['workplace']) > 0) {
                $mAddress = $this->modelAddress->where('job_id', $id)->update($data['workplace']);
            }
            $job = [
                'title' => $data['title'],
                'description' => $data['description'],
                'status' => $data['status'],
                'salary' => isset($data['salary']) ? $data['salary'] : null,
            ];
            $mJob = $mJob->where('id', $id)->updateOrCreate($job);
            DB::commit();

            return $mJob;
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception($e->getMessage());
        }
    }
}
