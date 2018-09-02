<?php

/**
* @Table = pessoa_banco
* @Schema = konsig
*/
class PessoaBanco {

    /**
    * @Serial
    * @Colmap = ide_pessoa_banco
    */
    private $id;

    /**
    * @Colmap = ide_pessoa
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=Pessoa,type=OneToOne)
    */
    private $pessoa;

    /**
    * @Colmap = ide_banco
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=Banco,type=OneToOne)
    */
    private $banco;

    /**
    * @Colmap = num_agencia
    * @Persistence (type=texto,NotNull=true,MaxSize=10)
    */
    private $numeroAgencia;

    /**
    * @Colmap = num_conta
    * @Persistence (type=texto,NotNull=true,MaxSize=15)
    */
    private $numeroConta;

    /**
    * @Colmap = ide_tipo_conta
    * @Persistence (type=inteiro,NotNull=true)
    */
    private $tipoConta;

    /**
    * @Colmap = des_observacao
    * @Persistence (type=texto,MaxSize=250)
    */
    private $observacao;

    /**
    * @Colmap = ide_usuario_criador
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=Usuario,type=OneToOne)
    */
    private $usuarioCriador;

    /**
    * @Colmap = dat_criacao
    * @Persistence (type=texto,NotNull=true)
    */
    private $dataCriacao;

    /**
    * @Colmap = ide_usuario_atualizador
    * @Persistence (type=inteiro)
    * @Relationship (objeto=Usuario,type=OneToOne)
    */
    private $usuarioAtualizador;

    /**
    * @Colmap = dat_atualizacao
    * @Persistence (type=texto)
    */
    private $dataAtualizacao;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPessoa() {
        return $this->pessoa;
    }

    public function setPessoa($pessoa) {
        $this->pessoa = $pessoa;
    }

    public function getBanco() {
        return $this->banco;
    }

    public function setBanco($banco) {
        $this->banco = $banco;
    }

    public function getNumeroAgencia() {
        return $this->numeroAgencia;
    }

    public function setNumeroAgencia($numeroAgencia) {
        $this->numeroAgencia = $numeroAgencia;
    }

    public function getNumeroConta() {
        return $this->numeroConta;
    }

    public function setNumeroConta($numeroConta) {
        $this->numeroConta = $numeroConta;
    }

    public function getTipoConta() {
        return $this->tipoConta;
    }

    public function setTipoConta($tipoConta) {
        $this->tipoConta = $tipoConta;
    }

    public function getObservacao() {
        return $this->observacao;
    }

    public function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

    public function getUsuarioCriador() {
        return $this->usuarioCriador;
    }

    public function setUsuarioCriador($usuarioCriador) {
        $this->usuarioCriador = $usuarioCriador;
    }

    public function getDataCriacao() {
        return $this->dataCriacao;
    }

    public function setDataCriacao($dataCriacao) {
        $this->dataCriacao = $dataCriacao;
    }

    public function getUsuarioAtualizador() {
        return $this->usuarioAtualizador;
    }

    public function setUsuarioAtualizador($usuarioAtualizador) {
        $this->usuarioAtualizador = $usuarioAtualizador;
    }

    public function getDataAtualizacao() {
        return $this->dataAtualizacao;
    }

    public function setDataAtualizacao($dataAtualizacao) {
        $this->dataAtualizacao = $dataAtualizacao;
    }

}