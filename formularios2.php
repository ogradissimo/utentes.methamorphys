<style>
	textarea { resize: none ;}
</style>
<?php 
include 'cont.php' ;
$STH = $DBH -> prepare('select tabeladicionario.nome_tabela ,campos.tipovalidacao,tabeladicionario.nome_campo, tipo_controlo.id_tipo_control, tipo_controlo.tipo, tipo_controlo.style ,campos.id_campos,campos.nome_web  from formulario ,campos, tipo_controlo, tabeladicionario where formulario.id_pagina= ? and formulario.id_formulario=campos.id_formulario and campos.id_tipo_controlo=tipo_controlo.id_tipo_control and campos.campo_associado=tabeladicionario.id_dicionario ORDER BY ordem ASC');
$STH -> bindParam(1, $pagid);
$STH->execute();
echo "
	<form action='inserer2.php' method='get' name='formtest'>
	<div class='box-body'>";
	if(isset($_GET['idut']))
	{
		 $id = $_GET['idut'];
		echo '<input type="hidden" value="' . $id . '" name="idut"  />';
		echo '<input type="hidden" value="' . $pagid . '" name="pagid"  />';
		$ur=end(explode("/", $_SERVER['PHP_SELF']));
	    echo '<input type="hidden" value="' .$ur . '" name="url" />';
	}
	//Criação do Formulario
	while ($row = $STH -> fetch()) 
{
	$controlotipo[]=$row['id_tipo_control'];
	$tipos[]=$row['tipovalidacao'];
	$nome[]=$row['nome_web'];
	if($row['id_tipo_control']=='3')
	{
		$STH2 = $DBH -> prepare('SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE table_schema = "utentes_metha" AND TABLE_NAME = "'.$row['nome_tabela'].'" and COLUMN_KEY="PRI"');
		$STH2->execute();
		$STH3 = $DBH -> prepare('SELECT * FROM '.$row['nome_tabela'].' ');
		$STH3->execute();
	echo  "<div class='form-group'>
				<div class='box-body table-responsive no-padding'>
				<table border='0' cellpadding='' cellspacing='0' > 
						<tr>
								<td colspan='2'><label for='exampleInputEmail1'>".$row['nome_web']." :</label></td>
						</tr>";
						while ($row2 = $STH2 -> fetch()) 
						{
							$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($row['nome_web'], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
							while ($row3 = $STH3 -> fetch()) 
								{
									echo "<tr>
										<td width='20px' align='center'><input name='".$string."[]' id='".$string."' type='".$row['tipo']."' value='".$row3[$row2['COLUMN_NAME']]."' class='flat-red'/></td>
										 <td> <label align='left'> ".$row3[$row['nome_campo']]." </label></td>
										 </tr>";

									
									
								}		
						}	
														
				echo"</table></div>
		</div>";	
	}
if($row['id_tipo_control']== 4)
	{
		$STH2 = $DBH -> prepare('SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE table_schema = "utentes_metha" AND TABLE_NAME = "'.$row['nome_tabela'].'" and COLUMN_KEY="PRI"');
		$STH2->execute();
		$STH3 = $DBH -> prepare('SELECT * FROM '.$row['nome_tabela'].' ');
		$STH3->execute();
	echo  "<div class='form-group'>
				<div class='box-body table-responsive no-padding'>
				<table border='0' cellpadding='' cellspacing='0' > 
						<tr>
								<td colspan='2'><label for='exampleInputEmail1'>".$row['nome_web']." :</label></td>
						</tr>";
						$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($row['nome_web'], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
						
						while ($row2 = $STH2 -> fetch()) 
						{
							while ($row3 = $STH3 -> fetch()) 
								{

									echo "<tr>
										<td width='20px' align='center'><input name='".$string."' type='".$row['tipo']."' value='".$row3[$row2['COLUMN_NAME']]."'class='flat-red'/></td>
										 <td> <label> ".$row3[$row['nome_campo']]." </label></td>
										 </tr>";

									
									
								}		
						}	
														
				echo"</table></div>
		</div>";	
	}
if($row['id_tipo_control']== 5)
	{
		$STH2 = $DBH -> prepare('SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE table_schema = "utentes_metha" AND TABLE_NAME = "'.$row['nome_tabela'].'" and COLUMN_KEY="PRI"');
		$STH2->execute();
		$STH3 = $DBH -> prepare('SELECT * FROM '.$row['nome_tabela'].' ');
		$STH3->execute();
	echo  "<div class='form-group'>
						<label for='exampleInputEmail1'>".$row['nome_web']." :</label>";
					$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($row['nome_web'], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));						
					echo "<select name='".$string."'class='form-control'>"; 
						echo "<option value='000' selected='selected'>Selecione um Campo</option>";
						while ($row2 = $STH2 -> fetch()) 
						{
							while ($row3 = $STH3 -> fetch()) 
								{
									echo "<option value = '".$row3[$row2['COLUMN_NAME']]."'>".$row3[$row['nome_campo']]."</option>"; 	
								}		
						}	
						 echo "</select>"; 								
				echo"<div>";	
	}
	if($row['id_tipo_control']== 8)
	{
		$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($row['nome_web'], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));						
		
		echo"<div class='form-group'>
		<label for='exampleInputEmail1'>".$row['nome_web']."</label>
		<div class='box-body pad'>
		<textarea name='".$string."'  class='textarea' style='width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'></textarea>
		</div>
		</div>";
	}
if($row['id_tipo_control']!=3 and $row['id_tipo_control']!=4 and $row['id_tipo_control']!=5 and $row['id_tipo_control']!=8) 
	{	
		$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($row['nome_web'], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));	
		echo"
	<div class='form-group'>
		<label for='exampleInputEmail1'>".$row['nome_web']."</label>
		<div class='input-group'>
		 <div class='input-group-addon'>
       	 <i class='".$row['style']."'></i>
        </div>
		<input type='".$row['tipo']."' id='".$row['id_campos']."' name='".$string."' class='form-control'>
		</div>
		<div>
		";
	}
}
echo "
                  <div class='box-footer'>
                    <input type='submit' value='Enviar' name='env' class='btn btn-primary'></form> ";
                   if(isset($_GET['voltar']))
                   {
                   	    echo" <input type='button' onclick=\"location.href='".$_GET['voltar']."'\"value='Cancelar' class='btn btn-primary'>";	                  	
                   }
                   echo "</div>";
 
 //Criar a validação do formulario                   
   for($a=0;$a<count($tipos);$a++)
{
switch ($tipos[$a]) {
    case 2:
			$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($nome[$a], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
			$validacao[]= 'frmvalidator.addValidation("'.$string.'","req","Campo '.$nome[$a].' Necessário ");';
			$validacao[]= 'frmvalidator.addValidation("'.$string.'","alpha_s","Caracteres invalidos no campo '.$nome[$a].'  ");';
		
        break;
    case 3:
			$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($nome[$a], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));			
			$validacao[]= 'frmvalidator.addValidation("'.$string.'","req","Campo '.$nome[$a].' Necessário ");';
			$validacao[]=  'frmvalidator.addValidation("'.$string.'","num","O Campo '.$nome[$a].' tem que ser numeros ");';
			$validacao[]=  'frmvalidator.addValidation("'.$string.'","maxlength=9","O Campo '.$nome[$a].' tem que ter 9 numeros ");';
        break;
   case 4:
				$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($nome[$a], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
				$validacao[]= 'frmvalidator.addValidation("'.$string.'","dontselect=000","Selecione um Opção no '.$nome[$a].'");';
  break;
   case 5:
			$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($nome[$a], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
				$validacao[]="frmvalidator.addValidation('".$string."','selone','Selecione um Opção no ".$nome[$a]."');";
   break;

}
}                   
                    
 echo '<script  type="text/javascript">
 var frmvalidator = new Validator("formtest");';
  //Adiciona as regas de validação aos Campos
  for($e=0;$e<count($validacao);$e++)
{
  echo $validacao[$e];
}
echo'frmvalidator.EnableMsgsTogether();
</script>';

?>