<?php


namespace App\Services;


class PositionsServices extends Services
{
    public function addPosition()
    {
        $this->Request->allowMethod(['POST']);

        $user = $this->Table->newEntity($this->Request->getData());
        $user->status = true;
        $this->Table->save($user);

        if ($user->getErrors()) {
            $return['errors'] = $user->getErrors();
            $this->setResponse($this->Response->withStatus(400));
            return $return;
        }

        $return['user'] = $user;

        return $return;
    }
}
