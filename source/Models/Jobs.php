<?php

namespace Source\Models;
use Source\FirebaseCore;
use Source\Helpers\Functions;

class Jobs extends Functions
{
    private $table   = 'jobs';
    private $instanceFirebase;
    private $colunms = [
        'title'          => ['rules' => ['type' => 'string|max256', 'required' => true]],
        'description'    => ['rules' => ['type' => "string|max10000", 'required' => true]],
        'status'         => ['rules' => ['type' => 'enum|max3', 'required' => true]],
        'workplace'      => ['rules' => ['type' => 'string|*', 'required' => false]],
        'salary'         => ['rules' => ['type' => 'string|*','required' => false]],
    ];

    public function __construct()
    {
        $this->instanceFirebase = new FirebaseCore();
        $this->instanceFirebase->setTable($this->table);
    }

    public function insertJob($dataPost)
    {
        $formValidade = Functions::formValidateTable($this->colunms, $dataPost);
        if($formValidade){
            $create       = $this->instanceFirebase->insertRecord(Functions::getFinalTable(), true);
            if($create){
                echo json_encode(['status' => 'success','dataInsert' => $create]);
                exit();
            }

            echo json_encode(['status' => 'error']);
            exit();
        }

    }

    public function updateJob($dataPost)
    {
        $idJob = $dataPost['id'];

        $formValidade = Functions::formValidateTable($this->colunms, $dataPost);
        if($formValidade){
            $update   = $this->instanceFirebase->updateRecord($idJob, Functions::getFinalTable());
            if($update){
                echo json_encode(['status' => 'success','dataUpdate' => $update]);
                exit();
            }

            echo json_encode(['msg' => 'Impossivel Salvar, id Informado Não confere', 'status' => 'error']);
            exit();
        }
    }

    public function showAllRecords()
    {
        $records = $this->instanceFirebase->getRecords();

        if(!empty($records)){
            echo json_encode(['allRecords' => $records]);
            return;
        }

        echo json_encode(['status' => 'error', 'msg' => 'Não foram Encontrados Registros']);
        exit();
    }

    public function prepareTable(string $table)
    {
        $this->instanceFirebase->truncateTable($table);
    }

    public function deleteJob($dataPost)
    {

        if(!empty($dataPost)){
            $delete   = $this->instanceFirebase->deleteRecord($dataPost['id']);
            if($delete){
                echo json_encode(['status' => 'success','dataDelete' => $delete]);
                exit();
            }

            echo json_encode(['msg' => 'Impossivel Salvar, id Informado Não confere', 'status' => 'error']);
            exit();
        }
    }



}