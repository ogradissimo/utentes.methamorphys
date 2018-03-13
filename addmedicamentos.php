<form action="inserirmedicamento.php" method="get" name="formtest">
       <div class="form-group">
         <label>Medicamento</label>
         <?php
         $id = $_GET['idut'];
		echo '<input type="hidden" value="' . $id . '" name="idutenteup" id="idutenteup" />';
         include 'cont.php'; 
         $STH3 = $DBH -> prepare('SELECT  * FROM  medicamentos');
		$STH3->execute();
		 echo' <select class="form-control" name="medic">';
		 		 echo '<option value="000">Selecione um opção</option>';
		 
		while ($row3 = $STH3 -> fetch())    
	{
                    
                        echo '<option value="'.$row3['id_medicamento'].'">'.$row3['descricaoo'].'</option>';
	}
                     echo' </select>
                    </div>';
       echo' <div class="form-group">
         <label>Momento</label>';
		$STH4 = $DBH -> prepare('SELECT  * FROM  momentos');
		$STH4->execute();
		 echo' <select class="form-control" name="moment">';
		 echo '<option value="000">Selecione um opção</option>';
		while ($row4 = $STH4 -> fetch())    
	{
                    
                        echo '<option value="'.$row4['id_momento'].'">'.$row4['descricao'].'</option>';
	}
                     echo' </select>
           </div>';

					?>               
                    
                    <label>Dose</label>

                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-medkit"></i></span>
                    <input type="text" class="form-control" name="dose">
                  </div>
                  <div class='input-group'>
                  	<br>
                    <input type='submit' value='Enviar' name='env' class='btn btn-primary'></form> 
                    <?php 
                    if(isset($_GET['voltar']))
                   {
                   	    $idut= $_GET['idut'];
					
                   	    echo" &nbsp <input type='button' onclick=\"location.href='".$_GET['voltar']."?idut=".$idut."'\"value='Cancelar' class='btn btn-primary'>";	                  	
                   }
                   ?>
                  </div>

	</form>
	<script  type="text/javascript">
 var frmvalidator = new Validator("formtest");
frmvalidator.addValidation("dose","req","Campo dose necessario ");
frmvalidator.addValidation("moment","dontselect=000","Selecione um opção no campo Momento");
frmvalidator.addValidation("medic","dontselect=000","Selecione um opção no campo Medicamento");

frmvalidator.EnableMsgsTogether();
</script>