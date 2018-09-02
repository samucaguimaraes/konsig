<?php

/**
 * Classe de log de sistema
 * @author igorsantos
 */
class LogHelper {

    public static function gerarLogPath($path,$msg) {

        $log = "------------------------------------------ LOG (" . date("d-m-Y H:i:s") . ") C/A: {$_SERVER['QUERY_STRING']} ------------------------------------------\n";
        $log .= "#ERROR#: [{$msg}]\n";
        $log .= "#PATH#: [{$path}]\n";
        $log .= "--------------------------------------------------------------------- FIM LOG ---------------------------------------------------------------------\n\n";

        $fopen = fopen(PATH_LOG_SYSTEM, 'a');
        fwrite($fopen, $log);
        fclose($fopen);
    }

    public static function gerarLogAction($controller,$action) {

        $log = "------------------------------------------ LOG (" . date("d-m-Y H:i:s") . ") C/A: {$_SERVER['QUERY_STRING']} ------------------------------------------\n";
        $log .= "#ERROR#: [A action '{$action}' informada não existe no controller '{$controller}]'\n";
        $log .= "--------------------------------------------------------------------- FIM LOG ---------------------------------------------------------------------\n\n";

        $fopen = fopen(PATH_LOG_SYSTEM, 'a');
        fwrite($fopen, $log);
        fclose($fopen);
    }

    public static function gerarLogActionIsPublic($controller,$action) {

        $log = "------------------------------------------ LOG (" . date("d-m-Y H:i:s") . ") C/A: {$_SERVER['QUERY_STRING']} ------------------------------------------\n";
        $log .= "#ERROR#: [A action '{$controller}->{$action}()' informada não é pública]'\n";
        $log .= "--------------------------------------------------------------------- FIM LOG ---------------------------------------------------------------------\n\n";

        $fopen = fopen(PATH_LOG_SYSTEM, 'a');
        fwrite($fopen, $log);
        fclose($fopen);
    }

}