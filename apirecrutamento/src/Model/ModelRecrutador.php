<?php

namespace Api\Model;

class ModelRecrutador
{
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectRecrutador($usuario, $senha)
    {
        $sql = $this->pdo->prepare('
            select
                id,
                usuario
            from
                recrutador
            where 
                usuario = :usuario and
                senha = :senha
        ');

        $sql->execute([
            ':usuario' => $usuario,
            ':senha' => $senha,
        ]);
        $data = $sql->fetchAll($this->pdo::FETCH_OBJ);
        return $data;
    }

    /**
     * Insert Recrutador
     */
    public function insertRecrutador($recrutador): string
    {
        $sql = $this->pdo->prepare('
            insert into recrutador 
                (nome,usuario,senha,empresa) values 
                (:nome,:usuario,:senha,:empresa)
        ');
        $sql->execute([
            ':nome' => $recrutador->nome,
            ':usuario' => $recrutador->usuario,
            ':senha' => $recrutador->senha,
            ':empresa' => $recrutador->empresa
        ]);

        return $this->pdo->lastInsertId();
    }

    public function updateRecrutador($recrutador, $id): int
    {
        $sql = $this->pdo->prepare('
            update recrutador set 
                nome = :nome,
                usuario = :usuario,
                senha = :senha
                empresa = :empresa
            where id = :id
        ');
        $sql->execute([
            ':nome' => $recrutador->nome,
            ':usuario' => $recrutador->usuario,
            ':senha' => $recrutador->senha,
            ':empresa' => $recrutador->empresa,
            ':id' => $id
        ]);
        
        return $sql->rowCount();
    }
    
    public function delete($id): int
    {
        $sql = $this->pdo->prepare('
            delete from recrutador where id = :id
        ');
        $sql->execute([
            ':id' => $id
        ]);

        return $sql->rowCount();
    }
}
