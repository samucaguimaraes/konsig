<?php

class ConsultaLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new ConsultaDAO());
    }

}