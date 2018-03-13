<?php
include 'cont.php';
  $medic = $_GET['medic'];
 $moment = $_GET['moment'];
 $dose = $_GET['dose'];
 $ut = $_GET['idutenteup'];
$STH3 = $DBH->prepare("INSERT INTO tratamento (id_utente, id_medicamento , id_momento , dose ) VALUES (?, ? , ? ,?)");
$STH3->bindParam('1', $ut);
$STH3->bindParam('2', $medic);
$STH3->bindParam('3', $moment);
$STH3->bindParam('4', $dose);
echo $STH3->execute();
$count2 = $STH3->rowCount();
if($count2 == 1)
{
		echo '<meta http-equiv="refresh" content="0; url=medicamentos.php?idut='.$ut.'&alt=true" />';

}
?>
