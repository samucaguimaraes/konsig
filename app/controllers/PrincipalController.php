<?php

class PrincipalController extends TMetroUIv3 {

    public function index() {
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");
        $this->TPageMetro('index');
    }
}