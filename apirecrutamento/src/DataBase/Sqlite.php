<?php

namespace Api\DataBase;

class Sqlite extends \PDO
{
    private $pdo;

    public function __construct()
    {
        if ($this->pdo == null) {
            $this->pdo = parent::__construct('sqlite:db_recrutamento');
        }

        return $this->pdo;
    }
}
