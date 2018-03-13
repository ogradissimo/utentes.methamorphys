
<?php
include 'cont.php';
$STH = $DBH->prepare("SELECT * FROM utilizador Where id_ut=?");
 $id=$_GET['idut']; 
$STH -> bindParam(1, $id);
$STH->execute();
	while ($row = $STH->fetch()) {
		echo '<form action="alterarut.php" method="post" name="formtest"  enctype="multipart/form-data">
              <input type="hidden" class="form-control" name="idut" value="'.$id.'">
			   <div class="form-group">
               <label>Nome: </label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                    <input type="text" class="form-control" name="nome" value="'.$row['nome'].'">
                  </div>
                    <label> Email:</label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-envelope-o"></i></span>
                    <input type="email" class="form-control" name="email" value="'.$row['email'].'" >
                  </div>
                  <label>Foto actual: </label>
                   <div class="input-group">
                     <input type="hidden" class="form-control" name="imagem" value="'.$row['foto'].'">
					<img src="dist/img/'.$row['foto'].'" width="100" height="100">                  
					</div>
                 <label>Foto: </label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-folder-open-o"></i></span>
                    <input type="file" class="form-control" name="img[]">
                  </div>
                  <label>Utilizador: </label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                    <input type="text" class="form-control" name="ut" value="'.$row['utilizador'].'">
                  </div>';		
	echo' <label>Perfil</label>';
		$STH4 = $DBH -> prepare('SELECT  * FROM  tipo_utilizador');
		$STH4->execute();
		 echo' <select class="form-control" name="perfil">';
		 echo '<option value="0">Selecione Um perfil</option>';
		while ($row4 = $STH4 -> fetch())    
	{
     if($row['id_tipo']==$row4['id_tipo'])
	 {
	 	                        echo '<option value="'.$row4['id_tipo'].'" selected>'.$row4['descricao'].'</option>';
		
	 	
	 }  
else
	{
	                        echo '<option value="'.$row4['id_tipo'].'">'.$row4['descricao'].'</option>';
		
	}             
	}
                     echo' </select>
   </div>';	
   }
echo '<br>
                  <div class="input-group">
        <input type="submit" value="Alterar" class="btn btn-primary" /></form>&nbsp;';
echo"<input type='button' onclick=location.href='verutilizador.php?idut=".$id."' value='Cancelar'  class='btn btn-primary'>               
</div>";
?>




               