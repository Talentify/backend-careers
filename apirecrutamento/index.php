<?php

declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Api\Docs\Swagger;
use Api\Controller\RecrutadorController;
use Api\Controller\VagaController;
use Api\Model\Recrutador;
use Api\Model\Vaga;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->get('/', Swagger::class);

$app->post('/recrutador', function (Request $request, Response $response) {
    $data = (object) $request->getQueryParams();
    $dados = (new RecrutadorController())->create(
        new Recrutador(
            $data->nome,
            $data->usuario,
            $data->senha,
            $data->empresa
        )
    );

    $response->getBody()->write(json_encode(['msg' => $dados['msg']]));
    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus($dados['status']);
});

$app->get('/listar',  function (Request $request, Response $response) {
    $dados = (new VagaController())->findAll();
    $response->getBody()->write(json_encode($dados));
    return $response->withHeader('Content-Type', 'application/json');
});

/**
 * Autenticação Recrutador
 */
$auth = function (Request $request, RequestHandler $handler) {
    global $retorno;
    $response = $handler->handle($request);
    $retorno = (new RecrutadorController())->login($request->getUri()->getUserInfo());
    if (!empty($retorno['usuario'])) {
        return $response;
    } else {
        $response = new $response();
        $response = $response->withStatus(403);
        $retorno = [
            'usuario' => 'Usuário ou senha inválido!'
        ];
        $response->getBody()->write(json_encode($retorno));
        return $response->withHeader('Content-Type', 'application/json');
    }
};

$app->group('/vagas', function (RouteCollectorProxy $group) {
    /**
     * Listar vagas
     */
    $group->get(
        '/{id}/{recrutador_id}',
        function (Request $request, Response $response, array $params) {
            $dados = (new VagaController())->find($params['id'], $params['recrutador_id']);
            $response->getBody()->write(json_encode($dados));
            return $response->withHeader('Content-Type', 'application/json');
        }
    );
    /**
     * Cadastrar Vaga
     */
    $group->post(
        '/cadastrar/{recrutador_id}',
        function (Request $request, Response $response, array $params) {
            $data = (object) $request->getQueryParams();
            $dados = (new VagaController())->create(
                new Vaga(
                    $data->title,
                    $data->description,
                    $data->status,
                    $data->address,
                    $data->salary,
                    $data->company
                ),
                $params['recrutador_id']
            );
            $response->getBody()->write(json_encode(['msg' => $dados['msg']]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus($dados['status']);
        }
    );
    /**
     * Atualiza Vaga
     */
    $group->put(
        '/atualizar/{id}/{recrutador_id}',
        function (Request $request, Response $response, array $params) {
            $dados = (new VagaController())->find($params['id'], $params['recrutador_id']);
            $data = (object) $request->getQueryParams();
            $dados = (new VagaController())->update(
                new Vaga(
                    $data->title,
                    $data->description,
                    $data->status,
                    $data->address,
                    $data->salary,
                    $data->company
                ),
                $params['id'],
                $params['recrutador_id']
            );
            $response->getBody()->write(json_encode(['msg' => $dados['msg']]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus($dados['status']);
        }
    );
    /**
     * Deletar Vaga
     */
    $group->delete(
        '/deletar/{id}/{recrutador_id}',
        function (Request $request, Response $response, array $params) {
            $dados = (new VagaController())->delete($params['id'], $params['recrutador_id']);
            $response->getBody()->write(json_encode(['msg' => $dados['msg']]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus($dados['status']);
        }
    );
})->add($auth);


$app->run();
