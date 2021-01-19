<?php

namespace App\Infrastructure\DataFixture;

use App\Domain\Model\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserDataFixture extends Fixture
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $encodedPassword = $this->encoder->encodePassword($user, 'talentify');

        $user->setUsername('admin');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($encodedPassword);

        $manager->persist($user);
        $manager->flush();
    }

}