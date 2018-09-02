<?php

/**
* @Table = banco
* @Schema = konsig
*/
class Banco {

    /**
    * @Serial
    * @Colmap = ide_banco
    */
    private $id;

    /**
    * @Colmap = num_codigo
    * @Persistence (type=texto,MaxSize=3)
    */
    private $codigo;

    /**
    * @Colmap = nom_banco
    * @Persistence (type=texto,NotNull=true,MaxSize=115)
    */
    private $nome;

    /**
    * @Colmap = num_cnpj
    * @Mask = cnpj
    * @Persistence (type=cnpj,NotNull=true,MaxSize=14)
    */
    private $numeroCNPJ;

    /**
    * @Colmap = des_url
    * @Persistence (type=texto,MaxSize=115)
    */
    private $url;

    /**
    * @Colmap = des_status
    * @Persistence (type=texto,MaxSize=1)
    */
    private $status;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNumeroCNPJ() {
        return $this->numeroCNPJ;
    }

    public function setNumeroCNPJ($numeroCNPJ) {
        $this->numeroCNPJ = $numeroCNPJ;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

}