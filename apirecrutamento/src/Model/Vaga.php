<?php

namespace Api\Model;

class Vaga
{
    public $title;
    public $description;
    public $status;
    public $address;
    public $salary;
    public $company;

    public function __construct(
        $title,
        $description,
        $status,
        $address,
        $salary,
        $company
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->address = $address;
        $this->salary = $salary;
        $this->company = $company;
    }
}
