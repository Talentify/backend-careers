<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

//$capsule->addConnection([
//    'driver' => 'mysql',
//    'host' => $_ENV['DB_HOST'],
//    'database' => $_ENV['DB_DATABASE'],
//    'username' => $_ENV['DB_USER'],
//    'password' => $_ENV['DB_PASSWORD']
//]);

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'database',
    'database' => 'database',
    'username' => 'username',
    'password' =>'pwd',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();