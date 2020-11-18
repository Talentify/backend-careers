<?php
namespace App\Service;

use App\Entity\Job;

class JobService extends AbstractEntityService
{
    /**
     * @return string
     */
    public function getEntityClass(): string
    {
        return Job::class;
    }
}