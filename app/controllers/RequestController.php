<?php

/**
 * Controller de requisição de dados
 */
class RequestController extends TRequest {

    public function post() {
        $nameObjLogic = ucfirst($this->getParam('l', false)) . 'Logic';
        $method = $this->getParam('a', false);
        $ObjLogic = new $nameObjLogic();
        $ObjLogic->$method(RequestPageHelper::getObjPageRequisitante());
    }

    public function get() {
        $nameObjLogic = ucfirst($this->getParam('l', false)) . 'Logic';
        $method = $this->getParam('a', false);
        $ObjLogic = new $nameObjLogic();
        $params = $this->getParam();
        unset($params['a'], $params['l']);
        (count($params) > 0) ? $ObjLogic->$method(RequestPageHelper::getObjPageRequisitante(), $params) : $ObjLogic->$method(RequestPageHelper::getObjPageRequisitante());
    }

    /**
     * AjaxPost
     * O metodo recebe um $_POST e retorna um objeto json
     * @param string $_POST['dados']['objeto'] Nome do objeto a ser instanciado
     * @param string $_POST['dados']['method'] Nome do metodo a ser chamado sem o ajax
     * @param array $params Caso exista mais dados na variavel $_POST é alocado nesta variavel
     * @return objeto json
     */
    public function ajaxPost() {

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $POST = $_POST['dados'];
            unset($_POST);
            $nameObjLogic = ucfirst($POST['objeto']) . 'Logic';
            unset($POST['objeto']);

            $method = 'ajax' . ucfirst($POST['method']);
            unset($POST['method']);

            $tPost = count($POST);
            if ($tPost > 0) {
                $params = $POST;
            }
            unset($tPost);
            unset($POST);

            $ObjLogic = new $nameObjLogic();
            unset($nameObjLogic);

            if (!isset($params)) {
                $result = $ObjLogic->$method();
            } else {
                $result = $ObjLogic->$method($params);
            }
            unset($ObjLogic);
            unset($method);
            unset($params);

            echo $result;
        } else {
            echo false;
        }
    }

    /**
     * AjaxGet
     * O metodo recebe um $_GET e retorna um objeto json
     * @param string $_GET['objeto'] Nome do objeto a ser instanciado
     * @param string $_GET['method'] Nome do metodo a ser chamado sem o ajax
     * @param array $params Caso exista mais dados na variavel $_POST � alocado nesta variavel
     * @return objeto json
     */
    public function ajaxGet() {

        if ($_SERVER['REQUEST_METHOD'] === "GET") {

            unset($_GET['c']);
            unset($_GET['a']);

            $DADOS = $_GET;
            unset($_GET);
            $nameObjLogic = ucfirst($DADOS['objeto']) . 'Logic';
            unset($DADOS['objeto']);

            $method = 'ajax' . ucfirst($DADOS['method']);
            unset($DADOS['method']);

            $tGet = count($DADOS);
            if ($tGet > 0) {
                $params = $DADOS;
            }
            unset($tGet);
            unset($DADOS);

            $ObjLogic = new $nameObjLogic();
            unset($nameObjLogic);

            if (!isset($params)) {
                $result = $ObjLogic->$method();
            } else {
                $result = $ObjLogic->$method($params);
            }
            unset($ObjLogic);
            unset($method);
            unset($params);

            echo $result;
        } else {
            echo false;
        }
    }

}