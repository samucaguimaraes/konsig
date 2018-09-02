<?php

/**
* @Table = pessoa_convenio
* @Schema = konsig
*/
class PessoaConvenio {

    /**
    * @Serial
    * @Colmap = ide_pessoa_convenio
    */
    private $id;

    /**
    * @Colmap = ide_pessoa
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=Pessoa,type=OneToOne)
    */
    private $pessoa;

    /**
    * @Colmap = ide_convenio
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=Convenio,type=OneToOne)
    */
    private $convenio;

    /**
    * @Colmap = des_observacao
    * @Persistence (type=texto,MaxSize=115)
    */
    private $observacao;

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

    public function getConvenio() {
        return $this->convenio;
    }

    public function setConvenio($convenio) {
        $this->convenio = $convenio;
    }

    public function getObservacao() {
        return $this->observacao;
    }

    public function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

}