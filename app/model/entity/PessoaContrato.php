<?php

/**
* @Table = pessoa_contrato
* @Schema = konsig
*/
class PessoaContrato {

    /**
    * @Serial
    * @Colmap = ide_pessoa_contrato
    */
    private $id;

    /**
    * @Colmap = ide_pessoa
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=Pessoa,type=OneToOne)
    */
    private $Pessoa;

    /**
    * @Colmap = ide_convenio
    * @Persistence (type=inteiro)
    * @Relationship (objeto=Convenio,type=OneToOne)
    */
    private $convenio;

    /**
    * @Colmap = ide_pessoa_consulta_emprestimo
    * @Persistence (type=inteiro)
    * @Relationship (objeto=PessoaConsultaEmprestimo,type=OneToOne)
    */
    private $pessoaConsultaEmprestimo;

    /**
    * @Colmap = ide_tipo_contrato
    * @Persistence (type=inteiro)
    * @Relationship (objeto=TipoContrato,type=OneToOne)
    */
    private $tipoContrato;

    /**
    * @Colmap = ide_parceiro
    * @Persistence (type=inteiro)
    * @Relationship (objeto=Parceiro,type=OneToOne)
    */
    private $parceiro;

    /**
    * @Colmap = num_contrato
    * @Persistence (type=texto,MaxSize=25)
    */
    private $numeroContrato;

    /**
    * @Colmap = dat_inicio_contrato
    * @Mask = data
    * @Persistence (type=data)
    */
    private $dataInicioContrato;

    /**
    * @Colmap = des_observacao
    * @Persistence (type=texto,MaxSize=500)
    */
    private $observacao;

    /**
    * @Colmap = ide_tipo_situacao
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=TipoSituacao,type=OneToOne)
    */
    private $tipoSituacao;

    /**
    * @Colmap = vlr_bruto
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrBruto;

    /**
    * @Colmap = vlr_liquido
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrLiquido;

    /**
    * @Colmap = vlr_parcela
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrParcela;

    /**
    * @Colmap = num_total_parcela
    * @Persistence (type=inteiro)
    */
    private $totalParcela;

    /**
    * @Colmap = vlr_taxa_juros
    * @Persistence (type=monetario)
    */
    private $vlrTaxaJuros;

    /**
    * @Colmap = vlr_taxa_comissao
    * @Persistence (type=monetario)
    */
    private $vlrTaxaComissao;

    /**
    * @Colmap = vlr_comissao_contrato
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrComissaoContrato;

    /**
    * @Colmap = des_status
    * @Persistence (type=texto)
    */
    private $status;

    /**
    * @Colmap = dat_pagamento_comissao
    * @Mask = data
    * @Persistence (type=data)
    */
    private $dataPagamentoComissao;

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

    /**
    * @Colmap = dat_tipo_situacao
    * @Mask = data
    * @Persistence (type=data)
    */
    private $dataTipoSituacao;

    /**
    * @Colmap = vlr_comissao_receber
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrComissaoReceber;

    /**
    * @Colmap = vlr_comissao_pagar
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrComissaoPagar;

    /**
    * @Colmap = ide_corretor
    * @Persistence (type=inteiro)
    * @Relationship (objeto=Corretor,type=OneToOne)
    */
    private $corretor;

    /**
    * @Colmap = ide_corretor_banco
    * @Persistence (type=inteiro)
    */
    private $corretorBanco;

    /**
    * @Colmap = dat_pagamento_corretor
    * @Mask = data
    * @Persistence (type=data)
    */
    private $dataPagamentoCorretor;

    /**
    * @Colmap = vlr_taxa_corretor
    * @Persistence (type=monetario)
    */
    private $vlrTaxaCorretor;

    /**
    * @Colmap = dat_cadastro_contrato
    * @Mask = data
    * @Persistence (type=data)
    */
    private $dataCadastroContrato;

    /**
    * @Colmap = num_proposta
    * @Persistence (type=texto,MaxSize=25)
    */
    private $numeroProposta;

    /**
    * @Colmap = ide_pessoa_orgao
    * @Persistence (type=inteiro)
    * @Relationship (objeto=PessoaOrgao,type=OneToOne)
    */
    private $pessoaOrgao;

    /**
    * @Colmap = des_comissionado
    * @Persistence (type=texto,MaxSize=1)
    */
    private $isComissionado;

    /**
    * @Colmap = dat_entrega_fisico
    * @Persistence (type=texto)
    */
    private $dataEntregaFisico;

    /**
    * @Colmap = num_protocolo_entrega
    * @Persistence (type=texto)
    */
    private $numeroProtocoloEntrega;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPessoa() {
        return $this->Pessoa;
    }

    public function setPessoa($Pessoa) {
        $this->Pessoa = $Pessoa;
    }

    public function getConvenio() {
        return $this->convenio;
    }

    public function setConvenio($convenio) {
        $this->convenio = $convenio;
    }

    public function getPessoaConsultaEmprestimo() {
        return $this->pessoaConsultaEmprestimo;
    }

    public function setPessoaConsultaEmprestimo($pessoaConsultaEmprestimo) {
        $this->pessoaConsultaEmprestimo = $pessoaConsultaEmprestimo;
    }

    public function getTipoContrato() {
        return $this->tipoContrato;
    }

    public function setTipoContrato($tipoContrato) {
        $this->tipoContrato = $tipoContrato;
    }

    public function getParceiro() {
        return $this->parceiro;
    }

    public function setParceiro($parceiro) {
        $this->parceiro = $parceiro;
    }

    public function getNumeroContrato() {
        return $this->numeroContrato;
    }

    public function setNumeroContrato($numeroContrato) {
        $this->numeroContrato = $numeroContrato;
    }

    public function getDataInicioContrato() {
        return $this->dataInicioContrato;
    }

    public function setDataInicioContrato($dataInicioContrato) {
        $this->dataInicioContrato = $dataInicioContrato;
    }

    public function getObservacao() {
        return $this->observacao;
    }

    public function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

    public function getTipoSituacao() {
        return $this->tipoSituacao;
    }

    public function setTipoSituacao($tipoSituacao) {
        $this->tipoSituacao = $tipoSituacao;
    }

    public function getVlrBruto() {
        return $this->vlrBruto;
    }

    public function setVlrBruto($vlrBruto) {
        $this->vlrBruto = $vlrBruto;
    }

    public function getVlrLiquido() {
        return $this->vlrLiquido;
    }

    public function setVlrLiquido($vlrLiquido) {
        $this->vlrLiquido = $vlrLiquido;
    }

    public function getVlrParcela() {
        return $this->vlrParcela;
    }

    public function setVlrParcela($vlrParcela) {
        $this->vlrParcela = $vlrParcela;
    }

    public function getTotalParcela() {
        return $this->totalParcela;
    }

    public function setTotalParcela($totalParcela) {
        $this->totalParcela = $totalParcela;
    }

    public function getVlrTaxaJuros() {
        return $this->vlrTaxaJuros;
    }

    public function setVlrTaxaJuros($vlrTaxaJuros) {
        $this->vlrTaxaJuros = $vlrTaxaJuros;
    }

    public function getVlrTaxaComissao() {
        return $this->vlrTaxaComissao;
    }

    public function setVlrTaxaComissao($vlrTaxaComissao) {
        $this->vlrTaxaComissao = $vlrTaxaComissao;
    }

    public function getVlrComissaoContrato() {
        return $this->vlrComissaoContrato;
    }

    public function setVlrComissaoContrato($vlrComissaoContrato) {
        $this->vlrComissaoContrato = $vlrComissaoContrato;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getDataPagamentoComissao() {
        return $this->dataPagamentoComissao;
    }

    public function setDataPagamentoComissao($dataPagamentoComissao) {
        $this->dataPagamentoComissao = $dataPagamentoComissao;
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

    public function getDataTipoSituacao() {
        return $this->dataTipoSituacao;
    }

    public function setDataTipoSituacao($dataTipoSituacao) {
        $this->dataTipoSituacao = $dataTipoSituacao;
    }

    public function getVlrComissaoReceber() {
        return $this->vlrComissaoReceber;
    }

    public function setVlrComissaoReceber($vlrComissaoReceber) {
        $this->vlrComissaoReceber = $vlrComissaoReceber;
    }

    public function getVlrComissaoPagar() {
        return $this->vlrComissaoPagar;
    }

    public function setVlrComissaoPagar($vlrComissaoPagar) {
        $this->vlrComissaoPagar = $vlrComissaoPagar;
    }

    public function getCorretor() {
        return $this->corretor;
    }

    public function setCorretor($corretor) {
        $this->corretor = $corretor;
    }

    public function getCorretorBanco() {
        return $this->corretorBanco;
    }

    public function setCorretorBanco($corretorBanco) {
        $this->corretorBanco = $corretorBanco;
    }

    public function getDataPagamentoCorretor() {
        return $this->dataPagamentoCorretor;
    }

    public function setDataPagamentoCorretor($dataPagamentoCorretor) {
        $this->dataPagamentoCorretor = $dataPagamentoCorretor;
    }

    public function getVlrTaxaCorretor() {
        return $this->vlrTaxaCorretor;
    }

    public function setVlrTaxaCorretor($vlrTaxaCorretor) {
        $this->vlrTaxaCorretor = $vlrTaxaCorretor;
    }

    public function getDataCadastroContrato() {
        return $this->dataCadastroContrato;
    }

    public function setDataCadastroContrato($dataCadastroContrato) {
        $this->dataCadastroContrato = $dataCadastroContrato;
    }

    public function getNumeroProposta() {
        return $this->numeroProposta;
    }

    public function setNumeroProposta($numeroProposta) {
        $this->numeroProposta = $numeroProposta;
    }

    public function getPessoaOrgao() {
        return $this->pessoaOrgao;
    }

    public function setPessoaOrgao($pessoaOrgao) {
        $this->pessoaOrgao = $pessoaOrgao;
    }

    public function getIsComissionado() {
        return $this->isComissionado;
    }

    public function setIsComissionado($isComissionado) {
        $this->isComissionado = $isComissionado;
    }

    public function getDataEntregaFisico() {
        return $this->dataEntregaFisico;
    }

    public function setDataEntregaFisico($dataEntregaFisico) {
        $this->dataEntregaFisico = $dataEntregaFisico;
    }

    public function getNumeroProtocoloEntrega() {
        return $this->numeroProtocoloEntrega;
    }

    public function setNumeroProtocoloEntrega($numeroProtocoloEntrega) {
        $this->numeroProtocoloEntrega = $numeroProtocoloEntrega;
    }

}