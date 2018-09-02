<?php

/**
* @Table = cidade
* @Schema = konsig
*/
class Cidade {

    /**
    * @Serial
    * @Colmap = ide_cidade
    */
    private $id;

    /**
    * @Colmap = nom_cidade
    * @Persistence (type=texto,MaxSize=120)
    */
    private $nome;

    /**
    * @Colmap = ide_estado
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=Estado,type=OneToOne)
    */
    private $estado;

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

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

}