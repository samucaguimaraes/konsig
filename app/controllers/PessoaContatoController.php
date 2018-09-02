<?php

class PessoaContatoController extends TMetroUIv3 {

    public $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new PessoaContatoLogic();
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

        $objTipoContatoLogic = new TipoContatoLogic();
        $arrayList = $objTipoContatoLogic->listar();
        $this->addDados('listTipoContato', $arrayList);

        $objOperadoraLogic = new OperadoraLogic();
        $arrayList = $objOperadoraLogic->listar();
        $this->addDados('listOperadora', $arrayList);

        $this->TPageAdmin($this->getAction());
    }

    public function informar() {

        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");   
        $objPessoaContato = $this->logic->obterPorId($this->getParam('id'), true);
        $this->addDados('objPessoaContato', $objPessoaContato);

        unset($objPessoaContato);

        $this->TPageAdmin($this->getAction());
    }
    
    public function editar(){
        
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.populate.js");
        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "select2.min.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");   
        
        $objPessoaContato = $this->logic->obterPorId($this->getParam('id'));
        $this->addDados('objPessoaContato', $objPessoaContato);
        
        $objPessoaLogic = new PessoaLogic();
        $objPessoa = $objPessoaLogic->obterPorId($objPessoaContato->getPessoa());
        $this->addDados('objPessoa', $objPessoa);
        
        $objTipoContatoLogic = new TipoContatoLogic();
        $arrayList = $objTipoContatoLogic->listar();
        $this->addDados('listTipoContato', $arrayList);

        $objOperadoraLogic = new OperadoraLogic();
        $arrayList = $objOperadoraLogic->listar();
        $this->addDados('listOperadora', $arrayList);
        
        //Logs
        $objUsuarioLogic = new UsuarioLogic();
        $logCriacao = "";
        $logAtualizacao = "";
        
        $objUsuarioCriador = $objUsuarioLogic->obterPorId($objPessoaContato->getUsuarioCriador());
        if($objUsuarioCriador!=null){
            $logCriacao = "<p>Registro criado por {$objUsuarioCriador->getNome()} em {$objPessoaContato->getDataCriacao()}</p>";
        }
        
        $objUsuarioAtualizador = $objUsuarioLogic->obterPorId($objPessoaContato->getUsuarioAtualizador());
        if($objUsuarioAtualizador!=null){
            $logAtualizacao = "<p>Última atualização por {$objUsuarioAtualizador->getNome()} em {$objPessoaContato->getDataAtualizacao()}</p>";
        }
        $this->addDados('logCriacao', $logCriacao);
        $this->addDados('logAtualizacao', $logAtualizacao);
        
        unset($objUsuarioLogic,$objUsuarioCriador,$objUsuarioAtualizador);
        
        $this->addDados('json_objeto', $this->logic->objectToJson($objPessoaContato));
                
        $this->TPageAdmin($this->getAction());
        
    }
    
}
