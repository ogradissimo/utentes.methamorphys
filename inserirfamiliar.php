<?php
include 'cont.php';
   $nome = $_GET['nome'];
  $nomarada = $_GET['morada'];
 $parent = $_GET['paren'];
  $idade = $_GET['idade'];
  $contacto = $_GET['contacto'];
  $proxmimo = $_GET['fam'];
  $ut = $_GET['idutenteup'];
$STH3 = $DBH->prepare("INSERT INTO familiares (nome, morada, id_parentesco, idade, contacto, familiarproximo, id_utente ) VALUES (?, ? , ? ,?, ?,?,?)");
$STH3->bindParam('1', $nome);
$STH3->bindParam('2', $nomarada);
$STH3->bindParam('3', $parent);
$STH3->bindParam('4', $idade);
$STH3->bindParam('5', $contacto);
$STH3->bindParam('6', $proxmimo);
$STH3->bindParam('7', $ut);
echo $STH3->execute();
$count2 = $STH3->rowCount();
if($count2 == 1)
{
		echo '<meta http-equiv="refresh" content="0; url=pagfamiliares.php?idut='.$ut.'&alt=true" />';

}
?>
