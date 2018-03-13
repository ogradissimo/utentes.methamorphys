<?php
include 'cont.php';
$ver=$_GET['di'];
print_r($ver);
$nome=$_GET['nome'];
print_r($nome);
$ut=$_GET['utente'];
for ($i=0; $i < count($nome) ; $i++) {
	 $string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($nome[$i], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
	
	$respostas[]= $_GET[$string];
}
if(count($ver)==count($respostas))
{
		$STH12 = $DBH -> prepare('DELETE FROM difilculdade_resposta_utente WHERE id_utente = ?');
		$STH12 -> bindParam(1, $ut);
		$STH12 -> execute();
		echo count($respostas);
for ($a=0; $a < count($respostas) ; $a++) {
		
		$STH13 = $DBH -> prepare('INSERT INTO difilculdade_resposta_utente (id_utente, id_dificuldade, id_resposta) VALUES (?, ? ,?)');
		$STH13 -> bindParam(1, $ut);
		$STH13 -> bindParam(2, $ver[$a]);
		$STH13 -> bindParam(3, $respostas[$a]);
		$STH13 -> execute();
}
	echo $count2 = $STH13->rowCount();
 if($count2 == 1)
{
		echo '<meta http-equiv="refresh" content="0; url=dificuldades.php?idut='.$ut.'&at=true" />';

}		
}
?>