<?php

namespace App\Http\Controllers;

use PDO;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function conexao(){
      $DB_HOST = env("DB_HOST");
      $DB_PORT = env("DB_PORT");
      $DB_DATABASE = env("DB_DATABASE");
      $DB_USERNAME = env("DB_USERNAME");
      $DB_PASSWORD = env("DB_PASSWORD");
      $pdo = new PDO("mysql:host=$DB_HOST:$DB_PORT; dbname=$DB_DATABASE", "$DB_USERNAME", "$DB_PASSWORD");
      return $pdo;
    }
}
