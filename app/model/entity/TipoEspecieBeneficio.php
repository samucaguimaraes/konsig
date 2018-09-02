<?php

/**
* @Table = tipo_especie_beneficio
* @Schema = konsig
*/
class TipoEspecieBeneficio {

    /**
    * @Serial
    * @Colmap = ide_tipo_especie_beneficio
    */
    private $id;

    /**
    * @Colmap = num_codigo
    * @Persistence (type=texto,NotNull=true,MaxSize=2)
    */
    private $codigo;

    /**
    * @Colmap = nom_tipo_especie_beneficio
    * @Persistence (type=texto,NotNull=true,MaxSize=115)
    */
    private $nome;

    /**
    * @Colmap = des_status
    * @Persistence (type=texto,MaxSize=1)
    */
    private $status;

    /**
    * @Colmap = ide_orgao
    * @Persistence (type=inteiro)
    * @Relationship (objeto=Orgao,type=OneToOne)
    */
    private $orgao;

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

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getOrgao() {
        return $this->orgao;
    }

    public function setOrgao($orgao) {
        $this->orgao = $orgao;
    }

}