<?php

class CorretorController extends TMetroUIv3 {

    public $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new CorretorLogic();
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

        $objEstadoLogic = new EstadoLogic();
        $arrayList = $objEstadoLogic->listar("ide_pais = 1"); //Estados Brasileiros
        $this->addDados('listEstado', $arrayList);
        unset($arrayList);
        
        $this->TPageAdmin($this->getAction());
    }

    public function informar() {
        
        $objCorretor = $this->logic->obterPorId($this->getParam('id'),true);
        $this->addDados('objCorretor', $objCorretor);
                
        $objEstadoLogic = new EstadoLogic();
        $objEstado = $objEstadoLogic->obterPorId($objCorretor->getCidade()->getEstado());
        
        /**
         * Construir a estrutura de contato para os corretores
         */
        $this->addDados('isCorretorContato', false);
        $this->addDados('objEstado', $objEstado);
        /* Definir a aba que vai ser aberta */
        if (isset($_SESSION['frame'])) {
            $objTFrameActive = new TFrameActiveHelper($_SESSION['frame'], 'frame');
        } else {
            $objTFrameActive = new TFrameActiveHelper('frameA', 'frame');
        }
        $this->addDados('frameActive', $objTFrameActive);
        
        unset($objCorretor);
        
        $this->TPageAdmin($this->getAction());
    }

}
