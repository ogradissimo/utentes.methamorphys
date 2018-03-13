<?php
session_start();
include 'cont.php';
 $destino=$_GET['destino'];
 $titulo=$_GET['titulo'];
 $mensagem=$_GET['aviso'];
$visto=0;
if($destino==0)
{
$STH2 = $DBH -> prepare('Select * From utilizador ');
$STH2 -> execute();
$result=$STH2->rowCount();
echo $result;
while ($row2 = $STH2 -> fetch()) {
$STH3 = $DBH->prepare("INSERT INTO avisos (titulo_aviso, msg_aviso, id_utilizador_dest, id_utilizadorcre, data, hora, visto) VALUES (?, ?, ? , ? ,?, ?, ?)");
$STH3->bindParam('1', $titulo);
$STH3->bindParam('2', $mensagem);
$STH3->bindParam('3', $utilizador);
$STH3->bindParam('4', $_SESSION['idut']);
$STH3->bindParam('5', date("y/m/d"));
$STH3->bindParam('6', date("H:i:s"));
$STH3->bindParam('7', $visto);
 date("H:i:s");
 $utilizador = $row2['id_ut'];
 $STH3->execute();
$count2 = $STH3->rowCount();
}	
}
else {
	echo 'entrei';

$STH2 = $DBH -> prepare('Select * From utilizador WHERE id_tipo= ? ');
$STH2->bindParam(1,$destino );
$STH2 -> execute();
$result=$STH2->rowCount();
echo $result;
while ($row2 = $STH2 -> fetch()) {
$STH3 = $DBH->prepare("INSERT INTO avisos (titulo_aviso, msg_aviso, id_utilizador_dest, id_utilizadorcre, data, hora, visto) VALUES (?, ? , ? ,?, ?, ?, ?)");
$STH3->bindParam('1', $titulo);
$STH3->bindParam('2', $mensagem);
$STH3->bindParam('3', $utilizador);
$STH3->bindParam('4', $_SESSION['idut']);
$STH3->bindParam('5', date("y/m/d"));
$STH3->bindParam('6',date("H:i:s"));
$STH3->bindParam('7', $visto);
echo $utilizador = $row2['id_ut'];
echo $STH3->execute();
$count2 = $STH3->rowCount();
}
}
if($count2 == 1)
{
		echo '<meta http-equiv="refresh" content="0; url=criaravisos.php?&alt=true" />';

}
?>


