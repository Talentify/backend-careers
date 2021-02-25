<?php
return [
    'host'     => getenv('DB_HOST'),
    'user'     => getenv('DB_USER'),
    'password'     => getenv('DB_PASSWORD'),
    'dbname'     => getenv('DB_NAME'),
    'driver' => 'pdo_mysql',
    'charset'  => 'utf8',
];