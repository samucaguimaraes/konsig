<?php

class UsuarioController extends TMetroUIv3 {

    public $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new UsuarioLogic();
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
        
        $objUsuario = $this->logic->obterPorId($this->getParam('id'));
        $this->addDados('objUsuario', $objUsuario);
        unset($objUsuario);
        
        $this->TPageAdmin($this->getAction());
    }

}
