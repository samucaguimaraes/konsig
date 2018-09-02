<?php

class SecurityController extends TMetroUIv3 {

    public function __construct() {
        parent::__construct();
    }
    
    public function alterarSenha() {
        
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");
        
        $this->addDados('idUsuario', $this->SECURITY->getUsuario()->getId());
        
        $this->TPageAdmin($this->getAction());
    }

}