<?php

/**
* @Table = consulta
* @Schema = konsig
*/
class Consulta {

    /**
    * @Serial
    * @Colmap = ide_consulta
    */
    private $id;

    /**
    * @Colmap = ide_pessoa_orgao
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=PessoaOrgao,type=OneToOne)
    */
    private $PessoaOrgao;

    /**
    * @Colmap = dat_consulta
    * @Mask = data
    * @Persistence (type=data,NotNull=true,MaxSize=10)
    */
    private $dataConsulta;

    /**
    * @Colmap = vlr_margem_disponivel
    * @Mask = monetario
    * @Persistence (type=monetario,NotNull=true)
    */
    private $margemDisponivel;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPessoaOrgao() {
        return $this->PessoaOrgao;
    }

    public function setPessoaOrgao($PessoaOrgao) {
        $this->PessoaOrgao = $PessoaOrgao;
    }

    public function getDataConsulta() {
        return $this->dataConsulta;
    }

    public function setDataConsulta($dataConsulta) {
        $this->dataConsulta = $dataConsulta;
    }

    public function getMargemDisponivel() {
        return $this->margemDisponivel;
    }

    public function setMargemDisponivel($margemDisponivel) {
        $this->margemDisponivel = $margemDisponivel;
    }

}