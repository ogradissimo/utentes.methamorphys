<?php 
 $familiar = $_GET['idfm'];
 $utente = $_GET['ut'];
include 'cont.php';
$STH3 = $DBH -> prepare('DELETE FROM  familiares Where id_familiar = ?');
$STH3 -> bindParam(1, $familiar);
$STH3->execute();
$count2 = $STH3->rowCount();
echo $count2;
if($count2 == 1)
{
		echo '<meta http-equiv="refresh" content="0; url=pagfamiliares.php?idut='.$utente.'" />';

}
?>