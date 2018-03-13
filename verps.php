<?php
include 'cont.php';
$STH = $DBH->prepare("SELECT psicologico.id_relatoriopsi, psicologico.descri ,psicologico.data ,utilizador.utilizador FROM psicologico, utilizador Where  psicologico.id_utilizador=utilizador.id_ut and id_relatoriopsi = ?");
$id=$_GET['idpsi']; 
$STH -> bindParam(1, $id);
$STH->execute();
	while ($row = $STH->fetch()) {
		echo "<p><b>Diligência nº ".$row['id_relatoriopsi']."</b>
		<p><b>Data: </b>".$row['data']."</p>
		<p><b>Descrição: </b></p>
		<p>".$row['descri']."</p>
		<p><b>Autor: </b>".$row['utilizador']."</p>";
		
	}

?>