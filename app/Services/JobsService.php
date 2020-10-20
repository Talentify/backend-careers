<?php


namespace App\Services;

use App\Repositories\Contracts\JobsInterface;
use Illuminate\Support\Facades\Auth;
use Monolog\Logger;

class JobsService
{
    private $jobsRepository;
    private $logger;

    /**
     * JobsService constructor.
     * @param JobsInterface $jobsRepository
     */
    public function __construct(JobsInterface $jobsRepository, Logger $logger)
    {
        $this->jobsRepository = $jobsRepository;
        $this->logger         = $logger;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        try {
            $isCreated = $this->jobsRepository->create($data);

            $this->logger->info('A new job has been created.', [
                'payload' => $data,
                'user'    => Auth::guard('api')->user()->name
            ]);

            return $isCreated;
        } catch (\Exception $ex) {
            $this->logger->error('There was an error saving a job.', [
                'payload'       => $data,
                'user'          => Auth::guard('api')->user()->name,
                'file'          => $ex->getFile(),
                'error-message' => $ex->getMessage(),
                'exception'     => get_class($ex)
            ]);
            throw $ex;
        }
    }

    /**
     * @param string $status
     * @return \Illuminate\Support\Collection
     */
    public function listOpenedJobs(string $status)
    {
        try {
            return $this->jobsRepository->findByStatus($status);
        } catch (\Exception $ex) {
            $this->logger->error('There was an error listing opened jobs.', [
                'payload'       => $data,
                'user'          => Auth::guard('api')->user()->name,
                'file'          => $ex->getFile(),
                'error-message' => $ex->getMessage(),
                'exception'     => get_class($ex)
            ]);
            throw $ex;
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function list()
    {
        try {
            return $this->jobsRepository->list();
        } catch (\Exception $ex) {
            $this->logger->error('There was an error listing jobs.', [
                'payload'       => $data,
                'user'          => Auth::guard('api')->user()->name,
                'file'          => $ex->getFile(),
                'error-message' => $ex->getMessage(),
                'exception'     => get_class($ex)
            ]);
            throw $ex;
        }
    }

    /**
     * @param int $jobId
     * @return mixed
     */
    public function find(int $jobId)
    {
        try {
            return $this->jobsRepository->find($jobId);
        } catch (\Exception $ex) {
            $this->logger->error('There was an error finding a job.', [
                'payload'       => $data,
                'user'          => Auth::guard('api')->user()->name,
                'file'          => $ex->getFile(),
                'error-message' => $ex->getMessage(),
                'exception'     => get_class($ex)
            ]);
            throw $ex;
        }
    }

    /**
     * @param int $jobId
     * @return mixed
     */
    public function delete(int $jobId)
    {
        try {
            $isDeleted = $this->jobsRepository->delete($jobId);

            $this->logger->info('A job has been deleted.', [
                'payload' => ['job.id' => $jobId],
                'user'    => Auth::guard('api')->user()->name
            ]);

            return $isDeleted;
        } catch (\Exception $ex) {
            $this->logger->error('There was an error deleting a job.', [
                'payload'       => ['job.id' => $jobId],
                'user'          => Auth::guard('api')->user()->name,
                'file'          => $ex->getFile(),
                'error-message' => $ex->getMessage(),
                'exception'     => get_class($ex)
            ]);
            throw $ex;
        }

    }

    public function update(array $jobData)
    {
        try {
            $isUpdated = $this->jobsRepository->update($jobData);

            $this->logger->info('A job has been updated.', [
                'payload' => $jobData,
                'user'    => Auth::guard('api')->user()->name
            ]);

            return $isUpdated;
        } catch (\Exception $ex) {
            $this->logger->error('There was an error saving a job.', [
                'payload'       => $jobData,
                'user'          => Auth::guard('api')->user()->name,
                'file'          => $ex->getFile(),
                'error-message' => $ex->getMessage(),
                'exception'     => get_class($ex)
            ]);

            throw $ex;
        }
    }
}