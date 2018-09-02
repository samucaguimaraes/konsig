<?php

class PessoaLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new PessoaDAO());
    }

    public function cadastrar($ObjPageRequisitante = null) {

        $objPessoa = new Pessoa();
        $objPessoa->setNome($_POST['nome']);
        $objPessoa->setApelido($_POST['apelido']);
        $objPessoa->setNumeroCPF($_POST['numeroCPF']);
        $objPessoa->setDataNascimento($_POST['dataNascimento']);
        $objPessoa->setEmail($_POST['email']);
        $objPessoa->setEndereco($_POST['endereco']);
        $objPessoa->setNumeroEndereco($_POST['numeroEndereco']);
        $objPessoa->setComplemento($_POST['complemento']);
        $objPessoa->setBairro($_POST['bairro']);
        $objPessoa->setCidade($_POST['cidade']);
        $objPessoa->setNumeroCEP($_POST['numeroCEP']);

        $objPessoa->setUsuarioCriador(SecurityHelper::getInstancia()->getUsuario()->getId());
        $objPessoa->setObservacao($_POST['observacao']);

        $objPessoa->setDataCriacao(date('Y-m-d H:i:s'));
        $salvar = $this->salvar($objPessoa);

        if ($salvar[0]) {
            TFeedbackMetroUIv3Helper::notifySuccess('Pessoa/Cliente cadastrado com sucesso!');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getId());
            RedirectorHelper::goToControllerAction('Pessoa', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::goToControllerAction('Pessoa', 'cadastrar');
        }
    }

    public function cadastrarSimples($ObjPageRequisitante = null) {

        $objPessoa = new Pessoa();
        $objPessoa->setNome($_POST['nome']);
        $objPessoa->setApelido($_POST['apelido']);
        $objPessoa->setNumeroCPF($_POST['numeroCPF']);
        $objPessoa->setDataNascimento($_POST['dataNascimento']);
        $objPessoa->setEmail($_POST['email']);
        $objPessoa->setEndereco($_POST['endereco']);
        $objPessoa->setNumeroEndereco($_POST['numeroEndereco']);
        $objPessoa->setComplemento($_POST['complemento']);
        $objPessoa->setBairro($_POST['bairro']);
        $objPessoa->setCidade($_POST['cidade']);
        $objPessoa->setNumeroCEP($_POST['numeroCEP']);

        $objPessoa->setUsuarioCriador(SecurityHelper::getInstancia()->getUsuario()->getId());
        $objPessoa->setObservacao($_POST['observacao']);

        $objPessoa->setDataCriacao(date('Y-m-d H:i:s'));
        //echo "<pre>";
        //var_dump($objPessoa);
        //exit();
        $salvar = $this->salvar($objPessoa);
        
        if ($salvar[0]) {

            $objPessoaOrgaoLogic = new PessoaOrgaoLogic();

            $objPessoaOrgao = new PessoaOrgao();
            $objPessoaOrgao->setPessoa($salvar[1]->getId());
            $objPessoaOrgao->setOrgao($_POST['orgao']);
            $objPessoaOrgao->setTipoEspecieBeneficio($_POST['tipoEspecieBeneficio']);
            $objPessoaOrgao->setTipoSituacao($_POST['tipoSituacao']);
            $objPessoaOrgao->setMatricula($_POST['matricula']);

            $objPessoaOrgao->setUsuarioCriador(SecurityHelper::getInstancia()->getUsuario()->getId());
            $objPessoaOrgao->setDataCriacao(date('Y-m-d H:i:s'));

            if (isset($_POST['isCredencialPublica'])) {
                $objPessoaOrgao->setIsCredencialPublica("A"); //Publicar Credencial
            }

            $objPessoaOrgao->setLogin($_POST['login']);
            $objPessoaOrgao->setSenha($_POST['senha']);

            $salvarOrgao = $objPessoaOrgaoLogic->salvar($objPessoaOrgao);

            if ($salvarOrgao[0]) {
                TFeedbackMetroUIv3Helper::notifySuccess('Orgão Pagador cadastrado com sucesso!');
            } else {
                TFeedbackMetroUIv3Helper::notifyError('Não foi possível salvar o Contato Pagador');
            }

            $objPessoaContatoLogic = new PessoaContatoLogic();

            $objPessoaContato = new PessoaContato();
            $objPessoaContato->setPessoa($salvar[1]->getId());
            $objPessoaContato->setNumero($_POST['numero']);
            $objPessoaContato->setTipoContato($_POST['tipoContato']);
            $objPessoaContato->setDescricao($_POST['descricao']);
            $objPessoaContato->setOperadora($_POST['operadora']);
            
            $objPessoaContato->setUsuarioCriador(SecurityHelper::getInstancia()->getUsuario()->getId());
            $objPessoaContato->setDataCriacao(date('Y-m-d H:i:s'));

            $salvarContato = $objPessoaContatoLogic->salvar($objPessoaContato);

            if ($salvarContato[0]) {
                TFeedbackMetroUIv3Helper::notifySuccess('Contato cadastrado com sucesso!');
            } else {
                TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar o Contato');
            }


            TFeedbackMetroUIv3Helper::notifySuccess('Pessoa/Cliente cadastrado com sucesso!');
            RedirectorHelper::addUrlParameter('id', $salvar[1]->getId());
            RedirectorHelper::goToControllerAction('Pessoa', 'informar');
        } else {
            TFeedbackMetroUIv3Helper::notifyError('Não foi possível cadastrar. Um error ocorreu. Tente novamente ou contate o suporte para maiores informações');
            RedirectorHelper::goToControllerAction('Pessoa', 'cadastrar');
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
                RedirectorHelper::addUrlParameter('id', $_POST['id']);
                RedirectorHelper::goToControllerAction('Pessoa', 'informar');
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

    public function ajaxListPessoa($params) {

        /* Atributos do objeto que poderam ser ordenado */
        $atributos = array('nome', 'numeroCPF', 'DataNascimento');
        $order = TDataTableSqliteHelper::mountOrderBy($atributos, $params['iSortCol_0'], $params['sSortDir_0']);
        unset($atributos);
        /* Colunas do banco a serem pesquisandas */
        $colunas = array('nom_pessoa', 'num_cpf', 'dat_nascimento');
        /* Montar search */
        $where = TDataTableSqliteHelper::mountSearch($colunas, $params['sSearch'], false);
        /* Total de registros */
        $iTotal = $this->totalRegistro($where);
        /* Listar */
        $arrayListObject = $this->listar($where, $order, true, null, $params['iDisplayStart'], $params['iDisplayLength']);
        unset($where);
        /* Montar output */
        $output = TDataTableSqliteHelper::mountArrayOutPut($params['sEcho'], $iTotal);
        unset($iTotal);

        if (isset($arrayListObject[0])) {
            $objPessoaConsultaLogic = new PessoaConsultaLogic();
            $objPessoaOrgaoLogic = new PessoaOrgaoLogic();
            foreach ($arrayListObject as $object) {
                
                $tConsulta = $objPessoaConsultaLogic->totalRegistro("ide_pessoa = {$object->getId()} AND des_status = 'A'");
                $tOrgao = $objPessoaOrgaoLogic->totalRegistro("ide_pessoa = {$object->getId()}");
                
                $url = UrlRequestHelper::mountUrl('Pessoa', 'informar', array('id' => $object->getId()));
                $link = "<a href='{$url}' title='Visualizar Cadastro'><span class=\"mif-eye place-right\"></span></a> " . $object->getNome();
                               
                $numeroCPF = $object->getNumeroCPF();
                $numeroCPF.=($tOrgao == 0)?"<span class='tag alert mif-ani-horizontal place-right'>ORGÃO</span>":"";
                $numeroCPF.=($tOrgao > 0 && $tOrgao > $tConsulta)?"<span class='tag warning mif-ani-horizontal place-right'>CONSULTA</span>":"";
//$status = ($object->getStatus()=='A')?"<span class='tag success'>Ativo</span>":"<span class='tag alert'>Desativado</span>";
                //$situacao = ($object->getTipoSituacao()->getId() == 11)?"<span class='tag success'>{$object->getTipoSituacao()->getNome()}</span>":"<span class='tag alert'>{$object->getTipoSituacao()->getNome()}</span>";
                
                $output['aaData'][] = array(
                    $link,
                    $numeroCPF,
                    $object->getDataNascimento()
                );
            }
        }
        unset($arrayListObject);

        return json_encode($output);
    }

    public function ajaxListAniversario($params) {

        $colunas = array('nom_pessoa', 'dat_nascimento');
        /* Criar Ordenacao */
        $order = TDataTableHelper::mountOrderByQuery($colunas, $params['iSortCol_0'], $params['sSortDir_0']);
        /* Montar search */
        $search = TDataTableHelper::mountSearch($colunas, $params['sSearch'], false);

        /* Montar Query */
        $tabela = "(SELECT ide_pessoa, nom_pessoa, dat_nascimento FROM pessoa WHERE SUBSTRING(dat_nascimento,5,2) = '" . date('m') . "') AS A";

        $where = $search;
        /* Total de registros */
        $iTotal = DbORM::totalRegistro('ide_pessoa', $tabela, $where);
        //$iTotal = 10;

        /* redefinir colunas a ser retornada */
        $colunas = implode(',', $colunas);

        /* Obter lista */
        $rWhere = ($where !== null) ? "WHERE {$where}" : '';
        $query = "SELECT ide_pessoa,{$colunas} FROM {$tabela} {$rWhere} ORDER BY SUBSTRING(dat_nascimento,7,2) ASC, {$order} LIMIT {$params['iDisplayLength']} OFFSET {$params['iDisplayStart']}";
        unset($where, $rWhere, $tabela, $order, $colunas);

        $arrayList = DbORM::select($query);

        /* Montar output */
        $output = TDataTableHelper::mountArrayOutPut($params['sEcho'], $iTotal);
        unset($iTotal);

        if (isset($arrayList[0])) {
            $objPessoaContatoLogic = new PessoaContatoLogic();
            foreach ($arrayList as $array) {
                $listContatos = $objPessoaContatoLogic->listar("ide_pessoa = " . $array['ide_pessoa'] . "");
                if ($listContatos!=null) {
                    $contatos = "";
                    foreach ($listContatos as $contato) {
                        switch ($contato->getOperadora()) {
                            case 1:
                                $operadora = "<span class='fg-crimson'>{$contato->getNumero()}</span>";
                                break;
                            case 2:
                                $operadora = "<span class='fg-amber'>{$contato->getNumero()}</span>";
                                break;
                            case 3:
                                $operadora = "<span class='fg-darkBlue'>{$contato->getNumero()}</span>";
                                break;
                            case 4:
                                $operadora = "<span class='fg-violet'>{$contato->getNumero()}</span>";
                                break;
                            default:
                                $operadora = "<span class='fg-grayDarker'>{$contato->getNumero()}</span>";
                                break;
                        }
                        $contatos.=$operadora . " ";
                    }
                }

                $dataNascimento = FormatHelper::formatData(FormatHelper::dataInversaToNormal($array['dat_nascimento']));
                $idade = DataHelper::calcularIdade(FormatHelper::formatData(FormatHelper::dataInversaToNormal($array['dat_nascimento']))) + 1;
                $hoje = date('md');
                if (substr($array['dat_nascimento'], -4) == $hoje) {
                    $pessoa = $array['nom_pessoa'] . "<span class='tag info place-right'>é hoje!</span>";
                } else {
                    $pessoa = $array['nom_pessoa'];
                }

                $output["aaData"][] = array(
                    $pessoa,
                    $dataNascimento,
                    $idade,
                    $contatos
                );
            }
        }
        unset($arrayList);

        return json_encode($output);
    }

    /**
     * AJAX
     * Verifica se o colaborador não existe no sistema
     * Se não existir retorna false caso exista retorna true
     * @return bollean
     */
    public function ajaxIsPessoaNotInSystem($param) {
        $cpf = FormatHelper::unformatCPF($param['cpf']);
        $pessoa = $this->obter("num_cpf = '{$cpf}'");
        return (is_object($pessoa)) ? 'true' : 'false';
    }

    /**
     * AJAX
     * Retorna se existem pessoas aniversariando hoje
     * Se não existir retorna false caso exista retorna true
     * @return bollean
     */
    public function ajaxIsPessoaAniversario() {
        $hoje = date('md');
        $totalAniversario = $this->totalRegistro("SUBSTRING(dat_nascimento,5,4) = '{$hoje}'");
        return ($totalAniversario > 0) ? 'true' : 'false';
    }

    /**
     * AJAX
     * Verifica se o colaborador não existe no sistema
     * Se não existir retorna false caso exista retorna true
     * @return bollean
     */
    public function ajaxObterDadosPessoa($param) {
        $cpf = FormatHelper::unformatCPF($param['numeroCPF']);
        $pessoa = $this->obter("num_cpf = '{$cpf}'");

        $output['aaData'][] = array(
            $pessoa->getNome()
        );

        return json_encode($output);
    }

}
