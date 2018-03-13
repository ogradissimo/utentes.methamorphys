<?php 
 $del = $_GET['idmed'];
include 'cont.php';
$STH3 = $DBH -> prepare('DELETE FROM  medicamentos Where id_medicamento = ?');
$STH3 -> bindParam(1, $del);
$STH3->execute();
$count2 = $STH3->rowCount();
echo $count2;
if($count2 == 1)
{
		echo '<meta http-equiv="refresh" content="0; url=visualizarmedicamento.php" />';

}
?>