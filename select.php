<?php
include 'con.php';
$pagid='1';
$id=$_GET['id'];
$STH = $DBH -> prepare('select formulario.guardaut ,campos.id_nome_bd, formulario.tabela_associada, tabeladicionario.nome_tabela ,campos.tipovalidacao,tabeladicionario.nome_campo, tipo_controlo.id_tipo_control, tipo_controlo.tipo, tipo_controlo.style ,campos.id_campos,campos.nome_web, campos.campo_associado from formulario ,campos, tipo_controlo, tabeladicionario where formulario.id_pagina=? and formulario.id_formulario=campos.id_formulario and campos.id_tipo_controlo=tipo_controlo.id_tipo_control and campos.campo_associado=tabeladicionario.id_dicionario  ORDER BY ordem ASC');
$STH -> bindParam(1, $pagid);
$STH->execute();
		while ($row = $STH -> fetch()) 
	{
		 $nome[]=$row['nome_web'];
		$camposdb[]=$row['nome_bd'];
	}
$STH -> setFetchMode(PDO::FETCH_ASSOC);
$STH2 = $DBH -> prepare('SELECT  *  FROM teste WHERE id = ? ');
$STH2 -> bindParam(1, $id);
$STH2->execute();
$STH2 -> setFetchMode(PDO::FETCH_ASSOC);
	echo "<table>";
	while ($row2 = $STH2 -> fetch()) 
	{
		for ($i=0; $i <count($camposdb) ; $i++)
		 { 
			echo "<tr>
						<td>".$nome[$i]."</td>
						<td>".$row2[''.$camposdb[$i].'']."</td>
				  </tr>";
		}
	}
	echo "<table>";
	?>