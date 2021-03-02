<?php


namespace App\Services;


use Cake\Datasource\Paginator;
use Cake\Http\Exception\BadRequestException;

class PositionsServices extends Services
{
    public function addPosition()
    {
        $this->Request->allowMethod(['POST']);
        $result = $this->Authentication->getResult();
        $position = $this->Table->newEntity($this->Request->getData());
        $position->status = true;
        $position->user_id = $result->getData()->id;
        $this->Table->save($position);

        if ($position->getErrors()) {
            $return['errors'] = $position->getErrors();
            $this->setResponse($this->Response->withStatus(400));
            return $return;
        }

        $return['position'] = $position;

        return $return;
    }

    public function editPosition($id)
    {

        $this->Request->allowMethod(['PUT']);
        $result = $this->Authentication->getResult();

        $position = $this->Table->findById($id)->first();

        if (!$position) {
            throw new BadRequestException(__("Position not found!"));
        }

        if ($position->user_id != $result->getData()->id) {
            throw new BadRequestException(__("You cannot change the position created by another recruiter!"));
        }

        $this->Table->patchEntity($position, $this->Request->getData());
        $this->Table->save($position);

        if ($position->getErrors()) {
            $return['errors'] = $position->getErrors();
            $this->setResponse($this->Response->withStatus(400));
            return $return;
        }

        $return['position'] = $position;

        return $return;

    }

    public function list(){

        $where = [
            'status' => true
        ];

        $query = $this->Table->find()
            ->where([$where]);

        $Paginator = new Paginator();
        $positions = $Paginator->paginate($query, []);
        $return['positions'] = $positions;
        $return['paginator'] = $Paginator->getPagingParams();

        return $return;
    }

    public function search(){

        $where  = $this->getSearchParams();
        $query = $this->Table->find()
            ->where([$where]);

        $Paginator = new Paginator();
        $positions = $Paginator->paginate($query, []);
        $return['positions'] = $positions;
        $return['paginator'] = $Paginator->getPagingParams();

        return $return;
    }

    protected function getSearchParams()
    {
        // Query Params
        $keyword = $this->Request->getQuery('keyword');
        $address = $this->Request->getQuery('address');
        $salary = $this->Request->getQuery('salary');
        $company = $this->Request->getQuery('company');

        $where = [
            'status' => true
        ];

        if($keyword){
            $where[] = [
                'LOWER(description) LIKE' => '%'.strtolower($keyword).'%'
            ];
        }

        if($address){
            $where[] = [
                'LOWER(address) LIKE' => '%'.strtolower($address).'%'
            ];
        }

        if($salary){
            $where[] = [
                'salary' => $salary
            ];
        }

        if($company){
            $where[] = [
                'LOWER(company) LIKE' => '%'.strtolower($company).'%'
            ];
        }

        return $where;



    }
}
