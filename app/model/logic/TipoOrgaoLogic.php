<?php

class TipoOrgaoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new TipoOrgaoDAO());
    }
    
    public function cadastrar($ObjPageRequisitante = null) {
        
        /* Verificar se email existe */
        $cfTipoOrgao = $this->obter("nom_tipo_orgao='{$_POST['nome']}'");
        if(is_object($cfTipoOrgao)) {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar este tipo de orgão. Nome já existente!');
            RedirectorHelper::goToControllerAction('TipoOrgao', 'cadastrar');
        }
        unset($cfTipoOrgao);

        $objTipoOrgao = new TipoOrgao();
        $objTipoOrgao->setNome($_POST['nome']);
        $objTipoOrgao->setTipoSituacao($_POST['tipoSituacao']);

        $salvar = $this->salvar($objTipoOrgao);

        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('Tipo de Orgão cadastrado com sucesso!');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getId());
            RedirectorHelper::goToControllerAction('TipoOrgao', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::goToControllerAction('TipoOrgao', 'cadastrar');
        }
    }
    
    public function ajaxListTipoOrgao($params) {

        /* Atributos do objeto que poderam ser ordenado */
        $atributos = array('nome', 'situacao');
        $order = TDataTableSqliteHelper::mountOrderBy($atributos, $params['iSortCol_0'], $params['sSortDir_0']);
        unset($atributos);
        /* Colunas do banco a serem pesquisandas */
        $colunas = array('ide_tipo_orgao','nom_tipo_orgao', 'ide_tipo_situacao');
        /* Montar search */
        $where = TDataTableSqliteHelper::mountSearch($colunas, $params['sSearch'], false);
        /* Total de registros */
        $iTotal = $this->totalRegistro($where);
        /* Listar */
        $arrayListObject = $this->listar($where, $order, true, null, $params['iDisplayStart'], $params['iDisplayLength']);
        unset($where);
        /* Montar output */
        $output = TDataTableSqliteHelper::mountArrayOutPut($params['sEcho'], $iTotal);
        unset($iTotal);

        if (isset($arrayListObject[0])) {
            foreach ($arrayListObject as $object) {
                $url = UrlRequestHelper::mountUrl('TipoOrgao', 'informar', array('id' => $object->getId()));
                $link = "<a href='{$url}'>" . $object->getNome() . "</a>";
                //$status = ($object->getStatus()=='A')?"<span class='tag success'>Ativo</span>":"<span class='tag alert'>Desativado</span>";
                $situacao = ($object->getTipoSituacao()->getId() == 11)?"<span class='tag success'>{$object->getTipoSituacao()->getNome()}</span>":"<span class='tag alert'>{$object->getTipoSituacao()->getNome()}</span>";
                $output['aaData'][] = array(
                    $link,
                    $situacao
                );
            }
        }
        unset($arrayListObject);

        return json_encode($output);
    }

}