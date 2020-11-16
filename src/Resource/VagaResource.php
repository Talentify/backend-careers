<?php
declare(strict_types=1);

namespace App\Resource;

use App\Entity\Vaga;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class VagaResource
{
    private EntityManagerInterface $entityManager;

    private ValidatorInterface $validator;

    /**
     * VagaResource constructor.
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     */
    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * @return bool|ConstraintViolationListInterface
     */
    public function create(Request $request)
    {
        $vaga = new Vaga();

        $vaga->setTitle($request->get('title'));
        $vaga->setWorkplace($request->get('workplace'));
        $vaga->setSalary(
            (float) str_replace(",", ".", str_replace(".","", $request->get('salary')))
        );
        $vaga->setDescription($request->get('description'));

        $errors = $this->validator->validate($vaga);

        if (count($errors) > 0) {
            return $errors;
        }
        $this->entityManager->persist($vaga);

        $this->entityManager->flush();

        return true;
    }

}