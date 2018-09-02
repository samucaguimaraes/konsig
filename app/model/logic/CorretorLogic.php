<?php

class CorretorLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new CorretorDAO());
    }
    
    public function cadastrar($ObjPageRequisitante = null) {
                
        $objCorretor = new Corretor();
        $objCorretor->setNome($_POST['nome']);
        $objCorretor->setNumeroCPF($_POST['numeroCPF']);
        $objCorretor->setDataNascimento($_POST['dataNascimento']);
        $objCorretor->setEmail($_POST['email']);
        $objCorretor->setSkype($_POST['skype']);
        $objCorretor->setEndereco($_POST['endereco']);
        $objCorretor->setNumeroEndereco($_POST['numeroEndereco']);
        $objCorretor->setComplemento($_POST['complemento']);
        $objCorretor->setBairro($_POST['bairro']);
        $objCorretor->setCidade($_POST['cidade']);
        $objCorretor->setNumeroCEP($_POST['numeroCEP']);       
        
        $objCorretor->setUsuarioCriador(SecurityHelper::getInstancia()->getUsuario()->getId());
        $objCorretor->setObservacao($_POST['observacao']);
        
        $objCorretor->setDataCriacao(date('Y-m-d H:i:s'));
        
        $salvar = $this->salvar($objCorretor);
        //var_dump($salvar);exit();
        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('Corretor cadastrado com sucesso!');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getId());
            RedirectorHelper::goToControllerAction('Corretor', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::goToControllerAction('Corretor', 'cadastrar');
        }
    }
    
    public function ajaxListCorretor($params) {

        /* Atributos do objeto que poderam ser ordenado */
        $atributos = array('nome', 'numeroCPF','DataNascimento','email','status');
        $order = TDataTableSqliteHelper::mountOrderBy($atributos, $params['iSortCol_0'], $params['sSortDir_0']);
        unset($atributos);
        /* Colunas do banco a serem pesquisandas */
        $colunas = array('nom_pessoa', 'num_cpf', 'dat_nascimento','des_email','des_status');
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
                $url = UrlRequestHelper::mountUrl('Corretor', 'informar', array('id' => $object->getId()));
                $link = "<a href='{$url}'>" . $object->getNome() . "</a>";
                $status = ($object->getStatus()=='A')?"<span class='tag success'>Ativo</span>":"<span class='tag alert'>Desativado</span>";
                $output['aaData'][] = array(
                    $link,
                    $object->getNumeroCPF(),
                    $object->getDataNascimento(),
                    $object->getEmail(),
                    $status
                );
            }
        }
        unset($arrayListObject);

        return json_encode($output);
    }

    /**
     * AJAX
     * Verifica se o colaborador nÃ£o existe no sistema
     * Se nÃ£o existir retorna false caso exista retorna true
     * @return bollean
     */
    public function ajaxIsCorretorNotInSystem($param) {
        $cpf = FormatHelper::unformatCPF($param['cpf']);
        $corretor = $this->obter("num_cpf = '{$cpf}'");
        return (is_object($corretor)) ? 'true' : 'false';
    }
    
}