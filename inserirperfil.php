 <?php
include 'cont.php';
session_start();
 $perfil = $_GET['perfil'];
$STH3 = $DBH->prepare("INSERT INTO tipo_utilizador (descricao) VALUES (?)");
$STH3->bindParam('1', $perfil);
$STH3->execute();
$count2 = $STH3->rowCount();
if($count2 == 1)
{		echo '<meta http-equiv="refresh" content="0; url=criarperfil.php?alt=true" />';
	

}
?>
