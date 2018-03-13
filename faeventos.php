
<div class='box box-default'>
	<div class='box-header with-border'>
		<h3 class='box-title'><i class="fa fa-tag"></i> Evento :</h3>
		<div class="box-tools pull-right">
		</div>
	</div>
	<div class='box-body'>
		<div class='row'>
			<div class='box-body pad'>

<style>
	textarea { resize: none ;}
</style>


<form action="inserirevento.php" method="get" name="formtest">
               <div class="form-group">
               <label>Data Inicio :</label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    <input type="date" class="form-control" name="data1">
                  </div>
                    <label>Data Fim :</label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    <input type="date" class="form-control" name="data2">
                  </div>
                 <label>Hora Inicio: </label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-clock-o"></i></span>
                    <input type="time" class="form-control" name="hora1">
                  </div>
                  <label>Hora Fim: </label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-clock-o"></i></span>
                    <input type="time" class="form-control" name="hora2">
                  </div>
                 <label>Evento : </label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                    <input type="text" class="form-control" name="evento">
                  </div>
                  <br>
                  <div class="input-group">
        <input type="submit" value="Enviar" class="btn btn-primary" />
                </div>

                </div>

	</form>
<script  type="text/javascript">
 var frmvalidator = new Validator("formtest");
frmvalidator.addValidation("data1","req","Campo Data Inicial Necessário ");
frmvalidator.addValidation("data2","req","Campo Data Final Necessário ");
frmvalidator.addValidation("hora1","req","Campo Hora Inicial Necessário ");
frmvalidator.addValidation("hora2","req","Campo Hora Final Necessário ");
frmvalidator.addValidation("evento","req","Campo Evento Necessário ");

frmvalidator.EnableMsgsTogether();
</script>
			</div>

		</div>
	</div>
</div>
<?php
if(isset($_GET['alt']))
{
		echo "<script>
	alert('Evento Criado!');
	</script> ";
}
?>
