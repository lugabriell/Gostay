<?php

    // OPTION HOSPEDAGEM
    // $dbHost = 'localhost';
    // $dbUsername = 'idsedu66_idsead';
    // $dbPassword = 'Lucas@2110';
    // $bancodedados = 'idsedu66_idsead';

    // $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$bancodedados, 3306) or die("not connected");



    // OPTION LOCAL
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $bancodedados = 'idsead';

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$bancodedados, 3306) or die("not connected");

?>
