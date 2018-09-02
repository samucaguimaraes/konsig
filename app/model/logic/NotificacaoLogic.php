<?php

class NotificacaoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new NotificacaoDAO());
    }

    public function cadastrar($ObjPageRequisitante = null) {

        $objNotificacao = new Notificacao();

        $objNotificacao->setDescricaoElemento($_POST['descricaoElemento']);
        $objNotificacao->setElemento($_POST['elemento']);
        $objNotificacao->setTipoNotificacao($_POST['tipoNotificacao']);
        $objNotificacao->setNotificacao($_POST['notificacao']);
        $explode = explode('/', $_POST['dataAlarme']);
        $objNotificacao->setDataAlarme(date($explode[2] . "-" . $explode[1] . "-" . $explode[0] . " 00:00:00"));
        $objNotificacao->setStatus('A');

        $objNotificacao->setUsuarioCriador(SecurityHelper::getInstancia()->getUsuario()->getId());
        $objNotificacao->setDataCriacao(date('Y-m-d H:i:s'));

        $salvar = $this->salvar($objNotificacao);

        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('Notificação cadastrada com sucesso!');
            RedirectorHelper::addUrlParameter('id', $objNotificacao->getElemento());
            RedirectorHelper::goToControllerAction($objNotificacao->getDescricaoElemento(), 'informar');
        } else {
            RedirectorHelper::addUrlParameter('id', $objNotificacao->getElemento());
            RedirectorHelper::addUrlParameter('elemento', $objNotificacao->getDescricaoElemento());
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::goToControllerAction('Notificacao', 'cadastrar');
        }
    }
    
    public function ajaxListNotificacao($params) {

        /* Atributos do objeto que poderam ser ordenado */
        $atributos = array('notificacao', 'descricaoElemento', 'status');
        $order = TDataTableSqliteHelper::mountOrderBy($atributos, $params['iSortCol_0'], $params['sSortDir_0']);
        unset($atributos);
        /* Colunas do banco a serem pesquisandas */
        $colunas = array('des_notificacao', 'dat_alarme', 'des_elemento', 'ide_elemento', 'des_status', 'ide_usuario_criador', 'dat_criacao');
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

                $url = UrlRequestHelper::mountUrl($object->getDescricaoElemento(), 'informar', array('id' => $object->getElemento()));
                $link = "<a href='{$url}' title='Visualizar Notificação'><span class=\"mif-eye place-right\"></span></a> " . $object->getNotificacao();

                switch ($object->getDescricaoElemento()) {
                    case 'Pessoa':
                        $local = 'Cadastro Base';
                        break;
                    case 'PessoaOrgao':
                        $local = 'Orgão do Cliente';
                        break;
                    case 'PessoaContrato':
                        $local = 'Contrato';
                        break;
                    case 'PessoaContato':
                        $local = 'Contato do Cliente';
                        break;
                    default:
                        $local = 'Não Definido';
                        break;
                }
                $status = ($object->getStatus() == 'A')?'Ativa':'Desativada';
//$status = ($object->getStatus()=='A')?"<span class='tag success'>Ativo</span>":"<span class='tag alert'>Desativado</span>";
                //$situacao = ($object->getTipoSituacao()->getId() == 11)?"<span class='tag success'>{$object->getTipoSituacao()->getNome()}</span>":"<span class='tag alert'>{$object->getTipoSituacao()->getNome()}</span>";
                $output['aaData'][] = array(
                    $link,
                    $local,
                    $status,
                    $object->getDataCriacao(),
                    $object->getUsuarioCriador()->getNome()
                );
            }
        }
        unset($arrayListObject);

        return json_encode($output);
    }
    
    /**
     * AJAX
     * Retorna se existem notificações ativas
     * Se não existir retorna false caso exista retorna true
     * @return bollean
     */
    public function ajaxIsNotificacao() {
        $totalNotificacao = $this->totalRegistro("des_status = 'A'");
        return ($totalNotificacao > 0) ? 'true' : 'false';
    }

}
