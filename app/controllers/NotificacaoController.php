<?php

class NotificacaoController extends TMetroUIv3 {

    public $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new NotificacaoLogic();
    }

    public function index() {
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");
        
        $totalConsulta = DbORM::select("SELECT COUNT(*) AS total FROM (SELECT COUNT(pessoa_consulta.ide_pessoa_consulta) As total, pessoa.ide_pessoa FROM pessoa
LEFT JOIN pessoa_consulta ON pessoa.ide_pessoa = pessoa_consulta.ide_pessoa GROUP BY pessoa.ide_pessoa HAVING total = 0) AS consulta");
        $this->addDados('totalConsulta', $totalConsulta[0]['total']);
        
        $objPessoaContratoLogic = new PessoaContratoLogic();
        $totalContratoFisico = $objPessoaContratoLogic->totalRegistro("des_status = 'A' AND dat_entrega_fisico IS NULL AND num_protocolo_entrega IS NULL AND ide_tipo_situacao = 16");
        $this->addDados('totalContratoFisico', $totalContratoFisico);
        
        $objPessoaConsultaEmprestimoLogic = new PessoaConsultaEmprestimoLogic();
        $tHiscon = $objPessoaConsultaEmprestimoLogic->totalRegistro("ide_convenio IS NULL");
        $this->addDados('totalHiscon', $tHiscon);
        
        $tNotificacao = $this->logic->totalRegistro("des_status = 'A'");
        $this->addDados('isNotificacao', ($tNotificacao>0)?true:false);
        
        $arrayObjNotificacao = $this->logic->listar();
        $this->addDados('listNotificacao', $arrayObjNotificacao);
        
        $this->TPageAdmin('index');
    }
    
    public function listar() {
        
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");
        
        switch ($this->getParam('alerta')) {
            case 'consulta':
                $this->TPageAdmin('listar_consulta');
                break;

            default:
                break;
        }
        
        $totalConsulta = DbORM::select("SELECT COUNT(*) AS total FROM (SELECT COUNT(pessoa_consulta.ide_pessoa_consulta) As total, pessoa.ide_pessoa FROM pessoa
LEFT JOIN pessoa_consulta ON pessoa.ide_pessoa = pessoa_consulta.ide_pessoa GROUP BY pessoa.ide_pessoa HAVING total = 0) AS consulta");
        $this->addDados('totalConsulta', $totalConsulta[0]['total']);
        
        $arrayObjNotificacao = $this->logic->listar();
        $this->addDados('listNotificacao', $arrayObjNotificacao);
        
        $this->TPageAdmin('index');
    }

    public function cadastrar() {
        
        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "select2.min.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");        
        
        $class = $this->getParam('elemento') . 'Logic';
        $objClassLogic = new $class();
        
        $this->addDados('elemento', $this->getParam('elemento'));
        
        $objClass = $objClassLogic->obterPorId($this->getParam('id'));
        $this->addDados('objClass', $objClass);
        
//var_dump($objClass);exit();
        
        $this->TPageAdmin($this->getAction());
    }

    public function informar() {
        
        $objNotificacao = $this->logic->obterPorId($this->getParam('id'));
        $this->addDados('objNotificacao', $objNotificacao);
        unset($objNotificacao);
        
        $this->TPageAdmin($this->getAction());
    }

}
