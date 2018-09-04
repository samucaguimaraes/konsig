<?php

class CorretorBancoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new CorretorBancoDAO());
    }
    
    public function cadastrar($ObjPageRequisitante = null) {
        $objCorretorBanco = new CorretorBanco();
        $objCorretorBanco->setCorretor($_POST['pessoa']);
        $objCorretorBanco->setBanco($_POST['banco']);
        $objCorretorBanco->setNumeroAgencia($_POST['numeroAgencia']);
        $objCorretorBanco->setNumeroConta($_POST['numeroConta']);
        $objCorretorBanco->setTipoConta($_POST['tipoConta']);
        $objCorretorBanco->setObservacao($_POST['observacao']);
        
        $objCorretorBanco->setUsuarioCriador(SecurityHelper::getInstancia()->getUsuario()->getId());
        $objCorretorBanco->setDataCriacao(date('y-m-d H:i:s'));
        $salvar = $this->salvar($objCorretorBanco,TRUE);
             
        if ($salvar[0]) {
        
            TFeedbackMetroUIv3Helper::notifySuccess('Conta Bancária cadastrada com sucesso!');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getCorretor());
            RedirectorHelper::goToControllerAction('Corretor', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getCorretor());
            RedirectorHelper::goToControllerAction('CorretorBanco', 'cadastrar');
        }
    }
    
    /**
     * 
     * @param type $params
     * @return type
     */
    public function ajaxListSelect2Banco($params) {
       
        $arrayCorretorBanco = $this->listar("ide_corretor = {$params['corretor']}");
        
        if (isset($arrayCorretorBanco[0])) {
            foreach ($arrayCorretorBanco as $objCorretorBanco) {
                $descricao = utf8_encode($objCorretorBanco->getNumeroAgencia()." - ".$objCorretorBanco->getNumeroConta());
                $arrayJson[] = array('value' => $objCorretorBanco->getId(), 'nome' => $descricao);
            }
        } else {
            $arrayJson = false;
        }

        return json_encode($arrayJson);
    }

}