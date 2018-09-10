<?php

/**
* @Table = corretor
* @Schema = konsig
*/
class Corretor {

    /**
    * @Serial
    * @Colmap = ide_corretor
    */
    private $id;

    /**
    * @Colmap = nom_corretor
    * @Persistence (type=texto,NotNull=true,MaxSize=230)
    */
    private $nome;

    /**
    * @Colmap = num_cpf
    * @Mask = cpf
    * @Persistence (type=cpf,NotNull=true,MaxSize=11)
    */
    private $numeroCPF;

    /**
    * @Colmap = dat_nascimento
    * @Mask = data
    * @Persistence (type=data,NotNull=true,MaxSize=8)
    */
    private $dataNascimento;

    /**
    * @Colmap = des_email
    * @Persistence (type=email,MaxSize=115)
    */
    private $email;

    /**
    * @Colmap = des_skype
    * @Persistence (type=texto,MaxSize=50)
    */
    private $skype;

    /**
    * @Colmap = des_endereco
    * @Persistence (type=texto,MaxSize=115)
    */
    private $endereco;

    /**
    * @Colmap = num_endereco
    * @Persistence (type=texto,MaxSize=5)
    */
    private $numeroEndereco;

    /**
    * @Colmap = des_complemento
    * @Persistence (type=texto,MaxSize=115)
    */
    private $complemento;

    /**
    * @Colmap = nom_bairro
    * @Persistence (type=texto,MaxSize=115)
    */
    private $bairro;

    /**
    * @Colmap = ide_cidade
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=Cidade,type=OneToOne)
    */
    private $cidade;

    /**
    * @Colmap = num_cep
    * @Persistence (type=texto,MaxSize=8)
    */
    private $numeroCEP;

    /**
    * @Colmap = des_observacao
    * @Persistence (type=texto,MaxSize=65535)
    */
    private $observacao;

    /**
    * @Colmap = des_status
    * @Persistence (type=texto,MaxSize=1)
    */
    private $status;

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

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNumeroCPF() {
        return $this->numeroCPF;
    }

    public function setNumeroCPF($numeroCPF) {
        $this->numeroCPF = $numeroCPF;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSkype() {
        return $this->skype;
    }

    public function setSkype($skype) {
        $this->skype = $skype;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getNumeroEndereco() {
        return $this->numeroEndereco;
    }

    public function setNumeroEndereco($numeroEndereco) {
        $this->numeroEndereco = $numeroEndereco;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function getNumeroCEP() {
        return $this->numeroCEP;
    }

    public function setNumeroCEP($numeroCEP) {
        $this->numeroCEP = $numeroCEP;
    }

    public function getObservacao() {
        return $this->observacao;
    }

    public function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
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