<?php

namespace Source\Controllers;
use Source\Models\Users;

class UsersController
{
    protected $instanceJobsModel;

    public function __construct()
    {
        $this->instanceJobsModel = new Users();
    }

    public function create($dataPost)
    {
        $this->instanceJobsModel->insertUser($dataPost);
    }

    public function creteAdmin($dataPost)
    {
        $this->instanceJobsModel->insertUser($dataPost);
    }

    public function showAllJobs()
    {
        $this->instanceJobsModel->showUsers();
    }

    public function clearTableUsers($table)
    {
        if(!array_key_exists('table', $table) || empty($table)){
            echo json_encode(['status' => 'error', 'Informe o nome de uma Table Válida (string)']);
            exit();
        }

        $this->instanceJobsModel->prepareTable($table['table']);
    }

    public function deleteUser($dataPost)
    {
        if(!array_key_exists('id', $dataPost) || empty($dataPost)){
            echo json_encode(['status' => 'error', 'Informe um id  Válida']);
            exit();
        }

        $this->instanceJobsModel->deletUser($dataPost);
    }

    public function showAllUsers()
    {
        $this->instanceJobsModel->showAllUsers();
    }

    public function updateUser($dataPost)
    {
        if(!array_key_exists('id', $dataPost)){
            echo json_encode(['msg' => 'Informe Um id válido', 'status' => 'error']);
            exit();
        }

        $this->instanceJobsModel->updateUser($dataPost);
    }

    public function clearTable($table)
    {

        if(!array_key_exists('table', $table) || empty($table)){
            echo json_encode(['status' => 'error', 'Informe o nome de uma Table Válida (string)']);
            exit();
        }

        $this->instanceJobsModel->prepareTable($table['table']);

    }

}