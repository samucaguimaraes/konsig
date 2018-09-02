<?php

class TipoContatoController extends TMetroUIv3 {

    public $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new TipoContatoLogic();
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

    public function informar() {
        
        $objTipoContato = $this->logic->obterPorId($this->getParam('id'));
        $this->addDados('objTipoContato', $objTipoContato);
        unset($objTipoContato);
        
        $this->TPageAdmin($this->getAction());
    }

}
