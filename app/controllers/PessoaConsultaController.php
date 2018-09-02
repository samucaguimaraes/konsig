<?php

class PessoaConsultaController extends TMetroUIv3 {

    public $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new PessoaConsultaLogic();
    }

    public function index() {
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");
        $this->TPageAdmin('index');
    }

    public function cadastrar() {

        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.mask.min.js");

        if (isset($_POST['numeroCPF']) OR $this->isParam("id")) {
            $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'JQueryUI/jquery-ui.min.js');
            $this->HTML->addCss(PATH_JS_CORE_URL . 'JQueryUI/jquery-ui.min.css');
            $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "select2.min.js");
            $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'jquery.maskMoney.min.js');
            $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
            $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");

            $objPessoaLogic = new PessoaLogic();
            $objPessoa = $objPessoaLogic->obterPorId($this->getParam("id"));
            unset($objPessoaLogic);

            $this->addDados('objPessoa', $objPessoa);

            //Consultas Existentes no Sistema para o Cliente
            $arrayConsultas = $this->logic->listar("ide_pessoa = {$objPessoa->getId()} AND des_status = 'A'");
            $inArray = "";
            if ($arrayConsultas) {
                foreach ($arrayConsultas as $objPessoaConsulta) {
                    $inArray.=$objPessoaConsulta->getPessoaOrgao() . ",";
                }
                $inArray = substr_replace($inArray, '', -1);
            }
            //Calculando o total de Orgãos Associados ao Cliente
            $objPessoaOrgaoLogic = new PessoaOrgaoLogic();
            $tPessoaOrgao = $objPessoaOrgaoLogic->totalRegistro("ide_pessoa = " . $objPessoa->getId());

            if ($this->isParam("idOrgao") === false && $tPessoaOrgao > 1) {
                $notIN = ($inArray != "") ? " AND ide_pessoa_orgao NOT IN (" . $inArray . ")" : "";

                $listObjPessoaOrgao = $objPessoaOrgaoLogic->listar("ide_pessoa = {$this->getParam("id")}{$notIN}", null, true);
                $this->addDados('isOrgao', ($listObjPessoaOrgao) ? true : false);

                $this->addDados('listPessoaOrgao', $listObjPessoaOrgao);
                $this->TPageAdmin('selecionar_cadastrar');
            } else {
                //Obtenho o orgão passado no GET
                if($this->isParam("idOrgao")){
                    $objPessoaOrgao = $objPessoaOrgaoLogic->obter("ide_pessoa_orgao = " . $this->getParam("idOrgao"), true);
                } else {
                    $objPessoaOrgao = $objPessoaOrgaoLogic->obter("ide_pessoa = " . $objPessoa->getId(), true);
                }
                
                $this->addDados('objPessoaOrgao', $objPessoaOrgao);

                //Verificando se o Acesso a Credencial esta público.
                $this->addDados('isCredencialPublica', ($objPessoaOrgao->getIsCredencialPublica() == "A") ? true : false);

                //Verificando se o ID passado achou um Orgão de uma Pessoa
                if (!is_object($objPessoaOrgao)) {
                    RedirectorHelper::addUrlParameter('id', $this->getParam("id"));
                    TFeedbackMetroUIv3Helper::notifyWarning('Ops! Não foi possível acessar o orgão selecionado.');
                    RedirectorHelper::goToAction("cadastrar");
                }

                //Validando o aparecimento da div Detalhamento e Margem Disponível
                $this->addDados('isDetalhamento', (in_array($objPessoaOrgao->getOrgao()->getId(), array(2))) ? true : false); //[2] Previdência Social
                $this->addDados('isMargemDisponivel', (in_array($objPessoaOrgao->getOrgao()->getId(), array(2))) ? false : true); //[2] Exclui Previdência Social

                unset($objPessoaOrgaoLogic);

                $this->TPageAdmin($this->getAction());
            }
        } else {
            $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
            $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/validar_cadastrar.js");

            $this->TPageAdmin('validar_cadastrar');
        }
    }

    public function editar() {

        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.mask.min.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'jquery.maskMoney.min.js');
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.populate.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'JQueryUI/jquery-ui.min.js');
        $this->HTML->addCss(PATH_JS_CORE_URL . 'JQueryUI/jquery-ui.min.css');
        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "select2.min.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");

        $objPessoaConsulta = $this->logic->obterPorId($this->getParam('id'));

        $objPessoaLogic = new PessoaLogic();
        $objPessoa = $objPessoaLogic->obterPorId($objPessoaConsulta->getPessoa());
        $this->addDados('objPessoa', $objPessoa);

        $objPessoaOrgaoLogic = new PessoaOrgaoLogic();
        $objPessoaOrgao = $objPessoaOrgaoLogic->obterPorId($objPessoaConsulta->getPessoaOrgao(), true);
        $this->addDados('objPessoaOrgao', $objPessoaOrgao);

        //Verificando se o Acesso a Credencial esta público.
        $this->addDados('isCredencialPublica', ($objPessoaOrgao->getIsCredencialPublica() == "A") ? true : false);

        //$objOrgaoLogic = new OrgaoLogic();
        //$arrayList = $objOrgaoLogic->listar();
        //$this->addDados('listOrgao', $arrayList);
        //unset($arrayList);
        //$objTipoEspecieBeneficioLogic = new TipoEspecieBeneficioLogic();
        //$arrayList = $objTipoEspecieBeneficioLogic->listar();
        //$this->addDados('listTipoEspecieBeneficio', $arrayList);
        //unset($arrayList);
        ///$objTipoSituacaoLogic = new TipoSituacaoLogic();
        //$arrayList = $objTipoSituacaoLogic->listar("ide_tipo_situacao IN (13,14,15)");
        //$this->addDados('listTipoSituacao', $arrayList);
        ////unset($arrayList);
        //Validando o aparecimento da div Detalhamento e Margem Disponível
        $this->addDados('isDetalhamento', (in_array($objPessoaOrgao->getOrgao()->getId(), array(2))) ? true : false); //[2] Previdência Social
        $this->addDados('isMargemDisponivel', (in_array($objPessoaOrgao->getOrgao()->getId(), array(2))) ? false : true); //[2] Exclui Previdência Social
        //Lista Emprestimos Existentes
        $objPessoaConsultaEmprestimoLogic = new PessoaConsultaEmprestimoLogic();
        $arrayList = $objPessoaConsultaEmprestimoLogic->listar("ide_pessoa_consulta = {$objPessoaConsulta->getId()} AND des_status = 'A'");

        if ($arrayList != null) {
            $key_Alternativa = 0;
            $html = '';
            foreach ($arrayList as $objPessoaConsultaEmprestimo) {
                $html .= '<div class="row" id=div_Alternativa_' . $key_Alternativa . '>';
                $html .= '<input type="hidden" name="alternativas[' . $key_Alternativa . '][id]" value="' . $objPessoaConsultaEmprestimo->getId() . '">';
                $html .= '<div class="cell colspan2">';
                $html .= '<label>Valor R$ <b class="fg-red">*</b></label>';
                $html .= '<div class="input-control text full-size" data-role="input">';
                $html .= '<input type="text" value="' . $objPessoaConsultaEmprestimo->getVlrParcela() . '" name="alternativas[' . $key_Alternativa . '][valor]" id="Altenativa_descricao_' . $key_Alternativa . '" onfocus="valor(\'Altenativa_descricao_' . $key_Alternativa . '\')" placeholder="Informe o valor R$" maxlength="100" autocomplete="off">';
                $html .= '<button class="button helper-button clear"><span class="mif-cross"></span></button>';
                $html .= '<span class="input-state-error mif-warning"></span>';
                $html .= '<span class="input-state-success mif-checkmark"></span>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '<div class="cell colspan10">';
                $html .= '<label>Observação</label>';
                $html .= '<div class="input-control text full-size" data-role="input">';
                $html .= '<input type="text" value="' . $objPessoaConsultaEmprestimo->getObservacao() . '" name="alternativas[' . $key_Alternativa . '][observacao]" id="Altenativa_descricao_' . $key_Alternativa . '" placeholder="Observações Adicionais" maxlength="100" autocomplete="off">';
                $html .= '<a onclick="deleteAlternativa(\'div_Alternativa_' . $key_Alternativa . '\')" class="button deleteButton"><span class="mif-bin fg-red">Remover</span></a>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                $key_Alternativa++;
            }
        }
        $this->addDados('emprestimosExistentes', $html);
        $this->addDados('key_Alternativa', $key_Alternativa);
        //Logs
        $objUsuarioLogic = new UsuarioLogic();
        $logCriacao = "";
        $logAtualizacao = "";

        $objUsuarioCriador = $objUsuarioLogic->obterPorId($objPessoaConsulta->getUsuarioCriador());
        if ($objUsuarioCriador != null) {
            $logCriacao = "<p>Registro criado por {$objUsuarioCriador->getNome()} em {$objPessoaConsulta->getDataCriacao()}</p>";
        }

        $objUsuarioAtualizador = $objUsuarioLogic->obterPorId($objPessoaConsulta->getUsuarioAtualizador());
        if ($objUsuarioAtualizador != null) {
            $logAtualizacao = "<p>Última atualização por {$objUsuarioAtualizador->getNome()} em {$objPessoaConsulta->getDataAtualizacao()}</p>";
        }
        $this->addDados('logCriacao', $logCriacao);
        $this->addDados('logAtualizacao', $logAtualizacao);

        unset($objUsuarioLogic, $objUsuarioCriador, $objUsuarioAtualizador);

        //Formatação Especial
        $dataCompetencia = substr($objPessoaConsulta->getDataCompetencia(), 4, 2) . "/" . substr($objPessoaConsulta->getDataCompetencia(), 0, 4);
        $objPessoaConsulta->setDataCompetencia($dataCompetencia);

        $this->addDados('json_objeto', $this->logic->objectToJson(
                        $objPessoaConsulta));

        $this->TPageAdmin($this->getAction());
    }

    public function informar() {

        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");

        $objPessoaConsulta = $this->logic->obterPorId($this->getParam('id'), true);
        $this->addDados('objPessoaConsulta', $objPessoaConsulta);

        //Controle de fluxo de navegação
        if ($objPessoaConsulta == null) {
            TFeedbackMetroUIv3Helper::notifyWarning('É constrangedor, mas não encontrei a informação solicitada!');
            RedirectorHelper::goToControllerAction('PessoaConsulta', 'index');
        }

        $objOrgaoLogic = new OrgaoLogic();
        $objOrgao = $objOrgaoLogic->obterPorId($objPessoaConsulta->getPessoaOrgao()->getOrgao());
        $this->addDados('objOrgao', $objOrgao);

//        $objPessoaLogic = new PessoaLogic();
//        $objPessoa = $objPessoaLogic->obterPorId($objPessoaConsulta->getPessoa());
//        $this->addDados('objPessoa', $objPessoa);

        $objPessoaConsultaEmprestimoLogic = new PessoaConsultaEmprestimoLogic();

        //PESSOA CONTATO, FLAG DE QUANTIDADE TOTAL
        $objPessoaContatoLogic = new PessoaContatoLogic();
        $tContatos = $objPessoaContatoLogic->totalRegistro("ide_pessoa = {$objPessoaConsulta->getPessoa()->getId()}");
        $this->addDados('isPessoaContato', ($tContatos > 0) ? true : false);

        $this->addDados('statusConsulta', ($objPessoaConsulta->getStatus() == 'A') ? "Ativa" : "Desativada");

        $tEmprestimo = $objPessoaConsultaEmprestimoLogic->totalRegistro("ide_pessoa_consulta = {$objPessoaConsulta->getId()} AND des_status = 'A'");
        $this->addDados('tEmprestimos', $tEmprestimo);
        $this->addDados('isEmprestimo', ($tEmprestimo > 0) ? true : false);

        $tEmprestimoNegociado = $objPessoaConsultaEmprestimoLogic->totalRegistro("ide_pessoa_consulta = {$objPessoaConsulta->getId()}  AND des_status = 'N'");
        $this->addDados('isEmprestimoNegociado', ($tEmprestimoNegociado > 0) ? true : false);

        if ($tEmprestimo > 0) {
            $arrayList = $objPessoaConsultaEmprestimoLogic->listar("ide_pessoa_consulta = {$objPessoaConsulta->getId()}  AND des_status = 'A'");
            $this->addDados('listEmprestimo', $arrayList);
            unset($arrayList);
        }

        unset($objPessoaConsulta, $objPessoa, $objPessoaLogic);

        $this->TPageAdmin($this->getAction());
    }

}
