<?php

namespace App\Infra\Controllers;

use App\Application\UserCommand;
use App\Domain\Exception\FormValidationException;
use App\Domain\User\DTO\User;
use App\Infra\Form\UserFormType;
use App\Infra\Request\UserRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    /**
     * @Route("/users", name="users-create", methods={"POST"})
     */
    public function create(Request $request, UserCommand $action)
    {
        $data = json_decode($request->getContent(), true);

        $userRequest = new UserRequest();
        $form = $this->createForm(UserFormType::class, $userRequest);
        $form->submit($data);

        if (!$form->isValid()) {
            throw new FormValidationException((string) $form->getErrors(true, false));
        }

        $action->createUser(User::fromRequest($userRequest));

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
