<?php

class PessoaOrgaoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new PessoaOrgaoDAO());
    }

    public function cadastrar($ObjPageRequisitante = null) {

        /* Verificar se email existe */
//        $cfPessoaOrgao = $this->obter("nom_tipo_contato='{$_POST['nome']}'");
//        if (is_object($cfPessoaOrgao)) {
//            TFeedbackMetroUIv3Helper::notifyError('Não foi possivel cadastrar este tipo de contato. Nome já existente!');
//            RedirectorHelper::goToControllerAction('PessoaOrgao', 'cadastrar');
//        }
//        unset($cfPessoaOrgao);

        $objPessoaOrgao = new PessoaOrgao();
        $objPessoaOrgao->setPessoa($_POST['pessoa']);
        $objPessoaOrgao->setOrgao($_POST['orgao']);
        $objPessoaOrgao->setTipoEspecieBeneficio($_POST['tipoEspecieBeneficio']);
        $objPessoaOrgao->setTipoSituacao($_POST['tipoSituacao']);
        $objPessoaOrgao->setMatricula($_POST['matricula']);

        $objPessoaOrgao->setUsuarioCriador(SecurityHelper::getInstancia()->getUsuario()->getId());
        $objPessoaOrgao->setDataCriacao(date('Y-m-d H:i:s'));

        if (isset($_POST['isComissao'])) {
            $objPessoaOrgao->setIsCredencialPublica("A"); //Publicar Credencial
        }

        $objPessoaOrgao->setLogin($_POST['login']);
        $objPessoaOrgao->setSenha($_POST['senha']);

        $salvar = $this->salvar($objPessoaOrgao);

        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('Orgão cadastrado com sucesso!');
            $_SESSION['frame'] = 'frameR';
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getPessoa());
            RedirectorHelper::goToControllerAction('Pessoa', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::goToControllerAction('PessoaOrgao', 'cadastrar');
        }
    }

    public function atualizar($requisitante, $params = null) {

        $USER_SECURITY = SecurityHelper::getInstancia()->getUsuario();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $_POST['usuarioAtualizador'] = $USER_SECURITY->getId();
            $_POST['dataAtualizacao'] = date('Y-m-d H:i:s');

            if (isset($_POST['isCredencialPublica'])) {
                $_POST['isCredencialPublica'] = "A"; //Publicar Credencial
            } else {
                $_POST['isCredencialPublica'] = "D"; //Despublicar Credencial
            }
            
            $salvar = $this->salvar($_POST);

            if ($salvar[0]) {
                TFeedbackMetroUIv3Helper::notifySuccess('Dados atualizados com sucesso!');
                //$_SESSION['frame'] = 'frameR';
                RedirectorHelper::addUrlParameter('id', $_POST['id']);
                RedirectorHelper::goToControllerAction('PessoaOrgao', 'informar');
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

    public function ajaxListOrgaosInPessoa($params) {

        $colunas = array('nom_orgao', 'nom_tipo_situacao', 'num_matricula', 'des_login', 'des_senha');
        /* Criar Ordenacao */
        $order = TDataTableHelper::mountOrderByQuery($colunas, $params['iSortCol_0'], $params['sSortDir_0']);
        /* Montar search */
        $search = TDataTableHelper::mountSearch($colunas, $params['sSearch'], false);

        /* Montar Query */
        $tabela = "(SELECT
                        pessoa_orgao.ide_pessoa_orgao,
                        orgao.nom_orgao,
                        tipo_situacao.nom_tipo_situacao,
                        pessoa_orgao.num_matricula,
                        pessoa_orgao.des_login,
                        pessoa_orgao.des_senha                        
                      FROM 
                        pessoa_orgao, 
                        tipo_situacao,
                        orgao
                      WHERE
                        pessoa_orgao.ide_orgao = orgao.ide_orgao
                        AND pessoa_orgao.ide_tipo_situacao = tipo_situacao.ide_tipo_situacao
                        AND pessoa_orgao.ide_pessoa = ' " . SecurityEncryptionHelper::decrypt($params['idPessoa']) . "'
                ) AS orgaos";

        $where = $search;
        /* Total de registros */
        //$iTotal = DbORM::totalRegistro('ide_pessoa_contato', $tabela, $where);
        $iTotal = 10;

        /* redefinir colunas a ser retornada */
        $colunas = implode(',', $colunas);

        /* Obter lista */
        $rWhere = ($where !== null) ? "WHERE {$where}" : '';
        $query = "SELECT ide_pessoa_orgao,{$colunas} FROM {$tabela} {$rWhere} ORDER BY {$order} LIMIT {$params['iDisplayLength']} OFFSET {$params['iDisplayStart']}";
        unset($where, $rWhere, $tabela, $order, $colunas);

        $arrayList = DbORM::select($query);

        /* Montar output */
        $output = TDataTableHelper::mountArrayOutPut($params['sEcho'], $iTotal);
        unset($iTotal);

        if (isset($arrayList[0])) {
            foreach ($arrayList as $array) {
                //$excluir = "<button class='button mini-button square-button place-right' data-role='hint' data-hint-background='bg-lightBlue' data-hint-color='fg-white' data-hint-mode='2' data-hint='|Excluir Registro' data-hint-position='top' style='margin:-3px 3px -3px 0px;'><span class='icon mif-bin'></span></button>";
                //$editar = "<button onclick=\"redirectUrl('" . UrlRequestHelper::mountUrl('PessoaOrgao', 'editar', array('id' => $array['ide_pessoa_orgao'])) . "')\" class='button mini-button square-button place-right' data-role='hint' data-hint-background='bg-lightBlue' data-hint-color='fg-white' data-hint-mode='2' data-hint='|Editar Registro' data-hint-position='top' style='margin:-3px 3px -3px 0px;'><span class='icon mif-pencil'></span></button>";
                //$acoes = $excluir . " " . $editar;
                $url = UrlRequestHelper::mountUrl('PessoaOrgao', 'informar', array('id' => $array['ide_pessoa_orgao']));
                $link = "<a href='{$url}' title='Visualizar Orgão'><span class=\"mif-eye place-right\"></span></a> " . $array['nom_orgao'];
                
                $credencial = "";
                if ($array['des_login'] != "" OR $array['des_senha'] != "") {
                    $credencial = "<span class='icon mif-key place-right' data-role='hint' data-hint-background='bg-lightBlue' data-hint-color='fg-white' data-hint-mode='2' data-hint='Credencial|Login:{$array['des_login']} Senha:{$array['des_senha']}' data-hint-position='top'></span>";
                }

                $matricula = $array['num_matricula'] . $credencial;

                $output["aaData"][] = array(
                    $link,
                    $array['nom_tipo_situacao'],
                    $matricula
                    //$acoes
                );
            }
        }
        unset($arrayList);

        return json_encode($output);
    }

    public function ajaxListOrgaosInConsulta($params) {

        $colunas = array('nom_orgao', 'nom_tipo_situacao', 'num_matricula');
        /* Criar Ordenacao */
        $order = TDataTableHelper::mountOrderByQuery($colunas, $params['iSortCol_0'], $params['sSortDir_0']);
        /* Montar search */
        $search = TDataTableHelper::mountSearch($colunas, $params['sSearch'], false);

        /* Montar Query */
        $tabela = "(SELECT 
                        pessoa_orgao.ide_pessoa_orgao,
                        orgao.nom_orgao,
                        tipo_situacao.nom_tipo_situacao,
                        pessoa_orgao.num_matricula
                      FROM 
                        pessoa_orgao                        
                        INNER JOIN pessoa ON pessoa_orgao.ide_pessoa = pessoa.ide_pessoa
                        INNER JOIN tipo_situacao ON pessoa_orgao.ide_tipo_situacao = tipo_situacao.ide_tipo_situacao
                        INNER JOIN orgao ON pessoa_orgao.ide_orgao = orgao.ide_orgao
                      WHERE 
                        ide_pessoa_orgao NOT IN( SELECT ide_pessoa_orgao FROM pessoa_consulta WHERE des_status = 'A')
                        AND pessoa.num_cpf = '" . FormatHelper::unformatCPF($params['numCPF']) . "'
                    ) AS orgaos";

        $where = $search;
        /* Total de registros */
        //$iTotal = DbORM::totalRegistro('ide_pessoa_contato', $tabela, $where);
        $iTotal = 10;

        /* redefinir colunas a ser retornada */
        $colunas = implode(',', $colunas);

        /* Obter lista */
        $rWhere = ($where !== null) ? "WHERE {$where}" : '';
        $query = "SELECT ide_pessoa_orgao,{$colunas} FROM {$tabela} {$rWhere} ORDER BY {$order} LIMIT {$params['iDisplayLength']} OFFSET {$params['iDisplayStart']}";
        unset($where, $rWhere, $tabela, $order, $colunas);

        $arrayList = DbORM::select($query);

        /* Montar output */
        $output = TDataTableHelper::mountArrayOutPut($params['sEcho'], $iTotal);
        unset($iTotal);

        if (isset($arrayList[0])) {
            foreach ($arrayList as $array) {
                //$excluir = "<button class='button mini-button rounded square-button place-right' data-role='hint' data-hint-background='bg-lightBlue' data-hint-color='fg-white' data-hint-mode='2' data-hint='|Excluir Registro' data-hint-position='top'><span class='icon mif-bin'></span></button>";
                $url = UrlRequestHelper::mountUrl('PessoaConsulta', 'cadastrar', array('id' => $array['ide_pessoa_orgao']));
                $link = "<a href='{$url}'>" . $array['nom_orgao'] . "</a>";
                $output["aaData"][] = array(
                    $link,
                    $array['nom_tipo_situacao'],
                    $array['num_matricula'],
                        //$excluir
                );
            }
        }
        unset($arrayList);

        return json_encode($output);
    }

}
