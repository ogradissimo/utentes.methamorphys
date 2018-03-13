
<div class='box box-default'>
	<div class='box-header with-border'>
		<h3 class='box-title'><i class="fa fa-tag"></i> Medicamento :</h3>
		<div class="box-tools pull-right">
		</div>
	</div>
	<div class='box-body'>
		<div class='row'>
			<div class='box-body pad'>

<style>
	textarea { resize: none ;}
</style>


<form action="inmedicamento.php" method="get" name="formtest"  enctype="multipart/form-data">
               <div class="form-group">
               <label>Nome: </label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                    <input type="text" class="form-control" name="nome">
                    </div>
                    <br />
                  <div class="input-group">
        <input type="submit" value="Enviar" class="btn btn-primary" /></form>&nbsp;
<input type='button' onclick=location.href='visualizarmedicamento.php' value='Voltar'  class='btn btn-primary'>               
</div>
<script  type="text/javascript">
 var frmvalidator = new Validator("formtest");
frmvalidator.addValidation("nome","req","Campo Nome Necessário ");
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