<?php

/**
* @Table = pais
* @Schema = konsig
*/
class Pais {

    /**
    * @Serial
    * @Colmap = ide_pais
    */
    private $id;

    /**
    * @Colmap = nom_pais
    * @Persistence (type=texto,MaxSize=60)
    */
    private $nome;

    /**
    * @Colmap = des_sigla
    * @Persistence (type=texto,MaxSize=10)
    */
    private $sigla;

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

}