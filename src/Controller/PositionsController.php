<?php
declare(strict_types=1);

namespace App\Controller;

use App\Services\PositionsServices;
use App\Services\UsersServices;

/**
 * Positions Controller
 * @property PositionsServices $PosistionsServices
 * @property \App\Model\Table\PositionsTable $Positions
 * @method \App\Model\Entity\Position[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PositionsController extends AppController
{
    protected $PositionsServices;

    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['list', 'search']);
        $this->PositionsServices = new PositionsServices($this->getRequest(), $this->getResponse(), $this->Positions, $this->Authentication);
    }

    /**
     * @api {post} /positions/add.json Add Position
     * @apiName Add Position
     * @apiGroup Positions
     *
     *
     * @apiParam {String} title Positions title.
     * @apiParam {String} description Positions description.
     * @apiParam {String} address Positions address.
     * @apiParam {String} salary Positions salary.
     * @apiParam {String} company Users company.
     *
     * @apiHeader {String} Authorization JWT token
     *
     * @apiSuccess {Object} position Position Object JSON.
     *
     */
    public function add()
    {
        $response = $this->PositionsServices->addPosition();
        $this->setResponse($this->PositionsServices->getReponse());
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }


    /**
     * @api {put} /positions/edit/{id}.json Edit Position
     * @apiName Edit Position
     * @apiGroup Positions
     *
     *
     * @apiParam {String} title Positions title.
     * @apiParam {String} description Positions description.
     * @apiParam {String} address Positions address.
     * @apiParam {Number} salary Positions salary.
     * @apiParam {Boolean} status Positions status.
     * @apiParam {String} company Users company.
     *
     * @apiHeader {String} Authorization JWT token
     *
     * @apiSuccess {Object} position Position Object JSON.
     *
     */
    public function edit($id)
    {
        $response = $this->PositionsServices->editPosition($id);
        $this->setResponse($this->PositionsServices->getReponse());
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    /**
     * @api {get} /positions/list.json List Public Positions
     * @apiName List
     * @apiGroup Positions
     *
     * @apiSuccess {Object[]} positions Array of Position Object JSON.
     * @apiSuccess {Object} paginator Paginator Object JSON.
     *
     */
    public function list()
    {
        $response = $this->PositionsServices->list();
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    /**
     * @api {get} /positions/search.json Search Public Positions
     * @apiName Search
     * @apiGroup Positions
     *
     * @apiParam {String} keyword Positions keyword.
     * @apiParam {String} address Positions address.
     * @apiParam {Number} salary Positions salary.
     * @apiParam {String} company Positions company.
     *
     * @apiSuccess {Object[]} positions Array of Position Object JSON.
     * @apiSuccess {Object} paginator Paginator Object JSON.
     *
     */
    public function search()
    {
        $response = $this->PositionsServices->search();
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }


}
