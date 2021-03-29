<?php

namespace Api\Model;

class ModelVaga
{
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectVaga()
    {
        $sql = $this->pdo->prepare('
            select distinct
                title,
                description,
                status,
                address,
                salary,
                company
            from 
                vagas
        ');

        $sql->execute();
        $data = $sql->fetchAll($this->pdo::FETCH_OBJ);
        return $data;
    }

    public function selectVagaRecrutador(string $id, string $recrutador_id)
    {
        $sql = $this->pdo->prepare('
            SELECT distinct
                id,
                title,
                description,
                status,
                address,
                salary,
                company
            FROM 
                vagas
            where 
                id = :id and
                recrutador_id = :recrutador_id
        ');
        $sql->execute([
            ':id' => $id,
            ':recrutador_id' => $recrutador_id
        ]);
        $data = $sql->fetchAll($this->pdo::FETCH_OBJ);
        return $data;
    }
    
    public function insertVaga(Vaga $vaga, string $recrutador_id): string
    {
        $sql = $this->pdo->prepare('
            insert into vagas 
                (title,description,status,address,salary,company,recrutador_id) values 
                (:title,:description,:status,:address,:salary,:company,:recrutador_id)
        ');
        $sql->execute([
            ':title' => $vaga->title,
            ':description' => $vaga->description,
            ':status' => $vaga->status,
            ':address' => $vaga->address,
            ':salary' => $vaga->salary,
            ':company' => $vaga->company,
            ':recrutador_id' => (int) $recrutador_id
        ]);

        return $this->pdo->lastInsertId();
    }

    public function updateVaga(Vaga $vaga, string $id, string $recrutador_id): int
    {
        $sql = $this->pdo->prepare('
            update vagas
            set title = :title,
                description = :description,
                status = :status,
                address = :address,
                salary = :salary,
                company = :company
            where 
                id = :id and
                recrutador_id = :recrutador_id
        ');

        $sql->execute([
            ':title' => $vaga->title,
            ':description' => $vaga->description,
            ':status' => $vaga->status,
            ':address' => $vaga->address,
            ':salary' => $vaga->salary,
            ':company' => $vaga->company,
            ':id' => $id,
            ':recrutador_id' => $recrutador_id
        ]);

        return $sql->rowCount();
    }

    public function deleteVaga(string $id, string $recrutador_id): int
    {
        $sql = $this->pdo->prepare('
            delete 
                from vagas 
            where 
                id = :id and
                recrutador_id = :recrutador_id
        ');
        $sql->execute([
            ':id' => $id,
            ':recrutador_id' => $recrutador_id
        ]);

        return $sql->rowCount();
    }
}
