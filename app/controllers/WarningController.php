<?php
class WarningController extends TErrors {

    public function index() {
        $this->addDados('erro', 'Ocorreu um erro, isso é constrangedor!!!');
        $this->TPageSecondary("erro");
    }

    public function HTTP_401() {
        $this->addDados('erro', 'ERRO 401 - PAGINA NÃO EXISTE!!!');
        $this->TPageSecondary("erro");
    }

    public function HTTP_403() {
        $this->addDados('erro', 'ERRO 403 - ACESSO NEGADO!!!');
        $this->TPageSecondary("erro");
    }

    public function HTTP_404() {
        $this->addDados('erro', 'ERRO 404 - PAGINA NÃO EXISTE!!!');
        $this->TPageSecondary("erro");
    }

    public function VIEW_404() {
        $this->addDados('erro', '404');
        $this->addDados('message', 'A URL requisitada não foi encontrada neste servidor.');
        $this->TPageAdmin("erro");
    }

    public function database(){
        $this->addDados('erro', 'Servidor - Temporariamente indisponivel!!!');
        $this->TPageSecondary("erro");
    }

}