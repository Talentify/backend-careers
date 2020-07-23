<?php

namespace App\Core;

abstract class Controller
{
    protected $repository;
    protected $service;

    public function __construct()
    {
        $this->initializeRepository();
        $this->initializeService();
    }

    abstract protected function initializeRepository();
    abstract protected function initializeService();
}
