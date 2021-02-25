<?php

namespace Admin\Factory;

use Admin\Controller\IndexController;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, null, []);
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get(EntityManager::class);
        return new IndexController($container,$em);
    }

}