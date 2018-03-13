<?php 
 $tratamento = $_GET['idtrat'];
 $utente = $_GET['ut'];
include 'cont.php';
$STH3 = $DBH -> prepare('DELETE FROM  tratamento Where id_tratamento = ?');
$STH3 -> bindParam(1, $tratamento);
$STH3->execute();
$count2 = $STH3->rowCount();
echo $count2;
if($count2 == 1)
{
		echo '<meta http-equiv="refresh" content="0; url=medicamentos.php?idut='.$utente.'" />';

}
?>