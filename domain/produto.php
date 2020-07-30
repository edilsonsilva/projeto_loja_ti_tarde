<?php

class Produto{

public $idproduto;
public $nomeproduto;
public $descricao;
public $preco;
public $idfoto;


public function __construct($db){
    $this->conexao = $db;
}

public function listar(){
    $query = "select * from produto";

    $stmt = $this->conexao->prepare($query);

    $stmt->execute();

    return $stmt;
}
}

?>