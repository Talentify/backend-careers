<?php

namespace App\Domain\User;

use App\Domain\JobOpening\Entity\Embeddable\Address;
use App\Domain\JobOpening\Entity\Embeddable\Money;
use App\Domain\JobOpening\Entity\JobOpening;
use App\Domain\User\DTO\User as UserDTO;
use App\Domain\User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager,  UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function create(UserDTO $userDTO)
    {
        $user = new User();

        $password = $this->passwordEncoder->encodePassword(
            $user,
            $userDTO->password
        );

        $user->setName($userDTO->name);
        $user->setUsername($userDTO->username);
        $user->setPassword($password);
        $user->setEmail($userDTO->email);

        $this->entityManager->getRepository(User::class)->save($user);
    }
}