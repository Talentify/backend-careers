<?php

namespace Api\Factory;

use Api\Controller\JobsController;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class JobsControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, null, []);
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get(EntityManager::class);
        return new JobsController($container,$em);
    }

}