<?php

class CidadeLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new CidadeDAO());
    }

    public function ajaxListSelect2Cidade($params) {
        $exception = array();
        $exception['load'] = ExceptionORM::mountLoadException('Cidade', array('nome'));
        //$notIn = ($params['acoesSelecionadas'] !== 'null') ? "AND ide_acao NOT IN ({$params['acoesSelecionadas']})" : "";
       
        $arrayCidades = $this->listar("ide_estado = {$params['estado']}", 'nome', null, $exception);
        if (isset($arrayCidades[0])) {
            foreach ($arrayCidades as $objCidade) {
                $arrayJson[] = array('value' => $objCidade->getId(), 'nome' => $objCidade->getNome());
            }
        } else {
            $arrayJson = false;
        }

        return json_encode($arrayJson);
    }

}
