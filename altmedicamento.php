<?php
include 'cont.php';
$tratamento =$_GET['idtra'];
$id = $_GET['idut'];
$STH5 = $DBH -> prepare('SELECT  *  FROM  tratamento WHERE id_tratamento = ? ');
$STH5 -> bindParam(1, $tratamento);
$STH5->execute();
	while ($row5 = $STH5 -> fetch())    
	{
		echo'<form action="altmedicamentoup.php" method="get" name="formtest">
       <div class="form-group">
         <label>Medicamento</label>';
         $id = $_GET['idut'];
		echo '<input type="hidden" value="' . $id . '" name="idutenteup" id="idutenteup" />';
		echo '<input type="hidden" value="' . $tratamento . '" name="idtrat"  />';
		
         include 'cont.php'; 
         $STH3 = $DBH -> prepare('SELECT  * FROM  medicamentos');
		$STH3->execute();
		 echo' <select class="form-control" name="medic">';
		while ($row3 = $STH3 -> fetch())    
	{
                    if($row3['id_medicamento']==$row5['id_medicamento'])
					{
						 echo '<option value="'.$row3['id_medicamento'].'" selected>'.$row3['descricaoo'].'</option>';
						
					}
                        echo '<option value="'.$row3['id_medicamento'].'">'.$row3['descricaoo'].'</option>';
	}
                     echo' </select>
                    </div>';
       echo' <div class="form-group">
         <label>Momento</label>';
		$STH4 = $DBH -> prepare('SELECT  * FROM  momentos');
		$STH4->execute();
		 echo' <select class="form-control" name="moment">';
		while ($row4 = $STH4 -> fetch())    
	{
                      if($row4['id_momento']==$row5['id_momento'])
					  {
					  echo '<option value="'.$row4['id_momento'].'" selected>'.$row4['descricao'].'</option>';
						
					  }
					
				else {
                        echo '<option value="'.$row4['id_momento'].'">'.$row4['descricao'].'</option>';
	
					}
	}
                     echo' </select>
           </div>';

					               
                    
                   echo' <label>Dose</label>

                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-medkit"></i></span>
                    <input type="text" class="form-control" name="dose" value="'.$row5['dose'].'">
                  </div>';
                  echo "<div class='input-group'>
                  	<br>
                    <input type='submit' value='Alterar' name='env' class='btn btn-primary'></form> ";
                   if(isset($_GET['voltar']))
                   {
                   	    echo" &nbsp <input type='button' onclick=\"location.href='".$_GET['voltar']."?idut=".$id."'\"value='Cancelar' class='btn btn-primary'>";	                  	
                   }
                  echo"</div>

	</form>";
		
}
?>