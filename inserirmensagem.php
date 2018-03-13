<?php
include 'cont.php';
session_start();

  $iddestino = $_GET['destino'];
 $mesagem = $_GET['texto'];
 $visto = 0;
$STH3 = $DBH->prepare("INSERT INTO mensagens (id_destino, mensagem , id_enviado ,data , hora , visto ) VALUES ( ?, ? , ? ,?, ?, ?)");
$STH3->bindParam('1', $iddestino);
$STH3->bindParam('2', $mesagem);
$STH3->bindParam('3', $_SESSION['idut']);
$STH3->bindParam('4', date("y/m/d"));
$STH3->bindParam('5', date("H:i:s"));
$STH3->bindParam('6', $visto);
echo $STH3->execute();
$count2 = $STH3->rowCount();
if($count2 == 1)
{
		echo '<meta http-equiv="refresh" content="0; url=mensagens.php?alt=true" />';

}
?>