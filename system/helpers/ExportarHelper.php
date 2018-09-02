<?php

include_once MPDF;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FPDFHelper
 * @tutorial Responsavel pela utiliza��o da biblioteca para gera��o de FPDF através
 * de componentes html
 * @author Samuel
 */
class ExportarHelper {
    /*
     * Instancia do Objeto ACTFactory para esta classe.
     */

    private static $instancia = null;
    private $_html;

    /**
     * ACTFactory::getInstancia
     *
     * @package system
     * @subpackage helpers
     * @param Void
     * @return Objeto ACTFactory
     * @tutorial: Verifica se existe uma instancia do Objeto ACTFactory, caso contrario
     * da um new e retorna o objeto
     */
    public static function getInstancia() {
        if (self::$instancia == null) {
            self::$instancia = new ExportarHelper();
        }
        return self::$instancia;
    }

    /**
     * ACTFactory::__clone
     *
     * @package system
     * @subpackage helpers
     * @param Void
     * @return Null
     * @tutorial: Impede que este objeto seja clonado
     * @exception: Clone nao e permitido.
     */
    public function __clone() {
        trigger_error('Clone não é permitido.', E_USER_ERROR);
    }

    public function __construct($html = null) {
        $this->_html = $html;
    }

    public function exportarXLS($html,$nomeArquivoXls) {
        // Determina que o arquivo � uma planilha do Excel
        header("Content-type: application/vnd.ms-excel");

        // For�a o download do arquivo
        header("Content-type: application/force-download");

        // Seta o nome do arquivo
        header("Content-Disposition: attachment; filename={$nomeArquivoXls}.xls");

        header("Pragma: no-cache");

        // Imprime o conte�do da nossa tabela no arquivo que ser� gerado
        echo $html;
    }

    public function exportarPDF($html, $orientation = null,  $header = null,  $marcaDAgua = null, $arquivo = null,  $usuario = null) {

        $this->_html = $html;

        //Alterar tempo maximo para 1200 segundos
        ini_set("max_execution_time", "1200");
        // Aletarar a memoria limit para -1
        ini_set('memory_limit', '-1');

        //inicia o bufferl
        ob_start();

        // Imprimir o html
        echo $this->_html;

        // pega o conteudo do buffer, insere na variavel e limpa a mem�ria
        $html = ob_get_clean();

        // converte o conteudo para uft-8
        //$html = utf8_encode($html);

        // cria o objeto
        $mpdf = new mPDF('pt', 'A4');


        // permite a conversao (opcional)
        $mpdf->allow_charset_conversion = true;

        // converte todo o PDF para utf-8
        $mpdf->charset_in = 'UTF-8';

        //adicionar orienta��o da pagina
        //$mpdf->displayDefaultOrientation = true;
        $orientation = ($orientation != null) ? $orientation : 'P';
        $mpdf->AddPage($orientation);

        //Header
        if ($header != null)
            $mpdf->SetHTMLHeader($header, 'c');

        // Configura��o de Texto como marca d'Agua
        if ($marcaDAgua != null) {
            $mpdf->SetWatermarkText($marcaDAgua, -5);
            $mpdf->watermark_font = 'DejaVuSansCondensed';
        }

        // Quantidade de paginas visualizadas
        //$mpdf->SetDisplayMode('fullpage', 'two');
        // Rodap�

        $mpdf->SetFooter('{DATE j/m/Y H:i}| ' . NAME_SIS . ' |{PAGENO}/{nb}');
        $mpdf->showWatermarkText = true;

        // escreve definitivamente o conteudo no PDF
        $mpdf->WriteHTML($html);

        // imprime
        $mpdf->Output($arquivo, 'I');

        // finaliza o codigo
        exit();
    }

}