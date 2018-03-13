<?php
include 'cont.php';
$id=$_GET['idmed'];
$nome=$_GET['nome'];
$STH = $DBH->prepare("UPDATE medicamentos SET descricaoo = ?  WHERE id_medicamento = ?");
$STH->bindParam('1', $nome);
$STH->bindParam('2', $id);
$STH->execute();
$count = $STH->rowCount();
if($count ==1)
{
	echo '<meta http-equiv="refresh" content="0; url=visualizarmedicamento.php?altu=true" />';
}
if($count ==0)
{
echo '<meta http-equiv="refresh" content="0; url=visualizarmedicamento.php" />';
}
?>