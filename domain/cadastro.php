<?php

class Cadastro{
    public $idcliente;
    public $nomecliente;
    public $cpf;
    public $sexo;
    public $idcontato;
    public $idendereco;
    public $idusuario;
    public $telefone;
    public $email;
    public $tipo;
    public $logradouro;
    public $numero;
    public $complemento;
    public $bairro;
    public $cep;
    public $nomeusuario;
    public $senha;
    public $foto;


public function __construct($db){
    $this->conexao = $db;
}



public function cadastro(){

    $query = "insert into usuario set nomeusuario=:n, senha=:s, foto=:f";

    $stmtu = $this->conexao->prepare($query);

    //Encriptografar a senha com o uso de md5
    $this->senha = md5($this->senha);

    /*Vamos vincular os dados que veem do app ou navegador com os campos de
    banco de dados
    */
    $stmtu->bindParam(":n",$this->nomeusuario);
    $stmtu->bindParam(":s",$this->senha);
    $stmtu->bindParam(":f",$this->foto);

    //vamos executar a consulta para realizar o cadastro na tabela usuario
    $stmtu->execute();

    //Vamos obter o ID gerado neste cadastro
    $this->idusuario = $this->conexao->lastInsertId();
    

    //-------------------- cadastro do contato -----------------------

    $query = "insert into contato set telefone=:t, email=:e";

    $stmtc = $this->conexao->prepare($query);

    /*Vamos vincular os dados que veem do app ou navegador com os campos de
    banco de dados
    */
    $stmtc->bindParam(":t",$this->telefone);
    $stmtc->bindParam(":e",$this->email);

    $stmtc->execute();
    $this->idcontato=$this->conexao->lastInsertId();


    //----------- Cadastro de endereco ------------------------------

    $query = "insert into endereco set tipo=:t,logradouro=:l,numero=:n,complemento=:c,bairro=:b,cep=:cep";

    $stmte = $this->conexao->prepare($query);
    /*Vamos vincular os dados que veem do app ou navegador com os campos de
    banco de dados
    */
    
    $stmte->bindParam(":t",$this->tipo);
    $stmte->bindParam(":l",$this->logradouro);
    $stmte->bindParam(":n",$this->numero);
    $stmte->bindParam(":c",$this->complemento);
    $stmte->bindParam(":b",$this->bairro);
    $stmte->bindParam(":cep",$this->cep);


    $stmte->execute();

    $this->idendereco=$this->conexao->lastInsertId();


    //--------------------- Cadastro do cliente ---------------

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
}
?>