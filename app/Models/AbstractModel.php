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
            ';dbname=' . env('DB_DATABASE') . ';charset=utf8';

        $this->pdo = new PDO($dns, env('DB_USERNAME'), env('DB_PASSWORD'));
        $this->pdo->exec("set names utf8");
    }

    public function getById(int $id)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE id=:id LIMIT 1";

        $sm = $this->pdo->prepare($query);
        $sm->execute([':id' => $id]);

        $item = $sm->fetch(PDO::FETCH_ASSOC);

        return $item;
    }

    public function all($status = 1)
    {
        $query = "SELECT * FROM {$this->tableName}";
        if (!empty($status)) {
            $query .= ' WHERE status=:status ';
        }
        $query .= ' ORDER BY id DESC';

        $sm = $this->pdo->prepare($query);
        if (!empty($status)) {
            $sm->execute([':status' => $status]);
        } else {
            $sm->execute();
        }

        $list = $sm->fetchAll(PDO::FETCH_ASSOC);

        return $list;
    }

    public function insert()
    {
        $query = "INSERT INTO {$this->tableName} SET ";

        $vars   = $this->cleanVars();
        $fields = [];

        $numFields = count($vars) - 1;
        $i = 0;
        foreach ($vars as $field => $value) {
            $query .= "{$field} = :{$field}" . ($i < $numFields ? ', ' : '');
            $fields[":{$field}"] = $value;
            $i++;
        }

        $st = $this->pdo->prepare($query);
        $executed = $st->execute($fields);

        if ($executed) {
            $id = $this->pdo->lastInsertId();

            $this->setId($id);

            return $id;
        }

        return false;
    }

    public function update()
    {
        $query = "UPDATE {$this->tableName} SET ";

        $vars   = $this->cleanVars();
        $fields = [];

        $numFields = count($vars) - 1;
        $i = 0;
        foreach ($vars as $field => $value) {
            $query .= "{$field} = :{$field}" . ($i < $numFields ? ', ' : '');
            $fields[":{$field}"] = $value;
            $i++;
        }

        $query .= " WHERE id={$this->getId()}";

        $st = $this->pdo->prepare($query);
        return $st->execute($fields);
    }

    public function remove()
    {
        $query = "DELETE FROM {$this->tableName} WHERE id=:id";

        $st = $this->pdo->prepare($query);
        return $st->execute([':id' => (int)$this->getId()]);
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

    private function cleanVars()
    {
        $vars = array_filter(get_object_vars($this), function ($var, $key) {
            return !is_null($var) && $key != 'tableName' && $key != 'id' && $key != 'pdo';
        }, ARRAY_FILTER_USE_BOTH);

        return $vars;
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
