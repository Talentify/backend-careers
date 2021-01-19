<?php

namespace App\Domain\Service;

use App\Domain\Model\Job;

interface JobServiceInterface
{
    public function findAllActives(): array;
    public function findInPaginator(int $page = 1, ?int $status = null): array;
    public function remove(Job $job): void;
    public function save(Job $job): void;
}