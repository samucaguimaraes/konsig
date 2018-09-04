<?php

/**
* @Table = corretor_banco
* @Schema = konsig
*/
class CorretorBanco {

    /**
    * @Serial
    * @Colmap = ide_corretor_banco
    */
    private $id;

    /**
    * @Colmap = ide_corretor
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=Corretor,type=OneToOne)
    */
    private $corretor;

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

    function getId() {
        return $this->id;
    }

    function getCorretor() {
        return $this->corretor;
    }

    function getBanco() {
        return $this->banco;
    }

    function getNumeroAgencia() {
        return $this->numeroAgencia;
    }

    function getNumeroConta() {
        return $this->numeroConta;
    }

    function getTipoConta() {
        return $this->tipoConta;
    }

    function getObservacao() {
        return $this->observacao;
    }

    function getUsuarioCriador() {
        return $this->usuarioCriador;
    }

    function getDataCriacao() {
        return $this->dataCriacao;
    }

    function getUsuarioAtualizador() {
        return $this->usuarioAtualizador;
    }

    function getDataAtualizacao() {
        return $this->dataAtualizacao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCorretor($corretor) {
        $this->corretor = $corretor;
    }

    function setBanco($banco) {
        $this->banco = $banco;
    }

    function setNumeroAgencia($numeroAgencia) {
        $this->numeroAgencia = $numeroAgencia;
    }

    function setNumeroConta($numeroConta) {
        $this->numeroConta = $numeroConta;
    }

    function setTipoConta($tipoConta) {
        $this->tipoConta = $tipoConta;
    }

    function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

    function setUsuarioCriador($usuarioCriador) {
        $this->usuarioCriador = $usuarioCriador;
    }

    function setDataCriacao($dataCriacao) {
        $this->dataCriacao = $dataCriacao;
    }

    function setUsuarioAtualizador($usuarioAtualizador) {
        $this->usuarioAtualizador = $usuarioAtualizador;
    }

    function setDataAtualizacao($dataAtualizacao) {
        $this->dataAtualizacao = $dataAtualizacao;
    }


}