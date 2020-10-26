<?php

namespace Source\Models;
use Source\FirebaseCore;
use Source\Helpers\Functions;

class Users extends Functions
{
    private $table   = 'users';
    private $instanceFirebase;

    private $columns = [
        'name'       => ['rules' => ['required' => true, 'type' => 'string|*']],
        'email'      => ['rules' => ['required' => true, 'type' => 'string|email']],
        'password'   => ['rules' => ['required' => true, 'type' => 'string|*', 'encrypted' => true]],
        'permission' => ['rules' => ['required' => true, 'type' => 'string|*']]
    ];

    public function __construct()
    {
        $this->instanceFirebase = new FirebaseCore();
        $this->instanceFirebase->setTable($this->table);
    }

    public function insertUser($dataPost)
    {
        $formValidade = Functions::formValidateTable($this->columns, $dataPost);

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

    public function showAllUsers()
    {
        $records = $this->instanceFirebase->getRecords();
        if(!empty($records)){
            echo json_encode(['allUsers' => $records]);
            return;
        }

        echo json_encode(['status' => 'error', 'msg' => 'Não foram Encontrados Usuários Cadastrados']);
        exit();
    }

    public function prepareTable(string $table)
    {
        $this->instanceFirebase->truncateTable($table);
    }

    public function deletUser($dataPost)
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

    public function updateUser($dataPost)
    {
        $idJob = $dataPost['id'];

        $formValidade = Functions::formValidateTable($this->columns, $dataPost);
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



}