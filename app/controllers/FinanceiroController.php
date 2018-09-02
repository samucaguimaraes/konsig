<?php

class FinanceiroController extends TMetroUIv3 {

    public function index() {
        
        //$this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");
        
        $objPessoaContratoLogic = new PessoaContratoLogic();
        
        //Contratos Cadastrados DIA
        $tContratosCadastradosHoje = $objPessoaContratoLogic->totalRegistro("DATE_FORMAT(dat_criacao, '%Y-%m-%d') = CURDATE()");
        $tContratosCadastradosOntem = $objPessoaContratoLogic->totalRegistro("dat_criacao BETWEEN DATE_FORMAT(CURDATE()-1,'%Y-%m-%d') AND CURDATE()");        
        //Validando Possibilidade de Variação Percentual
        $this->addDados('tContratoCadastradosHoje', $tContratosCadastradosHoje);
        if($tContratosCadastradosHoje>0 && $tContratosCadastradosOntem>0){
            $variacaoContratoDIA = round((($tContratosCadastradosHoje - $tContratosCadastradosOntem)/$tContratosCadastradosHoje)*100,1);
            $indicadorContratoDIA = ($tContratosCadastradosHoje >= $tContratosCadastradosOntem)? "<span class=\"mif-arrow-up fg-emerald\">{$variacaoContratoDIA}%</span>": "<span class=\"mif-arrow-down fg-red\">{$variacaoContratoDIA}%</span>";
        } else {
            $indicadorContratoDIA = "<span class='tag warning' title='Variação Percentual Indisponível'>N/A</span>";
        }
        $this->addDados('indicadorContratoDIA', $indicadorContratoDIA);
        
        //Contratos Cadastrados MÊS
        $tContratosCadastradosMesAnterior = $objPessoaContratoLogic->totalRegistro("EXTRACT(YEAR_MONTH FROM dat_criacao) BETWEEN EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 1 MONTH) AND EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 1 MONTH)");
        $tContratosCadastradosMesAtual = $objPessoaContratoLogic->totalRegistro("dat_criacao >= DATE_SUB( DATE( NOW() ), INTERVAL DAY( NOW() ) -1 DAY )");
        //Validando Possibilidade de Variação Percentual
        $this->addDados('tContratoCadastradosMes', $tContratosCadastradosMesAtual);
        if($tContratosCadastradosMesAtual>0 && $tContratosCadastradosMesAnterior>0){
            $variacaoContratoMES = round((($tContratosCadastradosMesAtual - $tContratosCadastradosMesAnterior)/$tContratosCadastradosMesAtual)*100,1);
            $indicadorContratoMES = ($tContratosCadastradosMesAtual >= $tContratosCadastradosMesAnterior)? "<span class=\"mif-arrow-up fg-emerald\">{$variacaoContratoMES}%</span>": "<span class=\"mif-arrow-down fg-red\">{$variacaoContratoMES}%</span>";
        } else {
            $indicadorContratoMES = "<span class='tag warning' title='Variação Percentual Indisponível'>N/A</span>";
        }
        $this->addDados('indicadorContratoMES', $indicadorContratoMES);
        
        //Pessoas Cadastradas ANO
        $tContratosCadastradosAnoAnterior = $objPessoaContratoLogic->totalRegistro("DATE_FORMAT(dat_criacao,'%Y') = DATE_FORMAT(CURDATE(),'%Y')-1");
        $tContratosCadastradosAnoAtual = $objPessoaContratoLogic->totalRegistro("DATE_FORMAT(dat_criacao,'%Y') = DATE_FORMAT(CURDATE(),'%Y')");
        //Validando Possibilidade de Variação Percentual
        $this->addDados('tContratoCadastradosAno', $tContratosCadastradosAnoAtual);
        if($tContratosCadastradosAnoAtual>0 && $tContratosCadastradosAnoAnterior>0){
            $variacaoContratoANO = round((($tContratosCadastradosAnoAtual - $tContratosCadastradosAnoAnterior)/$tContratosCadastradosAnoAtual)*100,1);
            $indicadorContratoANO = ($tContratosCadastradosAnoAtual >= $tContratosCadastradosAnoAnterior)? "<span class=\"mif-arrow-up fg-emerald\">{$variacaoContratoANO}%</span>": "<span class=\"mif-arrow-down fg-red\">{$variacaoContratoANO}%</span>";
        } else {
            $indicadorContratoANO = "<span class='tag warning' title='Variação Percentual Indisponível'>N/A</span>";
        }
        $this->addDados('indicadorContratoANO', $indicadorContratoANO);        
  
        
        $this->TPageAdmin('index');
    }

}