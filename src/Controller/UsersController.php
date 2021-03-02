<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\User;
use App\Services\UsersServices;
use Authentication\Controller\Component\AuthenticationComponent;
use Cake\Http\Exception\BadRequestException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

/**
 * Users Controller
 *
 * @property  UsersServices $UsersServices
 * @property  AuthenticationComponent $Authentication
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    protected $UsersServices;

    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['index', 'add']);
        $this->UsersServices = new UsersServices($this->getRequest(), $this->getResponse(), $this->Users, $this->Authentication);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $ok = "200";
        $this->set(compact('ok'));
        $this->set('_serialize', ['ok']);
    }



    public function add()
    {
        $response = $this->UsersServices->addUser();
        $this->setResponse($this->UsersServices->getReponse());
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);

    }

    public function list()
    {

        $users = $this->paginate();
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

}
