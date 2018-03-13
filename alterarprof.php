<?php 
include 'cont.php';
   $nome = $_POST['nome'];
   $email = $_POST['email'];
   $utilizador = $_POST['ut'];
   $pass = $_POST['pass'];
   $tipo = $_POST['perfil'];
   $uti = $_POST['idut'];
$STH = $DBH->prepare("UPDATE utilizador SET nome = ? , email = ? , foto = ? , utilizador = ? , password	= ? , id_tipo = ? WHERE id_ut = ?");
$STH->bindParam('1', $nome);
$STH->bindParam('2', $email);
$STH->bindParam('3', $img);
$STH->bindParam('4', $utilizador);
$STH->bindParam('5', $pass);
$STH->bindParam('6', $tipo);
$STH->bindParam('7', $uti);
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
		
		if($numFile <= 0){
			$img=$_POST['imagem']	;
			$STH->execute();
			$count = $STH->rowCount();	
}	
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
			}
				
$STH->execute();
$count = $STH->rowCount();
			
}

if($count ==1)
{
echo '<meta http-equiv="refresh" content="0; url=verperfil.php?idut='.$uti.'&altu=true" />';
}
if($count ==0)
{
echo '<meta http-equiv="refresh" content="0; url=verperfil.php?idut='.$uti.'" />';
}
?>