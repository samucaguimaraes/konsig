<?php

class ConvenioLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new ConvenioDAO());
    }
    
    public function cadastrar($ObjPageRequisitante = null) {

//        /* Verificar se email existe */
//        $cfConvenio = $this->obter("ide_banco='{$_POST['banco']}' AND ide_orgao='{$_POST['orgao']}'");
//        if (is_object($cfConvenio)) {
//            TFeedbackMetroUIv3Helper::notifyError('Não foi possivel cadastrar este Convênio!');
//            TFeedbackMetroUIv3Helper::notifyError('Combinação entre Banco e Orgão já existentes!');
//            RedirectorHelper::goToControllerAction('Convenio', 'cadastrar');
//        }
//        unset($cfConvenio);

        $objConvenio = new Convenio();
        $objConvenio->setNome($_POST['nome']);
        $objConvenio->setBanco($_POST['banco']);
        $objConvenio->setOrgao($_POST['orgao']);
        $objConvenio->setValorTaxa(str_replace(",", ".", $_POST['valorTaxa']));
        $objConvenio->setPrazo($_POST['prazo']);
        $objConvenio->setIdadeMinima($_POST['idadeMinima']);
        $objConvenio->setIdadeMaxima($_POST['idadeMaxima']);
        $objConvenio->setTipoSituacao(1);
        $objConvenio->setUsuarioCriador(SecurityHelper::getInstancia()->getUsuario()->getId());
        $objConvenio->setDataCriacao(date('y-m-d H:i:s'));
        $salvar = $this->salvar($objConvenio);
       
        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('Convênio cadastrado com sucesso!');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getId());
            RedirectorHelper::goToControllerAction('Convenio', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar');
            TFeedbackMetroUIv3Helper::notifyError('Ocorreu um erro Inesperado');
            TFeedbackMetroUIv3Helper::notifyError('Tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::goToControllerAction('Convenio', 'cadastrar');
        }
    }
    
    public function ajaxListConvenio($params) {

        /* Atributos do objeto que poderam ser ordenado */
        $atributos = array('nome');
        $order = TDataTableSqliteHelper::mountOrderBy($atributos, $params['iSortCol_0'], $params['sSortDir_0']);
        unset($atributos);
        /* Colunas do banco a serem pesquisandas */
        $colunas = array('nom_convenio');
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
                $url = UrlRequestHelper::mountUrl('Convenio', 'informar', array('id' => $object->getId()));
                $link = "<a href='{$url}'>" . $object->getNome() . "</a>";
                //$status = ($object->getStatus()=='A')?"<span class='tag success'>Ativo</span>":"<span class='tag alert'>Desativado</span>";
                //$situacao = ($object->getTipoSituacao()->getId() == 11)?"<span class='tag success'>{$object->getTipoSituacao()->getNome()}</span>":"<span class='tag alert'>{$object->getTipoSituacao()->getNome()}</span>";
                $output['aaData'][] = array(
                    $link,
                    $object->getBanco()->getNome(),
                    $object->getOrgao()->getNome(),
                    $object->getTipoSituacao()->getNome()
                );
            }
        }
        unset($arrayListObject);

        return json_encode($output);
    }
    
    public function ajaxListSelect2Convenio($params) {
        $exception = array();
        $exception['load'] = ExceptionORM::mountLoadException('Convenio', array('nome'));
        //$notIn = ($params['acoesSelecionadas'] !== 'null') ? "AND ide_acao NOT IN ({$params['acoesSelecionadas']})" : "";
        
        $objPessoaOrgaoLogic = new PessoaOrgaoLogic();
        $objPessoaOrgao = $objPessoaOrgaoLogic->obterPorId($params['pessoaOrgao']);
        
        $arrayConvenio = $this->listar("ide_orgao = {$objPessoaOrgao->getOrgao()} AND ide_tipo_situacao = 11", 'nome', null, $exception);//11 - Em operação

        if (isset($arrayConvenio[0])) {
            foreach ($arrayConvenio as $objConvenio) {
                $arrayJson[] = array('value' => $objConvenio->getId(), 'nome' => $objConvenio->getNome());
            }
        } else {
            $arrayJson = false;
        }

        return json_encode($arrayJson);
    }

}