<?php

class PessoaConsultaEmprestimoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new PessoaConsultaEmprestimoDAO());
    }
    
    public function editar($ObjPageRequisitante = null) {
        
        $salvar[0] = false;
        
        if(isset($_POST['emprestimos'])){
            foreach($_POST['emprestimos'] AS $k=>$array){
                $objPessoaConsultaEmprestimo = new PessoaConsultaEmprestimo();
                $objPessoaConsultaEmprestimo->setId($k);
                $objPessoaConsultaEmprestimo->setConvenio($array['convenio']);
                $objPessoaConsultaEmprestimo->setNumeroContrato($array['numeroContrato']);
                $objPessoaConsultaEmprestimo->setDataInicioContrato($array['dataInicioContrato']);
                $objPessoaConsultaEmprestimo->setTotalParcela($array['totalParcela']);
                $objPessoaConsultaEmprestimo->setVlrParcela($array['vlrParcela']);
                $objPessoaConsultaEmprestimo->setObservacao($array['observacao']);
                
                $objPessoaConsultaEmprestimo->setUsuarioAtualizador(SecurityHelper::getInstancia()->getUsuario()->getId());
                $objPessoaConsultaEmprestimo->setDataAtualizacao(date('Y-m-d H:i:s'));
                
                $salvar = $this->salvar($objPessoaConsultaEmprestimo);
            }
        }
                
        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('Emprestimos atualizados com sucesso!');
            RedirectorHelper::addUrlParameter('id', $_POST['pessoaConsulta']);
            RedirectorHelper::goToControllerAction('PessoaConsulta', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::addUrlParameter('id', $_POST['pessoaConsulta']);
            RedirectorHelper::goToControllerAction('PessoaConsultaEmprestimo', 'editar');
        }
    }
    
    public function ajaxListEmprestimosInPessoaConsulta($params) {
        
        $colunas = array('ide_pessoa_consulta_emprestimo', 'nom_convenio', 'num_contrato', 'dat_inicio_contrato','num_total_parcela','vlr_parcela','des_observacao');
        /* Criar Ordenacao */
        $order = TDataTableHelper::mountOrderByQuery($colunas, $params['iSortCol_0'], $params['sSortDir_0']);
        /* Montar search */
        $search = TDataTableHelper::mountSearch($colunas, $params['sSearch'], false);

        /* Montar Query */
        $tabela = "(SELECT
                        ide_pessoa_consulta_emprestimo,
                        convenio.nom_convenio,
                        num_contrato,
                        dat_inicio_contrato,
                        num_total_parcela,
                        vlr_parcela,
                        des_observacao,
                        pessoa_consulta_emprestimo.des_status
                    FROM 
                        pessoa_consulta_emprestimo
                    LEFT JOIN convenio ON pessoa_consulta_emprestimo.ide_convenio = convenio.ide_convenio
                    WHERE
                        pessoa_consulta_emprestimo.ide_pessoa_consulta = ". SecurityEncryptionHelper::decrypt($params['idPessoaConsulta']) ." AND pessoa_consulta_emprestimo.des_status = 'A'
                ) AS emprestimos";

        $where = $search;
        /* Total de registros */
        //$iTotal = DbORM::totalRegistro('ide_pessoa_contato', $tabela, $where);
        $iTotal = 10;

        /* redefinir colunas a ser retornada */
        $colunas = implode(',', $colunas);

        /* Obter lista */
        $rWhere = ($where !== null) ? "WHERE {$where}" : '';
        $query = "SELECT ide_pessoa_consulta_emprestimo,{$colunas} FROM {$tabela} {$rWhere} ORDER BY {$order} LIMIT {$params['iDisplayLength']} OFFSET {$params['iDisplayStart']}";
        unset($where, $rWhere, $tabela, $order, $colunas);

        $arrayList = DbORM::select($query);

        /* Montar output */
        $output = TDataTableHelper::mountArrayOutPut($params['sEcho'], $iTotal);
        unset($iTotal);
        
        if (isset($arrayList[0])) {
            foreach ($arrayList as $array) {
                $nomeConvenio = ($array['nom_convenio'] != null)?$array['nom_convenio']:"<span class='tag default'>Não Informado.</span>";
                $url = UrlRequestHelper::mountUrl('PessoaConsultaEmprestimo', 'informar', array('id' => $array['ide_pessoa_consulta_emprestimo']));
                $link = "<a href='{$url}' title='Visualizar Emprestimo'><span class=\"mif-eye place-right\"></span></a> " . $nomeConvenio;
                $numeroContrato = ($array['num_contrato'] != null)?$array['num_contrato']:"<span class='tag default'>Não Informado.</span>";
                $dataContrato = ($array['dat_inicio_contrato'] != null)? FormatHelper::formatData(FormatHelper::dataInversaToNormal($array['dat_inicio_contrato'])):"<span class='tag default'>Não Informado.</span>";
                $numeroParcela = ($array['num_total_parcela'] != null)?$array['num_total_parcela']:"<span class='tag default'>Não Informado.</span>";
                $parcelasPagas = ($array['dat_inicio_contrato'] != null)? ACalculosHelper::calcularParcelasPagas(FormatHelper::formatData(FormatHelper::dataInversaToNormal($array['dat_inicio_contrato'])), $array['num_total_parcela']):"";
                $observacao = ($array['des_observacao'] != null)?$array['des_observacao']:"<span class='tag default'>Não Informado.</span>";
                $parcelasAbertas = $numeroParcela - $parcelasPagas;
                $parcelasPagas = ($parcelasPagas < 10) ? "0{$parcelasPagas}" : $parcelasPagas;
                $alert = ($parcelasPagas >= 12) ? "<span class='mif-arrow-left mif-ani-flash mif-ani-slow place-right'></span>" : "";
                $posicao = "<span class='fg-emerald'>".$parcelasPagas. "</span>/<span class='fg-red'>" .$parcelasAbertas. "</span>".$alert;
                $output["aaData"][] = array(
                    $link,
                    $numeroContrato,
                    $dataContrato,
                    $numeroParcela,
                    $posicao,
                    "R$ ".FormatHelper::formatNumeroMonetario($array['vlr_parcela']),
                    $observacao
                );
            }
        }
        unset($arrayList);

        return json_encode($output);
    }
    
    public function ajaxListEmprestimosNegociadosInPessoaConsulta($params) {
        
        $colunas = array('ide_pessoa_consulta_emprestimo', 'nom_convenio', 'num_contrato', 'dat_inicio_contrato','num_total_parcela','vlr_parcela','des_observacao','ide_pessoa_consulta_emprestimo_destino');
        /* Criar Ordenacao */
        $order = TDataTableHelper::mountOrderByQuery($colunas, $params['iSortCol_0'], $params['sSortDir_0']);
        /* Montar search */
        $search = TDataTableHelper::mountSearch($colunas, $params['sSearch'], false);

        /* Montar Query */
        $tabela = "(SELECT
                        pessoa_consulta_emprestimo.ide_pessoa_consulta_emprestimo,
                        convenio.nom_convenio,
                        pessoa_consulta_emprestimo.num_contrato,
                        pessoa_consulta_emprestimo.dat_inicio_contrato,
                        pessoa_consulta_emprestimo.num_total_parcela,
                        pessoa_consulta_emprestimo.vlr_parcela,
                        pessoa_consulta_emprestimo.des_observacao,
                        pessoa_consulta_emprestimo.des_status,
                        pessoa_consulta_emprestimo.ide_pessoa_consulta_emprestimo_destino
                    FROM 
                        pessoa_consulta_emprestimo
                    LEFT JOIN convenio ON pessoa_consulta_emprestimo.ide_convenio = convenio.ide_convenio
                    LEFT JOIN pessoa_contrato ON pessoa_consulta_emprestimo.ide_pessoa_consulta_emprestimo = pessoa_contrato.ide_pessoa_consulta_emprestimo
                    WHERE
                        pessoa_consulta_emprestimo.ide_pessoa_consulta = ". SecurityEncryptionHelper::decrypt($params['idPessoaConsulta']) ." AND pessoa_consulta_emprestimo.des_status = 'N'
                ) AS emprestimos";

        $where = $search;
        /* Total de registros */
        $iTotal = DbORM::totalRegistro('ide_pessoa_consulta_emprestimo', $tabela, $where);
        //$iTotal = 10;

        /* redefinir colunas a ser retornada */
        $colunas = implode(',', $colunas);

        /* Obter lista */
        $rWhere = ($where !== null) ? "WHERE {$where}" : '';
        $query = "SELECT ide_pessoa_consulta_emprestimo,{$colunas} FROM {$tabela} {$rWhere} ORDER BY {$order} LIMIT {$params['iDisplayLength']} OFFSET {$params['iDisplayStart']}";
        unset($where, $rWhere, $tabela, $order, $colunas);

        $arrayList = DbORM::select($query);

        /* Montar output */
        $output = TDataTableHelper::mountArrayOutPut($params['sEcho'], $iTotal);
        unset($iTotal);
        
        if (isset($arrayList[0])) {
            $objPessoaContratoLogic = new PessoaContratoLogic();
            foreach ($arrayList as $array) {
                $nomeConvenio = ($array['nom_convenio'] != null)?$array['nom_convenio']:"<span class='tag default'>Não Informado.</span>";
                $numeroContrato = ($array['num_contrato'] != null)?$array['num_contrato']:"<span class='tag default'>Não Informado.</span>";
                $dataContrato = ($array['dat_inicio_contrato'] != null)? FormatHelper::formatData(FormatHelper::dataInversaToNormal($array['dat_inicio_contrato'])):"<span class='tag default'>Não Informado.</span>";
                $numeroParcela = ($array['num_total_parcela'] != null)?$array['num_total_parcela']:"<span class='tag default'>Não Informado.</span>";
                //$parcelasPagas = ($array['dat_inicio_contrato'] != null)? ACalculosHelper::calcularParcelasPagas(FormatHelper::formatData(FormatHelper::dataInversaToNormal($array['dat_inicio_contrato'])), $array['num_total_parcela']):"";
                $observacao = ($array['des_observacao'] != null)?$array['des_observacao']:"<span class='tag default'>Não Informado.</span>";
                //$parcelasAbertas = $numeroParcela - $parcelasPagas;
                //$parcelasPagas = ($parcelasPagas < 10) ? "0{$parcelasPagas}" : $parcelasPagas;
                //$posicao = "<span class='fg-emerald'>".$parcelasPagas. "</span>/<span class='fg-red'>" .$parcelasAbertas. "</span>";
                
                $objEmprestimoAtual = $this->obterPorId($array['ide_pessoa_consulta_emprestimo_destino'],true);                                   
                $objPessoaContrato = $objPessoaContratoLogic->obter("ide_pessoa_consulta_emprestimo = {$objEmprestimoAtual->getId()}",true);
                $negocio = ($objPessoaContrato!=null)?$objPessoaContrato->getTipoContrato()->getNome():"<span class='tag default'>Não Informado.</span>";
                
                $output["aaData"][] = array(
                    $nomeConvenio,
                    $numeroContrato,
                    "R$ ".FormatHelper::formatNumeroMonetario($array['vlr_parcela']),
                    $negocio,
                    $objEmprestimoAtual->getConvenio()->getNome(),
                    //$posicao,
                    $objEmprestimoAtual->getNumeroContrato(),
                );
            }
        }
        unset($arrayList);

        return json_encode($output);
    }
    
    public function ajaxListEmprestimosDisponiveisInGestao($params) {
        
        $colunas = array('nom_pessoa','num_cpf','total','soma');
        /* Criar Ordenacao */
        $order = TDataTableHelper::mountOrderByQuery($colunas, $params['iSortCol_0'], $params['sSortDir_0']);
        /* Montar search */
        $search = TDataTableHelper::mountSearch($colunas, $params['sSearch'], false);

        /* Montar Query */
        $tabela = "(SELECT
                        pessoa_consulta.ide_pessoa_consulta,
                        pessoa.nom_pessoa,
                        pessoa.num_cpf,
                        COUNT(pessoa_consulta_emprestimo.ide_pessoa_consulta_emprestimo) as total,
                        SUM(vlr_parcela) as soma
                    FROM 
                        pessoa_consulta_emprestimo
                    LEFT JOIN convenio ON pessoa_consulta_emprestimo.ide_convenio = convenio.ide_convenio
                    LEFT JOIN pessoa_consulta ON pessoa_consulta_emprestimo.ide_pessoa_consulta = pessoa_consulta.ide_pessoa_consulta
                    LEFT JOIN pessoa ON pessoa_consulta.ide_pessoa = pessoa.ide_pessoa
                    WHERE str_to_date(dat_inicio_contrato,'%Y%m%d') <= date_add(now(), interval -1 year) AND pessoa_consulta_emprestimo.des_status = 'A'
                    GROUP BY pessoa.nom_pessoa, pessoa.num_cpf
                ) AS consultas";

        $where = $search;
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
                $link = "<a href='{$url}' title='Visualizar Consulta'><span class=\"mif-eye place-right\"></span></a> " . $array['nom_pessoa'];
                //$dataCompetencia = substr($array['dat_competencia'], 4, 2)."/".substr($array['dat_competencia'], 0, 4);
                $soma = "R$ ".FormatHelper::formatNumeroMonetario($array['soma']);
                $output["aaData"][] = array(
                    $link,
                    FormatHelper::formatCPF($array['num_cpf']),
                    $array['total'],
                    $soma
                );
            }
        }
        unset($arrayList);

        return json_encode($output);
    }

}