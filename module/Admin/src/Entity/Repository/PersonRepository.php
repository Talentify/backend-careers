<?php
namespace Admin\Entity\Repository;


use Admin\Entity\Configurator;
use Admin\Entity\Person;
use Admin\Helper\UtilPassword;
use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;

class PersonRepository extends EntityRepository
{
    /**
     * @param string $login
     * @param string $password
     * @return Person|null
     */
    public function findLogin(string $login, string $password): ?Person
    {
        return $this->findOneBy([
            'email' => $login,
            'password' => UtilPassword::generatePassword($password),
        ]);
    }

    /**
     * @param array $data
     * @param int|null $personId
     * @return Person
     */
    public function save(
        array $data,
        ?int $personId
    ): Person
    {
        if (!$personId) {
            $this->validate($data['email']);
        }

        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] =  UtilPassword::generatePassword($data['password']);
        }

        if (!$personId) {
            return $this->insert($data);
        }

        return $this->update($data, $personId);
    }

    /**
     * @param string $email
     */
    public function validate(string $email) {
        $ent = $this->findOneBy(['email' => $email]);

        if ($ent) {
            throw new \DomainException('Já existe um cadastro com esse e-mail');
        }
    }

    /**
     * @param array $data
     * @param int $id
     * @return Person
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function update(array $data, int $id): Person
    {
        $person = $this->find($id);
        Configurator::configure($person, $data);
        $person->setUpdatedAt(Carbon::now());

        $this->_em->persist($person);
        $this->_em->flush();

        return $person;
    }

    /**
     * @param array $data
     * @return Person
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function insert(array $data)
    {
        $person = new Person($data);
        $person->setUpdatedAt(Carbon::now());
        $person->setCreatedAt(Carbon::now());

        $this->_em->persist($person);
        $this->_em->flush();

        return $person;
    }
}