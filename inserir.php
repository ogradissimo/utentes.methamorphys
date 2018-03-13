<?php 
session_start();
include_once 'cont.php';
$pagid=1;
$STH = $DBH -> prepare('select formulario.guardaut ,campos.id_nome_bd, formulario.tabela_associada, tabeladicionario.nome_tabela ,campos.tipovalidacao,tabeladicionario.nome_campo, tipo_controlo.id_tipo_control, tipo_controlo.tipo, tipo_controlo.style ,campos.id_campos,campos.nome_web, campos.campo_associado from formulario ,campos, tipo_controlo, tabeladicionario where formulario.id_pagina=? and formulario.id_formulario=campos.id_formulario and campos.id_tipo_controlo=tipo_controlo.id_tipo_control and campos.campo_associado=tabeladicionario.id_dicionario  ORDER BY ordem ASC');
$STH -> bindParam(1, $pagid);
$STH->execute();
		//Gerar os Array para O INSERT
		$i=3;
		while ($row = $STH -> fetch()) 
	{
		$ut=$row['guardaut'];
		$STH2 = $DBH -> prepare('select  * from tabeladicionario where id_dicionario='.$row['id_nome_bd'].'');
		$STH2->execute();
				while ($row2 = $STH2 -> fetch()) 
	{
	
	if($row['id_tipo_control'] !=3 )
		{
		$tabela=$row['tabela_associada'];
		 $campos .= $row2['nome_campo'].', ';
		 $values .=" ? , ";
		 $var[] = '$'.$row['id_campos'];
		 $var2[] = $row['nome_web'];
		}
//Insert for Checkbox
if($row['id_tipo_control']==3)
{
		 $string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($row['nome_web'], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));	
		$nomecheck[]= $string;
 		$array2[]="INSERT INTO ".$row2['nome_tabela']." (id_utente,".$row2['nome_campo']." ) values ( ? , ?)";
}
	}
}
 $campos=substr($campos, 0, -2);
 $values=substr($values, 0, -2);
 if($ut==1)
 {
 	if(isset($_GET['idut']))
	{
	 $STH2 = $DBH->prepare("INSERT INTO ".$tabela." (id_utente , ".$campos.", id_utilizador) values ( ?, ? ,".$values.")");
		
	}
else
	{
 $STH2 = $DBH->prepare("INSERT INTO ".$tabela." (".$campos.", id_utilizador) values ( ? ,".$values.")");
		
	}
 	
 }
else {
	 	if(isset($_GET['idut']))
	{
				$STH2 = $DBH->prepare("INSERT INTO ".$tabela." (id_utente , ".$campos.") values (? ,".$values.")");
		
	}
else
	{
		$STH2 = $DBH->prepare("INSERT INTO ".$tabela." (".$campos.") values (".$values.")");
		
	}
	
}
//Gera os BindParam para o PDO
if(isset($_GET['idut']))
{
$STH2->bindParam(1,$idutente);	
$idutente = $_GET['idut'];
$o=1;	
}
else {
$o=0;	
}

//Cria os BindParam para a tabela principal
for($i=0;$i<count($var);$i++)
{
  $o=$o+1;
 $STH2->bindParam($o,$var[$i]);
 $string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($var2[$i], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
 //echo  $var[$i];
 //echo $_GET[$string];
 //echo "<br>";
 $var[$i]=$_GET[$string];
}
if($ut==1)
{
$STH2->bindParam($o+1,$ut);
$ut=$_SESSION['idut'];

} 
//print_r($STH2);
$STH2->execute();
$count = $STH2->rowCount();

//echo $id;
//Insert em Tabelas a parte (Checkbox)
$contagem=count($array2);
if ($contagem != 0)
{
$id=$DBH->lastInsertId($tabela);
for($e=0;$e<$contagem;$e++)
{
	$opcoes = $_GET[$nomecheck[$e]];
	
	foreach ($opcoes as $campo){
			$STH3 = $DBH->prepare($array2[$e]);
			$STH3->bindParam(1,$id);
			$STH3->bindParam(2,$campo);
			$STH3->execute();
	
	}
}
	
} 
 
 if($count == 1)
{
	echo "<script>
	alert('Registo Inserido!');
	</script> ";
}
 

?>