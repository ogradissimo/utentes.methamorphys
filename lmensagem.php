<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1> Ler Mensagem </h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<?php include 'menumensagem.php'
			?>
			<div class="col-md-9">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"> Ler Mensagem</h3>
					</div><!-- /.box-header -->
					<div class="box-body no-padding">
						<?php
						include_once 'cont.php'; 
					if(isset($_GET['upd']))
{
$STH2 = $DBH->prepare("UPDATE mensagens SET visto = 1 WHERE id_mensagem = ?");
$id2 = $_GET['idmen'];
$STH2 -> bindParam(1, $id2);
$STH2->execute();
$STH3 = $DBH->prepare("Select * From mensagens Where visto = 0");
$STH3 -> bindParam(1, $id2);
$STH3->execute();	
$result3 = $STH3->rowcount();
$_SESSION['mensagem']=$result3;

}	
				$STH = $DBH -> prepare("SELECT utilizador.id_ut , utilizador.utilizador, mensagens.id_mensagem ,mensagens.mensagem , mensagens.hora,  mensagens.data FROM mensagens, utilizador Where mensagens.id_enviado=utilizador.id_ut and id_mensagem=?");
		$id = $_GET['idmen'];
		$STH -> bindParam(1, $id);
		$STH -> execute();
		while ($row = $STH -> fetch(PDO::FETCH_ASSOC)) {
		echo'	<div class="mailbox-read-info">
							
							<h3>Mensagem de : '.$row['utilizador'].'<span class="mailbox-read-time pull-right"></h3><h5>'.$row['data'].'&nbsp'.$row['hora'].'</span></h5>
						</div><!-- /.mailbox-read-info -->
						<div class="mailbox-read-message">
'.$row['mensagem'].'
						</div><!-- /.mailbox-read-message -->
					</div><!-- /.box-body -->';
					
		echo'<div class="box-footer">
						<div class="pull-right">';
							if(isset($_GET['env']))
							{
							echo"</div>";	
							}
else {
	echo "<input type='button' onclick=\"location.href='enviarmensagens.php?idev=".$row['id_ut']."'\"value='Responder'  class='btn btn-primary'>
						</div>";	
}
						
}	
						

						?>

							<input type='button' onclick="location.href='mensagens.php'" value='Voltar'  class='btn btn-primary'>
						
					</div><!-- /.box-footer -->
				</div><!-- /. box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

