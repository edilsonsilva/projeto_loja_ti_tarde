<?php

class Cliente{
public $idcliente;
public $nomecliente;
public $cpf;
public $sexo;
public $idcontato;
public $idendereco;
public $idusuario;

    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função para listar todos os usuários cadastrados no banco de dados
    */
    public function listar(){
        $query = "select * from cliente";
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


        $contato = "SELECT * FROM contato order by idcontato desc limit 0,1;";
        $stmt = $this->conexao->prepare($contato);
        $rs = $stmt->execute();

        while($linha = $rs->fetch(PDO::FETCH_ASSOC)){
            $this->idcontato=$linha["idcontato"];
        }


        $endereco = "SELECT * FROM endereco order by idendereco desc limit 0,1;";
        $stmt = $this->conexao->prepare($endereco);
        $rs = $stmt->execute();

        while($linha = $rs->fetch(PDO::FETCH_ASSOC)){
            $this->idendereco=$linha["idendereco"];
        }


        $usuario = "SELECT * FROM usuario order by idusuario desc limit 0,1;";
        $stmt = $this->conexao->prepare($usuario);
        $rs = $stmt->execute();

        while($linha = $rs->fetch(PDO::FETCH_ASSOC)){
            $this->idusuario=$linha["idusuario"];
        }



        $query = "insert into cliente set nomecliente=:n,cpf=:c,sexo=:s,idcontato=:ic,idendereco=:ie,idusuario=:iu";

        $stmt = $this->conexao->prepare($query);

        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */

$stmt->bindParam(":n",$this->nomecliente);
$stmt->bindParam(":c",$this->cpf);
$stmt->bindParam(":s",$this->sexo);
$stmt->bindParam(":ic",$this->idcontato);
$stmt->bindParam(":ie",$this->idendereco);
$stmt->bindParam(":iu",$this->idusuario);



        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

    public function atualizarcliente(){
        $query = "update cliente set nomecliente=:n,cpf=:c,sexo=:s,idcontato=:ic,idendereco=:ie,idusuario=:iu where idcliente=:idcli";

        $stmt = $this->conexao->prepare($query);

        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */

$stmt->bindParam(":n",$this->nomecliente);
$stmt->bindParam(":c",$this->cpf);
$stmt->bindParam(":s",$this->sexo);
$stmt->bindParam(":ic",$this->idcontato);
$stmt->bindParam(":ie",$this->idendereco);
$stmt->bindParam(":iu",$this->idusuario);
$stmt->bindParam(":idcli",$this->idcliente);



        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }


    public function apagarcliente(){
        $query = "delete from cliente where idcliente=:id";

        $stmt = $this->conexao->prepare($query);

        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
        $stmt->bindParam(":id",$this->idcliente);
      

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }


    

}


?>