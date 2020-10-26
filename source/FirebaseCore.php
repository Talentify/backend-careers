<?php

namespace Source;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseCore
{
    protected $database;
    protected $table          = 'jobs';
    public $primaryKey        = 'id';
    protected $firebase;
    public $secretKeyJsonPath = '';

    /**
     * Metodo Construtor
     *
     * @var string
     */
    public function __construct()
    {
        $this->secretKeyJsonPath = EngineFirebase::secretKey();
        $serviceAccount          = ServiceAccount::fromJsonFile(__DIR__ . $this->secretKeyJsonPath);
        $this->firebase          = (new Factory)->withServiceAccount($serviceAccount)->create();

        $this->database = $this->firebase->getDatabase();
    }

    /**
     * Metodo Setar Tabela
     *
     * @param string $table
     * @return $this
     */
    public function setTable(string $table)
    {
        $this->table = $table;
    }

    /**
     * Metodo Setar chave primária de uma tabela
     *
     * @param string $primaryKey
     * @return $this
     */
    public function setPrimaryKey(string $primaryKey)
    {
        $this->primaryKey = $primaryKey;

        return $this;
    }

    /**
     * Metodo Recuperar Todos Registro da Tabela que foi definida
     *
     * @return mixed
     */
    public function getRecords()
    {
        return $this->database->getReference($this->table)->getValue();
    }

    /**
     * Metodo Insert
     * Para Retornar Registro salvo, $returnData = true
     *
     * @param array $data
     * @param bool $returnData
     * @return $this|mixed
     * @throws \Exception
     */
    public function insertRecord(array $data, $returnData = false)
    {
        $countedRecords          = empty($this->getRecords()) ? 0 : count($this->getRecords());
        $data[$this->primaryKey] = $countedRecords > 1 ? $countedRecords + 1 : 1;
        $this->database->getReference()
            ->getChild($this->table)
            ->getChild($countedRecords)
            ->set($data);

        if ($returnData) {
            return $this->getRecord($data[$this->primaryKey]);
        }

        return $this;
    }

    /**
     * Metodo Resgatar Registro usando Parametros $this->>primaryKey
     * @param int $recordID
     * @return null|array
     */
    public function getRecord(int $recordID)
    {
        foreach($this->getRecords() as $key => $record) {
            if($record != null) {
                if($record[$this->primaryKey] == $recordID){
                    return $record;
                }
            }
        }

        return null;
    }

    /**
     * Metodo Responsável Pelo Login
     *
     * @param string $email
     * @param  string $password
     * @return bool
     */
    public function getLoginUser(string $email, string $password)
    {

      if(is_null($this->getRecords()) || empty($this->getRecords())){
          echo json_encode(['msg' => "Tabela {$this->table} Informada Não Localizada", 'status' => 'error']);
          exit();
      }

      foreach($this->getRecords() as $key => $record) {
          if($record != null) {
              if($record['email'] == $email){
                if(password_verify($password, $record['password'])){
                    return true;
                 }
              }
          }
      }

        return false;
    }

    /**
     * Metodo Atualizar Registro
     * Retornar o Registro Atualizado
     *
     * @param int $recordID
     * @param array $data
     * @return array
     */
    public function updateRecord(int $recordID, array $data)
    {
        foreach ($this->getRecords() as $key => $record) {
            if($record != null) {
                if ($recordID == $record[$this->primaryKey]) {
                    foreach ($data as $dataKey => $dataValue) {
                        if (isset($record[$dataKey])) {
                            $record[$dataKey] = $dataValue;
                        }
                    }

                    $this->database->getReference()
                        ->getChild($this->table)
                        ->getChild($key)
                        ->set($record);
                }
            }
        }

        return $this->getRecord($recordID);
    }

    /**
     * Metodo Delete dos Registro
     * Cuidados : Setar Cuidadosamente a Tabela
     * @param int $recordID
     * @return bool
     */
    public function deleteRecord(int $recordID) {
        foreach ($this->getRecords() as $key => $record) {
            if($record != null) {
                if ($record[$this->primaryKey] == $recordID) {
                    $this->database->getReference()
                        ->getChild($this->table)
                        ->getChild($key)
                        ->set(null);

                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Metodo Responsável Por Deletar uma Tabela
     * Cuidados : Setar Cuidadosamente a Tabela
     * @param int $recordID
     * @return bool
     */
    public function truncateTable($tableTarget)
    {
        $isExistRegisters = $this->database->getReference($tableTarget)->getValue();

        if(empty($isExistRegisters) || is_null($isExistRegisters) ){
            echo json_encode(['status' => 'error', 'msg' => 'Esta Tabela Já esta Vazia ou não Existe']);
            exit();
        }

        $amountDeletRecords = 0;
        foreach($isExistRegisters as $key => $record){
            if($record != null) {
                $this->database->getReference()
                    ->getChild($this->table)
                    ->getChild($key)
                    ->set(null);

                $amountDeletRecords++;
            }
        }

        echo json_encode(['status' => 'success', 'Amout Records Deleted' => $amountDeletRecords]);
        exit();

    }


}