<?php
include 'cont.php';
$id=$_GET['idut'];
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
	echo "<p><b>Tabela Diculdades Funcionais :</b></p>";
	echo "<form action='inserttab.php' method='get' name='formtest'><table class='table table-hover' >
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
	echo '<input type="hidden" name="utente"  value="'.$id.'"/>';
	
for ($r=0;$r<count($arraydif);$r++)
{
	echo "<tr><td>".$arraydif[$r]."</td>";
	echo '<input type="hidden" name="di[]"  value="'.$arraydifid[$r].'"/>';
	echo '<input type="hidden" name="nome[]"  value="'.$arraydif[$r].'"/>';
	
			 $string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($arraydif[$r], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
	
	for ($f=0;$f<count($arrayresp);$f++)
	{
		if($arrayrespid[$f]==$respostas[$r])
		{
			
		echo '<td><input type="radio" name="'.$string.'" checked="checked" value="'.$arrayrespid[$f].'"/></td>';
			
		}
		
		else
			{
						echo '<td><input type="radio" name="'.$string.'" value="'.$arrayrespid[$f].'" /></td>';
				
			}
		
	}
	echo "</tr>";
}
$cols=count($arrayresp)+1;
echo '<tr>
	<td colspan="'.$cols.'"><input type="submit" value="Enviar" name="btn" class="btn btn-primary" /></form>';
	if(isset($_GET['voltar']))
                   {
                   	    echo" <input type='button' onclick=\"location.href='".$_GET['voltar']."?idut=".$id."'\"value='Cancelar' class='btn btn-primary'>";	                  	
                   }
	echo'</td></table>';
echo '<script  type="text/javascript">
 var frmvalidator = new Validator("formtest");';
  //Adiciona as regas de validação aos Campos
  for($e=0;$e<count($arraydif);$e++)
{
  $string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($arraydif[$e], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
  echo "frmvalidator.addValidation('".$string."','selone','Opções em Falta');";
  
}
echo'frmvalidator.EnableMsgsTogether();
</script>';
?>