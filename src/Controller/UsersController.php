<?php
declare(strict_types=1);

namespace App\Controller;

use Authentication\Controller\Component\AuthenticationComponent;
use Cake\Http\Exception\BadRequestException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
/**
 * Users Controller
 *
 * @property  AuthenticationComponent $Authentication
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['index','login','add']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $ok = "200";
        $this->set(compact( 'ok'));
        $this->set('_serialize', [ 'ok']);
    }

    public function login(){

        $result = $this->Authentication->getResult();

        if(!$result->isValid()){
            throw new BadRequestException(__("ERRO LOGIN"));
        }

        $user = $result->getData();
        $payload = [
            'sub' => $user->id,
            'exp' => time() + 60,
        ];

        $json = [
            'token' => JWT::encode($payload, Security::getSalt(), 'HS256'),
        ];

        $this->set(compact( 'json'));
        $this->set('_serialize', [ 'json']);

    }

    public function add(){

        $this->getRequest()->allowMethod(['POST']);

        $user = $this->Users->newEntity($this->getRequest()->getData());
        $user->status = true;
        $this->Users->save($user);

        $errors = $user->getErrors();
        if(count($errors)){
            $this->setResponse($this->response->withStatus(400));
        }

        $this->set(compact('user', 'errors'));
        $this->set('_serialize', ['user', 'errors']);

    }

    public function list(){

        $users = $this->paginate();
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

}
