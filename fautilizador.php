
<div class='box box-default'>
	<div class='box-header with-border'>
		<h3 class='box-title'><i class="fa fa-tag"></i> Utilizador :</h3>
		<div class="box-tools pull-right">
		</div>
	</div>
	<div class='box-body'>
		<div class='row'>
			<div class='box-body pad'>

<style>
	textarea { resize: none ;}
</style>


<form action="inserirutilizador.php" method="post" name="formtest"  enctype="multipart/form-data">
               <div class="form-group">
               <label>Nome: </label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                    <input type="text" class="form-control" name="nome">
                  </div>
                    <label> Email:</label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-envelope-o"></i></span>
                    <input type="email" class="form-control" name="email">
                  </div>
                 <label>Foto: </label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-folder-open-o"></i></span>
                    <input type="file" class="form-control" name="img[]">
                  </div>
                  <label>Utilizador: </label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                    <input type="text" class="form-control" name="ut">
                  </div>
                 <label>Palavra-passe: </label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-lock"></i></span>
                    <input type="password" class="form-control" name="pass">
                  </div>
       <?php
        include 'cont.php';
        echo' <label>Perfil</label>';
		$STH4 = $DBH -> prepare('SELECT  * FROM  tipo_utilizador');
		$STH4->execute();
		 echo' <select class="form-control" name="perfil">';
		 echo '<option value="000">Selecione um Perfil</option>';
		while ($row4 = $STH4 -> fetch())    
	{
                    
                        echo '<option value="'.$row4['id_tipo'].'">'.$row4['descricao'].'</option>';
	}
                     echo' </select>
   </div>';?>
                  <br>
                  <div class="input-group">
        <input type="submit" value="Enviar" class="btn btn-primary" /></form>&nbsp;
<input type='button' onclick=location.href='visualizarutilizadores.php' value='Voltar'  class='btn btn-primary'>               
</div>
<script  type="text/javascript">
 var frmvalidator = new Validator("formtest");
frmvalidator.addValidation("nome","req","Campo Nome Necessário ");
frmvalidator.addValidation("email","req","Campo Email Necessário ");
frmvalidator.addValidation("ut","req","Campo Utilizador Necessário ");
frmvalidator.addValidation("pass","req","Campo Palavra-passe Necessário ");
frmvalidator.addValidation("perfil","dontselect=000","Selecione um Opção no Perfil");
frmvalidator.EnableMsgsTogether();
</script>

                </div>

	
			</div>

		</div>
	</div>
</div>
<?php
if(isset($_GET['alt']))
{
		echo "<script>
	alert('Registo Criado!');
	</script> ";
}
?>