<?php
include 'cont.php';
$tipo=$_GET['idp'];
$novoperfil=$_GET['perfil'];
$STH = $DBH->prepare("UPDATE tipo_utilizador SET descricao = ?  WHERE id_tipo = ?");
$STH->bindParam('1', $novoperfil);
$STH->bindParam('2', $tipo);
$STH->execute();
$count = $STH->rowCount();
if($count ==1)
{
	echo '<meta http-equiv="refresh" content="0; url=visualizarperfil.php?altu=true" />';
}
if($count ==0)
{
echo '<meta http-equiv="refresh" content="0; url=visualizarperfil.php" />';
}
?>