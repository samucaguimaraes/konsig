<?php

class PessoaConvenioLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new PessoaConvenioDAO());
    }

}