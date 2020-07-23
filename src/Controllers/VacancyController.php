<?php

namespace App\Controllers;

use App\Repository\UserRepository;
use App\Core\Controller;
use App\Repository\VacancyRepository;
use App\Service\UserService;
use App\Service\VacancyService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class VacancyController extends Controller
{
    protected function initializeRepository()
    {
        $this->repository = new VacancyRepository();
    }

    protected function initializeService()
    {
        $this->service = new VacancyService($this->repository);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function index(Request $request, Response $response)
    {
        $result = $this->service->listActive();
        $res = json_encode(['data' => $result->all()], JSON_PRETTY_PRINT);
        $response->getBody()->write($res);

        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param int $id
     * @return Response
     */
    public function show(Request $request, Response $response, $id)
    {
        $result = $this->service->get($id);
        $res = json_encode($result->toArray(), JSON_PRETTY_PRINT);
        $response->getBody()->write($res);

        return $response->withHeader('Content-Type', 'application/json');
    }
}