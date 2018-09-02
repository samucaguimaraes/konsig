<?php

/**
 * A class dar suporte a criação de menus laterais nas paginas administrativas
 * @author igor da Hora <igordahora@gmail.com>
 */
class ASiderBarHelper {

    public static function start() {
        $html = '';
        $method = ASiderBarHelper::map();
        if ($method) {
            $html .= '<ul class="sidebar">';
            $html .= ASiderBarHelper::$method();
            $html .= '</ul>';
        }
        return $html;
    }

    public static function map() {

        /* Mapeamento */
        $map = array();

        /* Seguranca */
        $map['Seguranca'] = 'getSiderBarSeguranca';
        $map['Usuario'] = 'getSiderBarSeguranca';
        $map['Perfil'] = 'getSiderBarSeguranca';
        $map['Funcionalidade'] = 'getSiderBarSeguranca';
        $map['PainelControle'] = 'getSiderBarSeguranca';
        $map['Tipologia'] = 'getSiderBarTipologia';
        $map['TipoSituacao'] = 'getSiderBarTipologia';
        $map['TipoOrgao'] = 'getSiderBarTipologia';
        $map['TipoContato'] = 'getSiderBarTipologia';
        $map['TipoContrato'] = 'getSiderBarTipologia';
        $map['TipoEspecieBeneficio'] = 'getSiderBarTipologia';
        $map['Gestao'] = 'getSiderBarGestao';
        $map['Marketing'] = 'getSiderBarGestao';
        $map['Telemarketing'] = 'getSiderBarGestao';
        //$map['Financeiro'] = 'getSiderBarGestao';
        $map['Pessoa'] = 'getSiderBarGestao';
        $map['Notificacao'] = 'getSiderBarGestao';
        $map['PessoaContato'] = 'getSiderBarGestao';
        $map['PessoaBanco'] = 'getSiderBarGestao';
        $map['PessoaOrgao'] = 'getSiderBarGestao';
        $map['PessoaConsulta'] = 'getSiderBarGestao';
        $map['PessoaConsultaEmprestimo'] = 'getSiderBarGestao';
        $map['PessoaContrato'] = 'getSiderBarGestao';
        $map['Auxiliar'] = 'getSiderBarAuxiliar';
        $map['Banco'] = 'getSiderBarAuxiliar';
        $map['Orgao'] = 'getSiderBarAuxiliar';
        $map['Convenio'] = 'getSiderBarAuxiliar';
        $map['Parceiro'] = 'getSiderBarAuxiliar';
        $map['Comissao'] = 'getSiderBarAuxiliar';
        $map['Simulador'] = 'getSiderBarAuxiliar';
        $map['Corretor'] = 'getSiderBarAuxiliar';
        $map['Warning'] = 'getSiderBarErro';
        

        if (isset($map[CurrentUrlHelper::getController()])) {
            return $map[CurrentUrlHelper::getController()];
        } else {
            return false;
        }
    }

    public static function getHtmlMenu($title, $icon, $url, $active = false, $total = null) {
        $act = ($active) ? ' class="active"' : '';
        $html = '';
        $html .= "<li{$act}>";
        $html .= '<a href="' . $url . '">';
        $html .= '<span class="mif-' . $icon . ' icon"></span>';
        $html .= '<span class="title">' . $title . '</span>';
        if ($total !== null) {
            $html .= '<span class="counter">' . $total . '</span>';
        }
        $html .= '</a>';
        $html .= '</li>';
        return $html;
    }

    public static function getSiderBarSeguranca() {
       
        $objUsuarioLogic = new UsuarioLogic();
        $totalUsuarios = (int) $objUsuarioLogic->totalRegistro();
        $tUsuarios = ($totalUsuarios < 10) ? "0{$totalUsuarios}" : $totalUsuarios;
        unset($objUsuarioLogic, $totalUsuarios);

        $html = '';
        $html .= ASiderBarHelper::getHtmlMenu('Segurança', 'apps', UrlRequestHelper::mountUrl('Seguranca'), (CurrentUrlHelper::getController() === 'Seguranca') ? true : false, '1 Usuário Online');
        $html .= ASiderBarHelper::getHtmlMenu('Usuário', 'user-check', UrlRequestHelper::mountUrl('Usuario'), (CurrentUrlHelper::getController() === 'Usuario') ? true : false, $tUsuarios);
        $html .= ASiderBarHelper::getHtmlMenu('Perfil', 'users', UrlRequestHelper::mountUrl('Perfil'), (CurrentUrlHelper::getController() === 'Perfil') ? true : false, $tUsuarios);
        $html .= ASiderBarHelper::getHtmlMenu('Funcionalidade', 'cogs', UrlRequestHelper::mountUrl('Funcionalidade'), (CurrentUrlHelper::getController() === 'Funcionalidade') ? true : false, $tUsuarios);
        $html .= ASiderBarHelper::getHtmlMenu('Painel Controle', 'equalizer-v', UrlRequestHelper::mountUrl('PainelControle'), (CurrentUrlHelper::getController() === 'PainelControle') ? true : false);
        return $html;
    }
    
    public static function getSiderBarErro() {
       
        //$objUsuarioLogic = new UsuarioLogic();
        //$totalUsuarios = (int) $objUsuarioLogic->totalRegistro();
        //$tUsuarios = ($totalUsuarios < 10) ? "0{$totalUsuarios}" : $totalUsuarios;
        //unset($objUsuarioLogic, $totalUsuarios);

        $html = '';
        $html .= ASiderBarHelper::getHtmlMenu('Voltar a Home', 'home', UrlRequestHelper::mountUrl('Principal'),true,'Erro Encontrado.');
        return $html;
    }
    
    public static function getSiderBarAuxiliar() {
       
        $objBancoLogic = new BancoLogic();
        $totalBancos = (int) $objBancoLogic->totalRegistro();
        $tBancos = ($totalBancos < 10) ? "0{$totalBancos}" : $totalBancos;
        unset($objBancoLogic, $totalBancos);
        
        $objOrgaoLogic = new OrgaoLogic();
        $totalOrgaos = (int) $objOrgaoLogic->totalRegistro();
        $tOrgaos = ($totalOrgaos < 10) ? "0{$totalOrgaos}" : $totalOrgaos;
        unset($objOrgaoLogic, $totalOrgaos);
        
        $objConvenioLogic = new ConvenioLogic();
        $totalConvenios = (int) $objConvenioLogic->totalRegistro();
        $tConvenios = ($totalConvenios < 10) ? "0{$totalConvenios}" : $totalConvenios;
        unset($objConvenioLogic, $totalConvenios);
        
        $objParceiroLogic = new ParceiroLogic();
        $totalParceiros = (int) $objParceiroLogic->totalRegistro();
        $tParceiros = ($totalParceiros < 10) ? "0{$totalParceiros}" : $totalParceiros;
        unset($objParceiroLogic, $totalParceiros);
        
        $objCorretorLogic = new CorretorLogic();
        $totalCorretores = (int) $objCorretorLogic->totalRegistro();
        $tCorretores = ($totalCorretores < 10) ? "0{$totalCorretores}" : $totalCorretores;
        unset($objCorretorLogic, $totalCorretores);

        $html = '';
        $html .= ASiderBarHelper::getHtmlMenu('Auxiliares', 'apps', UrlRequestHelper::mountUrl('Auxiliar'), (CurrentUrlHelper::getController() === 'Auxiliar') ? true : false);
        $html .= ASiderBarHelper::getHtmlMenu('Banco', 'library', UrlRequestHelper::mountUrl('Banco'), (CurrentUrlHelper::getController() === 'Banco') ? true : false, $tBancos);
        $html .= ASiderBarHelper::getHtmlMenu('Orgãos', 'windows', UrlRequestHelper::mountUrl('Orgao'), (CurrentUrlHelper::getController() === 'Orgao') ? true : false, $tOrgaos);
        $html .= ASiderBarHelper::getHtmlMenu('Convênios', 'clipboard', UrlRequestHelper::mountUrl('Convenio'), (CurrentUrlHelper::getController() === 'Convenio') ? true : false, $tConvenios);
        $html .= ASiderBarHelper::getHtmlMenu('Parceiros', 'shop', UrlRequestHelper::mountUrl('Parceiro'), (CurrentUrlHelper::getController() === 'Parceiro') ? true : false, $tParceiros);
        $html .= ASiderBarHelper::getHtmlMenu('Comissão', 'dollars', UrlRequestHelper::mountUrl('Comissao'), (CurrentUrlHelper::getController() === 'Comissao') ? true : false);
        $html .= ASiderBarHelper::getHtmlMenu('Simulador', 'calculator2', UrlRequestHelper::mountUrl('Simulador'), (CurrentUrlHelper::getController() === 'Simulador') ? true : false);
        $html .= ASiderBarHelper::getHtmlMenu('Corretores', 'suitcase', UrlRequestHelper::mountUrl('Corretor'), (CurrentUrlHelper::getController() === 'Corretor') ? true : false, $tCorretores);
        
        return $html;
    }
    
    public static function getSiderBarTipologia() {
       
        $objTipoSituacaoLogic = new TipoSituacaoLogic();
        $totalTipoSituacao = (int) $objTipoSituacaoLogic->totalRegistro();
        $tTipoSituacao = ($totalTipoSituacao < 10) ? "0{$totalTipoSituacao}" : $totalTipoSituacao;
        
        $objTipoOrgaoLogic = new TipoOrgaoLogic();
        $totalTipoOrgao = (int) $objTipoOrgaoLogic->totalRegistro();
        $tTipoOrgao = ($totalTipoOrgao < 10) ? "0{$totalTipoOrgao}" : $totalTipoOrgao;
        
        $objTipoContatoLogic = new TipoContatoLogic();
        $totalTipoContato = (int) $objTipoContatoLogic->totalRegistro();
        $tTipoContato = ($totalTipoContato < 10) ? "0{$totalTipoContato}" : $totalTipoContato;
        
        $objTipoEspecieBeneficioLogic = new TipoEspecieBeneficioLogic();
        $totalTipoEspecieBeneficio = (int) $objTipoEspecieBeneficioLogic->totalRegistro();
        $tTipoEspecieBeneficio = ($totalTipoEspecieBeneficio < 10) ? "0{$totalTipoEspecieBeneficio}" : $totalTipoEspecieBeneficio;
        
        $objTipoContratoLogic = new TipoContratoLogic();
        $totalTipoContrato = (int) $objTipoContratoLogic->totalRegistro();
        $tTipoContrato = ($totalTipoContrato < 10) ? "0{$totalTipoContrato}" : $totalTipoContrato;
        
        unset($objTipoSituacaoLogic, $totalTipoSituacao, $totalTipoOrgao, $totalTipoContato, $totalTipoEspecieBeneficio, $objTipoContratoLogic, $totalTipoContrato);
        
        $html = '';
        $html .= ASiderBarHelper::getHtmlMenu('Tipologia', 'apps', UrlRequestHelper::mountUrl('Tipologia'), (CurrentUrlHelper::getController() === 'Tipologia') ? true : false);
        $html .= ASiderBarHelper::getHtmlMenu('Situação', 'tags', UrlRequestHelper::mountUrl('TipoSituacao'), (CurrentUrlHelper::getController() === 'TipoSituacao') ? true : false, $tTipoSituacao);
        $html .= ASiderBarHelper::getHtmlMenu('Orgão', 'location-city', UrlRequestHelper::mountUrl('TipoOrgao'), (CurrentUrlHelper::getController() === 'TipoOrgao') ? true : false, $tTipoOrgao);
        $html .= ASiderBarHelper::getHtmlMenu('Contato', 'perm-phone-msg', UrlRequestHelper::mountUrl('TipoContato'), (CurrentUrlHelper::getController() === 'TipoContato') ? true : false, $tTipoContato);
        $html .= ASiderBarHelper::getHtmlMenu('Espécie Beneficio', 'stack', UrlRequestHelper::mountUrl('TipoEspecieBeneficio'), (CurrentUrlHelper::getController() === 'TipoEspecieBeneficio') ? true : false, $tTipoEspecieBeneficio);
        $html .= ASiderBarHelper::getHtmlMenu('Contrato', 'file-text', UrlRequestHelper::mountUrl('TipoContrato'), (CurrentUrlHelper::getController() === 'TipoContrato') ? true : false, $tTipoContrato);
        
        return $html;
    }
    
    public static function getSiderBarGestao() {
       
        $objPessoaLogic = new PessoaLogic();
        $totalPessoas = (int) $objPessoaLogic->totalRegistro();
        $tPessoas = ($totalPessoas < 10) ? "0{$totalPessoas}" : $totalPessoas;
        unset($objPessoaLogic, $totalPessoas);
        
        $objPessoaContratoLogic = new PessoaContratoLogic();
        $totalPessoaContratosI = (int) $objPessoaContratoLogic->totalRegistro("ide_tipo_situacao = 16");
        $tPessoaContratosI = ($totalPessoaContratosI < 10) ? "<span class='tag success' title='Integrados'>0{$totalPessoaContratosI}</span>" : "<span class='tag success'>{$totalPessoaContratosI}</span>";
        
        $totalPessoaContratosR = (int) $objPessoaContratoLogic->totalRegistro("ide_tipo_situacao = 17");
        $tPessoaContratosR = ($totalPessoaContratosR < 10) ? " <span class='tag alert no-tablet' title='Reprovados'>0{$totalPessoaContratosR}</span>" : " <span class='tag alert'>{$totalPessoaContratosR}</span>";
        
        $totalPessoaContratosA = (int) $objPessoaContratoLogic->totalRegistro("ide_tipo_situacao = 10");
        $tPessoaContratosA = ($totalPessoaContratosA < 10) ? " <span class='tag default no-tablet' title='Em Andamento'>0{$totalPessoaContratosA}</span>" : " <span class='tag default'>{$totalPessoaContratosA}</span>";
        
        unset($objPessoaContratoLogic, $totalPessoaContratos);
        
        $hoje = date("Y-m-d");
        $objPessoaConsultaLogic = new PessoaConsultaLogic();
        $totalPessoaConsulta = (int) $objPessoaConsultaLogic->totalRegistro("dat_criacao >= '{$hoje}'");
        $tPessoaConsulta = ($totalPessoaConsulta == 0) ? "Nenhuma Hoje" : "Hoje: ".$totalPessoaConsulta;
                
        //Verificações de Alerta Consultas
        //$objPessoaConsultaEmprestimoLogic = new PessoaConsultaEmprestimoLogic();
        
        //$tHiscon = $objPessoaConsultaEmprestimoLogic->totalRegistro("ide_convenio IS NULL");
        //$tMargem = $objPessoaConsultaLogic->totalRegistro("vlr_margem_disponivel IS NULL");
        /*
        $alertConsulta = "";
        
        if($tHiscon>0){
            $tPessoaConsulta = "";
            $alertConsulta.= "<span class='tag warning mif-ani-horizontal place-right no-tablet'>HISCON</span>";
        }
        
        if($tMargem>0){
            $tPessoaConsulta = "";
            $alertConsulta.= "<span class='tag alert mif-ani-horizontal place-right no-tablet'>MARGEM</span>";
        }
        */
        
        unset($objPessoaConsultaLogic, $totalPessoaConsulta);
        $html = '';
        $html .= ASiderBarHelper::getHtmlMenu('Gestão', 'apps', UrlRequestHelper::mountUrl('Gestao'), (CurrentUrlHelper::getController() === 'Gestao') ? true : false);
        $html .= ASiderBarHelper::getHtmlMenu('Pessoas', 'organization', UrlRequestHelper::mountUrl('Pessoa'), (CurrentUrlHelper::getController() === 'Pessoa') ? true : false, $tPessoas);
        $html .= ASiderBarHelper::getHtmlMenu('Contratos', 'cabinet', UrlRequestHelper::mountUrl('PessoaContrato'), (CurrentUrlHelper::getController() === 'PessoaContrato') ? true : false, $tPessoaContratosI.$tPessoaContratosR.$tPessoaContratosA);
        $html .= ASiderBarHelper::getHtmlMenu('Consultas', 'search', UrlRequestHelper::mountUrl('PessoaConsulta'), (CurrentUrlHelper::getController() === 'PessoaConsulta') ? true : false, $tPessoaConsulta);
        //$html .= ASiderBarHelper::getHtmlMenu('Financeiro', 'dollar2', UrlRequestHelper::mountUrl('Financeiro'), (CurrentUrlHelper::getController() === 'Financeiro') ? true : false);
        $html .= ASiderBarHelper::getHtmlMenu('Marketing', 'mail-read', UrlRequestHelper::mountUrl('Marketing'), (CurrentUrlHelper::getController() === 'Marketing') ? true : false);
        $html .= ASiderBarHelper::getHtmlMenu('Telemarketing', 'ring-volume', UrlRequestHelper::mountUrl('Telemarketing'), (CurrentUrlHelper::getController() === 'Telemarketing') ? true : false,"<span class='no-tablet'>Hoje: 10 Ligações</span>");
        return $html;
    }
    

}
