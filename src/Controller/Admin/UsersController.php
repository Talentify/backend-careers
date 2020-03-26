<?php
namespace App\Controller\Admin;

use Cake\Event\Event;
use App\Controller\Admin\AdminController;

class UsersController extends AdminController
{
  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
    $this->Auth->allow();
  }

  public function login()
  {
    if ($this->request->is('post')) {
      $user = $this->Auth->identify();

      if ($user) {
        $this->Auth->setUser($user);
        return $this->redirect($this->Auth->redirectUrl());
      } else {
        $this->Flash->error('E-mail ou senha inválidos.');
      }
    }
  }

  public function logout()
  {
    return $this->redirect($this->Auth->logout());
  }
}
