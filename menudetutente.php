<?php
include ("cont.php");
$STH2 = $DBH -> query('Select paginas.nome , paginas.link From  perfil_pagina , paginas where perfil_pagina.id_pagina = paginas.id_pagina and id_local=3 and id_agre=1 and id_tipo = ' . $_SESSION['perfil'] . ' ');
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
                <a href="'.$row2['link'].'"><img src="dist/img/Document.png"><h4>'.$row2['nome'].'</h4></a>
                <p>&nbsp</p>
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
echo "<div class='box box-default'>
	<div class='box-header with-border'>
		<h3 class='box-title'><a href='visualizarutentes.php'><i class='fa fa-fw fa-arrow-left'></a></i> Informações Gerais:</h3>
	</div>
	<div class='box-body'>
		<div class='row'>
			<div class='box-body pad'>";
include 'cont.php';
$pagid='2';
$STH = $DBH -> prepare('select formulario.guardaut ,campos.id_nome_bd, formulario.tabela_associada, tabeladicionario.nome_tabela ,campos.tipovalidacao,tabeladicionario.nome_campo, tipo_controlo.id_tipo_control, tipo_controlo.tipo, tipo_controlo.style ,campos.id_campos,campos.nome_web, campos.campo_associado from formulario ,campos, tipo_controlo, tabeladicionario where formulario.id_pagina=? and formulario.id_formulario=campos.id_formulario and campos.id_tipo_controlo=tipo_controlo.id_tipo_control and campos.campo_associado=tabeladicionario.id_dicionario  ORDER BY ordem ASC');
$STH -> bindParam(1, $pagid);
$STH->execute();
		while ($row = $STH -> fetch()) 
	{
		$tabela=$row['tabela_associada'];
		$STH2 = $DBH -> prepare('select  * from tabeladicionario where id_dicionario='.$row['id_nome_bd'].'');
		$STH2->execute();
		while ($row2 = $STH2 -> fetch()) 
		{
		$nome[]=$row['nome_web'];
		$camposdb[]=$row2['nome_campo'];
		$campoasociada[]=$row['campo_associado'];
	}
		
	}
$STH3 = $DBH -> prepare('SELECT  *  FROM '.$tabela.' WHERE idutente = ? ');
$id=$_GET['idut'];
$STH3 -> bindParam(1, $id);
$STH3->execute();
$STH3 -> setFetchMode(PDO::FETCH_ASSOC);
	while ($row3= $STH3->fetch()) 
	{		
		for ($i=0; $i<count($camposdb) ; $i++)
		 {
			if($campoasociada[$i]!=1)
			{
				$STH4 = $DBH -> prepare('select  * from tabeladicionario where id_dicionario='.$campoasociada[$i].'');
				$STH4->execute();
				while ($row4 = $STH4->fetch()) 
				{
					$STH6 = $DBH -> prepare('SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE table_schema = "meta" AND TABLE_NAME = "'.$row4['nome_tabela'].'" and COLUMN_KEY="PRI"');
					$STH6->execute();
			while ($row6 = $STH6 -> fetch()) 
				{
					$STH5 = $DBH -> prepare('select  * from '.$row4['nome_tabela'].' where '.$row6['COLUMN_NAME'].'='.$row3[$camposdb[$i]].'');
					$STH5->execute();
					while ($row5 = $STH5->fetch()) 
				{
					echo "<b>".$nome[$i].":</b>  ".$row5[$row4['nome_campo']];
					echo "<br>";
					
				}	
			}
					
			}
			}
else{
				echo " <p><b>".$nome[$i].":</b>  ".$row3[$camposdb[$i]]."</p>";
	
}
			
		}
	}

echo"		</div>
			
		</div>
	</div>
</div>";
}

else {
	include 'paginaerro.php';
}
?>
