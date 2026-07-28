<?php
require_once __DIR__ . "/functions/headers.php";
require_once __DIR__ . "/functions/sessions.php";
function gerarCodigoHex($tamanho=30){
    $bytes = ceil($tamanho/2);
    $codigo = bin2hex(random_bytes($bytes));

    return $codigo; 
}
function gerarCodigoHex2($tamanho){
    $bytes = ceil($tamanho/2);
    $codigo = bin2hex(random_bytes($bytes));

    return $codigo; 
}

?>
