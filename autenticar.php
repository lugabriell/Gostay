<?php

include_once 'functions/gerarcodigo.php';

function enviaremail($email){

    $chave = gerarChaveAleatoria();

    $python = "C:/Users/andre/AppData/Local/Programs/Python/Python310/python.exe";
    $script = "C:/xampp/htdocs/idsead/app2.py";

    $payload = json_encode([
        "emails" => [$email],
        "chave"  => $chave
    ]);

    $descriptorspec = [
        0 => ["pipe", "r"], // STDIN
        1 => ["pipe", "w"], // STDOUT
        2 => ["pipe", "w"]  // STDERR
    ];

    $process = proc_open("\"$python\" \"$script\"", $descriptorspec, $pipes);

    if (!is_resource($process)) {
        return 'negado';
    }

    // envia JSON para o Python
    fwrite($pipes[0], $payload);
    fclose($pipes[0]);

    $output = stream_get_contents($pipes[1]);
    $error  = stream_get_contents($pipes[2]);

    fclose($pipes[1]);
    fclose($pipes[2]);

    proc_close($process);

    
    // DEBUG opcional
    file_put_contents("debug_python.txt", $output . "\n" . $error);

    $resposta = json_decode(trim($output), true);

    if (is_array($resposta) && $resposta["status"] === "ok") {
        $_SESSION['codigoaluno'] = $chave;
        return 'ok';
    }

    return 'negado';
}
