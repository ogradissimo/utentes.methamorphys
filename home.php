<?php 

	session_start();
	if ($_SESSION['activa']!=true) {
		header("location: index.php");
	
		}
		$mensagem=0;
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
  	<meta name="author" content="Abdullah Almsaeed">
    <meta charset="UTF-8">
    <title>Methamorphys</title>
    <link rel="shortcut icon" href="dist/img/ico.ico" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
   
    <link href="plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />


  </head>

  <body class="skin-blue">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
<?php  include 'logo.php'; ?>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->

<?php include 'menucima.php'?>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <?php include 'user.php'?>
          </div>
		<!-- Sidebar Menu -->
          <ul class="sidebar-menu">
           <?php include 'menu.php' ?>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Pagina Inicial</h1>
        </section>

        <!-- Main content -->
        <section class="content">
<?php 
	include'paginainicial.php';
?>
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
        	        </div>
        <!-- Default to the left --> 
        <?php include 'company.php'?>
      </footer>

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    
    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment.min.js" type="text/javascript"></script>
    <script src="plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
    <script src='lang-all.js'></script>
<?php
include'cont.php';
$STH = $DBH -> prepare('SELECT  *  FROM calendario');
$STH -> execute();

while ($row = $STH -> fetch()) 
{
	$datainicio[]=$row['data_inicio'];
	$datafim[]=$row['data_fim'];
	$horainicio[]=$row['hora'];
	$horafim[]=$row['horafim'];
	$titulo[]=$row['descricao_evento'];
}
$string_array1 = implode('|', $datainicio);
$string_array2 = implode('|', $datafim);
$string_array3 = implode('|', $horainicio);
$string_array4 = implode('|', $horafim);
$string_array5 = implode('|', $titulo);
?>
   <script>
var  string_array1, string_array2, string_array3, string_array4, string_array5 ,array1,array2,array3,array4,array5,i;
var eventos=[];//Cria um array na variavel eventos

//recebe a string com elementos separados, vindos do PHP
string_array1 = '<?php echo $string_array1; ?>';
string_array2 = '<?php echo $string_array2; ?>';
string_array3 = '<?php echo $string_array3; ?>';
string_array4 = '<?php echo $string_array4; ?>';
string_array5 = '<?php echo $string_array5; ?>';
//transforma esta string em um array próprio do Javascript
array1 = string_array1.split('|');
array2 = string_array2.split('|');
array3 = string_array3.split('|');
array4 = string_array4.split('|');
array5 = string_array5.split('|');


	$(document).ready(function() {
	for (var i = 0; i< array1.length; i++) {
    //Adiciona o evento ao array
    eventos.push({
        title: array5[i],
        start: array1[i]+'T'+array3[i],
        end:  array2[i]+'T'+array4[i]
    });
}	
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			lang: "pt",
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: eventos
		});
		
	});

</script>

  </body>
</html>