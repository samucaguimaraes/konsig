<?php

class TipoOrgaoController extends TMetroUIv3 {

    public $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new TipoOrgaoLogic();
    }

    public function index() {
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");
        $this->TPageAdmin('index');
    }

    public function cadastrar() {
        
        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "select2.min.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");        
        
        $objTipoSituacaoLogic = new TipoSituacaoLogic();
        $arrayListObj = $objTipoSituacaoLogic->listar("ide_tipo_situacao IN (11,12)");
        
        $this->addDados('listTipoSituacao', $arrayListObj);
        
        $this->TPageAdmin($this->getAction());
    }

    public function informar() {
        
        $objTipoOrgao = $this->logic->obterPorId($this->getParam('id'));
        $this->addDados('objTipoOrgao', $objTipoOrgao);
        unset($objTipoOrgao);
        
        $this->TPageAdmin($this->getAction());
    }

}
