<?php

class PessoaContratoController extends TMetroUIv3 {

    public $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new PessoaContratoLogic();
    }

    public function index() {
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");

        $tContratoPendenciaFisico = $this->logic->totalRegistro("des_status = 'A' AND dat_entrega_fisico IS NULL AND num_protocolo_entrega IS NULL AND ide_tipo_situacao = 16", null, true);
        $this->addDados('isFisico', ($tContratoPendenciaFisico > 0) ? true : false);

        $this->TPageAdmin('index');
    }

    public function cadastrar() {

        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.mask.min.js");
        if (isset($_POST['numeroCPF']) OR $this->isParam("id")) {
            //$this->HTML->addJavaScript(PATH_JS_CORE_URL . 'JQueryUI/jquery-ui.min.js');
            //$this->HTML->addCss(PATH_JS_CORE_URL . 'JQueryUI/jquery-ui.min.css');
            $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "select2.min.js");
            $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'jquery.maskMoney.min.js');
            $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
            $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");

            $objPessoaLogic = new PessoaLogic();
            $objPessoa = $objPessoaLogic->obterPorId($this->getParam("id"));
            $this->addDados('objPessoa', $objPessoa);
            //unset($objPessoaLogic);

            $objPessoaConsultaLogic = new PessoaConsultaLogic();
            $objPessoaConsultaEmprestimoLogic = new PessoaConsultaEmprestimoLogic();

            if (!$this->isParam("op")) {
                if ($this->isParam('consulta')) {

                    $objPessoaConsulta = $objPessoaConsultaLogic->obterPorId($this->getParam("consulta"), true);
                    
                    $arrayList = $objPessoaConsultaEmprestimoLogic->listar("ide_pessoa_consulta = {$objPessoaConsulta->getId()}", null, true);

                    $objOrgaoLogic = new OrgaoLogic();
                    $objOrgao = $objOrgaoLogic->obterPorId($objPessoaConsulta->getPessoaOrgao()->getOrgao());
                    $this->addDados('objOrgao', $objOrgao);
                    $this->addDados('objPessoaConsulta', $objPessoaConsulta);
                } else {
                    $arrayObjPessoaConsulta = $objPessoaConsultaLogic->listar("ide_pessoa = {$objPessoa->getId()} AND des_status = 'A'");
             
                    $inArray = "";
                    if ($arrayObjPessoaConsulta) {
                        foreach ($arrayObjPessoaConsulta as $objPessoaConsulta) {
                            $inArray.=$objPessoaConsulta->getId() . ",";
                        }
                        $inArray = substr_replace($inArray, '', -1);
                        
                    }
                    $arrayList = $objPessoaConsultaEmprestimoLogic->listar("ide_pessoa_consulta IN ({$inArray}) AND des_status = 'A'", null, true);
                }
                $this->addDados('isEmprestimo', ($arrayList) ? true : false);
                $this->addDados('listEmprestimos', $arrayList);
                unset($arrayList);
                //var_dump($inArray);exit();
                $this->TPageAdmin('selecionar_cadastrar');
            }

            $this->addDados('isEmprestimo', ($this->isParam('idEmp')) ? true : false);

            if ($this->isParam('idEmp')) {
                $objPessoaConsultaEmprestimo = $objPessoaConsultaEmprestimoLogic->obterPorId($this->getParam('idEmp'), true);
                $this->addDados('objPessoaConsultaEmprestimo', $objPessoaConsultaEmprestimo);

                $objPessoaContrato = null;
                if ($objPessoaConsultaEmprestimo->getPessoaConsultaEmprestimoOrigem() != null) {
                    $objPessoaContratoLogic = new PessoaContratoLogic();
                    $objPessoaContrato = $objPessoaContratoLogic->obter("ide_pessoa_consulta_emprestimo = {$objPessoaConsultaEmprestimo->getPessoaConsultaEmprestimoOrigem()->getId()}");
                    //echo "<pre>";var_dump($objPessoaConsultaEmprestimo->getPessoaConsultaEmprestimoOrigem()->getId());exit();
                    $this->addDados('objPessoaContratoOrigem', $objPessoaContrato);
                }
            }

            $objTipoContratoLogic = new TipoContratoLogic();
            //Filtro de Tipos de Contratos
            $arrayList = ($this->getParam('op') == 1) ? $objTipoContratoLogic->listar('ide_tipo_contrato = 1') : $objTipoContratoLogic->listar('ide_tipo_contrato IN (2,3)');
            $this->addDados('listTipoContrato', $arrayList);
            unset($arrayList);

            $objPessoaOrgaoLogic = new PessoaOrgaoLogic();
            //Filtro Pessoa Orgão
            if ($this->isParam('op')) {
                $where = ($this->getParam('op') == 1) ? "ide_pessoa = {$objPessoa->getId()}" : "ide_pessoa_orgao = {$objPessoaConsultaEmprestimo->getPessoaConsulta()->getPessoaOrgao()}";
                $arrayList = $objPessoaOrgaoLogic->listar($where, null, true);
                $this->addDados('listPessoaOrgao', $arrayList);
                unset($arrayList);
            }

            $objParceiroLogic = new ParceiroLogic();
            $arrayList = $objParceiroLogic->listar();
            $this->addDados('listParceiro', $arrayList);
            unset($arrayList);

            $objCorretorLogic = new CorretorLogic();
            $arrayList = $objCorretorLogic->listar("des_status = 'A'");
            $this->addDados('listCorretor', $arrayList);
            unset($arrayList);

            $objTipoSituacaoLogic = new TipoSituacaoLogic();
            $arrayList = $objTipoSituacaoLogic->listar();
            $this->addDados('listTipoSituacao', $arrayList);
            unset($arrayList);

            $objConvenioLogic = new ConvenioLogic();
            $arrayList = $objConvenioLogic->listar();
            $this->addDados('listConvenio', $arrayList);
            unset($arrayList);

            $objPessoaConsultaEmprestimoLogic = new PessoaConsultaEmprestimoLogic();
            $arrayList = $objPessoaConsultaEmprestimoLogic->listar("ide_pessoa_consulta = {$this->getParam("id")}", null, true);
            $this->addDados('listEmprestimos', $arrayList);
            unset($arrayList);


//            $objPessoaOrgaoLogic = new PessoaOrgaoLogic();
//            $objPessoaOrgao = $objPessoaOrgaoLogic->obterPorId($this->getParam("id"),true);
//            $this->addDados('objPessoaOrgao', $objPessoaOrgao);
            //Verificando se o Acesso a Credencial esta público.
            //$this->addDados('isCredencialPublica', ($objPessoaOrgao->getIsCredencialPublica() == "A")?true:false);
            //Verificando se o ID passado achou um Orgão de uma Pessoa
//            if(!is_object($objPessoaOrgao)){
//                TFeedbackMetroUIv3Helper::notifyWarning('Não foi possível acessar as informações.');
//                TFeedbackMetroUIv3Helper::notifyWarning('Caso o problema persista, contate o suporte técnico.');
//                RedirectorHelper::goToAction("cadastrar");
//            }
            //Validando o aparecimento da div Detalhamento e Margem Disponível
            //$this->addDados('isDetalhamento', (in_array($objPessoaOrgao->getOrgao()->getId(),array(2)))?true:false); //[2] Previdência Social
            //$this->addDados('isMargemDisponivel', (in_array($objPessoaOrgao->getOrgao()->getId(),array(2)))?false:true); //[2] Exclui Previdência Social
            //unset($objPessoaOrgaoLogic);

            $this->TPageAdmin($this->getAction());
        } else {
            $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
            $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/validar_cadastrar.js");

            $this->TPageAdmin('validar_cadastrar');
        }
    }

    public function incluirFisico() {

        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");

        $objPessoaContrato = $this->logic->obterPorId($this->getParam('id'), true);
        $this->addDados('objPessoaContrato', $objPessoaContrato);

        $this->TPageAdmin('incluir_fisico');
    }

    public function incluirFisicoMalote() {

        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");

        //$objPessoaContrato = $this->logic->obterPorId($this->getParam('id'),true);
        //$this->addDados('objPessoaContrato', $objPessoaContrato);       
        $arrayList = $this->logic->listar("des_status = 'A' AND dat_entrega_fisico IS NULL AND num_protocolo_entrega IS NULL AND ide_tipo_situacao = 16", null, true);
        $this->addDados('listContratos', $arrayList);

        $tContratos = $this->logic->totalRegistro("des_status = 'A' AND dat_entrega_fisico IS NULL AND num_protocolo_entrega IS NULL AND ide_tipo_situacao = 16");

        $this->addDados('tContrato', $tContratos);
        $this->addDados('isFisico', ($tContratos > 0) ? true : false);

        unset($arrayList);

        $this->TPageAdmin('incluir_fisico_malote');
    }

    public function atualizarStatusMassa() {

        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "select2.min.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");

        //$objPessoaContrato = $this->logic->obterPorId($this->getParam('id'),true);
        //$this->addDados('objPessoaContrato', $objPessoaContrato);       
        $arrayList = $this->logic->listar("des_status = 'A' AND ide_tipo_situacao = 10", null, true); //Em Análise
        $this->addDados('listContratos', $arrayList);

        $tContratos = $this->logic->totalRegistro("des_status = 'A' AND ide_tipo_situacao = 10"); //Em Análise

        $this->addDados('tContrato', $tContratos);
        $this->addDados('isFisico', ($tContratos > 0) ? true : false);

        $objTipoSituacaoLogic = new TipoSituacaoLogic();
        $arrayList = $objTipoSituacaoLogic->listar('ide_tipo_situacao IN (16,17)');
        $this->addDados('listTipoSituacao', $arrayList);
        
        unset($arrayList);

        $this->TPageAdmin('atualizar_status_massa');
    }

    public function informar() {

        $objPessoaContrato = $this->logic->obterPorId($this->getParam('id'), true);
        $this->addDados('objPessoaContrato', $objPessoaContrato);

        $objPessoaOrgaoLogic = new PessoaOrgaoLogic();
        $objPessoaOrgao = $objPessoaOrgaoLogic->obterPorId($objPessoaContrato->getPessoaOrgao()->getId(), true);
        $this->addDados('objPessoaOrgao', $objPessoaOrgao);

        //Tag de Tipo Situação
        switch ($objPessoaContrato->getTipoSituacao()->getId()) {
            case 16:
                $tag = 'success';
                break;
            case 17:
                $tag = 'alert';
                break;
            default:
                $tag = 'default';
                break;
        }

        $this->addDados('isCorretagem', ($objPessoaContrato->getCorretor() != null) ? true : false);
        $this->addDados('isComissionado', ($objPessoaContrato->getIsComissionado() == 'A') ? true : false);
        $this->addDados('isIntegrado', ($objPessoaContrato->getTipoSituacao()->getId() != 16) ? true : false);

        $this->addDados('tag', $tag);
        unset($objPessoaContrato);
        $this->TPageAdmin($this->getAction());
    }

}
