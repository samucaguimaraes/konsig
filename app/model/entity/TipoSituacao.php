<?php

/**
* @Table = tipo_situacao
* @Schema = konsig
*/
class TipoSituacao {

    /**
    * @Serial
    * @Colmap = ide_tipo_situacao
    */
    private $id;

    /**
    * @Colmap = nom_tipo_situacao
    * @Persistence (type=texto,NotNull=true,MaxSize=115)
    */
    private $nome;

    /**
    * @Colmap = des_status
    * @Persistence (type=texto,NotNull=true,MaxSize=1)
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

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

}