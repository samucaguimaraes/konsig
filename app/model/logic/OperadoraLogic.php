<?php

class OperadoraLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new OperadoraDAO());
    }

}