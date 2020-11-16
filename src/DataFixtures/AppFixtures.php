<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Vaga;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture implements ORMFixtureInterface
{
    private UserPasswordEncoderInterface $encoder;


    /**
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new Admin();
        $user->setUsername('admin');
        $user->setPassword(
            $this->encoder->encodePassword($user, 'admin')
        );
        $user->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);

        $vaga = new Vaga();
        $vaga->setTitle('Programador PHP');
        $vaga->setDescription('Desenvolvimento utilizando o framework Symfony');
        $vaga->setWorkplace('199 Lafayette St. at the corner of Broome Street');
        $vaga->setSalary(4000.00);
        $vaga->setStatus(1);

        $manager->persist($vaga);

        $vaga = new Vaga();
        $vaga->setTitle('Programador PHP');
        $vaga->setDescription('Desenvolvimento utilizando o framework Laravel');
        $vaga->setWorkplace('20 W 34th St, New York, NY 10001');
        $vaga->setSalary(5000.00);
        $vaga->setStatus(1);

        $manager->persist($vaga);

        $manager->flush();
    }
}
