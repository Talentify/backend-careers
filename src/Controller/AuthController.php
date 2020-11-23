<?php
namespace App\Controller;

use App\Entity\User;
use App\Exceptions\EmptyException;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * AuthController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return JsonResponse
     * @throws EmptyException
     * @throws \Exception
     *
     * @Route(
     *     "/auth/credentials",
     *     methods={"POST"},
     *     name="auth-get-credentials"
     * )
     */
    public function getCredentials(): JsonResponse
    {
        return new JsonResponse($this->userService->persist(
            $this->getUserModel()->setToken($this->generateRandomToken())
        ), Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     *
     * @Route(
     *     "/auth/logged",
     *     methods={"GET"},
     *     name="auth-is-logged"
     * )
     */
    public function isLogged(): JsonResponse
    {
        return new JsonResponse($this->getUserModel(), Response::HTTP_OK);
    }

    /**
     * @return User
     */
    private function getUserModel(): User
    {
        return $this->getUser();
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function generateRandomToken(): string
    {
        return bin2hex(random_bytes(32));
    }
}