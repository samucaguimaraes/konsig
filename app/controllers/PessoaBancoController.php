<?php

class PessoaBancoController extends TMetroUIv3 {

    public $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new PessoaBancoLogic();
    }

    public function index() {
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");
        $this->TPageAdmin('index');
    }

    public function cadastrar() {
        
        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "select2.min.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.mask.min.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");        
        
        $objPessoaLogic = new PessoaLogic();
        $objPessoa = $objPessoaLogic->obterPorId($this->getParam('id'));
        $this->addDados('objPessoa', $objPessoa);
        
        $objBancoLogic = new BancoLogic();
        $arrayList = $objBancoLogic->listar();
        $this->addDados('listBanco', $arrayList);
        unset($arrayList);
        
        $this->TPageAdmin($this->getAction());
    }

    public function informar() {
        
        $objPessoaBanco = $this->logic->obterPorId($this->getParam('id'));
        $this->addDados('objPessoaBanco', $objPessoaBanco);
        unset($objPessoaBanco);
        
        $this->TPageAdmin($this->getAction());
    }

}
