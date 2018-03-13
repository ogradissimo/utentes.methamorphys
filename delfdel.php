<?php 
 $del = $_GET['iddel'];
 $utente = $_GET['ut'];
include 'cont.php';
$STH3 = $DBH -> prepare('DELETE FROM  deligencia_utente Where id_deligenciautente = ?');
$STH3 -> bindParam(1, $del);
$STH3->execute();
$count2 = $STH3->rowCount();
echo $count2;
if($count2 == 1)
{
		echo '<meta http-equiv="refresh" content="0; url=pagdeligencias.php?idut='.$utente.'" />';

}
?>