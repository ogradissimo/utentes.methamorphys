<style>
	textarea { resize: none ;}
</style>
<?php
include 'cont.php';
$STH = $DBH->prepare("SELECT * FROM familiares  Where  id_familiar = ?");
$id=$_GET['idfm']; 
$STH -> bindParam(1, $id);
$STH->execute();
	while ($row = $STH->fetch()) {
			$idfm=$row['id_familiar'];
		echo ' <form action="upadatefamilia.php" method="get" name="formtest">
		 <div class="form-group">
                   <label>Nome:</label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                    <input type="text" class="form-control" name="nome" value="'.$row['nome'].'">
                  </div>
                   <label>Morada:</label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-home"></i></span>
                    <input type="text" class="form-control" name="morada" value="'.$row['morada'].'">
                  </div>
       <div class="form-group">
         <label>Parentesco</label>';
         $id = $_GET['idut'];
		 echo '<input type="hidden" value="' . $_GET['tras'] . '" name="tras" id="tras" />';
		echo '<input type="hidden" value="' . $id . '" name="idutenteup" id="idutenteup" />';
		echo '<input type="hidden" value="' . $row['id_familiar'] . '" name="idfm"  />';
		$ur=end(explode("/", $_SERVER['PHP_SELF']));
		echo '<input type="hidden" value="' . $ur . '" name="url"  />';
		
         include 'cont.php'; 
         $STH3 = $DBH -> prepare('SELECT  * FROM  grau_parentesco');
		$STH3->execute();
		 echo' <select class="form-control" name="paren">';
		while ($row3 = $STH3 -> fetch())    
	{
                    if($row3['id_grau_parentesco']==$row['id_parentesco'])
					{
						                        echo '<option value="'.$row3['id_grau_parentesco'].'" selected="selected">'.$row3['descricao'].'</option>';
						
					}
else {
	                        echo '<option value="'.$row3['id_grau_parentesco'].'">'.$row3['descricao'].'</option>';
	
}
	}
                     echo' </select>
                    </div>';
     				  

                    echo '<label>Idade</label>

                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                    <input type="text" class="form-control" name="idade" value="'.$row['idade'].'">
                  </div>


                    <label>Contacto</label>

                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-mobile-phone"></i></span>
                    <input type="text" class="form-control" name="contacto" value="'.$row['contacto'].'">
                  </div>


                    <label>Familiar Proximo? </label>

                    <div class="input-group">';
					if($row['familiarproximo']=='1')
					{
						                    echo'<p><b><input type="radio" class="flat-red" name="fam" value="1" checked="checked"> Sim </b></p>';
											echo'<p><b> <input type="radio"  class="flat-red" name="fam" value="0" > Não </b></p>';
						
					}
					else {
										echo'<p><b><input type="radio" class="flat-red" name="fam" value="1" > Sim </b></p>';
						
					                   echo'<p><b> <input type="radio"  class="flat-red" name="fam" value="0" checked="checked"> Não </b></p>';
						
					}
                  echo'</div>';
                  echo "<div class='input-group'>
                  	<br>
                    <input type='submit' value='Alterar' name='env' class='btn btn-primary'></form> ";
                   
                    if(isset($_GET['voltar']))
                   {                   	    $tras= $_GET['tras'];
                   		
                   	
                   	    $idut= $_GET['idut'];
					     echo" &nbsp <input type='button' onclick=\"location.href='".$_GET['voltar']."?idut=".$idut."&idfm=".$idfm."&tras=".$tras."'\"value='Cancelar' class='btn btn-primary'>";	                  	
                   }
               echo'
                  </div>
                </div>

	</form>';
	}


?>

