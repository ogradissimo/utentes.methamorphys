<?php
include 'cont.php';
echo $tipo=$_GET['perm'];
$STH3 = $DBH -> prepare('DELETE FROM  perfil_pagina Where id_tipo = ?');
$STH3 -> bindParam(1, $tipo);
$STH3->execute();
$check = $_GET['check'];
$conta=0;
for($i=0;$i<count($check);$i++)
{
$pagina=$check[$i];
$STH4 = $DBH -> prepare('INSERT INTO perfil_pagina (id_tipo, id_pagina) VALUES (?, ?)');
$STH4 -> bindParam(1, $tipo);
$STH4 -> bindParam(2, $pagina);
$STH4->execute();
$result=$STH4->rowcount();
$conta=$conta+$result;
}
if($conta==count($check))
{
	echo '<meta http-equiv="refresh" content="0; url=verpermissoes.php?perfil='.$tipo.'&alt=true" />';
}
?>