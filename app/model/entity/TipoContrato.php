<?php

/**
* @Table = tipo_contrato
* @Schema = konsig
*/
class TipoContrato {

    /**
    * @Serial
    * @Colmap = ide_tipo_contrato
    */
    private $id;

    /**
    * @Colmap = nom_tipo_contrato
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