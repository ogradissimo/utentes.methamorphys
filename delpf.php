<?php 
 $del = $_GET['idp'];
include 'cont.php';
$STH3 = $DBH -> prepare('DELETE FROM  tipo_utilizador Where id_tipo = ?');
$STH3 -> bindParam(1, $del);
$STH3->execute();
$count2 = $STH3->rowCount();
echo $count2;
if($count2 == 1)
{
		echo '<meta http-equiv="refresh" content="0; url=visualizarperfil.php" />';

}
?>