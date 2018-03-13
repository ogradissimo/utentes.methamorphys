<?php
include 'cont.php';
session_start();

  $data1 = $_GET['data1'];
 $data2 = $_GET['data2'];
 $hora = $_GET['hora1'];
 $hora2 = $_GET['hora2'];
 $evento = $_GET['evento'];
$STH3 = $DBH->prepare("INSERT INTO calendario (data_inicio, data_fim , hora ,horafim , descricao_evento,id_utilizador ) VALUES (?, ?, ? , ? ,?, ?)");
$STH3->bindParam('1', $data1);
$STH3->bindParam('2', $data2);
$STH3->bindParam('3', $hora);
$STH3->bindParam('4', $hora2);
$STH3->bindParam('5', $evento);
$STH3->bindParam('6', $_SESSION['idut']);
 $STH3->execute();
$count2 = $STH3->rowCount();
if($count2 == 1)
{		echo '<meta http-equiv="refresh" content="0; url=criareventos.php?idut='.$ut.'&alt=true" />';
	

}
?>
