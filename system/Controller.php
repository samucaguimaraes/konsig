<?php

class Controller {

    private $DADOS;

    public function __construct() {
        $this->DADOS = null;
    }

    public function init() {}
    
    public function getController() {
        return CurrentUrlHelper::getController();
    }
    
    public function getAction() {
        return CurrentUrlHelper::getAction();
    }
    
    public function getParam($name = null, $dencrypt = true) {
        return CurrentUrlHelper::getParam($name,$dencrypt);
    }

    public function isParam($name) {
        return CurrentUrlHelper::isParam($name);
    }

    public function addDados($name, $value) {
        $this->DADOS[$name] = $value;
    }

    public function view($nome) {
        if (is_array($this->DADOS) && count($this->DADOS) > 0) {
            extract($this->DADOS, EXTR_PREFIX_ALL, 'view');
        }

        $path = VIEWS . CurrentUrlHelper::getController() . "/" . $nome . '.phtml';

        if (!file_exists($path)) {
            LogHelper::gerarLogPath($path, 'A VIEW informada não existe em nossa base');
            RedirectorHelper::goToControllerAction("Warning", "VIEW_404");
        }

        return require_once ( $path );
    }

    public function viewCore($nome) {
        if (is_array($this->DADOS) && count($this->DADOS) > 0) {
            extract($this->DADOS, EXTR_PREFIX_ALL, 'view');
        }

        $path = VIEWS . "core/" . $nome . '.phtml';

        if (!file_exists($path)) {
            LogHelper::gerarLogPath($path, 'A VIEW informada não existe em nossa base');
            RedirectorHelper::goToControllerAction("Warning", "VIEW_404");
        }

        return require_once ( $path );
    }

}