<div class='box box-default'>
	<div class='box-header with-border'>
		<h3 class='box-title'><i class="fa fa-tag"></i> Informação do Aviso:</h3>
		<div class="box-tools pull-right">
					</div>
	</div>
	<div class='box-body'>
		<div class='row'>
			<div class='box-body pad'>
<?php
include 'cont.php';
if(isset($_GET['avisovisto']))
{
$STH2 = $DBH->prepare("UPDATE avisos SET visto = 1 WHERE id_aviso = ?");
$id2=$_GET['avisovisto']; 
$STH2 -> bindParam(1, $id2);
$STH2->execute();	
$STH3 = $DBH->prepare("Select * From avisos WHERE visto = 0 ");
$STH3->execute();
$result4=$STH3->rowcount();	
$_SESSION['aviso']=$result4;
}
$STH = $DBH->prepare("SELECT avisos.id_aviso ,avisos.titulo_aviso , avisos.msg_aviso, utilizador.utilizador ,avisos.data FROM avisos, utilizador Where  avisos.id_utilizadorcre=utilizador.id_ut and id_aviso = ?");
$id=$_GET['idav']; 
$STH -> bindParam(1, $id);
$STH->execute();
	while ($row = $STH->fetch()) {
		echo "<p><b>Aviso nº ".$row['id_aviso']."</b>
		<p><b>Titulo: </b>".$row['titulo_aviso']."</p>
		<p><b>Descrição: </b></p>
		<p>".$row['msg_aviso']."</p>
		<p><b>Autor: </b>".$row['utilizador']."</p>
				<p><b>Data: </b>".$row['data']."</p>";
		}
	if(isset($_GET['alg']))
	{
			echo '<br><a href="visualizaralavisosl.php"><img src="dist/img/back3.png" /> Voltar para a Tabela</a>';	
		
	}
	if(isset($_GET['avisovisto']))
{
	echo '<br><a href="visualizaralavisosl.php"><img src="dist/img/back3.png" /> Voltar para a Tabela</a>';	
	
	
}
if(isset($_GET['todos'])) {
echo '<br><a href="visualizartodosavisosl.php"><img src="dist/img/back3.png" /> Voltar para a Tabela</a>';	
	
}

?>
			</div>

		</div>
	</div>
	</div>