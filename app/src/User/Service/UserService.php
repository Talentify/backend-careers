<?php

namespace App\User\Service;

use App\User\Domain\Entity\User;
use App\User\Domain\Exceptions\RecordException;
use App\User\Domain\Exceptions\RecordNotFoundException;
use App\User\Domain\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Webmozart\Assert\Assert;

/**
 * Class UserService
 * @package App\User\Service
 */
class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @return \App\Job\Domain\Entity\Job[]|array
     */
    public function findAll()
    {
        return $this->userRepository->findAll();
    }

    /**
     * @param array $data
     * @return User
     */
    public function create(array $data)
    {
        $this->validateData($data);
        $entity = new User();

        $roles = $entity->getRoles();

        if (isset($data['roles'])) {
            array_push($roles, $data['roles']);
        }

        $entity->setEmail($data['email'])
            ->setRoles(array_unique($roles))
            ->setPassword($this->passwordEncoder->encodePassword($entity, $data['password']));

        return $this->userRepository->save($entity);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function update(int $id, array $data)
    {
        $this->validateData($data, false);
        $user = $this->userRepository->find($id);

        if (is_null($user)) {
            throw new RecordNotFoundException();
        }

        $roles = $user->getRoles();

        if (isset($data['roles'])) {
            array_push($roles, $data['roles']);
        }

        $user->setEmail($data['email'])
            ->setRoles($roles);

        if (isset($data['password'])) {
            $user->setPassword($this->passwordEncoder->encodePassword($user, $data['password']));
        }

        return $this->userRepository->update($user);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws RecordNotFoundException
     */
    public function find(int $id)
    {
        $user = $this->userRepository->find($id);

        if (is_null($user)) {
            throw new RecordNotFoundException;
        }

        return [
            'id'    => $user->getId(),
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
        ];
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function delete(int $id)
    {
        $user = $this->userRepository->find($id);

        if (is_null($user)) {
            throw new RecordNotFoundException();
        }

        $this->userRepository->delete($user);
    }

    /**
     * @param array $filters
     * @return array
     */
    public function findBy(array $filters)
    {
        return $this->userRepository->findBy($filters);
    }

    /**
     * @param array $data
     * @param bool $register
     */
    private function validateData(array &$data, bool $register = true)
    {

        if ($register) {
            Assert::keyExists($data, 'email', '"email" is required.');
            Assert::keyExists($data, 'password', '"password" is required.');
        }

        if (isset($data['email'])) {
            Assert::email($data['email'], '"email" is not a email.');
        }

        if (isset($data['password'])) {
            Assert::string($data['password'], '"password" is not a string.');
        }

        if (isset($data['role'])) {
            Assert::regex($data['role'], '/^ADMIN$|^USER$/', '"role" is not valid.');
        }

    }
}
