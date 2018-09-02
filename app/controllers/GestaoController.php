<?php

class GestaoController extends TMetroUIv3 {

    public function index() {
        
        
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");

        $objPessoaLogic = new PessoaLogic();

        //Tiles de Aniversários - âncora
        $mes = date('m');
        $totalAniversario = $objPessoaLogic->totalRegistro("SUBSTRING(dat_nascimento,5,2) = '{$mes}'");
        $this->addDados('totalAniversario', $totalAniversario);

        //Tiles de Emprestimos Disponíveis - âncora
        $objPessoaConsultaEmprestimoLogic = new PessoaConsultaEmprestimoLogic();
        $totalEmprestimosDisponiveis = $objPessoaConsultaEmprestimoLogic->totalRegistro("str_to_date(dat_inicio_contrato,'%Y%m%d') < date_add(now(), interval -1 year) AND pessoa_consulta_emprestimo.des_status = 'A'");
        $this->addDados('totalEmprestimosDisponiveis', $totalEmprestimosDisponiveis);
        
        //Tiles de Margens Disponíveis - âncora
        $objPessoaConsultaLogic = new PessoaConsultaLogic();
        $totalMargensDisponiveis = $objPessoaConsultaLogic->totalRegistro("vlr_margem_disponivel > 25.00 AND des_status = 'A'");
        $this->addDados('totalMargensDisponiveis', $totalMargensDisponiveis);
                
        //$alertPessoa = "";
        //$alertPessoa.=($tConsulta > 0) ? "<span class='tag warning mif-ani-horizontal place-right'>CONSULTA</span>" : "";
        //$alertPessoa.=($tOrgao > 0) ? "<span class='tag alert mif-ani-horizontal place-right'>ORGÃO</span>" : "";

        //$this->addDados('alertPessoa', $alertPessoa);
        
        //Pessoas Cadastradas DIA
        $tPessoasCadastradasHoje = $objPessoaLogic->totalRegistro("DATE_FORMAT(dat_criacao, '%Y-%m-%d') = CURDATE()");
        $tPessoasCadastradasOntem = $objPessoaLogic->totalRegistro("dat_criacao BETWEEN DATE_FORMAT(CURDATE()-1,'%Y-%m-%d') AND CURDATE()");
        //Validando Possibilidade de Variação Percentual
        $this->addDados('tPessoaCadastradasHoje', $tPessoasCadastradasHoje);
        if ($tPessoasCadastradasHoje > 0 && $tPessoasCadastradasOntem > 0) {
            $variacaoPessoaDIA = round((($tPessoasCadastradasHoje - $tPessoasCadastradasOntem) / $tPessoasCadastradasHoje) * 100, 1);
            $indicadorPessoaDIA = ($tPessoasCadastradasHoje >= $tPessoasCadastradasOntem) ? "<span class=\"mif-arrow-up fg-emerald\">{$variacaoPessoaDIA}%</span>" : "<span class=\"mif-arrow-down fg-red\">{$variacaoPessoaDIA}%</span>";
        } else {
            $indicadorPessoaDIA = "<span class='tag warning' title='Variação Percentual Indisponível'>N/A</span>";
        }
        $this->addDados('indicadorPessoaDIA', $indicadorPessoaDIA);

        //Pessoas Cadastradas MÊS
        $tPessoasCadastradasMesAnterior = $objPessoaLogic->totalRegistro("EXTRACT(YEAR_MONTH FROM dat_criacao) BETWEEN EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 1 MONTH) AND EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 1 MONTH)");
        $tPessoasCadastradasMesAtual = $objPessoaLogic->totalRegistro("dat_criacao >= DATE_SUB( DATE( NOW() ), INTERVAL DAY( NOW() ) -1 DAY )");
        //Validando Possibilidade de Variação Percentual
        $this->addDados('tPessoaCadastradasMes', $tPessoasCadastradasMesAtual);
        if ($tPessoasCadastradasMesAtual > 0 && $tPessoasCadastradasMesAnterior > 0) {
            $variacaoPessoaMES = round((($tPessoasCadastradasMesAtual - $tPessoasCadastradasMesAnterior) / $tPessoasCadastradasMesAtual) * 100, 1);
            $indicadorPessoaMES = ($tPessoasCadastradasMesAtual >= $tPessoasCadastradasMesAnterior) ? "<span class=\"mif-arrow-up fg-emerald\">{$variacaoPessoaMES}%</span>" : "<span class=\"mif-arrow-down fg-red\">{$variacaoPessoaMES}%</span>";
        } else {
            $indicadorPessoaMES = "<span class='tag warning' title='Variação Percentual Indisponível'>N/A</span>";
        }
        $this->addDados('indicadorPessoaMES', $indicadorPessoaMES);

        //Pessoas Cadastradas ANO
        $tPessoasCadastradasAnoAnterior = $objPessoaLogic->totalRegistro("DATE_FORMAT(dat_criacao,'%Y') = DATE_FORMAT(CURDATE(),'%Y')-1");
        $tPessoasCadastradasAnoAtual = $objPessoaLogic->totalRegistro("DATE_FORMAT(dat_criacao,'%Y') = DATE_FORMAT(CURDATE(),'%Y')");
        //Validando Possibilidade de Variação Percentual
        $this->addDados('tPessoaCadastradasAno', $tPessoasCadastradasAnoAtual);
        if ($tPessoasCadastradasAnoAtual > 0 && $tPessoasCadastradasAnoAnterior > 0) {
            $variacaoPessoaANO = round((($tPessoasCadastradasAnoAtual - $tPessoasCadastradasAnoAnterior) / $tPessoasCadastradasAnoAtual) * 100, 1);
            $indicadorPessoaANO = ($tPessoasCadastradasAnoAtual >= $tPessoasCadastradasAnoAnterior) ? "<span class=\"mif-arrow-up fg-emerald\">{$variacaoPessoaANO}%</span>" : "<span class=\"mif-arrow-down fg-red\">{$variacaoPessoaANO}%</span>";
        } else {
            $indicadorPessoaANO = "<span class='tag warning' title='Variação Percentual Indisponível'>N/A</span>";
        }
        $this->addDados('indicadorPessoaANO', $indicadorPessoaANO);

        $objPessoaContratoLogic = new PessoaContratoLogic();

        //Contratos Cadastrados DIA
        $tContratosCadastradosHoje = $objPessoaContratoLogic->totalRegistro("DATE_FORMAT(dat_criacao, '%Y-%m-%d') = CURDATE()");
        $tContratosCadastradosOntem = $objPessoaContratoLogic->totalRegistro("dat_criacao BETWEEN DATE_FORMAT(CURDATE()-1,'%Y-%m-%d') AND CURDATE()");
        //Validando Possibilidade de Variação Percentual
        $this->addDados('tContratoCadastradosHoje', $tContratosCadastradosHoje);
        if ($tContratosCadastradosHoje > 0 && $tContratosCadastradosOntem > 0) {
            $variacaoContratoDIA = round((($tContratosCadastradosHoje - $tContratosCadastradosOntem) / $tContratosCadastradosHoje) * 100, 1);
            $indicadorContratoDIA = ($tContratosCadastradosHoje >= $tContratosCadastradosOntem) ? "<span class=\"mif-arrow-up fg-emerald\">{$variacaoContratoDIA}%</span>" : "<span class=\"mif-arrow-down fg-red\">{$variacaoContratoDIA}%</span>";
        } else {
            $indicadorContratoDIA = "<span class='tag warning' title='Variação Percentual Indisponível'>N/A</span>";
        }
        $this->addDados('indicadorContratoDIA', $indicadorContratoDIA);

        //Contratos Cadastrados MÊS
        $tContratosCadastradosMesAnterior = $objPessoaContratoLogic->totalRegistro("EXTRACT(YEAR_MONTH FROM dat_criacao) BETWEEN EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 1 MONTH) AND EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 1 MONTH)");
        $tContratosCadastradosMesAtual = $objPessoaContratoLogic->totalRegistro("dat_criacao >= DATE_SUB( DATE( NOW() ), INTERVAL DAY( NOW() ) -1 DAY )");
        //Validando Possibilidade de Variação Percentual
        $this->addDados('tContratoCadastradosMes', $tContratosCadastradosMesAtual);
        if ($tContratosCadastradosMesAtual > 0 && $tContratosCadastradosMesAnterior > 0) {
            $variacaoContratoMES = round((($tContratosCadastradosMesAtual - $tContratosCadastradosMesAnterior) / $tContratosCadastradosMesAtual) * 100, 1);
            $indicadorContratoMES = ($tContratosCadastradosMesAtual >= $tContratosCadastradosMesAnterior) ? "<span class=\"mif-arrow-up fg-emerald\">{$variacaoContratoMES}%</span>" : "<span class=\"mif-arrow-down fg-red\">{$variacaoContratoMES}%</span>";
        } else {
            $indicadorContratoMES = "<span class='tag warning' title='Variação Percentual Indisponível'>N/A</span>";
        }
        $this->addDados('indicadorContratoMES', $indicadorContratoMES);

        //Pessoas Cadastradas ANO
        $tContratosCadastradosAnoAnterior = $objPessoaContratoLogic->totalRegistro("DATE_FORMAT(dat_criacao,'%Y') = DATE_FORMAT(CURDATE(),'%Y')-1");
        $tContratosCadastradosAnoAtual = $objPessoaContratoLogic->totalRegistro("DATE_FORMAT(dat_criacao,'%Y') = DATE_FORMAT(CURDATE(),'%Y')");
        //Validando Possibilidade de Variação Percentual
        $this->addDados('tContratoCadastradosAno', $tContratosCadastradosAnoAtual);
        if ($tContratosCadastradosAnoAtual > 0 && $tContratosCadastradosAnoAnterior > 0) {
            $variacaoContratoANO = round((($tContratosCadastradosAnoAtual - $tContratosCadastradosAnoAnterior) / $tContratosCadastradosAnoAtual) * 100, 1);
            $indicadorContratoANO = ($tContratosCadastradosAnoAtual >= $tContratosCadastradosAnoAnterior) ? "<span class=\"mif-arrow-up fg-emerald\">{$variacaoContratoANO}%</span>" : "<span class=\"mif-arrow-down fg-red\">{$variacaoContratoANO}%</span>";
        } else {
            $indicadorContratoANO = "<span class='tag warning' title='Variação Percentual Indisponível'>N/A</span>";
        }
        $this->addDados('indicadorContratoANO', $indicadorContratoANO);

        $objPessoaConsultaLogic = new PessoaConsultaLogic();

        $objPessoaConsultaEmprestimoLogic = new PessoaConsultaEmprestimoLogic();

        $tHiscon = $objPessoaConsultaEmprestimoLogic->totalRegistro("ide_convenio IS NULL");
        $tMargem = $objPessoaConsultaLogic->totalRegistro("vlr_margem_disponivel IS NULL");

        $alertConsulta = "";
        $alertConsulta.=($tHiscon > 0) ? "<span class='tag warning mif-ani-horizontal place-right'>HISCON</span>" : "";
        $alertConsulta.=($tMargem > 0) ? "<span class='tag alert mif-ani-horizontal place-right'>MARGEM</span>" : "";

        $this->addDados('alertConsulta', $alertConsulta);

        //Consultas Cadastradas DIA
        $tConsultasCadastradasHoje = $objPessoaConsultaLogic->totalRegistro("DATE_FORMAT(dat_criacao, '%Y-%m-%d') = CURDATE()");
        $tConsultasCadastradasOntem = $objPessoaConsultaLogic->totalRegistro("dat_criacao BETWEEN DATE_FORMAT(CURDATE()-1,'%Y-%m-%d') AND CURDATE()");
        //Validando Possibilidade de Variação Percentual
        $this->addDados('tConsultaCadastradasHoje', $tConsultasCadastradasHoje);
        if ($tConsultasCadastradasHoje > 0 && $tConsultasCadastradasOntem > 0) {
            $variacaoConsultaDIA = round((($tConsultasCadastradasHoje - $tConsultasCadastradasOntem) / $tConsultasCadastradasHoje) * 100, 1);
            $indicadorConsultaDIA = ($tConsultasCadastradasHoje >= $tConsultasCadastradasOntem) ? "<span class=\"mif-arrow-up fg-emerald\">{$variacaoConsultaDIA}%</span>" : "<span class=\"mif-arrow-down fg-red\">{$variacaoConsultaDIA}%</span>";
        } else {
            $indicadorConsultaDIA = "<span class='tag warning' title='Variação Percentual Indisponível'>N/A</span>";
        }
        $this->addDados('indicadorConsultaDIA', $indicadorConsultaDIA);

        //Consultas Cadastradas MÊS
        $tConsultasCadastradasMesAnterior = $objPessoaConsultaLogic->totalRegistro("EXTRACT(YEAR_MONTH FROM dat_criacao) BETWEEN EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 1 MONTH) AND EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 1 MONTH)");
        $tConsultasCadastradasMesAtual = $objPessoaConsultaLogic->totalRegistro("dat_criacao >= DATE_SUB( DATE( NOW() ), INTERVAL DAY( NOW() ) -1 DAY )");
        //Validando Possibilidade de Variação Percentual
        $this->addDados('tConsultaCadastradasMes', $tConsultasCadastradasMesAtual);
        if ($tConsultasCadastradasMesAtual > 0 && $tConsultasCadastradasMesAnterior > 0) {
            $variacaoConsultaMES = round((($tPessoasCadastradasMesAtual - $tPessoasCadastradasMesAnterior) / $tPessoasCadastradasMesAtual) * 100, 1);
            $indicadorConsultaMES = ($tConsultasCadastradasMesAtual >= $tPessoasCadastradasMesAnterior) ? "<span class=\"mif-arrow-up fg-emerald\">{$variacaoConsultaMES}%</span>" : "<span class=\"mif-arrow-down fg-red\">{$variacaoConsultaMES}%</span>";
        } else {
            $indicadorConsultaMES = "<span class='tag warning' title='Variação Percentual Indisponível'>N/A</span>";
        }
        $this->addDados('indicadorConsultaMES', $indicadorConsultaMES);

        //Consultas Cadastradas ANO
        $tConsultasCadastradasAnoAnterior = $objPessoaConsultaLogic->totalRegistro("DATE_FORMAT(dat_criacao,'%Y') = DATE_FORMAT(CURDATE(),'%Y')-1");
        $tConsultasCadastradasAnoAtual = $objPessoaConsultaLogic->totalRegistro("DATE_FORMAT(dat_criacao,'%Y') = DATE_FORMAT(CURDATE(),'%Y')");
        //Validando Possibilidade de Variação Percentual
        $this->addDados('tConsultaCadastradasAno', $tConsultasCadastradasAnoAtual);
        if ($tConsultasCadastradasAnoAtual > 0 && $tConsultasCadastradasAnoAnterior > 0) {
            $variacaoConsultaANO = round((($tConsultasCadastradasAnoAtual - $tConsultasCadastradasAnoAnterior) / $tConsultasCadastradasAnoAtual) * 100, 1);
            $indicadorConsultaANO = ($tConsultasCadastradasAnoAtual >= $tConsultasCadastradasAnoAnterior) ? "<span class=\"mif-arrow-up fg-emerald\">{$variacaoConsultaANO}%</span>" : "<span class=\"mif-arrow-down fg-red\">{$variacaoConsultaANO}%</span>";
        } else {
            $indicadorConsultaANO = "<span class='tag warning' title='Variação Percentual Indisponível'>N/A</span>";
        }
        $this->addDados('indicadorConsultaANO', $indicadorConsultaANO);

        $objPessoaContratoLogic = new PessoaContratoLogic();
        $arrayObjPessoaContratoMES = $objPessoaContratoLogic->listar("DATE_FORMAT(dat_tipo_situacao, '%Y-%m-%d') >= DATE_SUB( DATE( NOW() ), INTERVAL DAY( NOW() ) -1 DAY )");
        $arrayObjPessoaContratoMesAnterior = $objPessoaContratoLogic->listar("EXTRACT(YEAR_MONTH FROM dat_tipo_situacao) BETWEEN EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 1 MONTH) AND EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 1 MONTH)");

        //Definição de Variáveis Faturamento e Comissão
        $faturamentoMES = 0;
        $comissaoConfirmadaAtual = 0;
        $comissaoConfirmadaMesAnterior = 0;
        $comissaoPrevista = 0;
        
        //Contadores de Negocial
        $totalNovoIntegrado = 0;$totalNovoReprovado = 0;$totalNovoEmAndamento = 0;
        $totalRefinIntegrado = 0;$totalRefinReprovado = 0;$totalRefinEmAndamento = 0;
        $totalPortaIntegrado = 0;$totalPortaReprovado = 0;$totalPortaEmAndamento = 0;
        
        //Valores de Comissões Previstos
        $arrayObjPessoaContrato = $objPessoaContratoLogic->listar("ide_tipo_situacao = 10 AND des_status = 'A'");
        
        if($arrayObjPessoaContrato!=null){
            foreach ($arrayObjPessoaContrato as $objPessoaContrato) {
                $comissaoPrevista += FormatHelper::unFormatNumeroMonetario($objPessoaContrato->getVlrComissaoReceber());
                switch ($objPessoaContrato->getTipoContrato()) {
                    case 1:
                        $totalNovoEmAndamento++;
                        break;
                    case 2:
                        $totalRefinEmAndamento++;
                        break;
                    case 3:
                        $totalPortaEmAndamento++;
                        break;
                }
                
            }
        }
        $totalComissaoPrevista = $objPessoaContratoLogic->totalRegistro("ide_tipo_situacao = 10 AND des_status = 'A'");
                
        //Faturamento do Mês Vigente
        if ($arrayObjPessoaContratoMES != null) {
            foreach ($arrayObjPessoaContratoMES as $objPessoaContrato) {
                if ($objPessoaContrato->getTipoSituacao() == 16) {//Integrado
                    switch ($objPessoaContrato->getTipoContrato()) {
                        case 1: //Novos
                            $faturamentoMES += FormatHelper::unFormatNumeroMonetario($objPessoaContrato->getVlrBruto());
                            $totalNovoIntegrado++;
                            break;
                        case 2: //Refinanciamentos
                            $faturamentoMES += FormatHelper::unFormatNumeroMonetario($objPessoaContrato->getVlrLiquido());
                            $totalRefinIntegrado++;
                            break;
                        case 3: //Portabilidades
                            $faturamentoMES += FormatHelper::unFormatNumeroMonetario($objPessoaContrato->getVlrBruto());
                            $totalPortaIntegrado++;
                            break;
                        default: //Não Definidos
                            $faturamentoMES += 0;
                            break;
                    }
                    $comissaoConfirmadaAtual += FormatHelper::unFormatNumeroMonetario($objPessoaContrato->getVlrComissaoReceber());
                } elseif($objPessoaContrato->getTipoSituacao() == 17) { //Reprovado
                    switch ($objPessoaContrato->getTipoContrato()) {
                        case 1: //Novos
                            $totalNovoReprovado++;
                            break;
                        case 2: //Refinanciamentos
                            $totalRefinReprovado++;
                            break;
                        case 3: //Portabilidades
                            $totalPortaReprovado++;
                            break;
                        default: //Não Definidos
                            
                            break;
                    }
                }
            }
        }

        //Faturamento do Mês Anterior
        if ($arrayObjPessoaContratoMesAnterior != null) {
            foreach ($arrayObjPessoaContratoMesAnterior as $objPessoaContrato) {
                if ($objPessoaContrato->getTipoSituacao() == 16) {//Integrado
                    $comissaoConfirmadaMesAnterior += FormatHelper::unFormatNumeroMonetario($objPessoaContrato->getVlrComissaoReceber());
                }
            }
        }
        
        $totalComissaoPrevistaMES = ($totalComissaoPrevista>1)?"<span class='tag info'>{$totalComissaoPrevista} comissões</span>":"<span class='tag info'>{$totalComissaoPrevista} comissão</span>";
        
        //Cálculo de Variação Percentual de Comissão
        if ($comissaoConfirmadaAtual > 0 && $comissaoConfirmadaMesAnterior > 0) {
            $variacaoComissaoMES = round((($comissaoConfirmadaAtual - $comissaoConfirmadaMesAnterior) / $comissaoConfirmadaAtual) * 100, 1);
            $indicadorComissaoMES = ($comissaoConfirmadaAtual >= $comissaoConfirmadaMesAnterior) ? "<span class=\"mif-arrow-up fg-emerald\">{$variacaoComissaoMES}%</span>" : "<span class=\"mif-arrow-down fg-red\">{$variacaoComissaoMES}%</span>";
        } else {
            $indicadorComissaoMES = "<span class='tag warning' title='Variação Percentual Indisponível'>N/A</span>";
        }

        $this->addDados('faturamentoMES', FormatHelper::formatNumeroMonetario($faturamentoMES));
        $this->addDados('comissaoConfirmadaMES', FormatHelper::formatNumeroMonetario($comissaoConfirmadaAtual));
        $this->addDados('comissaoPrevistaMES', FormatHelper::formatNumeroMonetario($comissaoPrevista));
        $this->addDados('indicadorComissaoMES', $indicadorComissaoMES);
        
        $this->addDados('totalComissaoPrevistaMES', $totalComissaoPrevistaMES);
        
        $totalNovoMES = $totalNovoIntegrado + $totalNovoReprovado + $totalNovoEmAndamento;
        $totalRefinMES = $totalRefinIntegrado + $totalRefinReprovado + $totalRefinEmAndamento;
        $totalPortaMES = $totalPortaIntegrado + $totalPortaReprovado + $totalPortaEmAndamento;
        
        $totalNovoIntegrado = ($totalNovoIntegrado < 10) ? "<span class='tag success' title='Integrados'>0{$totalNovoIntegrado}</span>" : "<span class='tag success'>{$totalNovoIntegrado}</span>";
        $totalNovoReprovado = ($totalNovoReprovado < 10) ? " <span class='tag alert' title='Reprovados'>0{$totalNovoReprovado}</span>" : " <span class='tag alert'>{$totalNovoReprovado}</span>";
        $totalNovoEmAndamento = ($totalNovoEmAndamento < 10) ? " <span class='tag default' title='Em Andamento'>0{$totalNovoEmAndamento}</span>" : " <span class='tag default'>{$totalNovoEmAndamento}</span>";
        
        $displayNovo = $totalNovoIntegrado . $totalNovoReprovado . $totalNovoEmAndamento;
                
        $totalRefinIntegrado = ($totalRefinIntegrado < 10) ? "<span class='tag success' title='Integrados'>0{$totalRefinIntegrado}</span>" : "<span class='tag success'>{$totalRefinIntegrado}</span>";
        $totalRefinReprovado = ($totalRefinReprovado < 10) ? " <span class='tag alert' title='Reprovados'>0{$totalRefinReprovado}</span>" : " <span class='tag alert'>{$totalRefinReprovado}</span>";
        $totalRefinEmAndamento = ($totalRefinEmAndamento < 10) ? " <span class='tag default' title='Em Andamento'>0{$totalRefinEmAndamento}</span>" : " <span class='tag default'>{$totalRefinEmAndamento}</span>";
        
        $displayRefin = $totalRefinIntegrado . $totalRefinReprovado . $totalRefinEmAndamento;
                
        $totalPortaIntegrado = ($totalPortaIntegrado < 10) ? "<span class='tag success' title='Integrados'>0{$totalPortaIntegrado}</span>" : "<span class='tag success'>{$totalPortaIntegrado}</span>";
        $totalPortaReprovado = ($totalPortaReprovado < 10) ? " <span class='tag alert' title='Reprovados'>0{$totalPortaReprovado}</span>" : " <span class='tag alert'>{$totalPortaReprovado}</span>";
        $totalPortaEmAndamento = ($totalPortaEmAndamento < 10) ? " <span class='tag default' title='Em Andamento'>0{$totalPortaEmAndamento}</span>" : " <span class='tag default'>{$totalPortaEmAndamento}</span>";
        
        $displayPorta = $totalPortaIntegrado . $totalPortaReprovado . $totalPortaEmAndamento;
                
        //Disponibilização de Views do Total Negocial
        $this->addDados('displayNovo', $displayNovo);
        $this->addDados('displayRefin', $displayRefin);
        $this->addDados('displayPorta', $displayPorta);
        
        $this->addDados('tNovoMES', $totalNovoMES);
        $this->addDados('tRefinMES', $totalRefinMES);
        $this->addDados('tPortaMES', $totalPortaMES);
        
        unset($objPessoaLogic, $objPessoaConsultaLogic);
        $this->TPageAdmin('index');
    }

}
