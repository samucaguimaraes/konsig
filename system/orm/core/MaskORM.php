<?php

abstract class MaskORM {

    public static function getMask($mascara, $string) {

        $string = str_replace(" ", "", $string);

        for ($i = 0; $i < strlen($string); $i++) {
            $mascara[strpos($mascara, "#")] = $string[$i];
        }

        return $mascara;
    }

    public static function cpfOrCnpj($cpfOrCnpj) {

        if ($cpfOrCnpj !== null) {
            if (strlen($cpfOrCnpj) > 11) {
                /* CNPJ */
                return MaskORM::getMask('##.###.###/####-##', $cpfOrCnpj);
            } else {
                /* CPF */
                return MaskORM::getMask('###.###.###-##', $cpfOrCnpj);
            }
        }


        return null;
    }

    public static function cpf($cpf) {

        if ($cpf !== null) {
            return MaskORM::getMask('###.###.###-##', $cpf);
        }

        return null;
    }

    public static function tituloEleitor($tituloEleitor) {

        if ($tituloEleitor !== null) {
            return MaskORM::getMask('#########/##', $tituloEleitor);
        }

        return null;
    }

    public static function cnpj($cnpj) {

        if ($cnpj !== null) {
            return MaskORM::getMask('##.###.###/####-##', $cnpj);
        }

        return null;
    }

    public static function data($data) {

        if ($data !== null) {
            $data_unformat = substr($data, 6, 2) . substr($data, 4, 2) . substr($data, 0, 4);
            $dia = substr($data_unformat, 0, 2);
            $mes = substr($data_unformat, 2, 2);
            $ano = substr($data_unformat, 4, 4);
            $data = $dia . $mes . $ano;
            return MaskORM::getMask('##/##/####', $data);
        }

        return null;
    }

    public static function numeroAjuste($numero) {

        if ($numero !== null) {
            return MaskORM::getMask('####/####', $numero);
        }

        return null;
    }

    /**
     * Mascka para numero telefone 12345678901
     * @param type $telefone
     * @return type
     */
    public static function telefone($telefone) {

        if ($telefone !== null) {
            $tel = (string) $telefone;
            if (strlen($tel) > 10) {
                return MaskORM::getMask('(##)#####-####', $telefone);
            } else {
                return MaskORM::getMask('(##)####-####', $telefone);
            }
        }

        return null;
    }

    public static function cep($cep) {

        if ($cep !== null) {
            return MaskORM::getMask('#####-###', $cep);
        }

        return null;
    }

    public static function agencia($agencia) {

        if ($agencia !== null) {
            return MaskORM::getMask('####-#', $agencia);
        }

        return null;
    }

    public static function conta($conta) {

        if ($conta !== null) {
            return MaskORM::getMask('###########-#', $conta);
        }

        return null;
    }

    public static function codigoFonteRecurso($codigoFonteRecurso) {

        if ($codigoFonteRecurso !== null) {
            return MaskORM::getMask('#.###.######', $codigoFonteRecurso);
        }

        return null;
    }

    public static function hora($hora) {

        if ($hora !== null) {
            return MaskORM::getMask('##:##', $hora);
        }

        return null;
    }

    public static function datatime($datatime) {

        if ($datatime !== null) {
            return date("d-m-Y H:i:s", $datatime);
        }

        return null;
    }

    public static function monetario($valor) {

        if ($valor !== null) {
            return number_format($valor, 2, ',', '.');
        }

        return null;
    }

    public static function numeroSequencial($numeroSequencial) {
        if ($numeroSequencial !== null) {
            $ano = substr($numeroSequencial, 0, 4);
            $numero = substr($numeroSequencial, 4, 6);
            $numeroSequencial = "{$numero}{$ano}";
            return MaskORM::getMask('######/####', $numeroSequencial);
        }

        return null;
    }

    public static function placa($placa) {

        if ($placa !== null) {
            return MaskORM::getMask('###-####', $placa);
        }

        return null;
    }

}
