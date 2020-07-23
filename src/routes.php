<?php

use App\Controllers\UserController;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = AppFactory::create();

$app->get('/', function(Request $req, Response $res) {
    return (new UserController)->index($req, $res);
});

$app->run();