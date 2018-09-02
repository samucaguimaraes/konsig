<?php

/**
 * Class responsavel para realização calculos matematicos
 *
 * @author igor da hora <igordahora@gmail.com>
 */
class CalculadoraHelper {

    /**
     * <h1>Calcula numero de dias entre duas datas</h1>
     * @param string $data_inicial = '####-##-##'
     * @param string $data_final = '####-##-##'
     * @return interge $dias = Numero de dias
     */
    public static function obterDiferencaEntreDatas($data_inicial, $data_final) {
        /* Usa a função strtotime() e pega o timestamp das duas datas: */
        $time_inicial = strtotime($data_inicial);
        $time_final = strtotime($data_final);
        /* Calcula a diferença de segundos entre as duas datas: */
        $diferenca = $time_final - $time_inicial;
        /* Calcula a diferença de dias */
        $dias = (int) floor($diferenca / (60 * 60 * 24));
        return $dias;
    }

    /**
     * <h1>Adionar dias a data </h1>
     * @param string $data = 'dd/mm/YYYY'
     * @param int $dias = Numeros de dias a adicionar
     * @return interge $data = Data Adicionada formatada 'dd/mm/YYYY'
     */
    public static function adicionarDias($data,$dias) {
        return date('d/m/Y', strtotime("+{$dias} days", strtotime(str_replace('/', '-', $data))));
    }

    /**
     * <h1>Diminuir dias da data </h1>
     * @param string $data = 'dd/mm/YYYY'
     * @param int $dias = Numeros de dias a adicionar
     * @return interge $data = Data diminuida formatada 'dd/mm/YYYY'
     */
    public static function diminuirDias($data,$dias) {
        return date('d/m/Y', strtotime("-{$dias} days", strtotime(str_replace('/', '-', $data))));
    }

}
