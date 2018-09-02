<?php

class PessoaContatoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new PessoaContatoDAO());
    }
    
    public function cadastrar($ObjPageRequisitante = null) {
                
        $objPessoaContato = new PessoaContato();
        $objPessoaContato->setPessoa($_POST['pessoa']);
        $objPessoaContato->setNumero(FormatHelper::unformatTelefone($_POST['numero']));
        $objPessoaContato->setTipoContato($_POST['tipoContato']);
        $objPessoaContato->setDescricao($_POST['descricao']);
        $objPessoaContato->setOperadora($_POST['operadora']);
        
        $objPessoaContato->setUsuarioCriador(SecurityHelper::getInstancia()->getUsuario()->getId());
        $objPessoaContato->setDataCriacao(date('Y-m-d H:i:s'));
        $salvar = $this->salvar($objPessoaContato);
       
        
        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('Contato Pessoal cadastrado com sucesso!');
            $_SESSION['frame'] = 'frameC';
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getPessoa());
            RedirectorHelper::goToControllerAction('Pessoa', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('N�o foi poss�vel cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informa��es');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getPessoa());
            RedirectorHelper::goToControllerAction('PessoaContato', 'cadastrar');
        }
    }
    
    public function atualizar($requisitante, $params = null) {

        $USER_SECURITY = SecurityHelper::getInstancia()->getUsuario();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $_POST['usuarioAtualizador'] = $USER_SECURITY->getId();
            $_POST['dataAtualizacao'] = date('Y-m-d H:i:s');
            
            $salvar = $this->salvar($_POST);

            if ($salvar[0]) {
                TFeedbackMetroUIv3Helper::notifySuccess('Dados atualizados com sucesso!');
                //$_SESSION['frame'] = 'frameR';
                RedirectorHelper::addUrlParameter('id', $_POST['id']);
                RedirectorHelper::goToControllerAction('PessoaContato', 'informar');
            } else {
                TFeedbackMetroUIv3Helper::notifyError('Ocorreu um error na atualização, tente novamente ou contate o administrador!!!');
                RedirectorHelper::addUrlParameter('id', $_POST['id']);
                RedirectorHelper::goToControllerAction($requisitante->modulo, "editar");
            }
        } else {
            TFeedbackMetroUIv3Helper::notifyWarning('É constrangedor, mas tive problemas para processar a operação');
            RedirectorHelper::goToControllerAction("Pessoa", "informar");
        }
    }
    
    public function deletar($requisitante, $params = null) {

        $USER_SECURITY = SecurityHelper::getInstancia()->getUsuario();
        
        if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($params['id'])) {

            $excluir = $this->excluirPorId($params['id']);

            if ($excluir) {
                TFeedbackMetroUIv3Helper::notifySuccess('Dados excluidos com sucesso!');
                //$_SESSION['frame'] = 'frameR';
                RedirectorHelper::addUrlParameter('id', $params['idPessoa']);
                RedirectorHelper::goToControllerAction('Pessoa', 'informar');
            } else {
                TFeedbackMetroUIv3Helper::notifyError('Ocorreu um error na atualização, tente novamente ou contate o administrador!!!');
                RedirectorHelper::addUrlParameter('id', $params['id']);
                RedirectorHelper::goToControllerAction($requisitante->modulo, "informar");
            }
        } else {
            TFeedbackMetroUIv3Helper::notifyWarning('É constrangedor, mas tive problemas para processar a operação');
            RedirectorHelper::addUrlParameter('id', $params['id']);            
            RedirectorHelper::goToControllerAction("PessoaContato", "informar");
        }
    }
    
    public function ajaxListContatosInPessoa($params) {
        
        $colunas = array('num_contato', 'nom_tipo_contato', 'des_contato','ide_operadora');
        /* Criar Ordenacao */
        $order = TDataTableHelper::mountOrderByQuery($colunas, $params['iSortCol_0'], $params['sSortDir_0']);
        /* Montar search */
        $search = TDataTableHelper::mountSearch($colunas, $params['sSearch'], false);

        /* Montar Query */
        $tabela = "(SELECT
                        pessoa_contato.ide_pessoa_contato,
                        pessoa_contato.num_contato,
                        tipo_contato.nom_tipo_contato,
                        pessoa_contato.des_contato,
                        pessoa_contato.ide_operadora
                      FROM 
                        pessoa_contato, 
                        tipo_contato
                      WHERE 
                        pessoa_contato.ide_tipo_contato = tipo_contato.ide_tipo_contato                      
                        AND pessoa_contato.ide_pessoa = ' ". SecurityEncryptionHelper::decrypt($params['idPessoa']) ."'
                ) AS contatos";

        $where = $search;
        /* Total de registros */
        $iTotal = DbORM::totalRegistro('ide_pessoa_contato', $tabela, $where);
        //$iTotal = 10;

        /* redefinir colunas a ser retornada */
        $colunas = implode(',', $colunas);

        /* Obter lista */
        $rWhere = ($where !== null) ? "WHERE {$where}" : '';
        $query = "SELECT ide_pessoa_contato,{$colunas} FROM {$tabela} {$rWhere} ORDER BY {$order} LIMIT {$params['iDisplayLength']} OFFSET {$params['iDisplayStart']}";
        unset($where, $rWhere, $tabela, $order, $colunas);

        $arrayList = DbORM::select($query);

        /* Montar output */
        $output = TDataTableHelper::mountArrayOutPut($params['sEcho'], $iTotal);
        unset($iTotal);
        
        if (isset($arrayList[0])) {
            foreach ($arrayList as $array) {
                $descricao = ($array['des_contato'] != "")? $array['des_contato'] :"<span class='tag default'>Nenhuma descrição detalhada informada.</span>";
                $operadora = "";
                switch ($array['ide_operadora']) {
                    case 1:
                        $operadora = "<span class='tag bg-crimson fg-white place-right'>CLARO</span>";
                        break;
                    case 2:
                        $operadora = "<span class='tag bg-amber fg-white place-right'>OI</span>";
                        break;
                    case 3:
                        $operadora = "<span class='tag bg-darkBlue fg-white place-right'>TIM</span>";
                        break;
                    case 4:
                        $operadora = "<span class='tag bg-violet fg-white place-right'>VIVO</span>";
                        break;
                    default:
                        $operadora = "";
                        break;
                }
                $numero = FormatHelper::formatTelefone($array['num_contato']);
                $tipo = $array['nom_tipo_contato'] . $operadora;
                
                $url = UrlRequestHelper::mountUrl('PessoaContato', 'informar', array('id' => $array['ide_pessoa_contato']));
                $link = "<a href='{$url}' title='Visualizar Contato'><span class=\"mif-eye place-right\"></span></a> " . $numero;
                                
                $output["aaData"][] = array(
                    $link,
                    $tipo,
                    $descricao
                );
            }
        }
        unset($arrayList);

        return json_encode($output);
    }
    
    public function ajaxListContatosInPessoaConsulta($params) {
        
        $colunas = array('num_contato', 'nom_tipo_contato', 'des_contato', 'ide_operadora');
        /* Criar Ordenacao */
        $order = TDataTableHelper::mountOrderByQuery($colunas, $params['iSortCol_0'], $params['sSortDir_0']);
        /* Montar search */
        $search = TDataTableHelper::mountSearch($colunas, $params['sSearch'], false);

        /* Montar Query */
        $tabela = "(SELECT
                        pessoa_contato.ide_pessoa_contato,
                        pessoa_contato.num_contato,
                        tipo_contato.nom_tipo_contato,
                        pessoa_contato.des_contato,
                        pessoa_contato.ide_operadora
                      FROM 
                        pessoa_contato, 
                        tipo_contato
                      WHERE 
                        pessoa_contato.ide_tipo_contato = tipo_contato.ide_tipo_contato                      
                        AND pessoa_contato.ide_pessoa = (SELECT ide_pessoa FROM pessoa_consulta WHERE pessoa_consulta.ide_pessoa_consulta = ' ". SecurityEncryptionHelper::decrypt($params['idPessoaConsulta']) ."')
                ) AS contatos";

        $where = $search;
        /* Total de registros */
        //$iTotal = DbORM::totalRegistro('ide_pessoa_contato', $tabela, $where);
        $iTotal = 10;

        /* redefinir colunas a ser retornada */
        $colunas = implode(',', $colunas);

        /* Obter lista */
        $rWhere = ($where !== null) ? "WHERE {$where}" : '';
        $query = "SELECT ide_pessoa_contato,{$colunas} FROM {$tabela} {$rWhere} ORDER BY {$order} LIMIT {$params['iDisplayLength']} OFFSET {$params['iDisplayStart']}";
        unset($where, $rWhere, $tabela, $order, $colunas);

        $arrayList = DbORM::select($query);

        /* Montar output */
        $output = TDataTableHelper::mountArrayOutPut($params['sEcho'], $iTotal);
        unset($iTotal);
        
        if (isset($arrayList[0])) {
            foreach ($arrayList as $array) {
                $descricao = ($array['des_contato'] != "")? $array['des_contato'] :"<span class='tag default'>Nenhuma descrição detalhada informada.</span>";
                $operadora = "";
                switch ($array['ide_operadora']) {
                    case 1:
                        $operadora = "<span class='tag bg-crimson fg-white place-right'>CLARO</span>";
                        break;
                    case 2:
                        $operadora = "<span class='tag bg-amber fg-white place-right'>OI</span>";
                        break;
                    case 3:
                        $operadora = "<span class='tag bg-darkBlue fg-white place-right'>TIM</span>";
                        break;
                    case 4:
                        $operadora = "<span class='tag bg-violet fg-white place-right'>VIVO</span>";
                        break;
                    default:
                        $operadora = "";
                        break;
                }
                
                $numero = FormatHelper::formatTelefone($array['num_contato']) . $operadora;
                $output["aaData"][] = array(
                    $numero,
                    $array['nom_tipo_contato'],
                    $descricao
                );
            }
        }
        unset($arrayList);

        return json_encode($output);
    }

}