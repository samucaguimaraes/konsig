<?php

/**
 * Class de conexão com o banco de dados
 * @author igorsantos
 */
class DbORM {

    public static $conn = null;

    public static function connect() {
        if (DbORM::$conn === null) {
            $Dal = 'default'; 
            /* Inicia a instancia de resgistro de banco de dados */
            $registry = RegistryORM::getInstancia();
            /* Criar registro da conexão */
            $registry->set($Dal);
            DbORM::$conn = $registry->get($Dal);
        }
    }

    public static function limit($limit = null, $offset = null) {
        $pRegistros = '';
        if ($limit !== null) {
            if ($offset !== null) {
                $pRegistros = 'LIMIT ' . $limit . ' OFFSET ' . $offset;
            } else {
                $pRegistros = 'LIMIT ' . $limit;
            }
        }
        return $pRegistros;
    }

    public static function select($query, array $dados = null) {
        /* Faz conexão do o banco */
        DbORM::connect();
        try {
            $prepare = DbORM::$conn->prepare($query);
            if ($dados != null) {
                foreach ($dados as $indice => $value) {
                    $prepare->bindValue(":$indice", $value);
                }
            }
            $prepare->execute();
            $prepare->setFetchMode(PDO::FETCH_ASSOC);
            $rows = $prepare->fetchAll();
            return $rows;
        } catch (Exception $e) {
            LogErroORM::gerarLogSelect($e->getMessage(), $query, $dados);
            return false;
        }
    }

    /**
     * Realiza a operação de select no banco de dados
     * Retorna 1 linha da tabela
     * @param type $query
     * @param array $dados
     * @return boolean 
     */
    public static function obter($query, array $dados = null) {
        /* Faz conexão do o banco */
        DbORM::connect();
        try {

            $prepare = DbORM::$conn->prepare($query);

            if ($dados != null) {
                foreach ($dados as $indice => $value) {
                    $prepare->bindValue(":$indice", $value);
                }
            }

            $prepare->execute();
            $prepare->setFetchMode(PDO::FETCH_ASSOC);
            $row = $prepare->fetch();
            return $row;
        } catch (Exception $e) {
            // Gravar Log
            LogErroORM::gerarLogSelect($e->getMessage(), $query, $dados);
            return false;
        }
    }
        /**
     *
     * @param array $querys array de querys para deletar com segurança BEGIN COMMIT ROLLBACK
     * @param array $dados
     * @return boolean
     * @example  $result = DbORM::executeArrayQuery($query);
     *
     */
    public static function executeArrayQuery($querys) {

        if(count($querys) === 0){
            return true;
        }

        /* Faz conexï¿½o do o banco */
        DbORM::connect();
        // Inserir na base de dados
        try {

            #iniciar transaçao
            DbORM::$conn->beginTransaction();

            foreach ($querys as $query) {

                $prepare = DbORM::$conn->prepare($query);
                # executar query
                $prepare->execute();
//                if (!$result) {
//                    DbORM::$conn->rollBack();
//                    return false;
//                }
            }
            DbORM::$conn->commit();
            return true;
        } catch (Exception $e) {

            DbORM::$conn->rollBack();
            LogErroORM::gerarLog("ExecuteArrayQuery", '<hr>' . $e->getMessage() . '<hr>');
            return false;
        }
    }
    /**
     * Realiza a inserxão no banco de dados
     * @param type $query
     * @param array $dados
     * @param boolean $load = false
     * @return boolean 
     */
    public static function insert($query, array $dados = null) {
        /* Faz conexão do o banco */
        DbORM::connect();
        // Inserir na base de dados
        try {

            #iniciar transação
            DbORM::$conn->beginTransaction();

            $prepare = DbORM::$conn->prepare($query);
           

            if($dados !== null){
                foreach ($dados as $k => $v) {
                    if ($k === 'bytea') {
                        $prepare->bindValue(":{$v['colmap']}", $v['value'], PDO::PARAM_LOB);
                    } else {
                        $prepare->bindValue(":$k", $v);
                    }
                }                
            }

            $prepare->execute();
            $result = DbORM::$conn->lastInsertId();

            DbORM::$conn->commit();
        } catch (Exception $e) {
            DbORM::$conn->rollBack();
            $result = false;
            LogErroORM::gerarLog("INSERT", '<hr>' . $e->getMessage() . '<hr>');
        }

        return $result;
    }
    
    /**
     * Realiza a update no banco de dados
     * @param type $query
     * @param array $dados
     * @param boolean $load = false
     * @return boolean 
     */
    public static function update($query, array $dados = null, $load = false) {

        /* Faz conexão do o banco */
        DbORM::connect();
        // Inserir na base de dados
        try {

            #iniciar transa��o
            DbORM::$conn->beginTransaction();

            $prepare = DbORM::$conn->prepare($query);

            if ($dados !== null) {
                foreach ($dados as $k => $v) {
                    if ($k === 'bytea') {
                        $prepare->bindValue(":{$v['colmap']}", $v['value'], PDO::PARAM_LOB);
                    } else {
                        $prepare->bindValue(":$k", $v);
                    }
                }
            }

            $prepare->execute();

            $result = ($load === false) ? true : $prepare->fetch(PDO::FETCH_ASSOC);

            DbORM::$conn->commit();
        } catch (Exception $e) {
            DbORM::$conn->rollBack();
            $result = false;
            LogErroORM::gerarLog("UPDATE", '<hr>' . $e->getMessage() . '<hr>');
        }

        return $result;
    }
    
    /**
     * Total de registro de uma tabela
     * @param type $where
     * @return total
     */
    public static function totalRegistro($coluna, $tabela, $where = null) {
        /* Faz conexï¿½o do o banco */
        DbORM::connect();
        $where = ($where !== null) ? "WHERE {$where}" : '';
        $query = "SELECT count($coluna) AS total FROM {$tabela} {$where}";
        $totalRegistros = DbORM::obter($query);

        return $totalRegistros['total'];
    }

}
