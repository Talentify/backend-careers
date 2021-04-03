<?php

declare(strict_types=1);

namespace Api\Validator;

use App\Infrastructure\Core\Trigger;
use \InvalidArgumentException;

class RequestValidator
{
    private object $request;
    private $response;
    private const REQUEST_TYPE = ['get', 'post', 'delete', 'put'];

    public function __construct(object $request)
    {
        $this->request = $request;
    }

    public function requestValidate()
    {
        if (!in_array($this->request->method, self::REQUEST_TYPE, true)) {
            throw new InvalidArgumentException(Trigger::ERROR_MSG_REQUEST_NOT_FOUND);
        }

        return $this->response = $this->callRoute();
    }

    private function callRoute()
    {
        $route = ucfirst($this->request->route);

        if (!file_exists(DIR_ROOT . DIR_PROJECT . "app/Infrastructure/Api/Route/" . $route . "Route.php")) {
            throw new InvalidArgumentException(Trigger::ERROR_MSG_ROUTE_NOT_FOUND);
        }
    }
}
