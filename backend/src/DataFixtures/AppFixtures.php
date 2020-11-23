<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;        
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('test');
        $user->setPassword($this->encoder->encodePassword($user, 'test'));

        $manager->persist($user);
        $manager->flush();

        $manager->flush();
    }
}
