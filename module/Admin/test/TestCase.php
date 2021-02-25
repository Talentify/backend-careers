<?php

namespace AdminTest;

use Doctrine\ORM\EntityManager;
use Laminas\Stdlib\ArrayUtils;
use Laminas\Test\PHPUnit\Controller\AbstractControllerTestCase;

class TestCase extends AbstractControllerTestCase
{
    const DEFAULT_DATABASE = 'DB_TEST';

    protected $em;

    protected function setUp(): void
    {
        $configOverrides = [];

        if (!$this->em) {
            $this->setApplicationConfig(ArrayUtils::merge(
            // Grabbing the full application configuration:
                include __DIR__ . '/../../../config/application.test.config.php',
                $configOverrides
            ));

            $service = $this->getApplicationServiceLocator();
            $this->em = $service->get(EntityManager::class);
        }

        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    protected function defaultDataset($mockData = []): void
    {
        $this->truncateEntities();

        new TestDataSet(
            array_merge(
                [
                    'person' => [
                        ['id', 'name', 'email', 'password', 'created_at', 'updated_at'],
                        [1, 'Paulo Lavoratti', 'paulolavoratti@hotmail.com', md5('teste'), '2021-02-23 23:52:52', '2021-02-23 23:52:52'],
                        [2, 'Paulo Lavoratti', 'paulolavoratti@hotmail.com', md5('teste'), '2021-02-23 23:52:52', '2021-02-23 23:52:52'],
                    ]
                ],
                $mockData
            ),
            $this->em
        );
    }

    private function truncateEntities(): void
    {
        $this->em->getConnection()->exec("SET FOREIGN_KEY_CHECKS=0");

        $tables = $this->em->getConnection()->executeQuery("show tables")->fetchAllAssociative();

        foreach ($tables as $table) {
            $table = array_values((array) $table)[0];

            $this->em->getConnection()->exec("TRUNCATE {$table}");
        }

        $this->em->getConnection()->exec("SET FOREIGN_KEY_CHECKS=1");
    }
}
