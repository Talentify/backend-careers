<?php

namespace App\Models;

use PDO;

class User extends AbstractModel
{
    protected $name;
    protected $email;
    protected $password;

    public function __construct(array $params = [])
    {
        parent::__construct();
        $this->fill('users', $params);
    }

    public function getByEmail($email)
    {
        $query = "SELECT * FROM {$this->getTableName()} WHERE email=:email";

        $sm = $this->pdo->prepare($query);
        $sm->execute([':email' => $email]);

        $item = $sm->fetch(PDO::FETCH_ASSOC);

        return $item;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
