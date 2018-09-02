<?php

/**
 * Criação de url dinamicas para requisição
 * @author igor da hora <igordahora@gmail.com>
 */
class UrlRequestHelper {

    public static function mountUrlPost($logic, $action, Array $params = null, $encrypt = true) {
        
        $param = '';
        if ($params !== null) {
            $dados = array();
            foreach ($params as $key => $value) {
                $dados[] = $key;
                $dados[] = ($encrypt === false) ? $value : SecurityEncryptionHelper::getEncrypt($value);
            }
            $param = '/' . implode('/', $dados);
            unset($dados);
        }
        
        return PATH_URL_SYS."Request/post/l/{$logic}/a/{$action}{$param}";
    }

    public static function mountUrlGet($logic, $action, Array $params = null, $encrypt = true) {
        $param = '';
        if ($params !== null) {
            $dados = array();
            foreach ($params as $key => $value) {
                $dados[] = $key;
                $dados[] = ($encrypt === false) ? $value : SecurityEncryptionHelper::getEncrypt($value);
            }
            $param = '/' . implode('/', $dados);
            unset($dados);
        }
        
        return PATH_URL_SYS."Request/get/l/{$logic}/a/{$action}{$param}";
    }

    public static function mountUrl($controller, $action = 'index', Array $params = null, $encrypt = true) {

        $param = '';
        if ($params !== null) {
            $dados = array();
            foreach ($params as $key => $value) {
                $dados[] = $key;
                $dados[] = ($encrypt === false) ? $value : SecurityEncryptionHelper::getEncrypt($value);
            }
            $param .= '/' . implode('/', $dados);
            unset($dados);
        }
        
        if($action === 'index' && $param === '' ){
            return PATH_URL_SYS . ucfirst($controller);
        }else{
            return PATH_URL_SYS . ucfirst($controller) . "/{$action}{$param}";
        }
    }


}