<?php

class PessoaOrgaoController extends TMetroUIv3 {

    public $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new PessoaOrgaoLogic();
    }

    public function index() {
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");
        $this->TPageAdmin('index');
    }

    public function cadastrar() {
        
        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "select2.min.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");        
        
        $objPessoaLogic = new PessoaLogic();
        $objPessoa = $objPessoaLogic->obterPorId($this->getParam('id'));
        $this->addDados('objPessoa', $objPessoa);
        
        $objOrgaoLogic = new OrgaoLogic();
        $arrayList = $objOrgaoLogic->listar();
        $this->addDados('listOrgao', $arrayList);
        unset($arrayList);
        
        $objTipoEspecieBeneficioLogic = new TipoEspecieBeneficioLogic();
        $arrayList = $objTipoEspecieBeneficioLogic->listar();
        $this->addDados('listTipoEspecieBeneficio', $arrayList);
        unset($arrayList);
        
        $objTipoSituacaoLogic = new TipoSituacaoLogic();
        $arrayList = $objTipoSituacaoLogic->listar();
        $this->addDados('listTipoSituacao', $arrayList);
        unset($arrayList);
        
        $this->TPageAdmin($this->getAction());
    }
    
    public function editar(){
        
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.populate.js");
        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "select2.min.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");   
        
        $objPessoaOrgao = $this->logic->obterPorId($this->getParam('id'));
        
        $objPessoaLogic = new PessoaLogic();
        $objPessoa = $objPessoaLogic->obterPorId($objPessoaOrgao->getPessoa());
        $this->addDados('objPessoa', $objPessoa);
        
        $objOrgaoLogic = new OrgaoLogic();
        $arrayList = $objOrgaoLogic->listar();
        $this->addDados('listOrgao', $arrayList);
        unset($arrayList);
        
        $objTipoEspecieBeneficioLogic = new TipoEspecieBeneficioLogic();
        $arrayList = $objTipoEspecieBeneficioLogic->listar();
        $this->addDados('listTipoEspecieBeneficio', $arrayList);
        unset($arrayList);
        
        $objTipoSituacaoLogic = new TipoSituacaoLogic();
        $arrayList = $objTipoSituacaoLogic->listar("ide_tipo_situacao IN (13,14,15)");
        $this->addDados('listTipoSituacao', $arrayList);
        unset($arrayList);
        
        //Logs
        $objUsuarioLogic = new UsuarioLogic();
        $logCriacao = "";
        $logAtualizacao = "";
        
        $objUsuarioCriador = $objUsuarioLogic->obterPorId($objPessoaOrgao->getUsuarioCriador());
        if($objUsuarioCriador!=null){
            $logCriacao = "<p>Registro criado por {$objUsuarioCriador->getNome()} em {$objPessoaOrgao->getDataCriacao()}</p>";
        }
        
        $objUsuarioAtualizador = $objUsuarioLogic->obterPorId($objPessoaOrgao->getUsuarioAtualizador());
        if($objUsuarioAtualizador!=null){
            $logAtualizacao = "<p>Última atualização por {$objUsuarioAtualizador->getNome()} em {$objPessoaOrgao->getDataAtualizacao()}</p>";
        }
        $this->addDados('logCriacao', $logCriacao);
        $this->addDados('logAtualizacao', $logAtualizacao);
        
        unset($objUsuarioLogic,$objUsuarioCriador,$objUsuarioAtualizador);
        
        $this->addDados('json_objeto', $this->logic->objectToJson($objPessoaOrgao));
                
        $this->TPageAdmin($this->getAction());
        
    }

    public function informar() {
        
        $objPessoaOrgao = $this->logic->obterPorId($this->getParam('id'),true);
        $this->addDados('objPessoaOrgao', $objPessoaOrgao);
        
        $objNotificacaoLogic = new NotificacaoLogic();
        $arrayNotificacao = $objNotificacaoLogic->listar("des_elemento = 'PessoaOrgao' AND des_status = 'A' AND ide_elemento = {$objPessoaOrgao->getId()}",null,true);
        
        $this->addDados('tNotificacao', count($arrayNotificacao));
        $this->addDados('listNotificacao', $arrayNotificacao);
        unset($objPessoaOrgao);
        $this->TPageAdmin($this->getAction());
    }

}
