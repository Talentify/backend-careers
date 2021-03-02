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

    public function add()
    {
        $response = $this->PositionsServices->addPosition();
        $this->setResponse($this->PositionsServices->getReponse());
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function edit($id)
    {
        $response = $this->PositionsServices->editPosition($id);
        $this->setResponse($this->PositionsServices->getReponse());
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function list(){
        $response = $this->PositionsServices->list();
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function search(){
        $response = $this->PositionsServices->search();
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }


}
