<div class='box box-default'>
	<div class='box-header with-border'>
		<h3 class='box-title'><i class="fa fa-tag"></i> Informação do Utilizador:</h3>
		<div class="box-tools pull-right">
						<?php
				$id2=$_GET['idut']; 
				echo '<a href="verperfil.php?idut='.$id2.'&op=2"><img src="dist/img/edit.png" /></a>';
	?>
		</div>
	</div>
	<div class='box-body'>
		<div class='row'>
			<div class='box-body pad'>
<?php
if(isset($_GET['op']))
{
	include 'edprof.php';
}
else {
	
include 'cont.php';
$STH = $DBH->prepare("SELECT utilizador.id_ut , utilizador.nome , utilizador.email , utilizador.foto , utilizador.utilizador, tipo_utilizador.descricao FROM utilizador, tipo_utilizador Where utilizador.id_tipo=tipo_utilizador.id_tipo and utilizador.id_ut=?");
$id=$_GET['idut']; 
$STH -> bindParam(1, $id);
$STH->execute();
	while ($row = $STH->fetch()) {
		echo "<p><b>Utilizador nº ".$row['id_ut']."</b>
		<p><b>Nome: </b>".$row['nome']."</p>
		<p><b>Email: </b>".$row['email']."</p>
		<p><b>Foto: </b></p>
		<p><img src='dist/img/".$row['foto']."' width='100' height='100'></p>
		<p><b>Utilizador: </b>".$row['utilizador']."</p>
		<p><b>Tipo de Perfil: </b>".$row['descricao']."</p>";
		}
	}
if(isset($_GET['altu']))	
{
	echo'<script>
	alert("Registo Alterado")
	</script>';
	
}
?>
			</div>

		</div>
	</div>
	</div>