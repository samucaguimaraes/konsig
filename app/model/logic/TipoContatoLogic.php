<?php

class TipoContatoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new TipoContatoDAO());
    }

    public function cadastrar($ObjPageRequisitante = null) {

        /* Verificar se email existe */
        $cfTipoContato = $this->obter("nom_tipo_contato='{$_POST['nome']}'");
        if (is_object($cfTipoContato)) {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possivel cadastrar este tipo de contato. Nome já existente!');
            RedirectorHelper::goToControllerAction('TipoContato', 'cadastrar');
        }
        unset($cfTipoContato);

        $objTipoContato = new TipoContato();
        $objTipoContato->setNome($_POST['nome']);
        
        $salvar = $this->salvar($objTipoContato);

        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('Tipo de Contato cadastrada com sucesso!');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getId());
            RedirectorHelper::goToControllerAction('TipoContato', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::goToControllerAction('TipoContato', 'cadastrar');
        }
    }

    public function ajaxListTipoContato($params) {

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
                $url = UrlRequestHelper::mountUrl('TipoContato', 'informar', array('id' => $object->getId()));
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
