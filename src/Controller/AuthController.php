<?php


namespace App\Controller;

use App\Services\AuthServices;

class AuthController extends AppController
{

    protected $AuthServices;

    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['login']);
        $this->AuthServices = new AuthServices($this->getRequest(), $this->getResponse(), null, $this->Authentication);
    }

    /**
     * @api {post} /auth/login.json Login
     * @apiName Login
     * @apiGroup Auth
     *
     * @apiParam {String} email Users unique email.
     * @apiParam {String} password Users password.
     *
     * @apiSuccess {String} token JWT token.
     * 
     */
    public function login()
    {
        $response = $this->AuthServices->login();
        $this->setResponse($this->AuthServices->getReponse());
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);

    }
}
