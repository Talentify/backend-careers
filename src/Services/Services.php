<?php


namespace App\Services;

use Authentication\Controller\Component\AuthenticationComponent;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\ORM\Table;

class Services
{
    protected $Request;
    protected $Response;
    protected $Authentication;
    protected $Table;
    protected $ApiResponse;

    public function __construct(ServerRequest $Request, Response $Response, Table $Table, AuthenticationComponent $Authentication)
    {
        $this->Request = $Request;
        $this->Response = $Response;
        $this->Authentication = $Authentication;
        $this->Table = $Table;
    }

    public function setResponse(Response $Response)
    {
        $this->Response = $Response;
    }

    public function getReponse()
    {
        return $this->Response;
    }

}
