<?php

/**
 * Class responsavel pelos feedback predefinidos no sistema
 * Suportado na versão metro UI v3
 * @author igorsantos
 */
class TFeedbackMetroUIv3Helper {

    /**
     * Verifica se existe uma session feedback
     * @return boolean
     */
    private static function isFeedback() {
        if (isset($_SESSION['feedback'])) {
            return true;
        } else {
            return false;
        }
    }

    private static function getFeedback() {
        return $_SESSION['feedback'];
    }

    private static function deleteFeedback() {
        unset($_SESSION['feedback']);
    }

    public static function notifySuccess($mensagem) {
        $_SESSION['feedback'][]['success'] = $mensagem;
    }

    public static function notifyWarning($mensagem) {
        $_SESSION['feedback'][]['warning'] = $mensagem;
    }

    public static function notifyError($mensagem) {
        $_SESSION['feedback'][]['error'] = $mensagem;
    }

    public static function notifyInfo($mensagem) {
        $_SESSION['feedback'][]['info'] = $mensagem;
    }

    /**
     * Retorna o feedback
     * @return feedback
     */
    public static function displayFeedback() {

        $script = '';

        if (self::isFeedback()) {

            $time = 1000;
            $script .= '<script>';
            $script .= '$(document).ready(function() {';

            foreach (self::getFeedback() as $action) {

                if (isset($action['success'])) {
                    $script .= 'setTimeout(function(){';
                        $script .= self::getNotify('Sucesso!', $action['success'], 'thumbs-up', 'success',10);
                    $script .= '}, ' . $time . ');';
                } elseif (isset($action['warning'])) {
                    $script .= 'setTimeout(function(){';
                        $script .= self::getNotify('Aviso!', $action['warning'], 'notification', 'warning',10);
                    $script .= '}, ' . $time . ');';
                } elseif (isset($action['error'])) {
                    $script .= 'setTimeout(function(){';
                        $script .= self::getNotify('Alerta!', $action['error'], 'thumbs-down', 'alert',10);
                    $script .= '}, ' . $time . ');';
                } elseif (isset($action['info'])) {
                    $script .= 'setTimeout(function(){';
                        $script .= self::getNotify('Informativo!', $action['info'], 'info', 'info');
                    $script .= '}, ' . $time . ');';
                }

                $time += 1000;
            }
            $script .= '});';
            $script .= '</script>';
            self::deleteFeedback();
        }

        return $script;
    }

    private static function getNotify($titulo, $mensagem, $icon, $type = 'default', $time = false) {
        $script = '$.Notify({';
            $script .= "type: '{$type}',";
            $script .= "caption: \"{$titulo}\",";
            $script .= "content: \"{$mensagem}\",";
            $script .= "icon: \"<span class='mif-{$icon}'></span>\",";
            $script .= ($time !== false) ? "timeout: ".self::convetSegundoToMilissegundos($time)."," : '';
            $script .= ($time === false) ? 'keepOpen: true,' : '';
            $script .= 'shadow: true';
        $script .= '});';
        return $script;
    }
    
    
    private static function convetSegundoToMilissegundos($segundos){
        return $segundos * 1000;
    }

}
