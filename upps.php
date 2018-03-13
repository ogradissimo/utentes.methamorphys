<?php 
include 'cont.php';
$descricao =$_GET['des'];
$data =$_GET['data'];
$ps =$_GET['pslid'];
$STH = $DBH->prepare("UPDATE psicologico SET descri = ? , data = ?  WHERE id_relatoriopsi = ?");
$STH -> bindParam(1, $descricao);
$STH -> bindParam(2, $data);
$STH -> bindParam(3, $ps);
$STH->execute();
$count = $STH->rowCount();
if($count ==1)
{
	$url =$_GET['url'];
	$utente=$_GET['idut'];
echo '<meta http-equiv="refresh" content="0; url='.$url.'?idut='.$utente.'&idpsi='.$ps.'&alt=true" />';
}
?>