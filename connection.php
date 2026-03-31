<?php
require("functions/env.php");

$path = __DIR__ . '/.env';
loadEnv($path);
    // OPTION HOSPEDAGEM
    // $dbHost = 'localhost';
    // $dbUsername = $_ENV['DBUSERNAME'];
    // $dbPassword = $_ENV['DBPASSWORD'];
    // $bancodedados = $_ENV['DBDATABASE'];

    // $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$bancodedados, 3306) or die("not connected");



    // OPTION LOCAL
    $dbHost = 'localhost';
    $dbUsername = $_ENV['DBUSERNAME'];
    $dbPassword = "";
    $bancodedados = $_ENV['DBDATABASE'];

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$bancodedados, 3306) or die("not connected");


?>
