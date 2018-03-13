<?php
include 'cont.php';
$STH = $DBH->prepare("SELECT familiares.id_familiar , familiares.nome , familiares.contacto, familiares.idade  , familiares.morada , familiares.familiarproximo , grau_parentesco.descricao FROM familiares, grau_parentesco Where  familiares.id_parentesco=grau_parentesco.id_grau_parentesco and  id_familiar = ?");
$id=$_GET['idfm']; 
$STH -> bindParam(1, $id);
$STH->execute();
	while ($row = $STH->fetch()) {
		echo "<p><b>Familiar nº ".$row['id_familiar']."</b>
		<p><b>Nome: </b>".$row['nome']."</p>
		<p><b>Morada: </b>".$row['morada']."</p>
		<p><b>Parentesco: </b>".$row['descricao']."</p>
		<p><b>Idade: </b>".$row['idade']."</p>
		<p><b>Contacto: </b>".$row['contacto']."</p>";
		if($row['familiarproximo']=='1')
		{
					echo "<p><b>Proximo : </b>Sim</p>";
			
		}
		else {
					echo "<p><b>Proximo: </b>Não</p>";
			
		}
		
	}
if(isset($_GET['al']))
{
		echo "<script>
	alert('Registo Alterado!');
	</script> ";
}
?>