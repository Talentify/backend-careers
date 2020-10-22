<?php

namespace App\DataFixtures;

use App\User\Service\UserService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * AppFixtures constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->userService->create(['email' => 'admin@email.com', 'password' => 'admin', 'roles' => 'ROLE_ADMIN']);
    }
}
