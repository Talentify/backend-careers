<?php

namespace App\Repositories;

use App\Models\Job;
use App\Repositories\AbstractRepository;

class JobRepository extends AbstractRepository
{
    /**
     * Job model
     * 
     * @var Job $model
     */
    protected $model = Job::class;

    /**
     * Find all open jobs
     * 
     * @param int $records
     * @param bool $paginate
     * @return QueryBuilder
     */
    public function findAllOpen($records = 15, $paginate = true)
    {
        $query = $this->buildQuery();

        $query->where('status', 'open');

        return $this->runQuery($query, $records, $paginate);
    }
}