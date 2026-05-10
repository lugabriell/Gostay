<?php

require("functions/env.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$path = __DIR__ . '/../.env';
loadEnv($path);
    
    // $dbHost = '127.0.0.1';
    // $dbUsername = $_ENV['DBUSERNAMEHOSP'];
    // $dbPassword = $_ENV['DBPASSWORDHOSP'];
    // $bancodedados = $_ENV['DBDATABASEHOSP'];

    // $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$bancodedados, 3306);
    // if ($conexao->connect_error) {
    //     die("Erro de conexão: " . $conexao->connect_error);
    // }



    // OPTION LOCAL
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = "";
    $bancodedados = 'idsead';

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$bancodedados, 3306) or die("not connected");


?>
