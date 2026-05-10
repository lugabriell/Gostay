<?php  
file_put_contents('../debug.txt', print_r($_POST, true));
require_once("../connection.php");
session_start();

if(isset($_POST['tempo_atual'])) {
  $tempo_atual = floatval($_POST['tempo_atual']);
  $tempo_total = floatval($_POST['tempo_total']);
  $trackid     = intval($_POST['trackid']);

  $stmt = $conexao->prepare("UPDATE alunoaula SET ultimoacesso=? WHERE idaula=?");
  $stmt->bind_param("si", $tempo_atual, $trackid);
  $stmt->execute();
  exit;
}

switch(true) {
  case isset($_SESSION['nameadm']):
    header('Location: dashadm.php');
    break;
  case isset($_SESSION['nameprof']):
    header('Location: homeprof.php');
    break;
  case isset($_SESSION['nome']):
    header('Location: ../homepage.php');
    break;
}
?>