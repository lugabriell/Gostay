<?php
include_once('../connection.php');


function salvarft($arquivooriginal, $conexao){
    if (isset($arquivooriginal)) {

        $arquivo = $arquivooriginal;
        $nomeOriginal = $arquivo['name'];
        $tamanho = $arquivo['size'];
        $tmp = $arquivo['tmp_name'];

        $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

        $permitidas = ["jpg", "jpeg", "png", "gif", "webp"];

        if (!in_array($extensao, $permitidas)) {
            die("Extensão não permitida.");
        }

        $novoNome = uniqid() . "." . $extensao;

        $pastaDestino = "assets/";
        $caminhoFinal = $pastaDestino . $novoNome;

        if (move_uploaded_file($tmp, $caminhoFinal)) {
            return($caminhoFinal);
        } else {
            return false;
        }
    }
}

function salvarvideo($arquivooriginal, $conexao){
        if (isset($arquivooriginal)) {

        $arquivo = $arquivooriginal;
        $nomeOriginal = $arquivo['name'];
        $tamanho = $arquivo['size'];
        $tmp = $arquivo['tmp_name'];

        $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

        $permitida = ["mp4"];

        if (!in_array($extensao, $permitida)) {
            die("Extensão não permitida.");
        }

        $novoNome = uniqid() . "." . $extensao;

        $pastaDestino = "../creates/assets/";
        $caminhoFinal = $pastaDestino . $novoNome;

        if (move_uploaded_file($tmp, $caminhoFinal)) {

            return($caminhoFinal);
        } else {
            echo "Erro ao enviar o arquivo.";
            $erro = 'erro';
            return($erro);
        }
    }
}
function salvarconteudo($arquivooriginal, $conexao){
        if (isset($arquivooriginal)) {

        $arquivo = $arquivooriginal;
        $nomeOriginal = $arquivo['name'];
        $tamanho = $arquivo['size'];
        $tmp = $arquivo['tmp_name'];

        $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

        $permitida = ["pdf", "pptx", "txt"];

        if (!in_array($extensao, $permitida)) {
            die("Extensão não permitida.");
        }

        $novoNome = uniqid() . "." . $extensao;

        $pastaDestino = "../creates/assets/";
        $caminhoFinal = $pastaDestino . $novoNome;

        if (move_uploaded_file($tmp, $caminhoFinal)) {

            return($caminhoFinal);
        } else {
            echo "Erro ao enviar o arquivo.";
            $erro = 'erro';
            return($erro);
        }
    }
}
?>
