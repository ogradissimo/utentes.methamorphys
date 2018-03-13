<style>
	textarea { resize: none ;}
</style>
<?php
include 'cont.php';
$STH = $DBH->prepare("SELECT * FROM psicologico  Where  id_relatoriopsi = ?");
$id=$_GET['idpsi']; 
$STH -> bindParam(1, $id);
$STH->execute();
	while ($row = $STH->fetch()) {
		echo "<p><b>Relatório psicológico nº ".$row['id_relatoriopsi']."</b>";
		$idrl=$row['id_relatoriopsi'];
		echo '<form action="upps.php" method="get" name="form"><p><b>Data: </b></p>

                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    <input type="date" class="form-control" name="data" value="'.$row['data'].'">
                  </div>';
		$id = $_GET['idut'];
		echo '<input type="hidden" value="' . $id . '" name="idut"  />';
		echo '<input type="hidden" value="' . $row['id_relatoriopsi'] . '" name="pslid"  />';
		$ur=end(explode("/", $_SERVER['PHP_SELF']));
	    echo '<input type="hidden" value="' .$ur . '" name="url" />';
		
		echo "</p>
		<p><b>Descrição: </b></p>
		<textarea name='des' class='textarea' style='width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'>".$row['descri']."</textarea>";
		echo "<div class='input-group'>
                  	<br>
                    <input type='submit' value='Alterar' name='env' class='btn btn-primary'></form> ";
                    if(isset($_GET['voltar']))
                   {
                   	    echo" &nbsp <input type='button' onclick=\"location.href='".$_GET['voltar']."?idut=".$id."&idpsi=".$idrl."'\"value='Cancelar' class='btn btn-primary'>";	                  	
                   }
                echo"  </div>

	</form>";
		
	}


?>

