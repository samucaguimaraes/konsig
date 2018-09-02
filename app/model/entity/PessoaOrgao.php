<?php

/**
* @Table = pessoa_orgao
* @Schema = konsig
*/
class PessoaOrgao {

    /**
    * @Serial
    * @Colmap = ide_pessoa_orgao
    */
    private $id;

    /**
    * @Colmap = ide_pessoa
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=Pessoa,type=OneToOne)
    */
    private $pessoa;

    /**
    * @Colmap = ide_orgao
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=Orgao,type=OneToOne)
    */
    private $orgao;

    /**
    * @Colmap = num_matricula
    * @Persistence (type=texto,NotNull=true,MaxSize=50)
    */
    private $matricula;

    /**
    * @Colmap = des_login
    * @Persistence (type=texto,MaxSize=50)
    */
    private $login;

    /**
    * @Colmap = des_senha
    * @Persistence (type=texto,MaxSize=25)
    */
    private $senha;

    /**
    * @Colmap = ide_tipo_situacao
    * @Persistence (type=inteiro)
    * @Relationship (objeto=TipoSituacao,type=OneToOne)
    */
    private $tipoSituacao;

    /**
    * @Colmap = ide_tipo_especie_beneficio
    * @Persistence (type=inteiro)
    * @Relationship (objeto=TipoEspecieBeneficio,type=OneToOne)
    */
    private $tipoEspecieBeneficio;

    /**
    * @Colmap = des_credencial_publica
    * @Persistence (type=texto,MaxSize=1)
    */
    private $isCredencialPublica;

    /**
    * @Colmap = ide_usuario_criador
    * @Persistence (type=inteiro)
    * @Relationship (objeto=Usuario,type=OneToOne)
    */
    private $usuarioCriador;

    /**
    * @Colmap = dat_criacao
    * @Persistence (type=texto)
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

    public function getOrgao() {
        return $this->orgao;
    }

    public function setOrgao($orgao) {
        $this->orgao = $orgao;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getTipoSituacao() {
        return $this->tipoSituacao;
    }

    public function setTipoSituacao($tipoSituacao) {
        $this->tipoSituacao = $tipoSituacao;
    }

    public function getTipoEspecieBeneficio() {
        return $this->tipoEspecieBeneficio;
    }

    public function setTipoEspecieBeneficio($tipoEspecieBeneficio) {
        $this->tipoEspecieBeneficio = $tipoEspecieBeneficio;
    }

    public function getIsCredencialPublica() {
        return $this->isCredencialPublica;
    }

    public function setIsCredencialPublica($isCredencialPublica) {
        $this->isCredencialPublica = $isCredencialPublica;
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