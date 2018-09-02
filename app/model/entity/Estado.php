<?php

/**
* @Table = estado
* @Schema = konsig
*/
class Estado {

    /**
    * @Serial
    * @Colmap = ide_estado
    */
    private $id;

    /**
    * @Colmap = nom_estado
    * @Persistence (type=texto,MaxSize=75)
    */
    private $nome;

    /**
    * @Colmap = des_sigla
    * @Persistence (type=texto,MaxSize=5)
    */
    private $sigla;

    /**
    * @Colmap = ide_pais
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=Pais,type=OneToOne)
    */
    private $pais;

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

    public function getPais() {
        return $this->pais;
    }

    public function setPais($pais) {
        $this->pais = $pais;
    }

}