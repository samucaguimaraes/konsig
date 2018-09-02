<?php

/**
* @Table = notificacao
* @Schema = konsig
*/
class Notificacao {

    /**
    * @Serial
    * @Colmap = ide_notificacao
    */
    private $id;

    /**
    * @Colmap = des_elemento
    * @Persistence (type=texto,NotNull=true,MaxSize=25)
    */
    private $descricaoElemento;

    /**
    * @Colmap = ide_elemento
    * @Persistence (type=inteiro,NotNull=true)
    */
    private $elemento;

    /**
    * @Colmap = des_notificacao
    * @Persistence (type=texto,NotNull=true,MaxSize=500)
    */
    private $notificacao;

    /**
    * @Colmap = des_status
    * @Persistence (type=texto,NotNull=true,MaxSize=1)
    */
    private $status;

    /**
    * @Colmap = dat_alarme
    * @Persistence (type=texto)
    */
    private $dataAlarme;

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

    /**
    * @Colmap = ide_tipo_notificacao
    * @Persistence (type=inteiro,NotNull=true)
    */
    private $tipoNotificacao;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDescricaoElemento() {
        return $this->descricaoElemento;
    }

    public function setDescricaoElemento($descricaoElemento) {
        $this->descricaoElemento = $descricaoElemento;
    }

    public function getElemento() {
        return $this->elemento;
    }

    public function setElemento($elemento) {
        $this->elemento = $elemento;
    }

    public function getNotificacao() {
        return $this->notificacao;
    }

    public function setNotificacao($notificacao) {
        $this->notificacao = $notificacao;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getDataAlarme() {
        return $this->dataAlarme;
    }

    public function setDataAlarme($dataAlarme) {
        $this->dataAlarme = $dataAlarme;
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

    public function getTipoNotificacao() {
        return $this->tipoNotificacao;
    }

    public function setTipoNotificacao($tipoNotificacao) {
        $this->tipoNotificacao = $tipoNotificacao;
    }

}