<?php

class EstadoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new EstadoDAO());
    }

}