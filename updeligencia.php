<?php 
include 'cont.php';
$descricao =$_GET['des'];
$data =$_GET['data'];
$tipo =$_GET['tipodel'];
$del =$_GET['delid'];
$STH = $DBH->prepare("UPDATE deligencia_utente SET descricao = ? , data = ? , id_tipo_deligencia = ? WHERE id_deligenciautente = ?");
$STH -> bindParam(1, $descricao);
$STH -> bindParam(2, $data);
$STH -> bindParam(3, $tipo);
$STH -> bindParam(4, $del);
$STH->execute();
$count = $STH->rowCount();
if($count ==1)
{
	$url =$_GET['url'];
	$utente=$_GET['idut'];
echo '<meta http-equiv="refresh" content="0; url='.$url.'?idut='.$utente.'&iddel='.$del.'&alt=true" />';
}
?>