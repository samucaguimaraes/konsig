<?php

class TipoContratoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new TipoContratoDAO());
    }
    
    public function cadastrar($ObjPageRequisitante = null) {

        /* Verificar se email existe */
        $cfTipoContrato = $this->obter("nom_tipo_contrato='{$_POST['nome']}'");
        if (is_object($cfTipoContrato)) {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possivel cadastrar este tipo de contrato. Nome já existente!');
            RedirectorHelper::goToControllerAction('TipoContrato', 'cadastrar');
        }
        unset($cfTipoContrato);

        $objTipoContrato = new TipoContrato();
        $objTipoContrato->setNome($_POST['nome']);
            
        $salvar = $this->salvar($objTipoContrato);

        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('Tipo de Contrato cadastrada com sucesso!');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getId());
            RedirectorHelper::goToControllerAction('TipoContrato', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::goToControllerAction('TipoContrato', 'cadastrar');
        }
    }

    public function ajaxListTipoContrato($params) {

        /* Atributos do objeto que poderam ser ordenado */
        $atributos = array('nome');
        $order = TDataTableSqliteHelper::mountOrderBy($atributos, $params['iSortCol_0'], $params['sSortDir_0']);
        unset($atributos);
        /* Colunas do banco a serem pesquisandas */
        $colunas = array('nom_tipo_contato');
        /* Montar search */
        $where = TDataTableSqliteHelper::mountSearch($colunas, $params['sSearch'], false);
        /* Total de registros */
        $iTotal = $this->totalRegistro($where);
        /* Listar */
        $arrayListObject = $this->listar($where, $order, null, null, $params['iDisplayStart'], $params['iDisplayLength']);
        unset($where);
        /* Montar output */
        $output = TDataTableSqliteHelper::mountArrayOutPut($params['sEcho'], $iTotal);
        unset($iTotal);
        if (isset($arrayListObject[0])) {
            foreach ($arrayListObject as $object) {
                $url = UrlRequestHelper::mountUrl('TipoContrato', 'informar', array('id' => $object->getId()));
                $link = "<a href='{$url}'>" . $object->getNome() . "</a>";
                
                $output['aaData'][] = array(
                    $link
                );
            }
        }
        unset($arrayListObject);
        return json_encode($output);
    }

}