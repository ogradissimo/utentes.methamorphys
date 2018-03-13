     <script> 
function confirmacao(id ){ 
	var resposta = confirm("Deseja remover esse registro?");  
	 if (resposta == true) 
	 { 

	 	window.location.href = "delmens.php?idmes="+id ; 
	 	}
	
	
 }

	  
</script>
      <!-- Content Wrapper. Contains page content -->
      <link rel="stylesheet" href="dist/css/paginacao.css" type="text/css">

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mensagens  
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
<?php include 'menumensagem.php' ?>
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Inbox</h3>
                  <div class="box-tools pull-right">
                 <!--   <div class="has-feedback">
                      <input type="text" class="form-control input-sm" placeholder="Search Mail"/>
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>-->
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                  </div>
                  <div class="table-responsive mailbox-messages">
                   <?php
      session_start();
            
function limitarTexto($texto, $limite) {
	$texto2= trim ($texto);
	if(strlen($texto2)>$limite)
	{
	$texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
	return $texto;	
	}
	else {
	return $texto;		
	}
	
}

include "cont.php";
global $paginacao;

if (!isset($_GET['pag'])) {
	$_GET['pag'] = 1;
}

$pag = ($_GET['pag']);
$pag = filter_var($pag, FILTER_VALIDATE_INT);

$inicio = 0;
$limite = 12;
$textolimite = 20;
$titulolimite = 70;
if ($pag != '') {
	$inicio = ($pag - 1) * $limite;
}
$calcula_total = $DBH->prepare("SELECT * FROM mensagens Where id_destino=".$_SESSION['idut']."");
$calcula_total->execute();
$busca_total = $DBH->prepare("SELECT utilizador.utilizador, mensagens.id_mensagem ,mensagens.mensagem , mensagens.hora,  mensagens.data FROM mensagens, utilizador Where mensagens.id_enviado=utilizador.id_ut and id_destino=".$_SESSION['idut'] ." ORDER BY id_mensagem DESC LIMIT " . $inicio . ", " . $limite . "");
$busca_total->execute(); 
$total = $calcula_total->rowCount(PDO::FETCH_ASSOC);

if ($busca_total->rowcount(PDO::FETCH_ASSOC) > 0) {

							echo ' <table class="table table-hover table-striped">
							<tbody>';

	while ($row = $busca_total->fetch(PDO::FETCH_ASSOC)) {

echo'                      
                        <tr>
                          <td class="mailbox-name"><a href="lermensagem.php?idmen='.$row['id_mensagem'].'">'.$row['utilizador'].'</a></td>
                          <td class="mailbox-subject">'.limitarTexto($row['mensagem'],$titulolimite).'</td>';
                         echo' <td class="mailbox-date">'.$row['data'].'&nbsp'.$row['hora'].'</td>';
                        echo"<td><input type='button' onClick='confirmacao(".$row['id_mensagem'].")'  value='Eliminar' class='btn btn-primary'></td></tr>
                        ";

	}

	$prox = $pag + 1;
	$ant = $pag - 1;
	$ultima_pag = ceil($total / $limite);
	$penultima = $ultima_pag - 1;

	$adjacentes = 2;

	echo '  </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                </div>
                <div class="box-footer no-padding">
                  <div class="mailbox-controls"><div class="paginacao" align="center">';

	if ($pag > 1) {
		$paginacao = '<a href="mensagens.php?pag=' . $ant . '"><img src="dist/img/Back2.png" /></a>';
	}

	if ($ultima_pag <= 5) {
		for ($i = 1; $i < $ultima_pag + 1; $i++) {
			if ($i == $pag) {
				$paginacao .= '<a class="atual" href="mensagens.php?pag=' . $i . '">' . $i . '</a>';
			} else {
				$paginacao .= '<a href="mensagens.php?pag=' . $i . '">' . $i . '</a>';
			}
		}
	}

	if ($ultima_pag > 5) {
		if ($pag < 1+(2 * $adjacentes)) {
			for ($i = 1; $i < 2+(2 * $adjacentes); $i++) {
				if ($i == $pag) {
					if (isset($paginacao)) {
						$paginacao .= '<a class="atual" href="mensagens.php?pag=' . $i . '">' . $i . '</a>';
					} else {
						$paginacao = '<a class="atual" href="mensagens.php?pag=' . $i . '">' . $i . '</a>';
					}
				} else {
					if (isset($paginacao)) {
						$paginacao .= '<a href="mensagens.php?pag=' . $i . '">' . $i . '</a>';
					} else {
						$paginacao = '<a href="mensagens.php?pag=' . $i . '">' . $i . '</a>';
					}
				}
			}

			$paginacao .= '...';
			$paginacao .= '<a href="mensagens.php?pag=' . $penultima . '">' . $penultima . '</a>';
			$paginacao .= '<a href="mensagens.php?pag=' . $ultima_pag . '">' . $ultima_pag . '</a>';
		} elseif ($pag > (2 * $adjacentes) && $pag < $ultima_pag - 3) {
			$paginacao .= '<a href="mensagens.php?pag=1">1</a>';
			$paginacao .= '<a href="mensagens.php?pag=1">2</a> ... ';
			for ($i = $pag - $adjacentes; $i <= $pag + $adjacentes; $i++) {
				if ($i == $pag) {
					$paginacao .= '<a class="atual" href="mensagens.php?pag=' . $i . '">' . $i . '</a>';
				} else {
					$paginacao .= '<a href="mensagens.php?pag=' . $i . '">' . $i . '</a>';
				}
			}
			$paginacao .= '...';
			$paginacao .= '<a href="mensagens.php?pag=' . $penultima . '">' . $penultima . '</a>';
			$paginacao .= '<a href="mensagens.php?pag=' . $ultima_pag . '">' . $ultima_pag . '</a>';
		} else {
			$inic = $ultima_pag-(4+(2 * $adjacentes));
			if ($inic > 3) {
				$paginacao .= '<a href="mensagens.php?pag=1">1</a>';
				$paginacao .= '<a href="mensagens.php?pag=1">2</a> ... ';
			} else {
				$inic = 3;
				$paginacao .= '<a href="mensagens.php?pag=1">1</a>... ';
			}

			for ($i = $inic; $i <= $ultima_pag; $i++) {
				if ($i == $pag) {
					$paginacao .= '<a class="atual" href="mensagens.php?pag=' . $i . '">' . $i . '</a>';
				} else {
					$paginacao .= '<a href="mensagens.php?pag=' . $i . '">' . $i . '</a>';
				}
			}
		}
	}

}
else {
	echo "<h1>Sem Registos</h1>";
}
if ($prox <= $ultima_pag && $ultima_pag >= 2) {
	$paginacao .= '<a href="mensagens.php?pag=' . $prox . '"><img src="dist/img/Next.png" /></a>';
}

echo $paginacao;

echo '</div></div> ';
?>
                </div>
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php
      if(isset($_GET['alt']))
      {
      		echo "<script>
	alert('Mensagem Enviada');
	</script> ";
      }
      ?>