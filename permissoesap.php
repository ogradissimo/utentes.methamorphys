
<div class='box box-default'>
	<div class='box-header with-border'>
		<h3 class='box-title'><i class="fa fa-tag"></i> Permissões:</h3>
		<div class="box-tools pull-right">

		</div>
	</div>
	<div class='box-body'>
		<div class='row'>
			
			<div class='box-body pad'>
				<?php 
				echo '<form action="inserirperm.php" method="get">';
		include_once 'cont.php';
		
		$tipo=$_GET['perfil'];
		echo '<input type="hidden" name="perm" value="'.$tipo.'"  />';
		
		$STH2 = $DBH -> prepare("SELECT * FROM paginas  Order BY id_pagina ASC");
		$STH2 -> execute();
		echo "<table class='table table-hover' >
		<tr>";
		$roda=0;
		$vref=true;
		while ($row2 = $STH2 -> fetch(PDO::FETCH_ASSOC)) 
		{
			$vref=true;
		 
			if($roda==2)
			{
				echo"</tr><tr>";
				$roda=0;
			}
		$STH = $DBH -> prepare("SELECT* FROM perfil_pagina  Where id_tipo=".$tipo."  Order BY id_pagina DESC");
		$id = $_SESSION['idut'];
		$STH -> bindParam(1, $id);
		$STH -> execute();
		 $result=$STH->rowcount();
		if($result==0)
		{
			echo '<td><input type="checkbox" name="check[]"  value="'.$row2['id_pagina'].'" class="flat-red"/> &nbsp;<b> '.$row2['nome'].'</b> </td>';	
			 $roda=$roda+1;			
			 $vref=false;
			
		}
		while ($row = $STH -> fetch(PDO::FETCH_ASSOC)) 
		{
			if($row['id_pagina']==$row2['id_pagina'])
			{
			echo '<td><input type="checkbox" name="check[]"  value="'.$row2['id_pagina'].'" class="flat-red" checked="checked"/> &nbsp;<b> '.$row2['nome'].'</b> </td>';	
			 $roda=$roda+1;		
			 $vref=false;
			}
				
		}
		if($vref==true)
		{
			 echo '<td><input type="checkbox" name="check[]"  value="'.$row2['id_pagina'].'" class="flat-red" /> &nbsp;<b> '.$row2['nome'].'</b> </td>';	
			 $roda=$roda+1;		
			 $vref=true;	
		}	
		}
echo '<tr><tr>
<td clospan="2"><input type="submit" value="Enviar" name="Inserir" class="btn btn-primary"></form>';
echo" &nbsp <input type='button' onclick=\"location.href='permissoes.php'\"value='Cancelar' class='btn btn-primary'></td></tr></table>";
				if(isset($_GET['alt']))
				{
					echo"<script>
					alert('Permissões Mudadas')
					</script>";
				}
				?>
			</div>
		</div>
	</div>
</div>