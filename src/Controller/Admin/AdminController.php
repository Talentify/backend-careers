<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class AdminController extends AppController
{
  public function initialize()
  {
    parent::initialize();

    $this->loadComponent('Auth', [
      'authenticate'         => [
        'Form' => [
          'fields' => [
            'username' => 'email',
            'password' => 'password'
          ],
          'finder' => 'auth', // Custom finder
        ]
      ],
      'authError'            => 'Acesso negado',
      'authorize'            => ['Controller'],
      'unauthorizedRedirect' => [
        'controller' => 'Users',
        'action'     => 'forbidden',
      ],
      'loginRedirect' => '/admin',
      'logoutRedirect' =>
      [
        'controller' => 'Users',
        'action'     => 'login'
      ]
    ]);


  }
}
