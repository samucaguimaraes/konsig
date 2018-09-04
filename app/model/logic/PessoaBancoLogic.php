<?php

class PessoaBancoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new PessoaBancoDAO());
    }
    
    public function cadastrar($ObjPageRequisitante = null) {
        $objPessoaBanco = new PessoaBanco();
        $objPessoaBanco->setPessoa($_POST['pessoa']);
        $objPessoaBanco->setBanco($_POST['banco']);
        $objPessoaBanco->setNumeroAgencia($_POST['numeroAgencia']);
        $objPessoaBanco->setNumeroConta($_POST['numeroConta']);
        $objPessoaBanco->setTipoConta($_POST['tipoConta']);
        $objPessoaBanco->setObservacao($_POST['observacao']);
        
        $objPessoaBanco->setUsuarioCriador(SecurityHelper::getInstancia()->getUsuario()->getId());
        $objPessoaBanco->setDataCriacao(date('y-m-d H:i:s'));
        $salvar = $this->salvar($objPessoaBanco,TRUE);
      
        if ($salvar[0]) {
        
            TFeedbackMetroUIv3Helper::notifySuccess('Conta Bancária cadastrada com sucesso!');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getPessoa()->getId());
            RedirectorHelper::goToControllerAction('Pessoa', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getPessoa());
            RedirectorHelper::goToControllerAction('PessoaBanco', 'cadastrar');
        }
    }

}