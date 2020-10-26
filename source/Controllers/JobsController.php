<?php

namespace Source\Controllers;
use Source\Models\Jobs;

class JobsController
{
    protected $instanceJobsModel;

    public function __construct()
    {
        $this->instanceJobsModel = new Jobs();
    }

    public function create($dataPost)
    {
        $this->instanceJobsModel->insertJob($dataPost);
    }

    public function showAllJobs()
    {
        $this->instanceJobsModel->showAllRecords();
    }

    public function clearTable($table)
    {

        if(!array_key_exists('table', $table) || empty($table)){
            echo json_encode(['status' => 'error', 'Informe o nome de uma Table Válida (string)']);
            exit();
        }

        $this->instanceJobsModel->prepareTable($table['table']);

    }

    public function updateJob($dataPost)
    {
        if(!array_key_exists('id', $dataPost)){
            echo json_encode(['msg' => 'Informe Um id válido', 'status' => 'error']);
            exit();
        }

        $this->instanceJobsModel->updateJob($dataPost);
    }

    public function deleteJob($dataPost)
    {
        if(!array_key_exists('id', $dataPost)){
            echo json_encode(['msg' => 'Informe Um id válido', 'status' => 'error']);
            exit();
        }

        $this->instanceJobsModel->deleteJob($dataPost);
    }
}