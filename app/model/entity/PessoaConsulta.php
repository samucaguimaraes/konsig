<?php

/**
* @Table = pessoa_consulta
* @Schema = konsig
*/
class PessoaConsulta {

    /**
    * @Serial
    * @Colmap = ide_pessoa_consulta
    */
    private $id;

    /**
    * @Colmap = ide_pessoa_orgao
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=PessoaOrgao,type=OneToOne)
    */
    private $pessoaOrgao;

    /**
    * @Colmap = dat_competencia
    * @Persistence (type=texto,NotNull=true,MaxSize=6)
    */
    private $dataCompetencia;

    /**
    * @Colmap = vlr_margem_disponivel
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrMargemDisponivel;

    /**
    * @Colmap = des_observacao
    * @Persistence (type=texto,MaxSize=500)
    */
    private $observacao;

    /**
    * @Colmap = vlr_mensalidade_reajustada
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrMensalidadeReajustada;

    /**
    * @Colmap = vlr_comp_mr
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrCompMr;

    /**
    * @Colmap = vlr_salario_familia
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrSalarioFamilia;

    /**
    * @Colmap = vlr_grat_excomb
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrGratExcomb;

    /**
    * @Colmap = vlr_rffsa_nao_trib
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrRffsaNaoTrib;

    /**
    * @Colmap = vlr_compl_acompan
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrComplAcompan;

    /**
    * @Colmap = vlr_outras_vantagens
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrOutrasVantagens;

    /**
    * @Colmap = vlr_plansfer_rffsa
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrPlansferRffsa;

    /**
    * @Colmap = vlr_dupla_atividade
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrDuplaAtividade;

    /**
    * @Colmap = vlr_grat_produt_ect
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrGratProdutEct;

    /**
    * @Colmap = vlr_adic_talidomida
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrAdicTalidomida;

    /**
    * @Colmap = vlr_ir_retido_fonte
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrIrRetidoFonte;

    /**
    * @Colmap = vlr_deb_pensao_alim
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrDebPensaoAlim;

    /**
    * @Colmap = vlr_consignacao
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrConsignacao;

    /**
    * @Colmap = vlr_ir_exterior
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrIrExterior;

    /**
    * @Colmap = vlr_debito_dif_ir
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrDebitoDifIr;

    /**
    * @Colmap = vlr_desconto_inss
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrDescontoInss;

    /**
    * @Colmap = vlr_total_contribuicao
    * @Mask = monetario
    * @Persistence (type=monetario)
    */
    private $vlrTotalContribuicao;

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
    * @Colmap = ide_pessoa
    * @Persistence (type=inteiro,NotNull=true)
    * @Relationship (objeto=Pessoa,type=OneToOne)
    */
    private $pessoa;

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
    * @Colmap = des_automatica
    * @Persistence (type=texto,MaxSize=1)
    */
    private $automatica;

    /**
    * @Colmap = des_status
    * @Persistence (type=texto,MaxSize=1)
    */
    private $status;

    /**
    * @Relationship (objeto=PessoaConsultaEmprestimo,type=OneToMany)
    */
    private $emprestimos;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPessoaOrgao() {
        return $this->pessoaOrgao;
    }

    public function setPessoaOrgao($pessoaOrgao) {
        $this->pessoaOrgao = $pessoaOrgao;
    }

    public function getDataCompetencia() {
        return $this->dataCompetencia;
    }

    public function setDataCompetencia($dataCompetencia) {
        $this->dataCompetencia = $dataCompetencia;
    }

    public function getVlrMargemDisponivel() {
        return $this->vlrMargemDisponivel;
    }

    public function setVlrMargemDisponivel($vlrMargemDisponivel) {
        $this->vlrMargemDisponivel = $vlrMargemDisponivel;
    }

    public function getObservacao() {
        return $this->observacao;
    }

    public function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

    public function getVlrMensalidadeReajustada() {
        return $this->vlrMensalidadeReajustada;
    }

    public function setVlrMensalidadeReajustada($vlrMensalidadeReajustada) {
        $this->vlrMensalidadeReajustada = $vlrMensalidadeReajustada;
    }

    public function getVlrCompMr() {
        return $this->vlrCompMr;
    }

    public function setVlrCompMr($vlrCompMr) {
        $this->vlrCompMr = $vlrCompMr;
    }

    public function getVlrSalarioFamilia() {
        return $this->vlrSalarioFamilia;
    }

    public function setVlrSalarioFamilia($vlrSalarioFamilia) {
        $this->vlrSalarioFamilia = $vlrSalarioFamilia;
    }

    public function getVlrGratExcomb() {
        return $this->vlrGratExcomb;
    }

    public function setVlrGratExcomb($vlrGratExcomb) {
        $this->vlrGratExcomb = $vlrGratExcomb;
    }

    public function getVlrRffsaNaoTrib() {
        return $this->vlrRffsaNaoTrib;
    }

    public function setVlrRffsaNaoTrib($vlrRffsaNaoTrib) {
        $this->vlrRffsaNaoTrib = $vlrRffsaNaoTrib;
    }

    public function getVlrComplAcompan() {
        return $this->vlrComplAcompan;
    }

    public function setVlrComplAcompan($vlrComplAcompan) {
        $this->vlrComplAcompan = $vlrComplAcompan;
    }

    public function getVlrOutrasVantagens() {
        return $this->vlrOutrasVantagens;
    }

    public function setVlrOutrasVantagens($vlrOutrasVantagens) {
        $this->vlrOutrasVantagens = $vlrOutrasVantagens;
    }

    public function getVlrPlansferRffsa() {
        return $this->vlrPlansferRffsa;
    }

    public function setVlrPlansferRffsa($vlrPlansferRffsa) {
        $this->vlrPlansferRffsa = $vlrPlansferRffsa;
    }

    public function getVlrDuplaAtividade() {
        return $this->vlrDuplaAtividade;
    }

    public function setVlrDuplaAtividade($vlrDuplaAtividade) {
        $this->vlrDuplaAtividade = $vlrDuplaAtividade;
    }

    public function getVlrGratProdutEct() {
        return $this->vlrGratProdutEct;
    }

    public function setVlrGratProdutEct($vlrGratProdutEct) {
        $this->vlrGratProdutEct = $vlrGratProdutEct;
    }

    public function getVlrAdicTalidomida() {
        return $this->vlrAdicTalidomida;
    }

    public function setVlrAdicTalidomida($vlrAdicTalidomida) {
        $this->vlrAdicTalidomida = $vlrAdicTalidomida;
    }

    public function getVlrIrRetidoFonte() {
        return $this->vlrIrRetidoFonte;
    }

    public function setVlrIrRetidoFonte($vlrIrRetidoFonte) {
        $this->vlrIrRetidoFonte = $vlrIrRetidoFonte;
    }

    public function getVlrDebPensaoAlim() {
        return $this->vlrDebPensaoAlim;
    }

    public function setVlrDebPensaoAlim($vlrDebPensaoAlim) {
        $this->vlrDebPensaoAlim = $vlrDebPensaoAlim;
    }

    public function getVlrConsignacao() {
        return $this->vlrConsignacao;
    }

    public function setVlrConsignacao($vlrConsignacao) {
        $this->vlrConsignacao = $vlrConsignacao;
    }

    public function getVlrIrExterior() {
        return $this->vlrIrExterior;
    }

    public function setVlrIrExterior($vlrIrExterior) {
        $this->vlrIrExterior = $vlrIrExterior;
    }

    public function getVlrDebitoDifIr() {
        return $this->vlrDebitoDifIr;
    }

    public function setVlrDebitoDifIr($vlrDebitoDifIr) {
        $this->vlrDebitoDifIr = $vlrDebitoDifIr;
    }

    public function getVlrDescontoInss() {
        return $this->vlrDescontoInss;
    }

    public function setVlrDescontoInss($vlrDescontoInss) {
        $this->vlrDescontoInss = $vlrDescontoInss;
    }

    public function getVlrTotalContribuicao() {
        return $this->vlrTotalContribuicao;
    }

    public function setVlrTotalContribuicao($vlrTotalContribuicao) {
        $this->vlrTotalContribuicao = $vlrTotalContribuicao;
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

    public function getPessoa() {
        return $this->pessoa;
    }

    public function setPessoa($pessoa) {
        $this->pessoa = $pessoa;
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

    public function getAutomatica() {
        return $this->automatica;
    }

    public function setAutomatica($automatica) {
        $this->automatica = $automatica;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getEmprestimos() {
        return $this->emprestimos;
    }

    public function setEmprestimos($emprestimos) {
        $this->emprestimos = $emprestimos;
    }

}