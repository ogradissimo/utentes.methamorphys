<?php
session_start();
session_cache_expire(1);

include "cont.php";
$STH = $DBH -> prepare('SELECT  *  FROM utilizador WHERE utilizador=? and password=? ');
$STH -> bindParam(1, $user);
$STH -> bindParam(2, $pass);
$user = $_POST['user'];
$user = addslashes($user);
$pass = $_POST['pass'];
$pass = addslashes($pass);
$STH -> execute();
$STH -> setFetchMode(PDO::FETCH_ASSOC);
$res=$STH->rowcount();
	if($res==1)
	{
	while ($row = $STH -> fetch()) 

{
	
		$_SESSION['idut'] = $row['id_ut'];
		$_SESSION['utilizador'] = $row['utilizador'];
		$_SESSION['perfil'] = $row['id_tipo'];
		$_SESSION['foto'] =   $row['foto'];
        $_SESSION['activa'] = true;
		
		header("location: home.php");
		session_write_close ();

}
$_SESSION['mensagem'] = 0;
$_SESSION['aviso']=0; 
	}
else {
header("location: index.php?erro=003");
	} 

?>