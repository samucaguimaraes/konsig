<?php

class TipoEspecieBeneficioLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new TipoEspecieBeneficioDAO());
    }

    public function cadastrar($ObjPageRequisitante = null) {

        /* Verificar se email existe */
        $cfTipoEspecieBeneficio = $this->obter("nom_tipo_especie_beneficio='{$_POST['nome']}'");
        if (is_object($cfTipoEspecieBeneficio)) {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possivel cadastrar este tipo de espécie beneficio. Nome já existente!');
            RedirectorHelper::goToControllerAction('TipoEspecieBeneficio', 'cadastrar');
        }
        unset($cfTipoEspecieBeneficio);

        $objTipoEspecieBeneficio = new TipoEspecieBeneficio();
        $objTipoEspecieBeneficio->setNome($_POST['nome']);
        
        $salvar = $this->salvar($objTipoEspecieBeneficio);

        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('Tipo de Espécie Beneficio cadastrada com sucesso!');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getId());
            RedirectorHelper::goToControllerAction('TipoEspecieBeneficio', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::goToControllerAction('TipoEspecieBeneficio', 'cadastrar');
        }
    }

    public function ajaxListTipoEspecieBeneficio($params) {

        /* Atributos do objeto que poderam ser ordenado */
        $atributos = array('codigo','nome','status');
        $order = TDataTableSqliteHelper::mountOrderBy($atributos, $params['iSortCol_0'], $params['sSortDir_0']);
        unset($atributos);
        /* Colunas do banco a serem pesquisandas */
        $colunas = array('num_codigo','nom_tipo_especie_beneficio','des_status');
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
                $url = UrlRequestHelper::mountUrl('TipoEspecieBeneficio', 'informar', array('id' => $object->getId()));
                $link = "<a href='{$url}'>" . $object->getNome() . "</a>";
                $status = ($object->getStatus()=='A')?"<span class='tag success'>Ativo</span>":"<span class='tag alert'>Desativado</span>";
                $output['aaData'][] = array(
                    $link,                    
                    utf8_encode($object->getCodigo()),
                    $status
                );
            }
        }
        unset($arrayListObject);
        return json_encode($output);
    }
    
}