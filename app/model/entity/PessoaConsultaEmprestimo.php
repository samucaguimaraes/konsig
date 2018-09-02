<?php

/**
* @Table = pessoa_consulta_emprestimo
* @Schema = konsig
*/
class PessoaConsultaEmprestimo {

    /**
    * @Serial
    * @Colmap = ide_pessoa_consulta_emprestimo
    */
    private $id;

    /**
    * @Colmap = ide_pessoa_consulta
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=PessoaConsulta,type=OneToOne)
    */
    private $pessoaConsulta;

    /**
    * @Colmap = ide_convenio
    * @Persistence (type=inteiro)
    * @Relationship (objeto=Convenio,type=OneToOne)
    */
    private $convenio;

    /**
    * @Colmap = num_total_parcela
    * @Persistence (type=inteiro)
    */
    private $totalParcela;

    /**
    * @Colmap = dat_inicio_contrato
    * @Mask = data
    * @Persistence (type=data,MaxSize=10)
    */
    private $dataInicioContrato;

    /**
    * @Colmap = vlr_parcela
    * @Mask = monetario
    * @Persistence (type=monetario,NotNull=true)
    */
    private $vlrParcela;

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

    /**
    * @Colmap = des_observacao
    * @Persistence (type=texto,MaxSize=115)
    */
    private $observacao;

    /**
    * @Colmap = num_contrato
    * @Persistence (type=texto,MaxSize=25)
    */
    private $numeroContrato;

    /**
    * @Colmap = des_status
    * @Persistence (type=texto,MaxSize=1)
    */
    private $status;

    /**
    * @Colmap = ide_pessoa_consulta_emprestimo_origem
    * @Persistence (type=inteiro)
    * @Relationship (objeto=PessoaConsultaEmprestimo,type=OneToOne)
    */
    private $pessoaConsultaEmprestimoOrigem;

    /**
    * @Colmap = ide_pessoa_consulta_emprestimo_destino
    * @Persistence (type=inteiro)
    * @Relationship (objeto=PessoaConsultaEmprestimo,type=OneToOne)
    */
    private $pessoaConsultaEmprestimoDestino;

    /**
    * @Colmap = ide_pessoa_contrato
    * @Persistence (type=inteiro)
    * @Relationship (objeto=PessoaContrato,type=OneToOne)
    */
    private $PessoaContrato;

    /**
    * @Colmap = des_congelado
    * @Persistence (type=texto,size=1)
    */
    private $congelado;

    /**
    * @Colmap = dat_prazo_congelamento
    * @Persistence (type=texto)
    */
    private $dataPrazoCongelamento;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPessoaConsulta() {
        return $this->pessoaConsulta;
    }

    public function setPessoaConsulta($pessoaConsulta) {
        $this->pessoaConsulta = $pessoaConsulta;
    }

    public function getConvenio() {
        return $this->convenio;
    }

    public function setConvenio($convenio) {
        $this->convenio = $convenio;
    }

    public function getTotalParcela() {
        return $this->totalParcela;
    }

    public function setTotalParcela($totalParcela) {
        $this->totalParcela = $totalParcela;
    }

    public function getDataInicioContrato() {
        return $this->dataInicioContrato;
    }

    public function setDataInicioContrato($dataInicioContrato) {
        $this->dataInicioContrato = $dataInicioContrato;
    }

    public function getVlrParcela() {
        return $this->vlrParcela;
    }

    public function setVlrParcela($vlrParcela) {
        $this->vlrParcela = $vlrParcela;
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

    public function getObservacao() {
        return $this->observacao;
    }

    public function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

    public function getNumeroContrato() {
        return $this->numeroContrato;
    }

    public function setNumeroContrato($numeroContrato) {
        $this->numeroContrato = $numeroContrato;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getPessoaConsultaEmprestimoOrigem() {
        return $this->pessoaConsultaEmprestimoOrigem;
    }

    public function setPessoaConsultaEmprestimoOrigem($pessoaConsultaEmprestimoOrigem) {
        $this->pessoaConsultaEmprestimoOrigem = $pessoaConsultaEmprestimoOrigem;
    }

    public function getPessoaConsultaEmprestimoDestino() {
        return $this->pessoaConsultaEmprestimoDestino;
    }

    public function setPessoaConsultaEmprestimoDestino($pessoaConsultaEmprestimoDestino) {
        $this->pessoaConsultaEmprestimoDestino = $pessoaConsultaEmprestimoDestino;
    }

    public function getPessoaContrato() {
        return $this->PessoaContrato;
    }

    public function setPessoaContrato($PessoaContrato) {
        $this->PessoaContrato = $PessoaContrato;
    }

    public function getCongelado() {
        return $this->congelado;
    }

    public function setCongelado($congelado) {
        $this->congelado = $congelado;
    }

    public function getDataPrazoCongelamento() {
        return $this->dataPrazoCongelamento;
    }

    public function setDataPrazoCongelamento($dataPrazoCongelamento) {
        $this->dataPrazoCongelamento = $dataPrazoCongelamento;
    }

}