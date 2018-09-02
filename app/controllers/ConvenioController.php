<?php

class ConvenioController extends TMetroUIv3 {

    public $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new ConvenioLogic();
    }

    public function index() {
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");
        $this->TPageAdmin('index');
    }

    public function cadastrar() {
        
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.mask.min.js");
        
        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "select2.min.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . 'jquery.maskMoney.min.js');
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");        
        
        $objBancoLogic = new BancoLogic();
        $arrayList = $objBancoLogic->listar();
        $this->addDados('listBanco', $arrayList);
        unset($arrayList);
        
        $objOrgaoLogic = new OrgaoLogic();
        $arrayList = $objOrgaoLogic->listar();
        $this->addDados('listOrgao', $arrayList);
        unset($arrayList);
        
        $this->TPageAdmin($this->getAction());
    }

    public function informar() {
        
        $objConvenio = $this->logic->obterPorId($this->getParam('id'));
        $this->addDados('objConvenio', $objConvenio);
        unset($objConvenio);
        
        $this->TPageAdmin($this->getAction());
    }

}
