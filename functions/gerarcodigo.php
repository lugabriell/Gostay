<?php

function gerarChaveAleatoria($tamanho = 6) {

    $alfabeto = 'abcdefghijklmnopqrstuvwxy123456789';
    
  
    $tamanhoAlfabeto = strlen($alfabeto);
    
    $chave = '';
    
    for ($i = 0; $i < $tamanho; $i++) {
        
        $indiceAleatorio = random_int(0, $tamanhoAlfabeto - 1);
        $chave .= $alfabeto[$indiceAleatorio];
    }
    
    return $chave;
}



?>