<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Admin;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;

class Module
{
    public function getConfig(): array
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
