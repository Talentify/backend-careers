<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\User;
use App\Services\UsersServices;
use Authentication\Controller\Component\AuthenticationComponent;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;


/**
 * Users Controller
 *
 * @property  UsersServices $UsersServices
 * @property  AuthenticationComponent $Authentication
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RecruitersController extends AppController
{
    protected $UsersServices;

    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['add']);
        $this->Users =TableRegistry::getTableLocator()->get('Users');
        $this->UsersServices = new UsersServices($this->getRequest(), $this->getResponse(), $this->Users, $this->Authentication);
    }

    /**
     * @api {post} /recruiters/add.json Sign up
     * @apiName Sign up
     * @apiGroup Recruiters
     *
     * @apiParam {String} name Users name.
     * @apiParam {String} email Users unique email.
     * @apiParam {String} password Users password.
     * @apiParam {String} company Users company.
     *
     * @apiSuccess {Object} user User Object JSON.
     *
     */
    public function add()
    {
        $response = $this->UsersServices->addUser();
        $this->setResponse($this->UsersServices->getReponse());
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);

    }



}
