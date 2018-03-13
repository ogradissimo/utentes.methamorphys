<?php
include 'cont.php';
$STH3 = $DBH -> prepare('SELECT  *   FROM  difilculdades  ORDER BY id_difilculdade ASC');
$STH3->execute();
	while ($row3 = $STH3 -> fetch()) 
	{
		 $arraydifid[]=$row3['id_difilculdade'];
		 $arraydif[]=$row3['descricao'];
	}
$STH4 = $DBH -> prepare('SELECT  *   FROM  resposta_dificuldade ORDER BY id_resposta ASC');
$STH4->execute();
	while ($row4 = $STH4 -> fetch()) 
	{
		  $arrayrespid[]=$row4['id_resposta'];
		  $arrayresp[]=$row4['descricao'];
	}
$STH2 = $DBH -> prepare('SELECT   *  FROM difilculdade_resposta_utente  WHERE  id_utente = ? ORDER BY id_dificuldade ASC');
$STH2 -> bindParam(1, $id);
$STH2->execute();
$count = $STH2->rowCount();
if($count==0)
{
	echo "<p><b>Tabela Diculdades Funcionais</b></p><li>Tabela não preenchida</li>";
}
else {
	echo "<p><b>Tabela Diculdades Funcionais :</b></p>";
	echo "<table class='table table-hover' >
		<tr> 
			<th></th>";
	for ($d=0;$d<count($arrayresp);$d++)
	{
		echo "<th>".$arrayresp[$d]."</th>";
	}
	echo"</tr>";
	while ($row2 = $STH2 -> fetch()) 
	{
		 $respostas[]=$row2['id_resposta'];
		
	}
for ($r=0;$r<count($arraydif);$r++)
{
	echo "<tr><td>".$arraydif[$r]."</td>";
	for ($f=0;$f<count($arrayresp);$f++)
	{
		if($arrayrespid[$f]==$respostas[$r])
		{
		echo '<td><img src="dist/img/checked.png" width="20" height="20" /></td>';
			
		}
		
		else
			{
						echo "<td></td>";
				
			}
		
	}
	echo "</tr>";
}
echo "</table>";
}
?>
