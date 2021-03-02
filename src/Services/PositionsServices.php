<?php


namespace App\Services;


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
}
