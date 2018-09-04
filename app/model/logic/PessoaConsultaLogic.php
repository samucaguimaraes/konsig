<?php

class PessoaConsultaLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new PessoaConsultaDAO());
    }

    public function cadastrar($ObjPageRequisitante = null) {

        $objPessoaConsulta = new PessoaConsulta();
        $objPessoaConsulta->setPessoa($_POST['pessoa']);
        $objPessoaConsulta->setPessoaOrgao($_POST['pessoaOrgao']);
        $dataCompetencia = substr($_POST['dataCompetencia'], 3, 4) . substr($_POST['dataCompetencia'], 0, 2);

        $objPessoaConsulta->setDataCompetencia($dataCompetencia);
        //Verifico se a consulta é Previdência.
        if (in_array($_POST['orgao'], array(2))) {
            //Créditos
            $objPessoaConsulta->setVlrMensalidadeReajustada($_POST['vlrMensalidadeReajustada']);
            $objPessoaConsulta->setVlrCompMr($_POST['vlrCompMr']);
            $objPessoaConsulta->setVlrSalarioFamilia($_POST['vlrSalarioFamilia']);
            $objPessoaConsulta->setVlrGratExcomb($_POST['vlrGratExcomb']);
            $objPessoaConsulta->setVlrRffsaNaoTrib($_POST['vlrRffsaNaoTrib']);
            $objPessoaConsulta->setVlrComplAcompan($_POST['vlrComplAcompan']);
            $objPessoaConsulta->setVlrOutrasVantagens($_POST['vlrOutrasVantagens']);
            $objPessoaConsulta->setVlrPlansferRffsa($_POST['vlrPlansferRffsa']);
            $objPessoaConsulta->setVlrDuplaAtividade($_POST['vlrDuplaAtividade']);
            $objPessoaConsulta->setVlrGratProdutEct($_POST['vlrGratProdutEct']);
            $objPessoaConsulta->setVlrAdicTalidomida($_POST['vlrAdicTalidomida']);
            //Descontos
            $objPessoaConsulta->setVlrIrRetidoFonte($_POST['vlrIrRetidoFonte']);
            $objPessoaConsulta->setVlrDebPensaoAlim($_POST['vlrDebPensaoAlim']);
            $objPessoaConsulta->setVlrConsignacao($_POST['vlrConsignacao']);
            $objPessoaConsulta->setVlrIrExterior($_POST['vlrIrExterior']);
            $objPessoaConsulta->setVlrDebitoDifIr($_POST['vlrDebitoDifIr']);
            $objPessoaConsulta->setVlrDescontoInss($_POST['vlrDescontoInss']);
            $objPessoaConsulta->setVlrTotalContribuicao($_POST['vlrTotalContribuicao']);
        }

        //Emprestimos
        $totalEmprestimosSalvos = 0;
        if (isset($_POST['alternativas'])) {
            //$arrayEmprestimo = array();
            //Alterar quando corrigir o bug [**SUBST]
            $objPessoaConsultaEmprestimoLogic = new PessoaConsultaEmprestimoLogic();
            foreach ($_POST['alternativas'] AS $k => $array) {
                $objPessoaConsultaEmprestimo = new PessoaConsultaEmprestimo();
                $objPessoaConsultaEmprestimo->setVlrParcela($array['valor']);
                $objPessoaConsultaEmprestimo->setObservacao($array['observacao']);
                $objPessoaConsultaEmprestimo->setUsuarioCriador(SecurityHelper::getInstancia()->getUsuario()->getId());
                $objPessoaConsultaEmprestimo->setDataCriacao(date('Y-m-d H:i:s'));
                $objPessoaConsultaEmprestimo->setStatus('A');

                //$salvar = $objPessoaConsultaEmprestimoLogic->salvar($objPessoaConsultaEmprestimo);
//                if($salvar[0]){
//                    $totalEmprestimosSalvos++;
//                }
                $arrayEmprestimo[$k] = $objPessoaConsultaEmprestimo;
                $totalEmprestimosSalvos++;
            }
            $objPessoaConsulta->setEmprestimos($arrayEmprestimo);
        }

        if (in_array($_POST['orgao'], array(2))) {
            $margemDisponivel = ACalculosHelper::calcularMargemDisponivel($objPessoaConsulta);
            $objPessoaConsulta->setVlrMargemDisponivel(FormatHelper::formatNumeroMonetario($margemDisponivel));
        } else {
            if (isset($_POST['vlrMargemDisponivel'])) {
                $objPessoaConsulta->setVlrMargemDisponivel($_POST['vlrMargemDisponivel']);
            }
        }

        $objPessoaConsulta->setUsuarioCriador(SecurityHelper::getInstancia()->getUsuario()->getId());
        $objPessoaConsulta->setDataCriacao(date('Y-m-d H:i:s'));
        //echo "<pre>";
        //var_dump($objPessoaConsulta); exit();
        $salvar = $this->salvar($objPessoaConsulta);
        //var_dump($salvar); exit();
        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('Consulta cadastrada com sucesso!');
            if ($totalEmprestimosSalvos > 0) {
                TFeedbackMetroUIv3Helper::notifySuccess('Foram cadastrado(s) ' . $totalEmprestimosSalvos . ' emprestimo(s) com sucesso!');
            }
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getId());
            RedirectorHelper::goToControllerAction('PessoaConsulta', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informações');
            //RedirectorHelper::addUrlParameter('id', $salvar[1]->getPessoa());
            RedirectorHelper::goToControllerAction('PessoaConsulta', 'cadastrar');
        }
    }

    public function atualizar($requisitante, $params = null) {

        $USER_SECURITY = SecurityHelper::getInstancia()->getUsuario();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            //echo "<pre>"; //var_dump($_POST);
            $_POST['usuarioAtualizador'] = $USER_SECURITY->getId();
            $_POST['dataAtualizacao'] = date('Y-m-d H:i:s');
            $_POST['dataCompetencia'] = substr($_POST['dataCompetencia'], 3, 4) . substr($_POST['dataCompetencia'], 0, 2);
            /*
              if (isset($_POST['isCredencialPublica'])) {
              $_POST['isCredencialPublica'] = "A"; //Publicar Credencial
              } else {
              $_POST['isCredencialPublica'] = "D"; //Despublicar Credencial
              }
             */
            $objPessoaConsulta = $this->obterPorId($_POST['id']);
            //var_dump($objPessoaConsulta);
            if (isset($_POST['alternativas'])) {
                $stringIN = "";
                $objPessoaConsultaEmprestimoLogic = new PessoaConsultaEmprestimoLogic();
                
                foreach ($_POST['alternativas'] as $emprestimo) {
                    if (isset($emprestimo['id'])) {
                        $objPessoaConsultaEmprestimo = $objPessoaConsultaEmprestimoLogic->obterPorId($emprestimo['id']);
                        $objPessoaConsultaEmprestimo->setVlrParcela($emprestimo['valor']);
                        $objPessoaConsultaEmprestimo->setObservacao($emprestimo['observacao']);

                        $arrayEmprestimo[] = $objPessoaConsultaEmprestimo;

                        $objPessoaConsultaEmprestimoLogic->salvar($objPessoaConsultaEmprestimo);
                        $stringIN.= $emprestimo['id'] . ",";
                    } else {
                        $objPessoaConsultaEmprestimo = new PessoaConsultaEmprestimo();
                        $objPessoaConsultaEmprestimo->setPessoaConsulta($_POST['id']);
                        $objPessoaConsultaEmprestimo->setVlrParcela($emprestimo['valor']);
                        $objPessoaConsultaEmprestimo->setObservacao($emprestimo['observacao']);
                        $objPessoaConsultaEmprestimo->setUsuarioCriador($USER_SECURITY->getId());
                        $objPessoaConsultaEmprestimo->setDataCriacao(date('Y-m-d H:i:s'));
                        $objPessoaConsultaEmprestimo->setStatus('A');
                        
                        $salvarEmprestimo = $objPessoaConsultaEmprestimoLogic->salvar($objPessoaConsultaEmprestimo);
                        
                        if($salvarEmprestimo[0]){
                            TFeedbackMetroUIv3Helper::notifySuccess('Novo emprestimo adicionado a consulta!');
                            $arrayEmprestimo[] = $objPessoaConsultaEmprestimo;
                            $stringIN.= $salvarEmprestimo[1]->getId() . ",";
                        } else {
                            TFeedbackMetroUIv3Helper::notifyError('Não foi possível adicionar novo emprestimo!');
                        }
                    }
                }
                $stringIN = substr($stringIN, 0, -1);
            }
            ($arrayEmprestimo != NULL ) ? $objPessoaConsulta->setEmprestimos($arrayEmprestimo): "";
            //var_dump($arrayEmprestimo); exit();

            if (in_array($_POST['orgao'], array(2))) {
                $margemDisponivel = ACalculosHelper::calcularMargemDisponivel($objPessoaConsulta);
                $_POST['vlrMargemDisponivel'] = FormatHelper::formatNumeroMonetario($margemDisponivel);
            }
            //Excluir emprestimos retirados da consulta
            //$excluir = $objPessoaConsultaEmprestimoLogic->excluir("des_status = 'A' AND ide_pessoa_consulta = {$_POST['id']} AND ide_pessoa_consulta_emprestimo NOT IN ({$stringIN})");
            
            $salvar = $this->salvar($_POST);

            if ($salvar[0]) {
                TFeedbackMetroUIv3Helper::notifySuccess('Dados atualizados com sucesso!');
                //$_SESSION['frame'] = 'frameR';
                RedirectorHelper::addUrlParameter('id', $salvar[1]->getId());
                RedirectorHelper::goToControllerAction('PessoaConsulta', 'informar');
            } else {
                TFeedbackMetroUIv3Helper::notifyError('Ocorreu um error na atualização, tente novamente ou contate o administrador!!!');
                RedirectorHelper::addUrlParameter('id', $_POST['id']);
                RedirectorHelper::goToControllerAction($requisitante->modulo, "editar");
            }
        } else {
            RedirectorHelper::addUrlParameter('id', $_POST['id']);
            TFeedbackMetroUIv3Helper::notifyWarning('É constrangedor, mas tive problemas para processar a operação');
            RedirectorHelper::goToControllerAction("PessoaConsulta", "informar");
        }
    }

    /**
     * 
     * @param type $params
     * @return type
     */
      public function excluir($requisitante, $params = null) {

        $USER_SECURITY = SecurityHelper::getInstancia()->getUsuario();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
           
//            if ($salvar[0]) {
//                TFeedbackMetroUIv3Helper::notifySuccess('Dados atualizados com sucesso!');
//                //$_SESSION['frame'] = 'frameR';
//                RedirectorHelper::addUrlParameter('id', $salvar[1]->getId());
//                RedirectorHelper::goToControllerAction('PessoaConsulta', 'informar');
//            } else {
//                TFeedbackMetroUIv3Helper::notifyError('Ocorreu um error na atualização, tente novamente ou contate o administrador!!!');
//                RedirectorHelper::addUrlParameter('id', $_POST['id']);
//                RedirectorHelper::goToControllerAction($requisitante->modulo, "editar");
//            }
//        } else {
//            RedirectorHelper::addUrlParameter('id', $_POST['id']);
//            TFeedbackMetroUIv3Helper::notifyWarning('É constrangedor, mas tive problemas para processar a operação');
//            RedirectorHelper::goToControllerAction("PessoaConsulta", "informar");
        }
    }
    public function ajaxListConsulta($params) {

        /* Atributos do objeto que poderam ser ordenado */
        $atributos = array('id', 'nome');
        $order = TDataTableSqliteHelper::mountOrderBy($atributos, $params['iSortCol_0'], $params['sSortDir_0']);
        unset($atributos);
        /* Colunas do banco a serem pesquisandas */
        $colunas = array('ide_pessoa_consulta', 'ide_pessoa', 'ide_pessoa_orgao', 'dat_competencia', 'vlr_margem_disponivel', 'dat_criacao');
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
                $url = UrlRequestHelper::mountUrl('PessoaConsulta', 'informar', array('id' => $object->getId()));
                $link = "<a href='{$url}' title='Visualizar Consulta'><span class=\"mif-eye place-right\"></span></a> " . $object->getPessoa()->getNome();
                //$status = ($object->getStatus()=='A')?"<span class='tag success'>Ativo</span>":"<span class='tag alert'>Desativado</span>";
                //$situacao = ($object->getTipoSituacao()->getId() == 11)?"<span class='tag success'>{$object->getTipoSituacao()->getNome()}</span>":"<span class='tag alert'>{$object->getTipoSituacao()->getNome()}</span>";
                $automatica = ($object->getAutomatica() == 'A') ? "<span class='mif-brightness-auto place-right'></span>" : "";
                $objOrgao = $objOrgaoLogic->obterPorId($object->getPessoaOrgao()->getOrgao());
                $tHiscon = $objPessoaConsultaEmprestimoLogic->totalRegistro("ide_pessoa_consulta = {$object->getId()} AND ide_convenio IS NULL");
                $dataCriacao = $object->getDataCriacao() . $automatica;
                if ($tHiscon > 0) {
                    $margemDisponivel = $object->getVlrMargemDisponivel() . "<span class=\"tag warning mif-ani-horizontal place-right\">HISCON</span>";
                } elseif ($object->getVlrMargemDisponivel() == null) {
                    $margemDisponivel = "--,--<span class=\"tag alert mif-ani-horizontal place-right\">MARGEM</span>";
                } else {
                    $margemDisponivel = $object->getVlrMargemDisponivel();
                }
                $output['aaData'][] = array(
                    $link,
                    $object->getPessoa()->getNumeroCPF(),
                    $objOrgao->getNome(),
                    $margemDisponivel,
                    $dataCriacao
                );
            }
        }
        unset($arrayListObject);

        return json_encode($output);
    }

    public function ajaxListConsultasInPessoa($params) {

        $colunas = array('nom_orgao', 'num_matricula', 'dat_competencia', 'dat_criacao', 'vlr_margem_disponivel', 'des_status', 'des_automatica');
        /* Criar Ordenacao */
        $order = TDataTableHelper::mountOrderByQuery($colunas, $params['iSortCol_0'], $params['sSortDir_0']);
        /* Montar search */
        $search = TDataTableHelper::mountSearch($colunas, $params['sSearch'], false);

        /* Montar Query */
        $tabela = "(SELECT
                        pessoa_consulta.ide_pessoa_consulta,
                        orgao.nom_orgao,
                        pessoa_orgao.num_matricula,
                        pessoa_consulta.dat_competencia,
                        pessoa_consulta.dat_criacao,
                        pessoa_consulta.vlr_margem_disponivel,
                        pessoa_consulta.des_status,
                        pessoa_consulta.des_automatica
                      FROM 
                        pessoa_consulta
                        LEFT JOIN pessoa_orgao ON pessoa_orgao.ide_pessoa_orgao = pessoa_consulta.ide_pessoa_orgao
                        LEFT JOIN orgao ON pessoa_orgao.ide_orgao = orgao.ide_orgao
                      WHERE                       
                   	pessoa_consulta.des_status = 'A'
                        AND pessoa_consulta.ide_pessoa = '" . SecurityEncryptionHelper::decrypt($params['idPessoa']) . "'
                ) AS consultas";

        $where = $search;
        //var_dump($where);
        /* Total de registros */
        $iTotal = DbORM::totalRegistro('ide_pessoa_consulta', $tabela, $where);
        //$iTotal = 10;

        /* redefinir colunas a ser retornada */
        $colunas = implode(',', $colunas);

        /* Obter lista */
        $rWhere = ($where !== null) ? "WHERE {$where}" : '';
        $query = "SELECT ide_pessoa_consulta,{$colunas} FROM {$tabela} {$rWhere} ORDER BY {$order} LIMIT {$params['iDisplayLength']} OFFSET {$params['iDisplayStart']}";

        unset($where, $rWhere, $tabela, $order, $colunas);

        $arrayList = DbORM::select($query);

        /* Montar output */
        $output = TDataTableHelper::mountArrayOutPut($params['sEcho'], $iTotal);
        unset($iTotal);

        if (isset($arrayList[0])) {
            foreach ($arrayList as $array) {
                $url = UrlRequestHelper::mountUrl('PessoaConsulta', 'informar', array('id' => $array['ide_pessoa_consulta']));
                $link = "<a href='{$url}' title='Visualizar Consulta'><span class=\"mif-eye place-right\"></span></a> " . $array['nom_orgao'];
                //$url = UrlRequestHelper::mountUrl('PessoaConsulta', 'informar', array('id' => $array['ide_pessoa_consulta']));
                //$link = "<a href='{$url}'>" . $array['nom_orgao'] . "</a>";
                $automatica = ($array['des_automatica'] == 'A') ? "<span class='mif-brightness-auto place-right' title='Consulta gerada automaticamente pelo sistema'></span>" : "";
                $dataCompetencia = substr($array['dat_competencia'], 4, 2) . "/" . substr($array['dat_competencia'], 0, 4);
                $dataCriacao = FormatHelper::dataTimeInversaToNormal($array['dat_criacao']) . $automatica;
                $output["aaData"][] = array(
                    $link,
                    $array['num_matricula'],
                    $dataCompetencia,
                    $dataCriacao,
                    FormatHelper::formatNumeroMonetario($array['vlr_margem_disponivel'])
                );
            }
        }
        unset($arrayList);

        return json_encode($output);
    }

    public function ajaxListConsultasInContrato($params) {

        $colunas = array('nom_orgao', 'num_matricula', 'dat_competencia', 'vlr_margem_disponivel');
        /* Criar Ordenacao */
        $order = TDataTableHelper::mountOrderByQuery($colunas, $params['iSortCol_0'], $params['sSortDir_0']);
        /* Montar search */
        $search = TDataTableHelper::mountSearch($colunas, $params['sSearch'], false);

        /* Montar Query */
        $tabela = "(SELECT 
                        pessoa_consulta.ide_pessoa_consulta,
                        orgao.nom_orgao,
                        pessoa_orgao.num_matricula,
                        pessoa_consulta.dat_competencia,
                       	pessoa_consulta.vlr_margem_disponivel
                      FROM 
                        pessoa_consulta                        
                        INNER JOIN pessoa ON pessoa_consulta.ide_pessoa = pessoa.ide_pessoa
                        INNER JOIN pessoa_orgao ON pessoa_consulta.ide_pessoa_orgao = pessoa_orgao.ide_pessoa_orgao
                        INNER JOIN orgao ON pessoa_orgao.ide_orgao = orgao.ide_orgao
                      WHERE 
                        pessoa.num_cpf = '" . FormatHelper::unformatCPF($params['numCPF']) . "'
                    ) AS orgaos";

        $where = $search;
        /* Total de registros */
        //$iTotal = DbORM::totalRegistro('ide_pessoa_contato', $tabela, $where);
        $iTotal = 10;

        /* redefinir colunas a ser retornada */
        $colunas = implode(',', $colunas);

        /* Obter lista */
        $rWhere = ($where !== null) ? "WHERE {$where}" : '';
        $query = "SELECT ide_pessoa_consulta,{$colunas} FROM {$tabela} {$rWhere} ORDER BY {$order} LIMIT {$params['iDisplayLength']} OFFSET {$params['iDisplayStart']}";
        unset($where, $rWhere, $tabela, $order, $colunas);

        $arrayList = DbORM::select($query);

        /* Montar output */
        $output = TDataTableHelper::mountArrayOutPut($params['sEcho'], $iTotal);
        unset($iTotal);

        if (isset($arrayList[0])) {
            $objPessoaConsultaEmprestimoLogic = new PessoaConsultaEmprestimoLogic();
            foreach ($arrayList as $array) {
                $totalEmprestimo = $objPessoaConsultaEmprestimoLogic->totalRegistro("ide_pessoa_consulta = {$array['ide_pessoa_consulta']}");
                //$excluir = "<button class='button mini-button rounded square-button place-right' data-role='hint' data-hint-background='bg-lightBlue' data-hint-color='fg-white' data-hint-mode='2' data-hint='|Excluir Registro' data-hint-position='top'><span class='icon mif-bin'></span></button>";
                $url = UrlRequestHelper::mountUrl('PessoaContrato', 'cadastrar', array('id' => $array['ide_pessoa_consulta']));
                $link = "<a href='{$url}'>" . $array['nom_orgao'] . "</a>";
                $dataCompetencia = substr($array['dat_competencia'], 4, 2) . "/" . substr($array['dat_competencia'], 0, 4);
                $margemDisponivel = "R$ " . FormatHelper::formatNumeroMonetario($array['vlr_margem_disponivel']);
                $output["aaData"][] = array(
                    $link,
                    $array['num_matricula'],
                    $dataCompetencia,
                    $totalEmprestimo,
                    $margemDisponivel
                        //$excluir
                );
            }
        }
        unset($arrayList);

        return json_encode($output);
    }

    public function ajaxListMargensDisponiveisInGestao($params) {

        $colunas = array('nom_pessoa', 'nom_orgao', 'num_matricula', 'dat_competencia', 'dat_criacao', 'vlr_margem_disponivel');
        /* Criar Ordenacao */
        $order = TDataTableHelper::mountOrderByQuery($colunas, $params['iSortCol_0'], $params['sSortDir_0']);
        /* Montar search */
        $search = TDataTableHelper::mountSearch($colunas, $params['sSearch'], false);

        /* Montar Query */
        $tabela = "(SELECT 
                        pessoa_consulta.ide_pessoa_consulta,
                        pessoa.nom_pessoa,
                        orgao.nom_orgao,
                        pessoa_orgao.num_matricula,
                        pessoa_consulta.dat_competencia,
                        pessoa_consulta.dat_criacao,
                       	pessoa_consulta.vlr_margem_disponivel
                      FROM 
                        pessoa_consulta                        
                        INNER JOIN pessoa ON pessoa_consulta.ide_pessoa = pessoa.ide_pessoa
                        INNER JOIN pessoa_orgao ON pessoa_consulta.ide_pessoa_orgao = pessoa_orgao.ide_pessoa_orgao
                        INNER JOIN orgao ON pessoa_orgao.ide_orgao = orgao.ide_orgao
                      WHERE 
                        pessoa_consulta.vlr_margem_disponivel > 25.00
                    ) AS orgaos";

        $where = $search;
        /* Total de registros */
        $iTotal = DbORM::totalRegistro('ide_pessoa_consulta', $tabela, $where);
        //$iTotal = 10;

        /* redefinir colunas a ser retornada */
        $colunas = implode(',', $colunas);

        /* Obter lista */
        $rWhere = ($where !== null) ? "WHERE {$where}" : '';
        $query = "SELECT ide_pessoa_consulta,{$colunas} FROM {$tabela} {$rWhere} ORDER BY vlr_margem_disponivel DESC,{$order} LIMIT {$params['iDisplayLength']} OFFSET {$params['iDisplayStart']}";
        unset($where, $rWhere, $tabela, $order, $colunas);

        $arrayList = DbORM::select($query);

        /* Montar output */
        $output = TDataTableHelper::mountArrayOutPut($params['sEcho'], $iTotal);
        unset($iTotal);

        if (isset($arrayList[0])) {
            //$objPessoaConsultaEmprestimoLogic = new PessoaConsultaEmprestimoLogic();
            foreach ($arrayList as $array) {
                //$totalEmprestimo = $objPessoaConsultaEmprestimoLogic->totalRegistro("ide_pessoa_consulta = {$array['ide_pessoa_consulta']}");
                //$excluir = "<button class='button mini-button rounded square-button place-right' data-role='hint' data-hint-background='bg-lightBlue' data-hint-color='fg-white' data-hint-mode='2' data-hint='|Excluir Registro' data-hint-position='top'><span class='icon mif-bin'></span></button>";
                $url = UrlRequestHelper::mountUrl('PessoaConsulta', 'informar', array('id' => $array['ide_pessoa_consulta']));
                $link = "<a href='{$url}' title='Visualizar Consulta'><span class=\"mif-eye place-right\"></span></a> " . $array['nom_pessoa'];

                //$url = UrlRequestHelper::mountUrl('PessoaConsulta', 'informar', array('id' => $array['ide_pessoa_consulta']));
                //$link = "<a href='{$url}'>" . $array['nom_orgao'] . "</a>";
                $dataCompetencia = substr($array['dat_competencia'], 4, 2) . "/" . substr($array['dat_competencia'], 0, 4);
                $margemDisponivel = "R$ " . FormatHelper::formatNumeroMonetario($array['vlr_margem_disponivel']);
                $output["aaData"][] = array(
                    $link,
                    $array['nom_orgao'],
                    $array['num_matricula'],
                    $dataCompetencia,
                    $array['dat_criacao'],
                    $margemDisponivel
                        //$excluir
                );
            }
        }
        unset($arrayList);

        return json_encode($output);
    }

}
