<?php

namespace Api\Model;

class Recrutador
{
    public $nome;
    public $usuario;
    public $senha;
    public $empresa;

    public function __construct($nome, $usuario, $senha, $empresa)
    {
        $this->nome = $nome;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->empresa = $empresa;
    }
}
