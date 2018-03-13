<div class='box box-default'>
	<div class='box-header with-border'>
		<h3 class='box-title'><i class="fa fa-tag"></i>  Medicamento :</h3>
		<div class="box-tools pull-right">
						</div>

	</div>
	<div class='box-body'>
		<div class='row'>
			<div class='box-body pad'>
<?php
include 'cont.php';
$STH = $DBH->prepare("SELECT * FROM medicamentos Where id_medicamento=?");
 $id=$_GET['idmed']; 
$STH -> bindParam(1, $id);
$STH->execute();
	while ($row = $STH->fetch()) {
		echo '<form action="alteramedica.php" method="get" name="formtest"  enctype="multipart/form-data">
              <input type="hidden" class="form-control" name="idmed" value="'.$id.'">
			                 <div class="form-group">
       
               <label>Nome Medicamento :</label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                    <input type="text" class="form-control" name="nome" value="'.$row['descricaoo'].'">
                  </div>
                   <br>
                  <div class="input-group">

        <input type="submit" value="Alterar" class="btn btn-primary" />	</form>  &nbsp;';
	}
echo"<input type='button' onclick=location.href='visualizarperfil.php' value='Cancelar'  class='btn btn-primary'>      </div>         
</div>";
?>
			</div>

		</div>
	</div>
	</div>



               