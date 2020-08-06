<?php

class Contato{
    public $idcontato;
    public $telefone;
    public $email;

    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função para listar todos os usuários cadastrados no banco de dados
    */
    public function listar(){
        $query = "select * from contato";
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
        $query = "insert into contato set telefone=:t, email=:e";

        $stmt = $this->conexao->prepare($query);

        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
        $stmt->bindParam(":t",$this->telefone);
        $stmt->bindParam(":e",$this->email);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

    public function atualizarcontato(){
        $query = "update contato set telefone=:t, email=:e where idcontato=:id";

        $stmt = $this->conexao->prepare($query);

        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
        $stmt->bindParam(":t",$this->telefone);
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":id",$this->idcontato);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function apagarcontato(){
        $query = "delete from contato where idcontato=:id";

        $stmt = $this->conexao->prepare($query);

        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
        $stmt->bindParam(":id",$this->idcontato);
      

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

}


?>