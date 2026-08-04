<?php  
require_once("../connection.php");
session_start();

if(isset($_POST['tempo_atual'])) {
  $tempo_atual = floatval($_POST['tempo_atual']);
  $tempo_total = floatval($_POST['tempo_total']);
  $trackid     = intval($_POST['trackid']);
  echo "Tempo atual: " . $tempo_atual . "<br>";
  echo "Tempo total: " . $tempo_total . "<br>";
  echo "Track ID: " . $trackid . "<br>";

  $stmt = $conexao->prepare("UPDATE alunoaula SET ultimaposicao=?, tamanho_total=? WHERE idaula=?");
  $stmt->bind_param("ssi", $tempo_atual, $tempo_total, $trackid);
  $stmt->execute();
  exit;
}

// switch(true) {
//   case isset($_SESSION['nameadm']):
//     header('Location: dashadm.php');
//     break;
//   case isset($_SESSION['nameprof']):
//     header('Location: homeprof.php');
//     break;
//   case isset($_SESSION['nome']):
//     header('Location: ../homepage.php');
//     break;
// }
?>