<?php

/**
* @Table = tipo_orgao
* @Schema = konsig
*/
class TipoOrgao {

    /**
    * @Serial
    * @Colmap = ide_tipo_orgao
    */
    private $id;

    /**
    * @Colmap = nom_tipo_orgao
    * @Persistence (type=texto,NotNull=true,MaxSize=115)
    */
    private $nome;

    /**
    * @Colmap = ide_tipo_situacao
    * @Persistence (type=inteiro,NotNull=true)
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

    public function getTipoSituacao() {
        return $this->tipoSituacao;
    }

    public function setTipoSituacao($tipoSituacao) {
        $this->tipoSituacao = $tipoSituacao;
    }

}