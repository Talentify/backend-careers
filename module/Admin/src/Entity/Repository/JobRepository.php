<?php
namespace Admin\Entity\Repository;

use Admin\Entity\Configurator;
use Admin\Entity\Job;
use Admin\Entity\Person;
use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;

class JobRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function fetch()
    {
        return array_map(function ($job) {
            return $job->toArray();
        }, $this->findBy(['status' => 1]));
    }

    /**
     * @param array $data
     * @param int|null $jobId
     * @return Job
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(
        array $data,
        ?int $jobId
    ): Job
    {
        $person = $this->_em->getReference(Person::class, $data['personId']);
        $data['personId'] = $person;

        if (!$jobId) {
            return $this->insert($data);
        }

        $this->validate(
            $person->getId(),
            $jobId
        );

        return $this->update($data, $jobId);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Job
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function update(array $data, int $id): Job
    {
        $job = $this->find($id);
        Configurator::configure($job, $data);
        $job->setUpdatedAt(Carbon::now());

        $this->_em->persist($job);
        $this->_em->flush();

        return $job;
    }

    /**
     * @param array $data
     * @return Job
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function insert(array $data): Job
    {
        $job = new Job($data);
        $job->setUpdatedAt(Carbon::now());
        $job->setCreatedAt(Carbon::now());

        $this->_em->persist($job);
        $this->_em->flush();

        return $job;
    }

    /**
     * @param int $personId
     * @param int $jobId
     * @throws \Exception
     */
    private function validate(
        int $personId,
        int $jobId
    ) {
        $job = $this->find($jobId);
        if ($job->getPersonId()->getId() != $personId) {
            throw new \DomainException('Essa vaga não pertence a você!');
        }
    }
}