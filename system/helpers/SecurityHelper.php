<?php

class SecurityHelper {

    private $usuario;
    private static $instancia = null;
    private $userSession;

    public function __construct() {
        $this->userSession = USER_SESSION;
        /* Validar login */
        if ($this->isLogon()) { /* User logado */
            $this->validUserLogado();
        } else { /* User deslogado */
            $this->validUserDeslogado();
        }
    }

    public static function getInstancia() {
        if (self::$instancia == null) {
            self::$instancia = new SecurityHelper();
        }
        return self::$instancia;
    }

    public function __clone() {
        trigger_error('Clone não é permitido.', E_USER_ERROR);
    }

    private function getTimeSession() {
        return (SessionHelper::isSession('time_session')) ? SessionHelper::getSession('time_session') : 0;
    }

    public function iniciarSessao(Usuario &$objUsuario) {
        SessionHelper::addSession('time_session', time() + TIME_SESSION);
        SessionHelper::addObject($this->userSession, $objUsuario);
    }

    public function destruirSessao() {
        SessionHelper::destroy('time_session');
        SessionHelper::destroy($this->userSession);
        $this->usuario = null;
        $this->userSession = null;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    private function isLogon() {
        return SessionHelper::isSession($this->userSession);
    }

    private function validUserLogado() {

        /* Time atual */
        $time = time();
        /* Time atual + 30 minutos */
        $tempoDeAcesso = $time + TIME_SESSION;

        if ($this->getTimeSession() >= $time) {
            SessionHelper::addSession('time_session',$tempoDeAcesso);
            $this->usuario = unserialize($_SESSION[$this->userSession]);
            if (CurrentUrlHelper::getController() === 'Index') {
                RedirectorHelper::goToIndex();
            }
        } else {
            $this->destruirSessao();
            RedirectorHelper::goToControllerAction('Index', 'login');
        }
    }

    private function validUserDeslogado() {
        $url = str_replace('url=', '', $_SERVER['QUERY_STRING']);
        $flag = (
                stripos($url, 'Security/') === 0 ||
                stripos($url, 'Request/') === 0 ||
                stripos($url, 'Index/resgatar') === 0 ||
                stripos($url, 'Notice/') === 0 ||
                stripos($url, 'Index/login') === 0
                ) ? true : false;
        if (!$flag) {
            RedirectorHelper::goToControllerAction('Index', 'login');
        }
    }

}
