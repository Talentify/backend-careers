<?php

require_once __DIR__ . "/bootstrap.php";

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Symfony\Component\Console\Helper\HelperSet;

return new HelperSet([
    'em' => new EntityManagerHelper($entityManager)
]);
