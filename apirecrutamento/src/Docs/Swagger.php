<?php

namespace Api\Docs;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Symfony\Component\Yaml\Yaml;
use Slim\Views\Twig;

final class Swagger
{
    /**
     * @var Twig
     */
    private $twig;

    public function __construct()
    {
        $this->twig = Twig::create(
            __DIR__ . '/../../templates',
            ['cache' => __DIR__ . '']
        );
    }

    public function __invoke(
        Request $request,
        Response $response
    ): Response {
        // Path to the yaml file
        $yamlFile = __DIR__ . '/../../docs/recrutamento.yaml';

        $viewData = [
            'spec' => json_encode(Yaml::parseFile($yamlFile)),
        ];

        return $this->twig->render($response, 'swagger.twig', $viewData);
    }
}
