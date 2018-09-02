<?php

class PessoaConsultaEmprestimoController extends TMetroUIv3 {

    public $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new PessoaConsultaEmprestimoLogic();
    }

    public function index() {
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");
        $this->TPageAdmin('index');
    }

    public function cadastrar() {
        
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");        
        
        $this->TPageAdmin($this->getAction());
    }
    
    public function congelar() {
        
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");        
        
        $objPessoaConsultaEmprestimo = $this->logic->obterPorId($this->getParam('id'),true);
        $this->addDados('objPessoaConsultaEmprestimo', $objPessoaConsultaEmprestimo);
        
        $objOrgaoLogic = new OrgaoLogic();
        //$objOrgao = $objOrgaoLogic->obterPorId($objPessoaConsultaEmprestimo->getConvenio()->getOrgao());
        //$this->addDados('objOrgao', $objOrgao);
        //var_dump($objPessoaConsultaEmprestimo);exit();
        
        $this->TPageAdmin($this->getAction());
    }
    
    public function editar() {
        
        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "select2.min.js");
        //$this->HTML->addJavaScript(PATH_JS_CORE_URL . 'jquery.maskMoney.min.js');
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.mask.min.js");
        //$this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");        
        
        $objPessoaConsultaLogic = new PessoaConsultaLogic();
        $objPessoaConsulta = $objPessoaConsultaLogic->obterPorId($this->getParam('id'),true);
        $this->addDados('objPessoaConsulta', $objPessoaConsulta);
        
        $objOrgaoLogic = new OrgaoLogic();
        $objOrgao = $objOrgaoLogic->obterPorId($objPessoaConsulta->getPessoaOrgao()->getOrgao());
        $this->addDados('objOrgao', $objOrgao);
        
        $arrayList = $this->logic->listar("ide_pessoa_consulta = {$objPessoaConsulta->getId()} AND des_status = 'A'"); //Apenas Emprestimos Ativos
        $this->addDados('listEmprestimo', $arrayList);
        unset($arrayList);
        
        $objConvenioLogic = new ConvenioLogic();
        $arrayList = $objConvenioLogic->listar("ide_orgao = {$objOrgao->getId()}");
        
        $this->addDados('listConvenios', $arrayList);
        unset($arrayList);
        
        $this->TPageAdmin($this->getAction());
    }

    public function informar() {
        
        $objPessoaConsultaEmprestimo = $this->logic->obterPorId($this->getParam('id'),true);
        $this->addDados('objPessoaConsultaEmprestimo', $objPessoaConsultaEmprestimo);
        
        $arrayHistorico = array();
        $totalHistorico = 0;
        //Montando o histórico de empréstimos
        if($objPessoaConsultaEmprestimo->getPessoaConsultaEmprestimoOrigem() != null){
            //$arrayHistorico[] = $objPessoaConsultaEmprestimo->getPessoaConsultaEmprestimoOrigem();
            $idObjeto = $objPessoaConsultaEmprestimo->getPessoaConsultaEmprestimoOrigem()->getId();
            $flag = true;
            while ($flag) {
                $objeto = $this->logic->obterPorId($idObjeto);
                $arrayHistorico[] = $objeto;
                if($objeto->getPessoaConsultaEmprestimoOrigem() != null){
                    $idObjeto = $objeto->getPessoaConsultaEmprestimoOrigem();
                    $flag = true;
                } else {
                    $flag = false;
                }
            }
            $totalHistorico = count($arrayHistorico);
        }
        
        if($objPessoaConsultaEmprestimo->getConvenio() != null){
            $objConvenioLogic = new ConvenioLogic();
            $objConvenio = $objConvenioLogic->obterPorId($objPessoaConsultaEmprestimo->getConvenio()->getId(),true);
        } else {
            $objConvenio = null;
        }
        $this->addDados('objConvenio', $objConvenio);
        
        //Adicionando 1+ a contagem do histórico para adicionar o empréstimo original
        $totalHistorico = ($totalHistorico>0)?$totalHistorico++:$totalHistorico;
        
        $this->addDados('tHistorico', $totalHistorico);
        
        //Notificações
        $objNotificacaoLogic = new NotificacaoLogic();
        $arrayList = $objNotificacaoLogic->listar("des_elemento = '{$this->getController()}' AND ide_elemento = {$this->getParam('id')}");
        $tNotificacao = $objNotificacaoLogic->totalRegistro("des_elemento = '{$this->getController()}' AND ide_elemento = {$this->getParam('id')}");
        $this->addDados('isNotificacao', ($tNotificacao>0)?true:false);
        $this->addDados('listNotificacao', $arrayList);
        
        //echo "<pre>";var_dump($arrayHistorico);exit();
        /* Definir a aba que vai ser aberta */
        if (isset($_SESSION['frame'])) {
            $objTFrameActive = new TFrameActiveHelper($_SESSION['frame'], 'frame');
        } else {
            $objTFrameActive = new TFrameActiveHelper('frameA', 'frame');
        }
        $this->addDados('frameActive', $objTFrameActive);
        
        unset($objPessoaConsultaEmprestimo);        
        $this->TPageAdmin($this->getAction());
    }

}
