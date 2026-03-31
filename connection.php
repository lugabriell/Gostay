<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    header("Permissions-Policy: geolocation=(), camera=(), microphone=()");
require("functions/env.php");

$path = __DIR__ . '/.env';
loadEnv($path);
    // OPTION HOSPEDAGEM
    // $dbHost = 'localhost';
    // $dbUsername = $_ENV['DBUSERNAMEHOSP'];
    // $dbPassword = $_ENV['DBPASSWORDHOSP'];
    // $bancodedados = $_ENV['DBDATABASEHOSP'];

    // $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$bancodedados, 3306) or die("not connected");



    // OPTION LOCAL
    $dbHost = 'localhost';
    $dbUsername = $_ENV['DBUSERNAME'];
    $dbPassword = "";
    $bancodedados = $_ENV['DBDATABASE'];

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$bancodedados, 3306) or die("not connected");


?>
