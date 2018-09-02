<?php

/**
 * Description of Win8
 * @author igor
 */
class TErrors extends Controller {

    public $HTML;
    public $SECURITY;

    public function __construct() {

        parent::__construct();

        # Constantes
        define("TEMPLATE", 'TMetroUIv3');
        define("PATH_DIR_TEMPLATE_URL", PATH_TEMPLATE_URL . TEMPLATE . "/");
        define("PATH_TEMPLATE_JS_URL", PATH_DIR_TEMPLATE_URL . "js/");
        define("PATH_TEMPLATE_CSS_URL", PATH_DIR_TEMPLATE_URL . "css/");
        define("PATH_TEMPLATE_IMAGE_URL", PATH_DIR_TEMPLATE_URL . "images/");

        $this->HTML = new THtmlHelper();
        $this->SECURITY = SecurityHelper::getInstancia();
    }

    public function init() {

        parent::init();

        /* Meta Tag */
        $this->HTML->addMetaCharset();
        $this->HTML->addMetaTag("http-equiv='X-UA-Compatible' content='IE=edge'");
        $this->HTML->addMetaViewport();

        /* Definir icone do sistema */
        $this->HTML->setIcon(PATH_IMAGE_URL . "favicon.ico");

        /* Definir nome da pagina */
        $this->HTML->setTitle(strtoupper(NAME_SIS) . " - {$this->getController()}/{$this->getAction()}");

        /* JS */
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . "core.js", true); //3 a entrar
        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "metro.js", true); //2 a entrar
        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "jquery-2.1.3.min.js", true); //1 a entrar

        /* CSS */
        $this->HTML->addCss(PATH_TEMPLATE_CSS_URL . "metro-icons.css", true); //2 entrar
        $this->HTML->addCss(PATH_TEMPLATE_CSS_URL . "metro.css", true); //1 entrar
    }

    private function viewPageSecondary($content) {
        $dados = array();
        $dados['content'] = $content;
        extract($dados, EXTR_PREFIX_ALL, 'tView');
        unset($dados);

        $path = VIEWS . "core/" . TEMPLATE . '/secundary.phtml';

        if (!file_exists($path)) {
            LogHelper::gerarLogPath($path, 'O path informado não existe em nossa base');
            RedirectorHelper::goToControllerAction("Warning", "VIEW_404");
        }

        return require_once ( $path );
    }

    public function TPageSecondary($nome) {

        /* JS */
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . TEMPLATE . "/TPageSecondary.js");
        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "prettify/run_prettify.js");

        /* CSS */
        $this->HTML->addCss(PATH_TEMPLATE_CSS_URL . "metro-responsive.css");
        $this->HTML->addCss(PATH_TEMPLATE_CSS_URL . "metro-schemes.css");
        $this->HTML->addCss(PATH_CSS_CORE_URL . TEMPLATE . "/TPageSecondary.css");
        

        /* Inicia o buffer */
        ob_start();

        $this->view($nome);

        /* Pegar html e alocar numa variavel */
        $conteudo = ob_get_clean();

        /* Inicia o buffer */
        ob_start();

        $this->viewPageSecondary($conteudo);

        /* Pegar html e alocar numa variavel */
        $content = ob_get_clean();
        unset($conteudo);

        /* Adiconar css de customização */
        if (file_exists(PATH_CSS_CORE . "custom.css")) {
            $this->HTML->addCss(PATH_CSS_CORE_URL . "custom.css");
        }

        /* Adicionar a view ao Body */
        $this->HTML->setBodyContent($content);

        /* Imprime o HTML */
        echo $this->HTML->getHtml();
    }
    
    private function viewAdmin($content) {
        $arrayNome = FormatHelper::quebrarNome($this->SECURITY->getUsuario()->getNome());
        $dados = array();
        $dados['content'] = $content;
        $dados['modulo'] = $this->getController();
        $dados['nomeUsuario'] = current($arrayNome) . ' ' . end($arrayNome);
        $dados['idUsuario'] = $this->SECURITY->getUsuario()->getId();
        extract($dados, EXTR_PREFIX_ALL, 'tView');
        unset($dados, $arrayNome);

        $path = VIEWS . "core/" . TEMPLATE . '/administrativo.phtml';

        if (!file_exists($path)) {
            LogHelper::gerarLogPath($path, 'O path informado não existe em nossa base');
            RedirectorHelper::goToControllerAction("Warning", "VIEW_404");
        }

        return require_once ( $path );
    }
    
    public function TPageAdmin($nome) {
        /* Add atribute ao body */
        $this->HTML->setBodyAttribute('class="bg-steel"');
        /* JS */
        $this->HTML->addJavaScript(PATH_TEMPLATE_JS_URL . "jquery.dataTables.min.js"); //2 a entrar
        $this->HTML->addJavaScript(PATH_JS_CORE_URL . TEMPLATE . "/TPageAdmin.js");
        /* CSS */
        $this->HTML->addCss(PATH_TEMPLATE_CSS_URL . "metro-responsive.css"); //1 entrar
        $this->HTML->addCss(PATH_CSS_CORE_URL . TEMPLATE . "/TPageAdmin.css");

        /* Inicia o buffer */
        ob_start();

        $this->view($nome);

        /* Pegar html e alocar numa variavel */
        $conteudo = ob_get_clean();

        /* Inicia o buffer */
        ob_start();

        $this->viewAdmin($conteudo);

        /* Pegar html e alocar numa variavel */
        $content = ob_get_clean();
        unset($conteudo);

        /* Adiconar css de customização */
        if (file_exists(PATH_CSS_CORE . "core/custom.css")) {
            $this->HTML->addCss(PATH_CSS_CORE_URL . "custom.css");
        }

        /* Adicionar a view ao Body */
        $this->HTML->setBodyContent($content);
        unset($content);
        /* Imprime o HTML */
        echo $this->HTML->getHtml();
    }

}