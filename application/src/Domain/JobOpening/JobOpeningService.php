<?php

namespace App\Domain\JobOpening;

use App\Domain\JobOpening\Entity\Embeddable\Address;
use App\Domain\JobOpening\Entity\Embeddable\Money;
use App\Domain\JobOpening\Entity\JobOpening;
use App\Domain\JobOpening\DTO\JobOpening as JobOpeningDTO;
use Doctrine\ORM\EntityManagerInterface;

class JobOpeningService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(JobOpeningDTO $jobOpeningDTO)
    {
        $jobOpening = new JobOpening();
        $jobOpening->setTitle($jobOpeningDTO->title);
        $jobOpening->setDescription($jobOpeningDTO->description);
        $jobOpening->setStatus($jobOpeningDTO->status);

        $salary = new Money();
        $salary->setAmount($jobOpeningDTO->salary->amount);
        $salary->setCurrency($jobOpeningDTO->salary->currency);

        $jobOpening->setSalary($salary);

        $workplace = new Address();
        $workplace->setStreet($jobOpeningDTO->workplace->street);
        $workplace->setPostalCode($jobOpeningDTO->workplace->postalCode);
        $workplace->setCity($jobOpeningDTO->workplace->city);
        $workplace->setCountry($jobOpeningDTO->workplace->country);

        $jobOpening->setWorkplace($workplace);

        $this->entityManager->getRepository(JobOpening::class)->save($jobOpening);
    }

    public function list()
    {
        return $this->entityManager->getRepository(JobOpening::class)->list();
    }
}