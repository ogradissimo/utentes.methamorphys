<?php 
 $psic = $_GET['idps'];
 $utente = $_GET['ut'];
include 'cont.php';
$STH3 = $DBH -> prepare('DELETE FROM  psicologico Where id_relatoriopsi = ?');
$STH3 -> bindParam(1, $psic);
$STH3->execute();
$count2 = $STH3->rowCount();
echo $count2;
if($count2 == 1)
{
		echo '<meta http-equiv="refresh" content="0; url=pagpsico.php?idut='.$utente.'" />';

}
?>