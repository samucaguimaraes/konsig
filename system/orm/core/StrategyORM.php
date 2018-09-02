<?php

class StrategyORM {

    public static function getStrategy(&$class) {
        
        $reflection = new ReflectionORM($class);
        $registry = RegistryORM::getInstancia();
        $Dal = ($reflection->getClassAnnotations('@Dal') === '') ? 'default' : $reflection->getClassAnnotations('@Dal');
        $classConn = $registry->getClassConn($Dal);

        $type = array("mysql" => "MySql","sqlite" => "Sqlite", "pgsql" => "PgSql");
        
        if (isset($type[$classConn->type])) {
            $strategy = $type[$classConn->type] . ucfirst($classConn->lib) . "Strategy";
            $registry->set($Dal);
            $conexao = $registry->get($Dal);
            unset($classConn,$Dal);
            return new $strategy($conexao, $reflection);
        } else {
            LogErroORM::gerarLog('Tentativa de Conex„o', 'O tipo da conex„o [' . $classConn->type . '] informada n„o existe, verifique o arquivo de configura√ß√£o de banco de dados');
            unset($classConn,$Dal);
            return false;
        }
        
    }

}