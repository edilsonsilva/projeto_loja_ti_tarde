<?php

class Pagamento{

public $idpagamento;
public $idpedido;
public $tipo;
public $descricao;
public $valor;
public $parcelas;
public $valorparcela;

    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função para listar todos os usuários cadastrados no banco de dados
    */
    public function listar(){
        $query = "select * from pagamento";
        /*
        Será criada a variável stmt(Statement - Sentença)
        para guardar a preparação da consulta select que será executada
        posteriormente
        */
        $stmt = $this->conexao->prepare($query);

        //executar a consulta e retornar seus dados
        $stmt->execute();

        return $stmt;

    }

    public function cadastro(){
        $query = "insert into pagamento set idpedido=:ip, tipo=:t,descricao=:d,valor=:v,parcelas=:p,valorparcela=:vp";

        $stmt = $this->conexao->prepare($query);

        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */        


$stmt->bindParam(":ip",$this->idpedido);
$stmt->bindParam(":t",$this->tipo);
$stmt->bindParam(":d",$this->descricao);
$stmt->bindParam(":v",$this->valor);
$stmt->bindParam(":p",$this->parcelas);
$stmt->bindParam(":vp",$this->valorparcela);



        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }


}


?>