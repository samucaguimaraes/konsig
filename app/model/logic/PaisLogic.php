<?php

class PaisLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new PaisDAO());
    }

}