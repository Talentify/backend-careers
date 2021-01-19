<?php

namespace App\Infrastructure\Action;

use Symfony\Component\HttpFoundation\{
    RedirectResponse,
    Response
};
use Symfony\Component\Routing\{
    Annotation\Route,
    RouterInterface
};
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Domain\Model\User;
use Twig\Environment;

class LoginAction
{
    /**
     * @Route("/login", name="app_login", methods={"GET", "POST"})
     */
    public function __invoke(
        Environment $environment,
        AuthenticationUtils $authenticationUtils,
        TokenStorageInterface $tokenStorage,
        RouterInterface $router
    ): Response {
        $user = $tokenStorage->getToken()->getUser();

        if ($user instanceof User) {
            return new RedirectResponse(
                $router->generate('jobs_list')
            );
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return new Response(
            $environment->render(
                '/admin/login.html.twig',
                [
                    'last_username' => $lastUsername,
                    'error' => $error,
                ]
            )
        );
    }
}
