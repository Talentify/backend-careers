<?php

namespace App\Models;

use PDO;

abstract class AbstractModel
{
    private $id;
    private $tableName;

    public function __construct()
    {
        $dns = env('DB_CONNECTION') .
            ':host=' . env('DB_HOST') .
            ((!empty(env('DB_PORT'))) ? (';port=' . env('DB_PORT')) : '') .
            ';dbname=' . env('DB_DATABASE');

        $this->pdo = new PDO($dns, env('DB_USERNAME'), env('DB_PASSWORD'));
    }

    public function all()
    {
        $query = "SELECT * FROM {$this->tableName} ORDER BY id DESC";

        $sm = $this->pdo->prepare($query);
        $sm->execute();

        $list = $sm->fetchAll(PDO::FETCH_ASSOC);

        return $list;
    }

    public function insert()
    {
        $query = "INSERT INTO {$this->tableName} SET ";
        $vars = get_object_vars($this);

        $fields = [];

        $numFields = count($vars);
        foreach ($vars as $i => $field) {
            $method = 'get' . ucfirst($field);
            $value = $this->$method();

            if (method_exists($this, $value) && !is_null($value)) {
                $query .= "{$field} = :{$field}" . ($i < $numFields ? ', ' : '');
                $fields[":{$field}"] = $value;
            }
        }

        $st = $this->pdo->prepare($query);
        $st->execute($fields);
    }

    public function update()
    {
        $query = "UPDATE {$this->tableName} SET ";
        $vars  = get_object_vars($this);

        $fields = [];

        $numFields = count($vars);
        foreach ($vars as $i => $field) {
            $method = 'get' . ucfirst($field);
            $value = $this->$method();

            if (method_exists($this, $value) && !is_null($value)) {
                $query .= "{$field} = :{$field}" . ($i < $numFields ? ', ' : '');
                $fields[":{$field}"] = $value;
            }
        }

        $query .= "WHERE id={$this->getId()}";

        $st = $this->pdo->prepare($query);
        $st->execute($fields);
    }

    protected function fill(string $tableName, array $params = [])
    {
        $this->setTableName($tableName);

        if (empty($params)) {
            return;
        }

        foreach ($params as $property => $value) {
            $method = 'set' . ucfirst(strtolower(str_replace('_', '', $property)));
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Get the value of tableName
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * Set the value of tableName
     *
     * @return  self
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
