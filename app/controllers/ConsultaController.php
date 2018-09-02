<?php

class ConsultaController extends TMetroUIv3 {

    public $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new ConsultaLogic();
    }

    public function index() {
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");
        $this->TPageAdmin('index');
    }

    public function cadastrar() {
        
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.mask.min.js");
        
        if(isset($_POST['numeroCPF'])){
            $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "select2.min.js");
            $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
            $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");        
                        
            $objPessoaLogic = new PessoaLogic();
            $objPessoa = $objPessoaLogic->obter("num_cpf = '" . FormatHelper::unformatCPF($_POST['numeroCPF']) . "'");
            $this->addDados('objPessoa', $objPessoa);
            unset($objPessoaLogic);
            
            $objPessoaOrgaoLogic = new PessoaOrgaoLogic();
            $arrayList = $objPessoaOrgaoLogic->listar("ide_pessoa = {$objPessoa->getId()}",null,true);
            $this->addDados('listPessoaOrgao', $arrayList);
            unset($arrayList);
            
            $this->TPageAdmin($this->getAction());
        } else {            
            $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
            $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/validar_cadastrar.js");        
        
            $this->TPageAdmin('validar_cadastrar');
        }
    }
    
    public function informar() {
        
        $objConsulta = $this->logic->obterPorId($this->getParam('id'));
        $this->addDados('objConsulta', $objConsulta);
        unset($objConsulta);
        
        $this->TPageAdmin($this->getAction());
    }

}
