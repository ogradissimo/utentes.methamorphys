<style>
	textarea { resize: none ;}
</style>

<div class='box box-default'>
	<div class='box-header with-border'>
		<h3 class='box-title'><i class="fa fa-tag"></i> Criar Perfil :</h3>
		<div class="box-tools pull-right">
		</div>
	</div>
	<div class='box-body'>
		<div class='row'>
			<div class='box-body pad'>

<form action="inserirperfil.php" method="get" name="formtest">
               <div class="form-group">
       
               <label>Nome Perfil :</label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-home"></i></span>
                    <input type="text" class="form-control" name="perfil">
                  </div>
                   <br>
                  <div class="input-group">
        <input type="submit" value="Enviar" class="btn btn-primary" />	</form>
   &nbsp; <input type='button' onclick=location.href='visualizarperfil.php' value='Voltar'  class='btn btn-primary'>               
       
    </div>

                </div>


				</div>

		</div>
	</div>
</div>
<script  type="text/javascript">
 var frmvalidator = new Validator("formtest");
frmvalidator.addValidation("perfil","req","Campo Titulo Necessário ");
frmvalidator.addValidation("perfil","alpha_s","Caracteres invalidos ");
frmvalidator.EnableMsgsTogether();
</script>
<?php
if(isset($_GET['alt']))
{
		echo "<script>
	alert('Perfil Criado!');
	</script> ";
}
?>