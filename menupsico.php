<?php
$id=$_GET['idut'];
include ("cont.php");
$STH2 = $DBH -> query('Select paginas.nome , paginas.link From  perfil_pagina , paginas where perfil_pagina.id_pagina = paginas.id_pagina and id_local=6 and id_agre=1 and id_tipo = ' . $_SESSION['perfil'] . ' ');
$STH2 -> execute();
$result = $STH2 -> rowCount();
$STH2 -> setFetchMode(PDO::FETCH_ASSOC);
 $permisa =$STH2->rowcount();
echo '<div class="row" align="center">';
if($permisa!=0)
{
while ($row2 = $STH2 -> fetch()) {
	echo ' <div class="col-lg-3 col-xs-6">
              <!-- small box -->
                <div class="inner">
';
                if($row2['nome']=='Voltar')
				{
				echo'<a href="'.$row2['link'].'?idut='.$id.'"><img src="dist/img/back.png"><h4>'.$row2['nome'].'</h4></a>';
					
				}
				else {
				  echo'<a href="'.$row2['link'].'?idut='.$id.'"><img src="dist/img/Document.png"><h4>'.$row2['nome'].'</h4></a>';
					
				}               echo '                <p>&nbsp</p>
               </div>
            </div>';

}
}
else {
	$impedido=1;
}
echo"</div>";
if($impedido!=1)
{
echo"
<div class='box box-default'>
	<div class='box-header with-border'>
		<h3 class='box-title'><a href='visualizarutentes.php'><i class='fa fa-fw fa-arrow-left'></a></i> Informação relatório psicológico:</h3>
		<div class='box-tools pull-right'>";
			$id=$_GET['idut'];
			$id2=$_GET['idpsi']; 
			$STH5 = $DBH -> query('Select * From perfil_pagina Where id_pagina=22');
			$STH5 -> execute();
			while ($row5 = $STH5 -> fetch()) {
				if($row5['id_tipo']==$_SESSION['perfil'])
				{
				echo '<a href="verpsicologicos.php?idut='.$id.'&op=2&voltar='.$ur=end(explode("/", $_SERVER['PHP_SELF'])).'&idpsi='.$id2.'"><img src="dist/img/edit.png" /></a>';
					
				}
			}		
		echo"</div>
	</div>
	<div class='box-body'>
		<div class='row'>
			<div class='box-body pad'>";
				if(isset($_GET['op']))
				{
			include 'editarps.php';				
				}
else {
	include 'verps.php';
	echo "<br>";
	$id=$_GET['idut'];
echo '<a href="'.$_GET['tras'].'?idut='.$id.'"><img src="dist/img/back3.png" /> Voltar para a Tabela</a>';	
if(isset($_GET['alt']))
{
	echo "<script>
	alert('Registo Alterado!');
	</script> ";
}	
}
				
				echo"
			</div>

		</div>
	</div>
</div>";
}
else {
	include 'paginaerro.php';
}
?>
