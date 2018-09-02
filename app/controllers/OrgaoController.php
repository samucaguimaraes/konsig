<?php

class OrgaoController extends TMetroUIv3 {

    public $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new OrgaoLogic();
    }

    public function index() {
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");
        $this->TPageAdmin('index');
    }

    public function cadastrar() {
        
        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "select2.min.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");        
        
        $objTipoOrgaoLogic = new TipoOrgaoLogic();
        $arrayList = $objTipoOrgaoLogic->listar();
        $this->addDados('listTipoOrgao', $arrayList);
        unset($arrayList);
        
        $this->TPageAdmin($this->getAction());
    }

    public function informar() {
        
        $objOrgao = $this->logic->obterPorId($this->getParam('id'));
        $this->addDados('objOrgao', $objOrgao);
        unset($objOrgao);
        
        $this->TPageAdmin($this->getAction());
    }

}
