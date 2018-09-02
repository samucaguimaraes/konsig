<?php

/**
* @Table = convenio
* @Schema = konsig
*/
class Convenio {

    /**
    * @Serial
    * @Colmap = ide_convenio
    */
    private $id;

    /**
    * @Colmap = nom_convenio
    * @Persistence (type=texto,NotNull=true,MaxSize=115)
    */
    private $nome;

    /**
    * @Colmap = ide_banco
    * @Persistence (type=inteiro)
    * @Relationship (objeto=Banco,type=OneToOne)
    */
    private $banco;

    /**
    * @Colmap = ide_orgao
    * @Persistence (type=inteiro)
    * @Relationship (objeto=Orgao,type=OneToOne)
    */
    private $orgao;

    /**
    * @Colmap = vlr_taxa
    * @Persistence (type=texto)
    */
    private $valorTaxa;

    /**
    * @Colmap = des_prazo
    * @Persistence (type=texto,MaxSize=2)
    */
    private $prazo;

    /**
    * @Colmap = des_idade_minima
    * @Persistence (type=texto,MaxSize=2)
    */
    private $idadeMinima;

    /**
    * @Colmap = des_idade_maxima
    * @Persistence (type=texto,MaxSize=2)
    */
    private $idadeMaxima;

    /**
    * @Colmap = ide_usuario_criador
    * @Persistence (type=inteiro)
    * @Relationship (objeto=Usuario,type=OneToOne)
    */
    private $usuarioCriador;

    /**
    * @Colmap = dat_criacao
    * @Persistence (type=texto)
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

    /**
    * @Colmap = ide_tipo_situacao
    * @Persistence (type=inteiro)
    * @Relationship (objeto=TipoSituacao,type=OneToOne)
    */
    private $tipoSituacao;

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

    public function getBanco() {
        return $this->banco;
    }

    public function setBanco($banco) {
        $this->banco = $banco;
    }

    public function getOrgao() {
        return $this->orgao;
    }

    public function setOrgao($orgao) {
        $this->orgao = $orgao;
    }

    public function getValorTaxa() {
        return $this->valorTaxa;
    }

    public function setValorTaxa($valorTaxa) {
        $this->valorTaxa = $valorTaxa;
    }

    public function getPrazo() {
        return $this->prazo;
    }

    public function setPrazo($prazo) {
        $this->prazo = $prazo;
    }

    public function getIdadeMinima() {
        return $this->idadeMinima;
    }

    public function setIdadeMinima($idadeMinima) {
        $this->idadeMinima = $idadeMinima;
    }

    public function getIdadeMaxima() {
        return $this->idadeMaxima;
    }

    public function setIdadeMaxima($idadeMaxima) {
        $this->idadeMaxima = $idadeMaxima;
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

    public function getTipoSituacao() {
        return $this->tipoSituacao;
    }

    public function setTipoSituacao($tipoSituacao) {
        $this->tipoSituacao = $tipoSituacao;
    }

}