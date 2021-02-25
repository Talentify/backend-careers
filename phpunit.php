<?php

use Dotenv\Dotenv;

if (file_exists(getcwd().'/.env')) {
    $dotenv = Dotenv::createUnsafeImmutable(getcwd());
    $dotenv->load();
}
