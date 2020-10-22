<?php

namespace App\User\Http\Controller;

use App\User\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Exception;

/**
 * Class SearchAction
 * @package App\User\Http\Controller
 */
class SearchAction
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * CreateAction constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $data = [];
        parse_str($request->getQueryString(), $data);

        try {
            $data = $this->userService->findBy($data);
        } catch (Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], $exception->getCode() ? $exception->getCode() : Response::HTTP_BAD_REQUEST);
        } catch (Throwable $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], $exception->getCode() ? $exception->getCode() : Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'data' => $data,
            'status' => 'ok'
        ], Response::HTTP_OK);
    }
}
