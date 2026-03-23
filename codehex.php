<?php

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
