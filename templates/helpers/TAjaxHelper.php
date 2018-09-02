<?php

class TAjaxHelper {

    public static function mountArrayObjectToJson($arrayObject, $nome = 'nome', $value = 'id') {

        $array = false;

        # Criar array dos itens a serem retornados
        if ($arrayObject != null) {

            $getNome = 'get' . ucfirst($nome);
            $getValue = "get" . ucfirst($value);

            foreach ($arrayObject as $objeto) {
                $array[] = array('value' => $objeto->$getValue(), 'nome' => $objeto->$getNome());
            }
        }
        unset($arrayObject);
        # Retornar json
        return json_encode($array);
    }

    public static function mountArrayObjectToJsonConcat($arrayObject, $nome = 'nome', $nomeConcat = 'descricao', $value = 'id') {

        $array = false;

        # Criar array dos itens a serem retornados
        if ($arrayObject != null) {

            $getNome = 'get' . ucfirst($nome);
            $getValue = "get" . ucfirst($value);
            $getNomeConcat = "get" . ucfirst($nomeConcat);

            foreach ($arrayObject as $objeto) {
                $array[] = array('value' => $objeto->$getValue(), 'nome' => utf8_encode($objeto->$getNome()) . " - " . utf8_encode($objeto->$getNomeConcat()));
            }
        }
        unset($arrayObject);

        # Retornar json
        return json_encode($array);
    }

}
