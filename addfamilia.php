<form action="inserirfamiliar.php" method="get" name="formtest">
               <div class="form-group">
                   <label>Nome:</label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                    <input type="text" class="form-control" name="nome">
                  </div>
                   <label>Morada:</label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-home"></i></span>
                    <input type="text" class="form-control" name="morada">
                  </div>
       <div class="form-group">
         <label>Parentesco</label>
         <?php
         $id = $_GET['idut'];
		echo '<input type="hidden" value="' . $id . '" name="idutenteup" id="idutenteup" />';
         include 'cont.php'; 
         $STH3 = $DBH -> prepare('SELECT  * FROM  grau_parentesco');
		$STH3->execute();
		 echo' <select class="form-control" name="paren">';
		 echo '<option value="000">Selecione um opção</option>';

		while ($row3 = $STH3 -> fetch())    
	{
                    
                        echo '<option value="'.$row3['id_grau_parentesco'].'">'.$row3['descricao'].'</option>';
	}
                     echo' </select>
                    </div>';
     				?>  

                    <label>Idade</label>

                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                    <input type="text" class="form-control" name="idade">
                  </div>


                    <label>Contacto</label>

                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-mobile-phone"></i></span>
                    <input type="text" class="form-control" name="contacto">
                  </div>


                    <label>Familiar Proximo? </label>

                    <div class="input-group">
                    <p><b><input type="radio" class='flat-red' name="fam" value="1"> Sim </b></p>
                   <p><b> <input type="radio" class='flat-red' name="fam" value="0"> Não </b></p>
                  </div>
                  <div class='input-group'>
                  	<br>
                    <input type='submit' value='Enviar' name='env' class='btn btn-primary'></form> 
                    <?php 
                    if(isset($_GET['voltar']))
                   {
                   	    $idut= $_GET['idut'];
					
                   	    echo" &nbsp <input type='button' onclick=\"location.href='".$_GET['voltar']."?idut=".$id."'\"value='Cancelar' class='btn btn-primary'>";	                  	
                   }
                   ?>
                  </div>
                </div>

	</form>
<script  type="text/javascript">
 var frmvalidator = new Validator("formtest");
frmvalidator.addValidation("nome","req","Campo Nome Necessário ");
frmvalidator.addValidation("morada","req","Campo Morado Necessário ");
frmvalidator.addValidation("idade","req","Campo Idade Necessário ");
frmvalidator.addValidation("contacto","req","Campo Contacto Necessário ");
frmvalidator.addValidation('fam','selone','Campo  Familiar Proximo não Selecionado  ');
frmvalidator.addValidation("idade","num","O Campo idade tem que ser Numeros ");
frmvalidator.addValidation("contacto","num","O Campo contacto tem que ser Numeros ");
frmvalidator.addValidation("contacto","maxlength=9","O Campo  tem que ter 9 Numeros ");
frmvalidator.addValidation("paren","dontselect=000","Selecione um Opção no Campo Parentesco");
frmvalidator.EnableMsgsTogether();
</script>