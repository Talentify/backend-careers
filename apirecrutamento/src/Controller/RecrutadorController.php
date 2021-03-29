<?php

namespace Api\Controller;

use Api\Model\Recrutador;
use Api\Model\ModelRecrutador;
use Api\DataBase\Sqlite;

class RecrutadorController
{
    public $pdo;
    private $recrutador;

    public function __construct()
    {
        $this->pdo = new Sqlite();
        $this->recrutador = new ModelRecrutador($this->pdo);
    }

    public function login(string $dadosLogin): array
    {

        $dadosLogin = explode(':', $dadosLogin);
        $usuario = $dadosLogin[0];
        $senha = $dadosLogin[1];
    
        $usuarioID = 0;
        $usuarioValidado = '';
        
        $dadosUsuario = $this->recrutador->selectRecrutador($usuario, $senha);

        if(!empty($dadosUsuario[0]->usuario)) {
            $usuarioID = $dadosUsuario[0]->id;
            $usuarioValidado = $dadosUsuario[0]->usuario;
        }
        return [
            'id' => $usuarioID,
            'usuario' => $usuarioValidado
        ];
    }

    public function create(Recrutador $recrutador): array 
    {
        $this->recrutador->insertRecrutador($recrutador);

        return [
            'msg' => 'Recrutador cadastrado: ' . $recrutador->nome,
            'status' => 201
        ];
    }
}
