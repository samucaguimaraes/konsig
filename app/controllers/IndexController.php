<?php

class IndexController extends TMetroUIv3 {

    public function index() {
        RedirectorHelper::goToAction('login');
    }

    public function login() {
        
        /* Add atribute ao body */
//        $this->HTML->setBodyAttribute('class="bg-darkTeal"');
        
        /* JS */
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "jquery.mask.min.js");
        $this->HTML->addJavaScript(PATH_JS_URL . $this->getController() . "/" . $this->getAction() . ".js");
        /* CSS */
        $this->HTML->addCss(PATH_CSS_URL . $this->getController() . "/" . $this->getAction() . ".css");
        
        $this->TPage('login');
    }

}