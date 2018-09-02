<?php

class TipoSituacaoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new TipoSituacaoDAO());
    }
    
    public function cadastrar($ObjPageRequisitante = null) {
        
        /* Verificar se email existe */
        $cfTipoSituacao = $this->obter("nom_tipo_situacao='{$_POST['nome']}'");
        if(is_object($cfTipoSituacao)) {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possivel cadastrar este tipo de situação. Nome já existente!');
            RedirectorHelper::goToControllerAction('TipoSituacao', 'cadastrar');
        }
        unset($cfTipoSituacao);

        $objTipoSituacao = new TipoSituacao();
        $objTipoSituacao->setNome($_POST['nome']);
        $objTipoSituacao->setStatus('A');

        $salvar = $this->salvar($objTipoSituacao);

        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('Tipo de Situação cadastrada com sucesso!');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getId());
            RedirectorHelper::goToControllerAction('TipoSituacao', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::goToControllerAction('TipoSituacao', 'cadastrar');
        }
    }
    
    public function ajaxListTipoSituacao($params) {

        /* Atributos do objeto que poderam ser ordenado */
        $atributos = array('nome', 'status');
        $order = TDataTableSqliteHelper::mountOrderBy($atributos, $params['iSortCol_0'], $params['sSortDir_0']);
        unset($atributos);
        /* Colunas do banco a serem pesquisandas */
        $colunas = array('ide_tipo_situacao', 'nom_tipo_situacao', 'des_status');
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
                $url = UrlRequestHelper::mountUrl('TipoSituacao', 'informar', array('id' => $object->getId()));
                $link = "<a href='{$url}'>" . $object->getNome() . "</a>";
                $status = ($object->getStatus()=='A')?"<span class='tag success'>Ativo</span>":"<span class='tag alert'>Desativado</span>";
                $output['aaData'][] = array(
                    $link,
                    $status
                );
            }
        }
        unset($arrayListObject);
        return json_encode($output);
    }

}