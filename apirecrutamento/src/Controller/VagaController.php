<?php

namespace Api\Controller;

use Api\Model\Vaga;
use Api\Model\ModelVaga;
use Api\DataBase\Sqlite;

class VagaController
{
    public $pdo;
    public $vaga;

    public function __construct()
    {
        $this->pdo = new Sqlite();
        $this->vaga = new ModelVaga($this->pdo);
    }

    public function findAll(): array
    {
        return $this->vaga->selectVaga();
    }

    public function find(string $id, string $recrutador_id): array
    {
        return $this->vaga->selectVagaRecrutador($id, $recrutador_id);
    }

    public function create(Vaga $vaga, $recrutador_id): array 
    {
        $this->vaga->insertVaga($vaga, $recrutador_id);

        return [
            'msg' => 'Vaga cadastrada: ' . $vaga->description,
            'status' => 201
        ];
    }

    public function update(Vaga $vaga, $id, $recrutador_id): array
    {
        $this->vaga->updateVaga($vaga, $id, $recrutador_id);

        return [
            'msg' => 'Vaga atualizada: ' . $vaga->title,
            'status' => 201
        ];
    }

    public function delete($id, $recrutador_id): array
    {
        $this->vaga->deleteVaga($id, $recrutador_id);

        return [
            'msg' => 'Vaga Deletada: ' . $id,
            'status' => 201
        ];
    }
}
