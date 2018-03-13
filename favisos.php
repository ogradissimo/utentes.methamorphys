<style>
	textarea { resize: none ;}
</style>


<form action="inseriravisos.php" method="get" name="formtest">
               <div class="form-group">
        <?php
        include 'cont.php';
        echo' <label>Destino</label>';
		$STH4 = $DBH -> prepare('SELECT  * FROM  tipo_utilizador');
		$STH4->execute();
		 echo' <select class="form-control" name="destino">';
		 echo '<option value="0">Todos</option>';
		while ($row4 = $STH4 -> fetch())    
	{
                    
                        echo '<option value="'.$row4['id_tipo'].'">'.$row4['descricao'].'</option>';
	}
                     echo' </select>
           </div>';

					?>  
               <label>Titulo :</label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-home"></i></span>
                    <input type="text" class="form-control" name="titulo">
                  </div>
                   <label>Mensagem:</label>
		<div class='box-body pad'>
		<textarea name='aviso'  class='textarea' style='width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'></textarea>
		</div>
                  <div class="input-group">
        <input type="submit" value="Enviar" class="btn btn-primary" />
                </div>

                </div>

	</form>
<script  type="text/javascript">
 var frmvalidator = new Validator("formtest");
frmvalidator.addValidation("titulo","req","Campo Titulo Necessário ");
frmvalidator.addValidation("aviso","req","Campo Mensagem Necessário ");
frmvalidator.EnableMsgsTogether();
</script>
<?php
if(isset($_GET['alt']))
{
		echo "<script>
	alert('Aviso Emitido!');
	</script> ";
}
?>
