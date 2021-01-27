<?php

namespace App\Models;

use App\Exceptions\EmptyException;
use App\Exceptions\InvalidException;

class Job extends AbstractModel
{
    protected $title;
    protected $description;
    protected $status;
    protected $workplace;
    protected $salary;
    protected $created_at;
    protected $updated_at;

    const STATUS_ABERTA = 1;
    const STATUS_FECHADA = 0;

    public function __construct(array $params = [])
    {
        parent::__construct();
        $this->fill('job', $params);
    }

    public function validate()
    {
        if (empty($this->title)) {
            throw new EmptyException('Informe o título da vaga!');
        }

        if (empty($this->description)) {
            throw new EmptyException('Informe a descrição da vaga!');
        }

        if ((int)$this->status != self::STATUS_ABERTA && (int)$this->status != self::STATUS_FECHADA) {
            throw new InvalidException('Status da vaga inválido! Informe aberta ou fechada.');
        }

        if (strlen($this->title) > 256) {
            throw new InvalidException('Título inválido! Máx. de 256 caracteres.');
        }

        if (strlen($this->description) > 10000) {
            throw new InvalidException('Descrição inválida! Máx. de 10000 caracteres');
        }

        if (!empty($this->salary)) {
            $str = \Str::of($this->salary)->replace(',', '')->__toString();
            $this->salary = number_format($str, 2, '.', '');
        }
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of workplace
     */
    public function getWorkplace()
    {
        return $this->workplace;
    }

    /**
     * Set the value of workplace
     *
     * @return  self
     */
    public function setWorkplace($workplace)
    {
        $this->workplace = $workplace;

        return $this;
    }

    /**
     * Get the value of salary
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Set the value of salary
     *
     * @return  self
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }
}
