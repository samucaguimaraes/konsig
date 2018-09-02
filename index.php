<?php


header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$config = parse_ini_file("system/config/config.ini", true);

// inclui todos os módulos php da path system
foreach ($config["includes"] as $file) {
    require_once "system/" . $file . '.php';
}

// Definir as constante do sistema
Path::getInstancia();

// inicia a aplicação
$start = new System();
$start->run();