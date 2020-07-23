<?php

namespace App\Controllers;

use App\Repository\UserRepository;
use App\Core\Controller;
use App\Service\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController extends Controller
{
    protected function initializeRepository()
    {
        $this->repository = new UserRepository;
    }

    protected function initializeService()
    {
        $this->service = new UserService($this->repository);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function index(Request $request, Response $response)
    {
        $result = $this->service->list();
        $res = json_encode($result->all(), JSON_PRETTY_PRINT);
        $response->getBody()->write($res);

        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function create(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $res = json_encode($this->service->save($data), JSON_PRETTY_PRINT);
        $response->getBody()->write($res);

        return $response->withHeader('Content-Type', 'application/json');
    }
}