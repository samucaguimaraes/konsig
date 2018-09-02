<?php

class BancoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new BancoDAO());
    }
    
    public function ajaxListBanco($params) {

        /* Atributos do objeto que poderam ser ordenado */
        $atributos = array('nome','codigo','CNPJ');
        $order = TDataTableSqliteHelper::mountOrderBy($atributos, $params['iSortCol_0'], $params['sSortDir_0']);
        unset($atributos);
        /* Colunas do banco a serem pesquisandas */
        $colunas = array('nom_banco','num_codigo','num_cnpj');
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
                $url = UrlRequestHelper::mountUrl('Banco', 'informar', array('id' => $object->getId()));
                $link = "<a href='{$url}'>" . $object->getNome() . "</a>";
                
                $output['aaData'][] = array(
                    $link,
                    $object->getCodigo(),
                    $object->getNumeroCNPJ()
                );
            }
        }
        unset($arrayListObject);
        return json_encode($output);
    }

}