<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;

class VacanciesController extends AdminController
{

  public function initialize()
  {
    parent::initialize();

    $this->loadModel('Vacancies');
  }

  /**
   * Home
   * @return void
   */
  public function index()
  {
    // Paginate valid available vacancies
    $query = $this->Vacancies->find()
      ->order(['Vacancies.created_at' => 'DESC']);

    $this->set([
      'items' => $this->paginate($query, ['maxLimit' => 5]),
      'total' => $query->count()
    ]);

    if ($this->request->isJson())
      $this->set(['_serialize' => ['items', 'total']]);
  }

  public function add()
  {
    $entity = $this->Vacancies->newEntity();

    if ($this->request->is('post')) {
      $data = $this->request->getData();

      // Data read
      $entity = $this->Vacancies->patchEntity($entity, $data, [
        // Acceptable fields
        'fields' => [
          'title',
          'description',
          'workplace',
          'salary',
          'status',
        ]
      ]);

      // Backend entity validation
      if (!($errors = $entity->getErrors())) {
        // Try to save
        if ($this->Vacancies->save($entity)) {
          // Redirect with a success message in Session
          $this->Flash->success('Vaga publicada com sucesso');
          return $this->redirect(['action' => 'index']);
        }
        // Display an error message if saving proccess is has not successed
        $this->Flash->error('Vaga não pode ser publicada, tente novamente.');
      }
      else {
        // Display Default validation message
        $this->Flash->error('Vaga não publicada. Verifique os dados e tente novamente.', $errors);
      }
    }

    $this->set('entity', $entity);
  }

  public function edit(int $id)
  {
    $entity = $this->Vacancies->get($id);

    if ($this->request->is('post') || $this->request->is('put')) {
      $data = $this->request->getData();

      // Data read
      $entity = $this->Vacancies->patchEntity($entity, $data, [
        // Acceptable fields
        'fields' => [
          'title',
          'description',
          'workplace',
          'salary',
          'status',
        ]
      ]);

      // Backend entity validation
      if (!($errors = $entity->getErrors())) {
        // Try to save
        if ($this->Vacancies->save($entity)) {
          // Redirect with a success message in Session
          $this->Flash->success('Vaga atualizada com sucesso');
          return $this->redirect(['action' => 'index']);
        }
        // Display an error message if saving proccess is has not successed
        $this->Flash->error('Vaga não pode ser atualizada, tente novamente.');
      }
      else {
        // Display Default validation message
        $this->Flash->error('Vaga não atualizada. Verifique os dados e tente novamente.', $errors);
      }
    }

    $this->set('entity', $entity);
    $this->render('add');
  }

  public function isAuthorized()
  {
    return true;
  }
}
