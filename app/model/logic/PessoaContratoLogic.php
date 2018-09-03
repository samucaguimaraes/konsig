<?php

class PessoaContratoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new PessoaContratoDAO());
    }

    public function cadastrar($ObjPageRequisitante = null) {

        $objPessoaContrato = new PessoaContrato();
        $objPessoaContrato->setPessoa($_POST['pessoa']);
        $objPessoaContrato->setPessoaOrgao($_POST['pessoaOrgao']); //Importante!
        $objPessoaContrato->setConvenio($_POST['convenio']);
        if (isset($_POST['emprestimo']))
            $objPessoaContrato->setPessoaConsultaEmprestimo($_POST['emprestimo']);
        $objPessoaContrato->setTipoContrato($_POST['tipoContrato']);
        $objPessoaContrato->setParceiro($_POST['parceiro']);
        $objPessoaContrato->setNumeroContrato($_POST['numeroContrato']);
        $objPessoaContrato->setNumeroProposta($_POST['numeroProposta']);
        $objPessoaContrato->setDataInicioContrato($_POST['dataContrato']);
        $objPessoaContrato->setDataCadastroContrato($_POST['dataCadastroContrato']);
        $objPessoaContrato->setObservacao($_POST['observacao']);
        $objPessoaContrato->setTipoSituacao($_POST['tipoSituacao']);
        if (isset($_POST['dataTipoSituacao']))
            $objPessoaContrato->setDataTipoSituacao($_POST['dataTipoSituacao']);
        $objPessoaContrato->setVlrBruto($_POST['valorBruto']);
        $objPessoaContrato->setVlrLiquido($_POST['valorLiquido']);
        $objPessoaContrato->setVlrParcela($_POST['valorParcela']);
        $objPessoaContrato->setTotalParcela($_POST['totalParcela']);
        $objPessoaContrato->setVlrTaxaJuros($_POST['taxa']);
        $objPessoaContrato->setVlrTaxaComissao($_POST['comissao']);
        $objPessoaContrato->setVlrComissaoContrato($_POST['comissaoContrato']);
        $objPessoaContrato->setVlrComissaoReceber($_POST['comissaoReceber']);
        $objPessoaContrato->setVlrComissaoPagar($_POST['comissaoPagar']);
        $objPessoaContrato->setStatus('A');

        if (isset($_POST['isCredencialPublica'])) {
            $objPessoaContrato->setIsComissionado("D"); //Contrato não comissionado
        }
        //Corretagem
        $objPessoaContrato->setCorretor($_POST['corretor']);
        if (isset($_POST['corretorBanco']))
            $objPessoaContrato->setCorretorBanco($_POST['corretorBanco']);
        if (isset($_POST['dataPagamentoCorretor']))
            $objPessoaContrato->setDataPagamentoCorretor($_POST['dataPagamentoCorretor']);
        $objPessoaContrato->setVlrTaxaCorretor($_POST['comissaoCorretor']);

        $objPessoaContrato->setUsuarioCriador(SecurityHelper::getInstancia()->getUsuario()->getId());
        $objPessoaContrato->setDataCriacao(date('Y-m-d H:i:s'));

        $salvar = $this->salvar($objPessoaContrato);
        echo "<pre>";        var_dump($salvar); exit();
        //$salvar = array(0 => true);
        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('Contrato cadastrado com sucesso!');

            //Logics Utilizados
            $objPessoaConsultaLogic = new PessoaConsultaLogic();
            $objPessoaOrgaoLogic = new PessoaOrgaoLogic();
            $objConvenioLogic = new ConvenioLogic();
            $objPessoaConsultaEmprestimoLogic = new PessoaConsultaEmprestimoLogic();

            //Variável que define o ID do emprestimo original
            $emprestimoOriginal = null;
            //$consulta = null;
            $arrayEmprestimos = array();

            //Verificando se existe uma consulta para o orgão informado através do convênio que foi escolhido
            $objConvenio = $objConvenioLogic->obterPorId($objPessoaContrato->getConvenio());

            //Recuperando o ID do pessoaOrgao do cliente do contrato, os ativos ainda não foram selecionados
            $objPessoaOrgao = $objPessoaOrgaoLogic->obter("ide_pessoa_orgao = {$_POST['pessoaOrgao']}");

            //Alterar o Status do Empréstimo Anterior para Negociado e Criar um Emprestimo Novo
            if ($objPessoaContrato->getPessoaConsultaEmprestimo() != null) {

                $objPessoaConsultaEmprestimo = $objPessoaConsultaEmprestimoLogic->obterPorId($objPessoaContrato->getPessoaConsultaEmprestimo());
                $objPessoaConsultaEmprestimo->setStatus('N');
                $objPessoaConsultaEmprestimo->setUsuarioAtualizador(SecurityHelper::getInstancia()->getUsuario()->getId());
                $objPessoaConsultaEmprestimo->setDataAtualizacao(date('Y-m-d H:i:s'));
//echo '<pre>';var_dump($objPessoaConsultaEmprestimo);exit();
                //Indicando que o ID do empréstimo original foi o recebido no objeto contrato
                $emprestimoOriginal = $objPessoaConsultaEmprestimo->getId();
                //Indicando a Consulta Utilizada
                $objPessoaConsulta = $objPessoaConsultaLogic->obterPorId($objPessoaConsultaEmprestimo->getPessoaConsulta());
                //$consulta = $objPessoaConsulta->getId();
                //Caso o contrato seja do tipo 2 - Refinanciamento
                $exception = ($objPessoaContrato->getTipoContrato() == 2) ? " AND ide_pessoa_consulta_emprestimo <> {$objPessoaConsultaEmprestimo->getId()}" : "";
                //Lista de Empréstimos Ativos, o emprestimo negociado está de fora
                $arrayObjPessoaConsultaEmprestimo = $objPessoaConsultaEmprestimoLogic->listar("ide_pessoa_consulta = {$objPessoaConsulta->getId()} AND des_status = 'A'{$exception}");
                if ($arrayObjPessoaConsultaEmprestimo) {
                    $arrayEmprestimos = $arrayObjPessoaConsultaEmprestimo;
                }//echo "<pre>";var_dump($arrayEmprestimos);
//var_dump($objPessoaConsultaEmprestimo);exit();
                $salvarEmprestimo = $objPessoaConsultaEmprestimoLogic->salvar($objPessoaConsultaEmprestimo);
                //$salvarEmprestimo = array(0 => true);
                if ($salvarEmprestimo[0]) {
                    TFeedbackMetroUIv3Helper::notifySuccess('Empréstimo original atualizado com sucesso!');
                } else {
                    TFeedbackMetroUIv3Helper::notifyError('Não foi possível atualizar o emprestimo original.');
                }
            } else {
                $objPessoaConsulta = $objPessoaConsultaLogic->obter("ide_pessoa = {$objPessoaContrato->getPessoa()} AND ide_pessoa_orgao = {$_POST['pessoaOrgao']} AND des_status = 'A'");

                //Caso Exista consulta para a pessoa adiciona-se o array de Emprestimos existentes
                if ($objPessoaConsulta) {
                    //Lista de Empréstimos Ativos, o emprestimo negociado está de fora
                    $arrayObjPessoaConsultaEmprestimo = $objPessoaConsultaEmprestimoLogic->listar("ide_pessoa_consulta = {$objPessoaConsulta->getId()} AND des_status = 'A'");
                    if ($arrayObjPessoaConsultaEmprestimo) {
                        $arrayEmprestimos = $arrayObjPessoaConsultaEmprestimo;
                    }
                } else {
                    //Caso não exista nenhuma consulta para o cliente, será necessário criar uma consulta automática
                    $objPessoaConsulta = new PessoaConsulta();
                    $objPessoaConsulta->setPessoa($objPessoaContrato->getPessoa());
                    $objPessoaConsulta->setPessoaOrgao($_POST['pessoaOrgao']);
                    $objPessoaConsulta->setDataCompetencia(substr($objPessoaContrato->getDataInicioContrato(), 6, 4) . substr($objPessoaContrato->getDataInicioContrato(), 3, 2));
                    $objPessoaConsulta->setUsuarioCriador(SecurityHelper::getInstancia()->getUsuario()->getId());
                    $objPessoaConsulta->setDataCriacao(date('Y-m-d H:i:s'));

                    $objPessoaConsulta->setAutomatica("A"); //Consulta gerada automaticamente pelo sistema
                    $salvarConsulta = $objPessoaConsultaLogic->salvar($objPessoaConsulta);
                    //$salvarConsulta = array(0 => true, 1 => new PessoaConsulta());
                    if ($salvarConsulta[0]) {
                        TFeedbackMetroUIv3Helper::notifySuccess('Consulta automática criada com sucesso!');
                    } else {
                        TFeedbackMetroUIv3Helper::notifyError('Não foi possível criar consulta automaticamente.');
                    }
                    $objPessoaConsulta = $salvarConsulta[1];
                }
            }

            //Criando o Emprestimo do Contrato Atual
            $objPessoaConsultaEmprestimo = new PessoaConsultaEmprestimo();
            $objPessoaConsultaEmprestimo->setVlrParcela($objPessoaContrato->getVlrParcela());
            $objPessoaConsultaEmprestimo->setPessoaConsultaEmprestimoOrigem($emprestimoOriginal);
            $objPessoaConsultaEmprestimo->setConvenio($objPessoaContrato->getConvenio());
            $objPessoaConsultaEmprestimo->setDataInicioContrato($objPessoaContrato->getDataInicioContrato());
            $objPessoaConsultaEmprestimo->setTotalParcela($objPessoaContrato->getTotalParcela());
            $objPessoaConsultaEmprestimo->setPessoaConsulta($objPessoaConsulta->getId());
            $objPessoaConsultaEmprestimo->setPessoaContrato($salvar[1]->getId()); //Atribuíndo o Emprestimo atual ao Contrato
            $objPessoaConsultaEmprestimo->setNumeroContrato($objPessoaContrato->getNumeroContrato());
            $objPessoaConsultaEmprestimo->setStatus('A');
            $objPessoaConsultaEmprestimo->setUsuarioCriador(SecurityHelper::getInstancia()->getUsuario()->getId());
            $objPessoaConsultaEmprestimo->setDataCriacao(date('Y-m-d H:i:s'));

            $salvarPessoaEmprestimo = $objPessoaConsultaEmprestimoLogic->salvar($objPessoaConsultaEmprestimo);

            if ($salvarPessoaEmprestimo[0]) {
                array_push($arrayEmprestimos, $objPessoaConsultaEmprestimo);

                if ($objPessoaContrato->getPessoaConsultaEmprestimo() != null) {
                    //Atualizando o destino do emprestimo original com os dados do novo emprestimo
                    $objPessoaConsultaEmprestimoOriginal = $objPessoaConsultaEmprestimoLogic->obterPorId($emprestimoOriginal);
                    $objPessoaConsultaEmprestimoOriginal->setPessoaConsultaEmprestimoDestino($salvarPessoaEmprestimo[1]->getId());

                    $objPessoaConsultaEmprestimoLogic->salvar($objPessoaConsultaEmprestimoOriginal);
                }
                TFeedbackMetroUIv3Helper::notifySuccess('Novo emprestimo adicionado a consulta!');
            } else {
                TFeedbackMetroUIv3Helper::notifyError('Não foi possível criar novo emprestimo.');
            }

            //array_push($arrayEmprestimos, $objPessoaConsultaEmprestimo);
            $objPessoaConsulta->setEmprestimos($arrayEmprestimos);

            if (in_array($objPessoaOrgao->getOrgao(), array(2)) && $objPessoaConsulta->getAutomatica() == 'D') {
                $margemDisponivel = ACalculosHelper::calcularMargemDisponivel($objPessoaConsulta);
                $objPessoaConsulta->setVlrMargemDisponivel(FormatHelper::formatNumeroMonetario($margemDisponivel));

                $objPessoaConsulta->setDataAtualizacao(date('Y-m-d H:i:s'));
                $objPessoaConsulta->setUsuarioAtualizador(SecurityHelper::getInstancia()->getUsuario()->getId());
            }

            $salvarPessoaConsulta = $objPessoaConsultaLogic->salvar($objPessoaConsulta);
            //$salvarPessoaConsulta = array(0 => true);
            if ($salvarPessoaConsulta[0]) {
                TFeedbackMetroUIv3Helper::notifySuccess('Margem e emprestimos de consultas atualizados!');
            } else {
                TFeedbackMetroUIv3Helper::notifyError('Não foi possível atualizar margem e emprestimos da consulta.');
            }

            RedirectorHelper::addUrlParameter('id', $salvar[1]->getId());
            RedirectorHelper::goToControllerAction('PessoaContrato', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getPessoa());
            RedirectorHelper::goToControllerAction('Pessoa', 'informar');
        }
    }

    public function incluirFisico($requisitante, $params = null) {

        //$USER_SECURITY = SecurityHelper::getInstancia()->getUsuario();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $explode = explode('/', $_POST['dataEntregaFisico']);
            $_POST['dataEntregaFisico'] = date($explode[2] . "-" . $explode[1] . "-" . $explode[0] . " 00:00:00");

            $salvar = $this->salvar($_POST);

            if ($salvar[0]) {
                TFeedbackMetroUIv3Helper::notifySuccess('Dados atualizados com sucesso!');
                //$_SESSION['frame'] = 'frameR';
                RedirectorHelper::addUrlParameter('id', $_POST['id']);
                RedirectorHelper::goToControllerAction('PessoaContrato', 'informar');
            } else {
                TFeedbackMetroUIv3Helper::notifyError('Ocorreu um error na atualização, tente novamente ou contate o administrador!!!');
                RedirectorHelper::addUrlParameter('id', $_POST['id']);
                RedirectorHelper::goToControllerAction($requisitante->modulo, "incluirFisico");
            }
        } else {
            TFeedbackMetroUIv3Helper::notifyWarning('É constrangedor, mas tive problemas para processar a operação');
            RedirectorHelper::goToControllerAction("PessoaContrato", "informar");
        }
    }

    public function incluirFisicoMalote($requisitante, $params = null) {

        //$USER_SECURITY = SecurityHelper::getInstancia()->getUsuario();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $explode = explode('/', $_POST['dataEntregaFisico']);
            $_POST['dataEntregaFisico'] = date($explode[2] . "-" . $explode[1] . "-" . $explode[0] . " 00:00:00");

            if (isset($_POST['contratos'])) {
                $tMaloteSalvo = 0;
                $tMaloteError = 0;
                foreach ($_POST['contratos'] as $value) {
                    $_POST['id'] = $value;
                    $salvar = $this->salvar($_POST);
                    if ($salvar[0]) {
                        $tMaloteSalvo++;
                    } else {
                        $tMaloteError++;
                    }
                }
                if ($tMaloteSalvo>0) {
                    TFeedbackMetroUIv3Helper::notifySuccess('Dados atualizados com sucesso!');
                    TFeedbackMetroUIv3Helper::notifyInfo('Atualizados '.$tMaloteSalvo.' contrato(s). '.$tMaloteError.' erro(s) detectados.');
                    RedirectorHelper::goToControllerAction("PessoaContrato", "index");
                } else {
                    TFeedbackMetroUIv3Helper::notifyError('Ocorreu um error na atualização, tente novamente ou contate o administrador!');
                    TFeedbackMetroUIv3Helper::notifyInfo('Atualizados '.$tMaloteSalvo.' contrato(s). '.$tMaloteError.' erro(s) detectados.');
                    RedirectorHelper::goToControllerAction($requisitante->modulo, "incluirFisicoMalote");
                }
            } else {
                TFeedbackMetroUIv3Helper::notifyWarning('Nenhum contrato foi selecionado para incluir no malote');
                RedirectorHelper::goToControllerAction("PessoaContrato", "index");
            }
        } else {
            TFeedbackMetroUIv3Helper::notifyWarning('É constrangedor, mas tive problemas para processar a operação');
            RedirectorHelper::goToControllerAction("PessoaContrato", "index");
        }
    }
    
    public function atualizarStatusMassa($requisitante, $params = null) {

        //$USER_SECURITY = SecurityHelper::getInstancia()->getUsuario();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            //$explode = explode('/', $_POST['dataTipoSituacao']);
            //$_POST['dataTipoSituacao'] = $explode[2] . $explode[1] . $explode[0];

            if (isset($_POST['contratos'])) {
                $tMaloteSalvo = 0;
                $tMaloteError = 0;
                foreach ($_POST['contratos'] as $value) {
                    $_POST['id'] = $value;
                    $salvar = $this->salvar($_POST);
                    if ($salvar[0]) {
                        $tMaloteSalvo++;
                    } else {
                        $tMaloteError++;
                    }
                }
                if ($tMaloteSalvo>0) {
                    TFeedbackMetroUIv3Helper::notifySuccess('Dados atualizados com sucesso!');
                    TFeedbackMetroUIv3Helper::notifyInfo('Atualizados '.$tMaloteSalvo.' contrato(s). '.$tMaloteError.' erro(s) detectados.');
                    RedirectorHelper::goToControllerAction("PessoaContrato", "index");
                } else {
                    TFeedbackMetroUIv3Helper::notifyError('Ocorreu um error na atualização, tente novamente ou contate o administrador!');
                    TFeedbackMetroUIv3Helper::notifyInfo('Atualizados '.$tMaloteSalvo.' contrato(s). '.$tMaloteError.' erro(s) detectados.');
                    RedirectorHelper::goToControllerAction("PessoaContrato", "atualizarStatusMassa");
                }
            } else {
                TFeedbackMetroUIv3Helper::notifyWarning('Nenhum contrato foi selecionado para alteração de status');
                RedirectorHelper::goToControllerAction("PessoaContrato", "index");
            }
        } else {
            TFeedbackMetroUIv3Helper::notifyWarning('É constrangedor, mas tive problemas para processar a operação');
            RedirectorHelper::goToControllerAction("PessoaContrato", "index");
        }
    }

    public function ajaxListContrato($params) {

        /* Atributos do objeto que poderam ser ordenado */
        $atributos = array('id', 'numeroContrato', 'pessoa', 'tipoContrato', 'vlrLiquido', 'vlrParcela', 'tipoSituacao', 'dataTipoSituacao');
        $order = TDataTableSqliteHelper::mountOrderBy($atributos, $params['iSortCol_0'], $params['sSortDir_0']);
        unset($atributos);
        /* Colunas do banco a serem pesquisandas */
        $colunas = array('ide_pessoa_contrato', 'ide_pessoa', 'ide_tipo_contrato', 'vlr_liquido', 'vlr_parcela', 'ide_tipo_situacao', 'dat_tipo_situacao');
        /* Montar search */
        $where = TDataTableSqliteHelper::mountSearch($colunas, $params['sSearch'], false);
        /* Total de registros */
        $iTotal = $this->totalRegistro($where);
        /* Listar */
        $arrayListObject = $this->listar($where, 'dataCriacao:desc,' . $order, true, null, $params['iDisplayStart'], $params['iDisplayLength']);
        unset($where);
        /* Montar output */
        $output = TDataTableSqliteHelper::mountArrayOutPut($params['sEcho'], $iTotal);
        unset($iTotal);

        if (isset($arrayListObject[0])) {
            $objOrgaoLogic = new OrgaoLogic();
            $objPessoaConsultaEmprestimoLogic = new PessoaConsultaEmprestimoLogic();
            foreach ($arrayListObject as $object) {
                $url = UrlRequestHelper::mountUrl('PessoaContrato', 'informar', array('id' => $object->getId()));
                $link = "<a href='{$url}' title='Visualizar Contrato'><span class=\"mif-eye place-right\"></span></a> " . $object->getPessoa()->getNome();
                //$status = ($object->getStatus()=='A')?"<span class='tag success'>Ativo</span>":"<span class='tag alert'>Desativado</span>";
                //$objOrgao = $objOrgaoLogic->obterPorId($object->getPessoaOrgao()->getOrgao());
                //$tHiscon = $objPessoaConsultaEmprestimoLogic->totalRegistro("ide_pessoa_consulta = {$object->getId()} AND ide_convenio IS NULL");
                //if($tHiscon>0){
                //    $margemDisponivel = $object->getVlrMargemDisponivel() . "<span class=\"tag warning mif-ani-horizontal place-right\">HISCON</span>";
                //} else {
                //    $margemDisponivel = $object->getVlrMargemDisponivel();
                //}
                $output['aaData'][] = array(
                    $object->getNumeroContrato(),
                    $link,
                    $object->getTipoContrato()->getNome(),
                    $object->getVlrLiquido(),
                    $object->getVlrParcela(),
                    $object->getTipoSituacao()->getNome(),
                    $object->getDataTipoSituacao(),
                );
            }
        }
        unset($arrayListObject);

        return json_encode($output);
    }

    public function ajaxListContratosInPessoa($params) {

        /* Atributos do objeto que poderam ser ordenado */
        $atributos = array('id', 'numeroContrato', 'tipoContrato', 'vlrBruto', 'vlrLiquido', 'vlrParcela', 'tipoSituacao', 'dataTipoSituacao');
        $order = TDataTableSqliteHelper::mountOrderBy($atributos, $params['iSortCol_0'], $params['sSortDir_0']);
        unset($atributos);
        /* Colunas do banco a serem pesquisandas */
        $colunas = array('ide_pessoa_contrato', 'ide_tipo_contrato', 'vlr_bruto', 'vlr_liquido', 'vlr_parcela', 'ide_tipo_situacao', 'dat_tipo_situacao');
        /* Montar search */
        $where = TDataTableSqliteHelper::mountSearch($colunas, $params['sSearch'], false);
        $where .= ($where == null) ? "ide_pessoa = " . SecurityEncryptionHelper::decrypt($params['idPessoa']) . "" : " AND ide_pessoa = " . SecurityEncryptionHelper::decrypt($params['idPessoa']) . "";
        //var_dump($where);
        /* Total de registros */
        $iTotal = $this->totalRegistro($where);
        /* Listar */
        $arrayListObject = $this->listar($where, 'dataInicioContrato:desc,' . $order, true, null, $params['iDisplayStart'], $params['iDisplayLength']);
        unset($where);
        /* Montar output */
        $output = TDataTableSqliteHelper::mountArrayOutPut($params['sEcho'], $iTotal);
        unset($iTotal);

        if (isset($arrayListObject[0])) {
            //$objOrgaoLogic = new OrgaoLogic();
            //$objPessoaConsultaEmprestimoLogic = new PessoaConsultaEmprestimoLogic();
            foreach ($arrayListObject as $object) {
                $url = UrlRequestHelper::mountUrl('PessoaContrato', 'informar', array('id' => $object->getId()));
                $link = "<a href='{$url}' title='Visualizar Contrato'><span class=\"mif-eye place-right\"></span></a> " . $object->getNumeroContrato();
                //$status = ($object->getStatus()=='A')?"<span class='tag success'>Ativo</span>":"<span class='tag alert'>Desativado</span>";
                //$objOrgao = $objOrgaoLogic->obterPorId($object->getPessoaOrgao()->getOrgao());
                //$tHiscon = $objPessoaConsultaEmprestimoLogic->totalRegistro("ide_pessoa_consulta = {$object->getId()} AND ide_convenio IS NULL");
                //if($tHiscon>0){
                //    $margemDisponivel = $object->getVlrMargemDisponivel() . "<span class=\"tag warning mif-ani-horizontal place-right\">HISCON</span>";
                //} else {
                //    $margemDisponivel = $object->getVlrMargemDisponivel();
                //}
                $output['aaData'][] = array(
                    $link,
                    $object->getTipoContrato()->getNome(),
                    $object->getVlrBruto(),
                    $object->getVlrLiquido(),
                    $object->getVlrParcela(),
                    $object->getTipoSituacao()->getNome(),
                    $object->getDataTipoSituacao(),
                );
            }
        }
        unset($arrayListObject);

        return json_encode($output);
    }

}
