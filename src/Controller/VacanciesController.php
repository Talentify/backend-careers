<?php
declare(strict_types=1);

/**
* CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
* @link      https://cakephp.org CakePHP(tm) Project
* @since     0.2.9
* @license   https://opensource.org/licenses/mit-license.php MIT License
*/
namespace App\Controller;

/**
* Static content controller
*
* This controller will render views from templates/Pages/
*
* @link https://book.cakephp.org/4/en/controllers/pages-controller.html
*/
class VacanciesController extends AppController
{
  /**
   * Home
   * @return void
   */
  public function index()
  {
    // Paginate valid available vacancies
    $query = $this->Vacancies->find('available')
      ->order(['Vacancies.created_at' => 'DESC']);
      
    $this->set([
      'items' => $this->paginate($query, ['maxLimit' => 5]),
      'total' => $query->count()
    ]);

    if ($this->request->isJson())
      $this->set(['_serialize' => ['items', 'total']]);
  }

}
