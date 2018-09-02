<?php

class PessoaController extends TMetroUIv3 {

    public $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new PessoaLogic();
    }

    public function index() {
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");
        $this->TPageAdmin('index');
    }

    public function cadastrar() {

        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "select2.min.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.mask.min.js");


        $objEstadoLogic = new EstadoLogic();
        $arrayList = $objEstadoLogic->listar("ide_pais = 1"); //Estados Brasileiros
        $this->addDados('listEstado', $arrayList);
        unset($arrayList);

        if ($this->getParam('simples')) {
            $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/cadastrar_simples.js");

            $objOrgaoLogic = new OrgaoLogic();
            $arrayList = $objOrgaoLogic->listar();
            $this->addDados('listOrgao', $arrayList);
            unset($arrayList);

            $objTipoEspecieBeneficioLogic = new TipoEspecieBeneficioLogic();
            $arrayList = $objTipoEspecieBeneficioLogic->listar();
            $this->addDados('listTipoEspecieBeneficio', $arrayList);
            unset($arrayList);

            $objTipoSituacaoLogic = new TipoSituacaoLogic();
            $arrayList = $objTipoSituacaoLogic->listar();
            $this->addDados('listTipoSituacao', $arrayList);
            unset($arrayList);

            $objTipoContatoLogic = new TipoContatoLogic();
            $arrayList = $objTipoContatoLogic->listar();
            $this->addDados('listTipoContato', $arrayList);

            $objOperadoraLogic = new OperadoraLogic();
            $arrayList = $objOperadoraLogic->listar();
            $this->addDados('listOperadora', $arrayList);

            $this->TPageAdmin('cadastrar_simples');
        } else {
            $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");

            $this->TPageAdmin($this->getAction());
        }
    }

    public function editar() {

        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.populate.js");
        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "select2.min.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.pstrength-min.1.2.js");
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.mask.min.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");

        $objJSon = $this->logic->obterPorId($this->getParam('id'));

        $objEstadoLogic = new EstadoLogic();
        $arrayList = $objEstadoLogic->listar("ide_pais = 1"); //Estados Brasileiros
        $this->addDados('listEstado', $arrayList);
        unset($arrayList);

        $objCidadeLogic = new CidadeLogic();
        $objCidade = $objCidadeLogic->obterPorId($objJSon->getCidade());
        $arrayList = $objCidadeLogic->listar("ide_estado = {$objCidade->getEstado()}");
        $this->addDados('listCidade', $arrayList);
        unset($arrayList);

        $arrayJson = array();
        $arrayJson['estado'] = $objCidade->getEstado();

        $this->addDados('json_objeto', $this->logic->objectToJson($objJSon, $arrayJson));

        //Logs
        $objUsuarioLogic = new UsuarioLogic();
        $logCriacao = "";
        $logAtualizacao = "";

        $objUsuarioCriador = $objUsuarioLogic->obterPorId($objJSon->getUsuarioCriador());
        if ($objUsuarioCriador != null) {
            $logCriacao = "<p>Registro criado por {$objUsuarioCriador->getNome()} em {$objJSon->getDataCriacao()}</p>";
        }

        $objUsuarioAtualizador = $objUsuarioLogic->obterPorId($objJSon->getUsuarioAtualizador());
        if ($objUsuarioAtualizador != null) {
            $logAtualizacao = "<p>Última atualização por {$objUsuarioAtualizador->getNome()} em {$objJSon->getDataAtualizacao()}</p>";
        }
        $this->addDados('logCriacao', $logCriacao);
        $this->addDados('logAtualizacao', $logAtualizacao);

        $this->TPageAdmin($this->getAction());
    }

    public function informar() {

        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");

        $objPessoa = $this->logic->obterPorId($this->getParam('id'), true);
        $this->addDados('objPessoa', $objPessoa);

        //PESSOA ORGÃO, FLAG DE QUANTIDADE TOTAL
        $objPessoaOrgaoLogic = new PessoaOrgaoLogic();
        $tOrgaos = $objPessoaOrgaoLogic->totalRegistro("ide_pessoa = {$objPessoa->getId()}");
        $this->addDados('tPessoaOrgao', $tOrgaos);
        $this->addDados('isPessoaOrgao', ($tOrgaos > 0) ? true : false);

        //PESSOA CONTATO, FLAG DE QUANTIDADE TOTAL
        $objPessoaContatoLogic = new PessoaContatoLogic();
        $tContatos = $objPessoaContatoLogic->totalRegistro("ide_pessoa = {$objPessoa->getId()}");
        $this->addDados('tPessoaContato', $tContatos);
        $this->addDados('isPessoaContato', ($tContatos > 0) ? true : false);

        //PESSOA CONSULTA, FLAG DE QUANTIDADE TOTAL        
        $objPessoaConsultaLogic = new PessoaConsultaLogic();
        $tConsultas = $objPessoaConsultaLogic->totalRegistro("ide_pessoa = {$objPessoa->getId()} AND des_status = 'A'");
        $this->addDados('tPessoaConsulta', $tConsultas);
        $this->addDados('isPessoaConsulta', ($tConsultas > 0) ? true : false);

        //PESSOA CONTRATO, FLAG DE QUANTIDADE TOTAL        
        $objPessoaContratoLogic = new PessoaContratoLogic();
        $tContratos = $objPessoaContratoLogic->totalRegistro("ide_pessoa = {$objPessoa->getId()}");
        $this->addDados('tPessoaContrato', $tContratos);
        $this->addDados('isPessoaContrato', ($tContratos > 0) ? true : false);

        //PESSOA BANCO, FLAG DE QUANTIDADE TOTAL
        $objPessoaBancoLogic = new PessoaBancoLogic();
        $tBancos = $objPessoaBancoLogic->totalRegistro("ide_pessoa = {$objPessoa->getId()}");
        $this->addDados('isPessoaBanco', ($tBancos > 0) ? true : false);

        $arrayContasBancarias = $objPessoaBancoLogic->listar("ide_pessoa = {$objPessoa->getId()}", null, true);
        $this->addDados('listPessoaBanco', $arrayContasBancarias);

        $objEstadoLogic = new EstadoLogic();
        $objEstado = $objEstadoLogic->obterPorId($objPessoa->getCidade()->getEstado());

        $this->addDados('objEstado', $objEstado);
        /* Definir a aba que vai ser aberta */
        if (isset($_SESSION['frame'])) {
            $objTFrameActive = new TFrameActiveHelper($_SESSION['frame'], 'frame');
        } else {
            $objTFrameActive = new TFrameActiveHelper('frameA', 'frame');
        }
        $this->addDados('frameActive', $objTFrameActive);

        unset($objPessoa);
        $this->TPageAdmin($this->getAction());
    }

}
