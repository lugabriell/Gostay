<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    header("Permissions-Policy: geolocation=(), camera=(), microphone=()");

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
