<?php


namespace App\Services;

use Authentication\Controller\Component\AuthenticationComponent;
use Cake\ORM\Table;

class Services
{
    protected $Authentication;
    protected $TableRepository;
    protected $ApiResponse;

    public function __construct(AuthenticationComponent $Authentication, Table $TableRepository)
    {
        $this->Authentication = $Authentication;
        $this->TableRepository = $TableRepository;
    }

    public function setApiResponse($ApiResponse)
    {
        $this->ApiResponse = $ApiResponse;
    }

    public function getApiResponse()
    {
        return $this->ApiResponse;
    }
}
