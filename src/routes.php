<?php

use App\Controllers\VacancyController;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Handlers\Strategies\RequestResponseArgs;
use Slim\Routing\RouteCollectorProxy;

$app = AppFactory::create();

$routeCollector = $app->getRouteCollector();
$routeCollector->setDefaultInvocationStrategy(new RequestResponseArgs());

$app->group("/api/v1", function(RouteCollectorProxy $group) {
    $group->get('/vacancies', function(Request $req, Response $res) {
        return (new VacancyController())->index($req, $res);
    });

    $group->get('/vacancies/{id}', function(Request $req, Response $res, $id) {
        return (new VacancyController())->show($req, $res, $id);
    });
});

$app->run();