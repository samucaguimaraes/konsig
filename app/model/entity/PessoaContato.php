<?php

/**
* @Table = pessoa_contato
* @Schema = konsig
*/
class PessoaContato {

    /**
    * @Serial
    * @Colmap = ide_pessoa_contato
    */
    private $id;

    /**
    * @Colmap = ide_pessoa
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=Pessoa,type=OneToOne)
    */
    private $pessoa;

    /**
    * @Colmap = num_contato
    * @Mask = telefone
    * @Persistence (type=telefone,NotNull=true,MaxSize=11)
    */
    private $numero;

    /**
    * @Colmap = ide_tipo_contato
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=TipoContato,type=OneToOne)
    */
    private $tipoContato;

    /**
    * @Colmap = des_contato
    * @Persistence (type=texto,MaxSize=115)
    */
    private $descricao;

    /**
    * @Colmap = ide_operadora
    * @Persistence (type=inteiro)
    * @Relationship (objeto=Operadora,type=OneToOne)
    */
    private $operadora;

    /**
    * @Colmap = ide_usuario_criador
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=Usuario,type=OneToOne)
    */
    private $usuarioCriador;

    /**
    * @Colmap = dat_criacao
    * @Persistence (type=texto,NotNull=true)
    */
    private $dataCriacao;

    /**
    * @Colmap = ide_usuario_atualizador
    * @Persistence (type=inteiro)
    * @Relationship (objeto=Usuario,type=OneToOne)
    */
    private $usuarioAtualizador;

    /**
    * @Colmap = dat_atualizacao
    * @Persistence (type=texto)
    */
    private $dataAtualizacao;

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

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getTipoContato() {
        return $this->tipoContato;
    }

    public function setTipoContato($tipoContato) {
        $this->tipoContato = $tipoContato;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getOperadora() {
        return $this->operadora;
    }

    public function setOperadora($operadora) {
        $this->operadora = $operadora;
    }

    public function getUsuarioCriador() {
        return $this->usuarioCriador;
    }

    public function setUsuarioCriador($usuarioCriador) {
        $this->usuarioCriador = $usuarioCriador;
    }

    public function getDataCriacao() {
        return $this->dataCriacao;
    }

    public function setDataCriacao($dataCriacao) {
        $this->dataCriacao = $dataCriacao;
    }

    public function getUsuarioAtualizador() {
        return $this->usuarioAtualizador;
    }

    public function setUsuarioAtualizador($usuarioAtualizador) {
        $this->usuarioAtualizador = $usuarioAtualizador;
    }

    public function getDataAtualizacao() {
        return $this->dataAtualizacao;
    }

    public function setDataAtualizacao($dataAtualizacao) {
        $this->dataAtualizacao = $dataAtualizacao;
    }

}