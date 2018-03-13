<?php
include 'cont.php';
$STH = $DBH->prepare("SELECT deligencia_utente.id_deligenciautente, deligencia_utente.data, deligencia_utente.descricao , tipo_Deligencia.des , utilizador.utilizador FROM deligencia_utente , tipo_Deligencia , utilizador Where deligencia_utente.id_tipo_deligencia=tipo_Deligencia.id_tipodeligencia and deligencia_utente.id_utilizador=utilizador.id_ut and id_deligenciautente = ?");
$id=$_GET['iddel']; 
$STH -> bindParam(1, $id);
$STH->execute();
	while ($row = $STH->fetch()) {
		echo "<p><b>Diligência nº ".$row['id_deligenciautente']."</b>
		<p><b>Data: </b>".$row['data']."</p>
		<p><b>Tipo de diligência</b> ".$row['des']."</p>
		<p><b>Descrição: </b></p>
		<p>".$row['descricao']."</p>
		<p><b>Autor: </b>".$row['utilizador']."</p>";
		
	}

?>