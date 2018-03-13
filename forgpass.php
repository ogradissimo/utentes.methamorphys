<?php 
include_once('cont.php');
	session_start();
	if ($_SESSION['activa']==true) {
		header("location: home.php");
	
		}

if(isset($_GET['envia']))
{

$STH = $DBH -> prepare('SELECT  *  FROM utilizador WHERE email= ? ');
$STH -> bindParam(1, $email);
echo $_GET['email'];
$email = $_GET['email'];
$email = addslashes($email);
$STH -> execute();
$STH -> setFetchMode(PDO::FETCH_ASSOC);
$res=$STH->rowcount();

if($res==1)
	{
	while ($row = $STH -> fetch()) 

		{
	$t = $email;
  	$fro = "casulo.abrigo@methamorphys.pt";
    $nome=$row['nome'];
	$pass=$row['password'];
  	$subjec = "Recuperar a Password";
 
  $bod = <<<BODY
  Olá $nome,
 
  A sua password para entrar na plataforma é $pass
 
  Cumprimentos
  Methamorphys
BODY;
 
  mail ($t, $subjec, $bod, "From: $fro");
	
		}
	echo '<meta http-equiv="refresh" content="0; url=forgpass.php?env=true" />';
	}
else
	{
	echo '<meta http-equiv="refresh" content="0; url=forgpass.php?env=false" />';
		
	}	
}
?>
<!DOCTYPE html>
<html>
  <head>
  	<meta name="author" content="Abdullah Almsaeed">
    <meta charset="UTF-8">
    <title>Gestor Methamorphys</title>
        <link rel="shortcut icon" href="dist/img/ico.ico" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="index.php">Methamorphys</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg"><?php 
        	$msg=$_GET['env'];
			if(isset($_GET['env']))
			{
				if($_GET['env']=='true')
				{
									echo "<font color='green'>Email Enviado</font>";
					
				}
				else {
									echo "<font color='red'>Algo esta mal contacte o <i>Administrador</i> </font>";
					
				}
				
			}
			else {
				echo " Recuperar Password";
			}
        	
        	?>
        	</p>
        <form action="#" method="get">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">                           
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" name="envia">Recuperar</button>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
  </body>
</html>