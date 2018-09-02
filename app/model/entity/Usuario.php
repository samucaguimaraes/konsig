<?php

/**
* @Table = usuario
* @Schema = konsig
*/
class Usuario {

    /**
    * @Serial
    * @Colmap = ide_usuario
    */
    private $id;

    /**
    * @Colmap = nom_usuario
    * @Persistence (type=texto,NotNull=true,MaxSize=200)
    */
    private $nome;

    /**
    * @Colmap = des_email
    * @Persistence (type=email,NotNull=true,MaxSize=150)
    */
    private $email;

    /**
    * @Colmap = des_senha
    * @Persistence (type=senha,NotNull=true,MaxSize=16)
    */
    private $senha;

    /**
    * @Colmap = des_status
    * @Persistence (type=texto,size=1)
    */
    private $status;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

}