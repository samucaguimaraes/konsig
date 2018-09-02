<?php

class SqliteDrive {

    private $classConn;

    public function __construct(&$classConn) {
        $this->classConn = $classConn;
    }

    public function getConn() {
        $dados = $this->classConn;
        try {
            $path_db = "{$dados->server}{$dados->database}.db";
            $conn = new PDO("{$dados->type}:{$path_db}");
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $conn->exec('PRAGMA encoding = "UTF-8"');
            unset($path_db);
            return $conn;
        } catch (Exception $e) {
            LogErroORM::gerarLog("CONEXÃO - NÃO FOI POSSIVEL ESTABELECER UMA CONEXÃO COM O SERVIDOR", $e->getMessage());
            return false;
        }
    }

}