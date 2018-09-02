<?php

/**
* @Table = orgao
* @Schema = konsig
*/
class Orgao {

    /**
    * @Serial
    * @Colmap = ide_orgao
    */
    private $id;

    /**
    * @Colmap = nom_orgao
    * @Persistence (type=texto,NotNull=true,MaxSize=115)
    */
    private $nome;

    /**
    * @Colmap = des_sigla
    * @Persistence (type=texto,MaxSize=25)
    */
    private $sigla;

    /**
    * @Colmap = ide_tipo_orgao
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=TipoOrgao,type=OneToOne)
    */
    private $tipoOrgao;

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

    public function getSigla() {
        return $this->sigla;
    }

    public function setSigla($sigla) {
        $this->sigla = $sigla;
    }

    public function getTipoOrgao() {
        return $this->tipoOrgao;
    }

    public function setTipoOrgao($tipoOrgao) {
        $this->tipoOrgao = $tipoOrgao;
    }

}