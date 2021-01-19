<?php

namespace App\Infrastructure\Action\Admin;

use Symfony\Component\Routing\Annotation\Route;

class LogoutAction
{

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
    }
}