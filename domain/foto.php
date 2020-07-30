<?php

class Foto{
    public $idfoto;
    public $foto1;
    public $foto2;
    public $foto3;
    public $foto4;

    public function __construct($db){
        $this->conexao = $db;
    }

    public function listar(){
        $query = "select * from foto";

        $stmt = $this->conexao->prepare($query);

        $stmt->execute();
    
        return $stmt;
    }
}