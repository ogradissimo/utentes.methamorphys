<?php 
include 'cont.php';
  $nome = $_GET['nome'];
  $nomarada = $_GET['morada'];
  $parent = $_GET['paren'];
  $idade = $_GET['idade'];
 $contacto = $_GET['contacto'];
 $proxmimo = $_GET['fam'];
 $utente = $_GET['idutenteup'];
 $idfm = $_GET['idfm'];
$STH = $DBH->prepare("UPDATE familiares SET nome = ? , morada = ? , id_parentesco = ? , idade = ? , contacto = ?, familiarproximo = ? WHERE id_familiar = ?");
$STH->bindParam('1', $nome);
$STH->bindParam('2', $nomarada);
$STH->bindParam('3', $parent);
$STH->bindParam('4', $idade);
$STH->bindParam('5', $contacto);
$STH->bindParam('6', $proxmimo);
$STH->bindParam('7', $idfm);
$STH->execute();
$count = $STH->rowCount();
if($count ==1)
{
	$tras=$_GET['tras'];
	$url =$_GET['url'];
	$utente=$_GET['idutenteup'];
echo '<meta http-equiv="refresh" content="0; url='.$url.'?idut='.$utente.'&idfm='.$idfm.'&al=true&tras='.$tras.'" />';
}
if($count ==0)
{
	$tras=$_GET['tras'];	
	$url =$_GET['url'];
	$utente=$_GET['idutenteup'];
echo '<meta http-equiv="refresh" content="0; url='.$url.'?idut='.$utente.'&idfm='.$idfm.'&tras='.$tras.'" />';
}
?>