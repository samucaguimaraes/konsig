<?php

class VUsuarioLogic extends VLogicModel {

    public function __construct() {
        parent::__construct(new VUsuarioDAO());
    }
    
    public function ajaxVListUsuario($params) {
        /* Atributos do objeto que poderam ser ordenado */
        $atributos = array('nomePessoa','cpf', 'dataNascimento', 'descricaoPerfil', 'statusUsuario');
        $order = TDataTableSqliteHelper::mountOrderBy($atributos, $params['iSortCol_0'], $params['sSortDir_0']);
        unset($atributos);
        /* Colunas do banco a serem pesquisandas */
        $colunas = array('nom_pessoa', 'num_cpf', 'dat_nascimento','des_perfil','status_usuario' => array('A' => 'Ativo', 'D' => 'Desativado'));
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
                $url = UrlRequestHelper::mountUrl('Usuario', 'informar', array('id' => $object->getId()));
                $link = "<a href='{$url}'>" . $object->getNomePessoa() . "</a>";
                $dataNascimento = ($object->getDataNascimento() === NULL ) ? 'Não informado' : FormatHelper::formatData(FormatHelper::dataInversaToNormal($object->getDataNascimento()));
                $status = ($object->getStatusUsuario() === 'A') ? "<span class='mif-checkmark fg-green'></span>" : "<span class='mif-stop fg-red'></span>";
                $checked = ($object->getStatusUsuario() === 'A') ? 'checked' : '';
                $desativar = "<label class='switch-original'> "
                        . "<input type='checkbox' onclick='gerenciarStatus(\"" . $object->getId() . "\",\"" . $object->getStatusUsuario() . "\")' {$checked}>"
                        . "<span class='check'></span>"
                        . "</label>";
                $output['aaData'][] = array(
                    $link,
                    FormatHelper::formatCPF($object->getCpf()),
                    $dataNascimento,
                    $object->getDescricaoPerfil(),
                    $status,
                    $desativar
                );
            }
        }
        unset($arrayListObject);

        return json_encode($output);
    }

}