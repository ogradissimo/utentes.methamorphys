<?php
include 'cont.php';
$STH = $DBH -> prepare('select formulario.guardaut ,campos.id_nome_bd, formulario.tabela_associada, tabeladicionario.nome_tabela ,campos.tipovalidacao,tabeladicionario.nome_campo, tipo_controlo.id_tipo_control, tipo_controlo.tipo, tipo_controlo.style ,campos.id_campos,campos.nome_web, campos.campo_associado from formulario ,campos, tipo_controlo, tabeladicionario where formulario.id_pagina=? and formulario.id_formulario=campos.id_formulario and campos.id_tipo_controlo=tipo_controlo.id_tipo_control and campos.campo_associado=tabeladicionario.id_dicionario  ORDER BY ordem ASC');
$STH -> bindParam(1, $pagid);
$STH -> execute();
while ($row = $STH -> fetch()) {
	$tabela = $row['tabela_associada'];
	$STH2 = $DBH -> prepare('select  * from tabeladicionario where id_dicionario=' . $row['id_nome_bd'] . '');
	$STH2 -> execute();
	while ($row2 = $STH2 -> fetch()) {
		 $tabelaass=$row['tabela_associada'];
		 $nome[] = $row['nome_web'];
		 $camposdbid[] = $row['id_nome_bd'];
		 $camposdb[] = $row2['nome_campo'];
		 $campoasociada[] = $row['campo_associado'];
		 $tipocontrolo[]= $row['id_tipo_control'];
		if($row['id_tipo_control']!=3)
		{
			if($tabelaass!='utente')
{
$STH3 = $DBH -> prepare('SELECT  *  FROM ' . $row['tabela_associada'] . ' WHERE id_utente = ? ');
$id = $_GET['idut'];
$STH3 -> bindParam(1, $id);	
}
else {
$STH3 = $DBH -> prepare('SELECT  *  FROM ' . $tabela . ' WHERE idutente = ? ');
$id = $_GET['idut'];
$STH3 -> bindParam(1, $id);

}
$STH3 -> execute();
$STH3 -> setFetchMode(PDO::FETCH_ASSOC);
$count = $STH3->rowCount();
while ($row3 = $STH3 -> fetch()) {			
		if ($row['campo_associado'] != 1) {
			$STH4 = $DBH -> prepare('select  * from tabeladicionario where id_dicionario=' . $row['campo_associado'] . '');
			$STH4 -> execute();
			while ($row4 = $STH4 -> fetch()) {
				
				$STH6 = $DBH -> prepare('SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE table_schema = "utentes_metha" AND TABLE_NAME = "' . $row4['nome_tabela'] . '" and COLUMN_KEY="PRI"');
				$STH6 -> execute();
				while ($row6 = $STH6 -> fetch()) {
						if ($row3[$row2['nome_campo']] == '') {

							echo "<p><b>" . $row['nome_web'] . ":</b> Campo Vazio!!</p>";

						} 
					else {
					$STH5 = $DBH -> prepare('select  * from ' . $row4['nome_tabela'] . ' where ' . $row6['COLUMN_NAME'] . '=' . $row3[$row2['nome_campo']] . '');
					$STH5 -> execute();
					$STH5 -> setFetchMode(PDO::FETCH_ASSOC);	
					//$count = $STH5->rowCount();

					while ($row5 = $STH5 -> fetch()) {
						

							echo "<p><b>" . $row['nome_web'] . ":</b>  " . $row5[$row4['nome_campo']]."</p>";

						

					}
				}
			}

			}
		} else {
			if ($row3[$row2['nome_campo']] == '') {
				echo " <p><b>" . $row['nome_web'] . ":</b> Campo Vazio!! </p>";

			} else {
				echo " <p><b>" . $row['nome_web'] . ":</b>  " . $row3[$row2['nome_campo']] . "</p>";

			}
	
			}
		}
	}
		
			
else {
$STH6 = $DBH -> prepare('SELECT  *  FROM tabeladicionario WHERE id_dicionario = ? ');
$id1 = $row['id_nome_bd'];
$STH6 -> bindParam(1, $id1);
$STH6 -> execute();	
while ($row6 = $STH6 -> fetch()) {
	  $tabela1=$row6['nome_tabela'];
	  $campo1=$row6['nome_campo'];						
}

$STH7 = $DBH -> prepare('SELECT  *  FROM tabeladicionario WHERE id_dicionario = ? ');
$id2 = $row['campo_associado'];
$STH7 -> bindParam(1, $id2);
$STH7 -> execute();	
while ($row7 = $STH7 -> fetch()) {
$STH10 = $DBH -> prepare('SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE table_schema = "utentes_metha" AND TABLE_NAME =? and COLUMN_KEY="PRI"');
$tabelapr = $row7['nome_tabela'];
$STH10 -> bindParam(1, $tabelapr);
$STH10 -> execute();	
while ($row10 = $STH10 -> fetch()) {
$nomedpk=$row10['COLUMN_NAME'];	
}
	 $tabela2=$row7['nome_tabela'];
	 $campo2=$row7['nome_campo'];						
}
$STH8 = $DBH -> prepare('SELECT  '.$tabela2.'.'.$campo2.'  FROM '.$tabela1.','.$tabela2.' WHERE '.$tabela1.'.'.$campo1.'='.$tabela2.'.'.$nomedpk.' and id_utente = ? ');
$idut = $_GET['idut'];
$STH8 -> bindParam(1, $idut);
$STH8 -> execute();	
	 $count2 = $STH8->rowCount();
	 echo " <p><b>" . $row['nome_web'] . ":</b></p>";
	 
if($count2==0)
{
	echo "<li><p>Sem registos selecionados</p></li>";
}
else {
	

while ($row8 = $STH8 -> fetch()) {
					echo'<li><p>'.$row8[$campo2].'</p></li>';	
	}
}	
}
}

}
 if(isset($_GET['alt']))
{
	echo "<script>
	alert('Registo Alterado!');
	</script> ";
}
 
?>