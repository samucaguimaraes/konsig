<?php

class SecurityLogic {

    public function logar($ObjPageRequisitante = null) {
        $objUsuarioLogic = new UsuarioLogic();
        $email = $_POST['email'];
        $senha = md5($_POST['pwuser']);
      
        $objUsuario = $objUsuarioLogic->obter("des_email = '{$email}' AND des_senha = '{$senha}'");
        unset($objUsuarioLogic, $email, $senha);
        if (is_object($objUsuario)) {
            $objUsuario->setSenha(null);
            $objSecurityHelper = SecurityHelper::getInstancia();
            $objSecurityHelper->iniciarSessao($objUsuario);
            RedirectorHelper::goToIndex();
        } else {
            TFeedbackMetroUIv3Helper::notifyWarning('Login ou Senha invalido, tente novamente');
            RedirectorHelper::goToControllerAction('Index', 'login');
        }
    }

    public function deslogar($ObjPageRequisitante, $params = null) {
        $objSecurityHelper = SecurityHelper::getInstancia();
        $objSecurityHelper->destruirSessao();
        RedirectorHelper::goToControllerAction('Index', 'login');
    }

    public function alterarSenha($ObjPageRequisitante = null) {
        $objUsuarioLogic = new UsuarioLogic();
        $objUsuario = new Usuario();
        $objUsuario->setId($_POST['id']);
        $objUsuario->setSenha($_POST['senha']);

        $salvar = $objUsuarioLogic->salvar($objUsuario);

        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('Senha alterada com sucesso!!!');
            RedirectorHelper::goToIndex();
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possivel alterar devido a um error no sistema, tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::goToControllerAction('Security', 'alterarSenha');
        }
    }

}