<?php

/**
* @Table = operadora
* @Schema = konsig
*/
class Operadora {

    /**
    * @Serial
    * @Colmap = ide_operadora
    */
    private $id;

    /**
    * @Colmap = nom_operadora
    * @Persistence (type=texto,NotNull=true,MaxSize=25)
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