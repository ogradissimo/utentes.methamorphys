<?php
include 'cont.php';
$STH = $DBH->prepare("SELECT calendario.id_evento, calendario.data_inicio, calendario.data_fim, calendario.hora, calendario.horafim, calendario.descricao_evento , utilizador.utilizador FROM calendario , utilizador Where calendario.id_utilizador=utilizador.id_ut and id_evento = ?");
$id=$_GET['idev']; 
$STH -> bindParam(1, $id);
$STH->execute();
	while ($row = $STH->fetch()) {
		echo "<p><b>Evento nº ".$row['id_evento']."</b>
		<p><b>Data Inicio: </b>".$row['data_inicio']."</p>
		<p><b>Data Fim: </b>".$row['data_fim']."</p>
		<p><b>Hora Inicio: </b>".$row['hora']."</p>
		<p><b>Hora Fim: </b>".$row['horafim']."</p>
		<p><b>Descrição Evento: </b>".$row['descricao_evento']."</p>
		<p><b>Autor: </b>".$row['utilizador']."</p>";
		
	}
	echo '<br><a href="visualizareventos.php"><img src="dist/img/back3.png" /> Voltar para a Tabela</a>';
if(isset($_GET['alt']))
{
echo "<script>
	alert('Registo Alterado!');
	</script> ";
}
?>