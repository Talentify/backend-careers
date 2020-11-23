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
    const USERNAME = 'test';
    const PASSWORD = 'test';
    const TOKEN = 'test';

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
            ->setUsername(self::USERNAME)
            ->setPassword(password_hash(self::PASSWORD, PASSWORD_BCRYPT))
            ->setToken(self::TOKEN);
    }
}