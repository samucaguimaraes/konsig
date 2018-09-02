<?php

class OrgaoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new OrgaoDAO());
    }
    
    public function cadastrar($ObjPageRequisitante = null) {

        /* Verificar se email existe */
        $cfOrgao = $this->obter("nom_orgao='{$_POST['nome']}'");
        if (is_object($cfOrgao)) {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possivel cadastrar este tipo de contato. Orgão já existente!');
            RedirectorHelper::goToControllerAction('Orgao', 'cadastrar');
        }
        unset($cfOrgao);

        $objOrgao = new Orgao();
        $objOrgao->setNome($_POST['nome']);
        $objOrgao->setSigla($_POST['sigla']);
        $objOrgao->setTipoOrgao($_POST['tipoOrgao']);
        
        $salvar = $this->salvar($objOrgao);

        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('Orgão cadastrado com sucesso!');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getId());
            RedirectorHelper::goToControllerAction('Orgao', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::goToControllerAction('Orgao', 'cadastrar');
        }
    }
    
    public function ajaxListOrgao($params) {

        /* Atributos do objeto que poderam ser ordenado */
        $atributos = array('nome','sigla');
        $order = TDataTableSqliteHelper::mountOrderBy($atributos, $params['iSortCol_0'], $params['sSortDir_0']);
        unset($atributos);
        /* Colunas do banco a serem pesquisandas */
        $colunas = array('nom_orgao','des_sigla');
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
                $url = UrlRequestHelper::mountUrl('Orgao', 'informar', array('id' => $object->getId()));
                $link = "<a href='{$url}'>" . $object->getNome() . "</a>";
                $output['aaData'][] = array(
                    $link,
                    $object->getSigla()
                );
            }
        }
        unset($arrayListObject);
        return json_encode($output);
    }

}