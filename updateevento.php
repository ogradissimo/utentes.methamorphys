<?php 
include 'cont.php';
 $data1 = $_GET['data1'];
 $data2 = $_GET['data2'];
 $hora = $_GET['hora1'];
 $hora2 = $_GET['hora2'];
 $evento = $_GET['evento'];
 $idev=$_GET['id'];
$STH = $DBH->prepare("UPDATE calendario SET data_inicio = ? , data_fim = ? , hora = ? , horafim = ? , descricao_evento=? WHERE id_evento = ?");
$STH->bindParam('1', $data1);
$STH->bindParam('2', $data2);
$STH->bindParam('3', $hora);
$STH->bindParam('4', $hora2);
$STH->bindParam('5', $evento);
$STH->bindParam('6', $idev);

$STH->execute();
$count = $STH->rowCount();
if($count ==1)
{
	$url =$_GET['url'];
	$utente=$_GET['idut'];
echo '<meta http-equiv="refresh" content="0; url=vereventos.php?idev='.$idev.'&alt=true" />';
}
?>