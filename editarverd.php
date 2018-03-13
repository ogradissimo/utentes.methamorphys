<style>
	textarea { resize: none ;}
</style>
<?php
include 'cont.php';
$STH = $DBH->prepare("SELECT * FROM deligencia_utente  Where  id_deligenciautente = ?");
$id=$_GET['iddel']; 
$STH -> bindParam(1, $id);
$STH->execute();
	while ($row = $STH->fetch()) {
		echo "<p><b>Diligência nº ".$row['id_deligenciautente']."</b>";
		$iddelg=$row['id_deligenciautente'];
		echo '<form action="updeligencia.php" method="get" name="form"><p><b>Data: </b></p>

                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    <input type="date" class="form-control" name="data" value="'.$row['data'].'">
                  </div>
                  <p><b>Tipo de diligência</b> ';
		$id = $_GET['idut'];
		echo '<input type="hidden" value="' . $id . '" name="idut"  />';
		echo '<input type="hidden" value="' . $row['id_deligenciautente'] . '" name="delid"  />';
		$ur=end(explode("/", $_SERVER['PHP_SELF']));
	    echo '<input type="hidden" value="' .$ur . '" name="url" />';
		
		$STH3 = $DBH -> prepare('SELECT  * FROM  tipo_Deligencia');
		$STH3->execute();
		 echo' <select class="form-control" name="tipodel">';
		while ($row3 = $STH3 -> fetch())    
	{
                    if($row3['id_tipodeligencia']==$row['id_tipo_deligencia'])
					{
						 echo '<option value="'.$row3['id_tipodeligencia'].'" selected>'.$row3['des'].'</option>';
						
					}
					 else{
                        echo '<option value="'.$row3['id_tipodeligencia'].'">'.$row3['des'].'</option>';
                        }
	}
                     echo' </select>';
		echo "</p>
		<p><b>Descrição: </b></p>
		<textarea name='des' class='textarea' style='width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'>".$row['descricao']."</textarea>";
		echo "<div class='input-group'>
                  	<br>
                    <input type='submit' value='Alterar' name='env' class='btn btn-primary'></form> ";
                  	if(isset($_GET['voltar']))
                   {
                   	    echo" &nbsp <input type='button' onclick=\"location.href='".$_GET['voltar']."?idut=".$id."&iddel=".$iddelg."'\"value='Cancelar' class='btn btn-primary'>";	                  	
                   }
                  echo"</div>

	</form>";
		
	}


?>

