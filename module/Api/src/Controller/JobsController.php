<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Api\Controller;

use Admin\Controller\CrudApiController;
use Admin\Entity\Job;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

class JobsController extends CrudApiController
{

    public function __construct(ContainerInterface $container,EntityManager $em)
    {
        $this->container = $container;
        $this->em = $em;
        $this->repository = $em->getRepository(Job::class);
    }

    /**
     * @return \Laminas\View\Model\JsonModel
     */
    public function indexAction()
    {
        try{
            $request = $this->getRequest();
            if (!$request->isGet()) {
                throw new \Exception('Método inválido');
            }

            $this->setSuccess($this->repository->fetch());
        }catch (\Exception $e){
            $this->setError($e->getMessage());
        }

        return $this->createResponse();
    }

    /**
     * @return \Laminas\View\Model\JsonModel
     */
    public function registerAction()
    {
        try{
            $data = $this->getData();
            $data['personId'] = $this->tokenPayload->id;

            $id = $this->params()->fromRoute('id', null);
            if (is_numeric($id)) {
                $id = (int) $id;
            }

            $person = $this->repository->save(
                $data,
                $id
            );

            $this->setSuccess($person->toArray());
        }catch (\Exception $e){
            $this->setError($e->getMessage());
        }

        return $this->createResponse();
    }
}
