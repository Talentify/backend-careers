<?php
namespace App\DataFixtures;

use App\Entity\User;
use App\Exceptions\EmptyException;
use App\Exceptions\InvalidPasswordHashException;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class UserFixture
 * @package App\DataFixtures
 *
 * @codeCoverageIgnore
 */
class UserFixture extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws EmptyException
     * @throws InvalidPasswordHashException
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->getUser());
        $manager->flush();
    }

    /**
     * @return User
     * @throws EmptyException
     * @throws InvalidPasswordHashException
     */
    private function getUser(): User
    {
        return (new User())
            ->setUsername('test')
            ->setPassword(password_hash('test', PASSWORD_BCRYPT))
            ->setToken('test');
    }
}