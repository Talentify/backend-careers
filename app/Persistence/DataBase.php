<?php

namespace App\Persistence;

use \PDO;
use \PDOException;

abstract class DataBase
{
    private static $con;

    public static function connectDB()
    {
        $config = require "config.php";

        try {
            if (self::$con == null) {
                self::$con = new PDO(
                    "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}",
                    $config['user'],
                    $config['pass']
                );
            }
            return self::$con;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
