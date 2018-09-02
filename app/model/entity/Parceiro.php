<?php

/**
* @Table = parceiro
* @Schema = konsig
*/
class Parceiro {

    /**
    * @Serial
    * @Colmap = ide_parceiro
    */
    private $id;

    /**
    * @Colmap = nom_parceiro
    * @Persistence (type=texto,NotNull=true,MaxSize=115)
    */
    private $nome;

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

}