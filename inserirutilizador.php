<?php
include 'cont.php';
   $nome = $_POST['nome'];
   $email = $_POST['email'];
   $utilizador = $_POST['ut'];
   $pass = $_POST['pass'];
   $tipo = $_POST['perfil'];
$STH3 = $DBH->prepare("INSERT INTO utilizador (nome, email, foto, utilizador, password, id_tipo ) VALUES (?, ? , ? ,?, ?,?)");
$STH3->bindParam('1', $nome);
$STH3->bindParam('2', $email);
$STH3->bindParam('3', $img);
$STH3->bindParam('4', $utilizador);
$STH3->bindParam('5', $pass);
$STH3->bindParam('6', $tipo);
  $file = $_FILES['img'];
		$numFile	= count(array_filter($file['name']));
		
		//PASTA
		$folder		= 'dist/img';
		
		//REQUISITOS
		$permite 	= array('image/jpeg', 'image/png');
		$maxSize	= 1024 * 1024 * 5;
		
		//MENSAGENS
		$msg		= array();
		$errorMsg	= array(
			1 => 'O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini.',
			2 => 'O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE que foi especificado no formulário HTML',
			3 => 'o upload do arquivo foi feito parcialmente',
			4 => 'Não foi feito o upload do arquivo'
		);
		
		if($numFile <= 0)
			echo 'Selecione uma Imagem!';
		else{
			for($i = 0; $i < $numFile; $i++){
				$name 	= $file['name'][$i];
				$type	= $file['type'][$i];
				$size	= $file['size'][$i];
				$error	= $file['error'][$i];
				$tmp	= $file['tmp_name'][$i];
				
				$extensao = @end(explode('.', $name));
				$novoNome = rand().".$extensao";
				
				if($error != 0)
					$msg[] = "<b>$name :</b> ".$errorMsg[$error];
				else if(!in_array($type, $permite))
					$msg[] = "<b>$name :</b> Erro imagem não suportada!";
				else if($size > $maxSize)
					$msg[] = "<b>$name :</b> Erro imagem ultrapassa o limite de 5MB";
				else{
					
					if(move_uploaded_file($tmp, $folder.'/'.$novoNome))
						echo $img=$novoNome;
					else
						$msg[] = "<b>$name :</b> Desculpe! Ocorreu um erro...";
				
				}
				
	$STH3->execute();
$count2 = $STH3->rowCount();
			
}
	
		}
if($count2 == 1)
{
		echo '<meta http-equiv="refresh" content="0; url=criarutilizador.php?&alt=true" />';

}
?>
