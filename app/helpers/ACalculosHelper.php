<?php

class ACalculosHelper {

    public static function calcularMargemDisponivel(PessoaConsulta $objPessoaConsulta) {

        $margemDisponivel = 0.00;

        //Margem Reajustada
        $margemDisponivel += FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrMensalidadeReajustada());

        //Créditos
        $margemDisponivel += FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrCompMr());
        $margemDisponivel += FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrSalarioFamilia());
        $margemDisponivel += FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrGratExcomb());
        $margemDisponivel += FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrRffsaNaoTrib());
        $margemDisponivel += FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrComplAcompan());
        $margemDisponivel += FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrOutrasVantagens());
        $margemDisponivel += FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrPlansferRffsa());
        $margemDisponivel += FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrDuplaAtividade());
        $margemDisponivel += FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrGratProdutEct());
        $margemDisponivel += FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrAdicTalidomida());

        //Descontos
        $margemDisponivel -= FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrIrRetidoFonte());
        $margemDisponivel -= FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrDebPensaoAlim());
        $margemDisponivel -= FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrConsignacao());
        $margemDisponivel -= FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrIrExterior());
        $margemDisponivel -= FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrDebitoDifIr());
        $margemDisponivel -= FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrDescontoInss());
        $margemDisponivel -= FormatHelper::unFormatNumeroMonetario($objPessoaConsulta->getVlrTotalContribuicao());

        $margemDisponivel = round($margemDisponivel * 0.3, 2);

        //Empréstimos
        if ($objPessoaConsulta->getEmprestimos() != null) {
            $totalEmprestimo = 0.00;
            foreach ($objPessoaConsulta->getEmprestimos() AS $objPessoaConsultaEmprestimo) {
                if ($objPessoaConsultaEmprestimo->getStatus() == 'A') {
                    $totalEmprestimo += FormatHelper::unFormatNumeroMonetario($objPessoaConsultaEmprestimo->getVlrParcela());
                }
            }
        }

        $margemDisponivel -= $totalEmprestimo;

        return $margemDisponivel;
    }

    public static function calcularParcelasPagas($dataContrato, $totalParcelas) {

        $hoje = new DateTime(date("Y-m-d"));
        $explode = explode("/",$dataContrato);
        $dataContrato = $explode[2].'-'.$explode[1].'-'.$explode[0];
        $dataContrato = new DateTime($dataContrato);
        
        if($dataContrato < $hoje){
            $diferenca = $hoje->diff($dataContrato); //Diferença em meses
            $parcelas = $diferenca->m + ($diferenca->y * 12) + 1; //Soma-se 1 indicando o primeiro desconto na data cheia
        } else {
            $parcelas = 0;
        }
        //var_dump($parcelas);
        return $parcelas;        
    }

}
