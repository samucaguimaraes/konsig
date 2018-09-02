<?php

/**
* @Table = tipo_contato
* @Schema = konsig
*/
class TipoContato {

    /**
    * @Serial
    * @Colmap = ide_tipo_contato
    */
    private $id;

    /**
    * @Colmap = nom_tipo_contato
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