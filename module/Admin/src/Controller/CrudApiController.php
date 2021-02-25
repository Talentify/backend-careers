<?php
namespace Admin\Controller;

use Laminas\Json\Json;
use Laminas\View\Model\JsonModel;

abstract class CrudApiController extends CrudApiJwtController
{
	protected $entity;
	
	protected $form;
	
	protected $route;
	
	protected $controller;

	protected $em;

	protected $container;

    protected $repository;

    protected $service;

    public function getData(){
        return Json::decode($this->getRequest()->getContent(), Json::TYPE_ARRAY);
    }

    public function setSuccess($data, $message = null){
        $config = $this->getEvent()->getParam('config', false)['ApiRequest']['responseFormat'];

        $this->apiResponse[$config['statusKey']] = $config['statusOkText'];

        if ($message){
            $this->apiResponse[$config['messageKey']] = $message;
        }

        $this->apiResponse[$config['resultKey']] = $data;
    }

    public function setError($message, $data = null){
        $config = $this->getEvent()->getParam('config', false)['ApiRequest']['responseFormat'];

        $this->apiResponse[$config['statusKey']] = $config['statusNokText'];
        $this->apiResponse[$config['messageKey']] = $message;

        if ($data){
            $this->apiResponse[$config['resultKey']] = $data;
        }
    }

    /**
     * Create Response for api Assign require data for response and check is valid response or give error
     * @return \Laminas\View\Model\JsonModel
     *
     */
    public function createResponse()
    {
        $event = $this->getEvent();
        $response = $event->getResponse();

        $response->setStatusCode($this->httpStatusCode);
        return new JsonModel($this->apiResponse);
    }

    public function isProfissional(){
        if (!$this->tokenPayload->profissional){
            throw new \Exception('E0009');
        }
    }

    public function translate($nomeMsg){
        $msg = '';
        try{
            $translate =  $this->container->get('ViewHelperManager')->get('translate');
            $msg = $translate($nomeMsg);
        }catch (\Exception $e){

        }
        return $msg;
    }

}
