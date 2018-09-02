<?php

class UsuarioLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new UsuarioDAO());
    }

    public function cadastrar($ObjPageRequisitante = null) {
        
        /* Verificar se email existe */
        $cfUsuario = $this->obter("des_email='{$_POST['email']}'");
        if(is_object($cfUsuario)) {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possivel cadastrar o usuáio, E-mail já¡ cadastrado!!!');
            RedirectorHelper::goToControllerAction('Usuario', 'cadastrar');
        }
        unset($cfUsuario);

        $objUsuario = new Usuario();
        $objUsuario->setNome($_POST['nome']);
        $objUsuario->setEmail($_POST['email']);
        $objUsuario->setSenha($_POST['senha']);
        $objUsuario->setStatus('A');

        $salvar = $this->salvar($objUsuario);

        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('UsuÃ¡rio cadastrado com sucesso!!!');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getId());
            RedirectorHelper::goToControllerAction('Usuario', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('NÃ£o foi possivel cadastrar devido a um error no sistema, tente novamente ou contate o suporte para maiores informaÃ§Ãµes');
            RedirectorHelper::goToControllerAction('Usuario', 'cadastrar');
        }
    }

    public function atualizar($ObjPageRequisitante = null) {

        $objUsuario = new Usuario();
        $objUsuario->setNome($_POST['id']);
        $objUsuario->setNome($_POST['nome']);
        $objUsuario->setEmail($_POST['email']);
        $objUsuario->setStatus($_POST['status']);

        $salvar = $this->salvar($objUsuario);

        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('UsuÃ¡rio atualizado com sucesso!!!');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getId());
            RedirectorHelper::goToControllerAction('Usuario', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('NÃ£o foi possivel atualizar devido a um error no sistema, tente novamente ou contate o suporte para maiores informaÃ§Ãµes');
            RedirectorHelper::goToControllerAction('Usuario', 'atualizar');
        }
    }

    public function ajaxListUsuario($params) {

        /* Atributos do objeto que poderam ser ordenado */
        $atributos = array('nome', 'email');
        $order = TDataTableSqliteHelper::mountOrderBy($atributos, $params['iSortCol_0'], $params['sSortDir_0']);
        unset($atributos);
        /* Colunas do banco a serem pesquisandas */
        $colunas = array('nom_usuario', 'des_email');
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
                $link = "<a href='{$url}'>" . $object->getNome() . "</a>";
                $output['aaData'][] = array(
                    $link,
                    $object->getEmail()
                );
            }
        }
        unset($arrayListObject);

        return json_encode($output);
    }

}
