 <?php
include 'cont.php';
 $nome = $_GET['nome'];
$STH3 = $DBH->prepare("INSERT INTO medicamentos (descricaoo) VALUES (?)");
$STH3->bindParam('1', $nome);
$STH3->execute();
$count2 = $STH3->rowCount();
if($count2 == 1)
{		echo '<meta http-equiv="refresh" content="0; url=criarmedicamento.php?alt=true" />';
	

}
?>
