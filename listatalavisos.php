
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
$titulolimite=20;
if ($pag != '') {
	$inicio = ($pag - 1) * $limite;
}
$calcula_total = $DBH->prepare("SELECT * FROM avisos Where id_utilizador_dest=".$_SESSION['idut']."");
$calcula_total->execute();
$busca_total = $DBH->prepare("SELECT * FROM avisos Where id_utilizador_dest=".$_SESSION['idut'] ." ORDER BY id_aviso DESC LIMIT " . $inicio . ", " . $limite . "");
$busca_total->execute();
$total = $calcula_total->rowCount(PDO::FETCH_ASSOC);

if ($busca_total->rowcount(PDO::FETCH_ASSOC) > 0) {

							echo "<table class='table table-hover' >
										<tr>
                      <th>Id Aviso</th>
                      <th>Titulo</th>
                      <th>Data</th>
                      <th>Opções</th>
										</tr>";

	while ($row = $busca_total->fetch(PDO::FETCH_ASSOC)) {
			$str=strip_tags($row['descr']);
			$str2=ucfirst($str);
		echo " <tr>
		       <td>".$row['id_aviso']."</td>
              <td>".limitarTexto($row['titulo_aviso'],$titulolimite)."</td>
              <td>".$row['data']."</td>	
              <td><input type='button' onclick=\"location.href='veravisopag.php?idav=".$row['id_aviso']."&alg=true'\"value='Ver ' class='btn btn-primary'></td>
              <tr>";

	}

	$prox = $pag + 1;
	$ant = $pag - 1;
	$ultima_pag = ceil($total / $limite);
	$penultima = $ultima_pag - 1;

	$adjacentes = 2;

	echo '<tr>
				<td colspan="4" align="center"><div class="paginacao" >';

	if ($pag > 1) {
		$paginacao = '<a href="visualizaralavisosl.php?pag=' . $ant . '"><img src="dist/img/Back2.png" /></a>';
	}

	if ($ultima_pag <= 5) {
		for ($i = 1; $i < $ultima_pag + 1; $i++) {
			if ($i == $pag) {
				$paginacao .= '<a class="atual" href="visualizaralavisosl.php?pag=' . $i . '">' . $i . '</a>';
			} else {
				$paginacao .= '<a href="visualizaralavisosl.php?pag=' . $i . '">' . $i . '</a>';
			}
		}
	}

	if ($ultima_pag > 5) {
		if ($pag < 1+(2 * $adjacentes)) {
			for ($i = 1; $i < 2+(2 * $adjacentes); $i++) {
				if ($i == $pag) {
					if (isset($paginacao)) {
						$paginacao .= '<a class="atual" href="visualizaralavisosl.php?pag=' . $i . '">' . $i . '</a>';
					} else {
						$paginacao = '<a class="atual" href="visualizaralavisosl.php?pag=' . $i . '">' . $i . '</a>';
					}
				} else {
					if (isset($paginacao)) {
						$paginacao .= '<a href="visualizaralavisosl.php?pag=' . $i . '">' . $i . '</a>';
					} else {
						$paginacao = '<a href="visualizaralavisosl.php?pag=' . $i . '">' . $i . '</a>';
					}
				}
			}

			$paginacao .= '...';
			$paginacao .= '<a href="visualizaralavisosl.php?pag=' . $penultima . '">' . $penultima . '</a>';
			$paginacao .= '<a href="visualizaralavisosl.php?pag=' . $ultima_pag . '">' . $ultima_pag . '</a>';
		} elseif ($pag > (2 * $adjacentes) && $pag < $ultima_pag - 3) {
			$paginacao .= '<a href="visualizaralavisosl.php?pag=1">1</a>';
			$paginacao .= '<a href="visualizaralavisosl.php?pag=1">2</a> ... ';
			for ($i = $pag - $adjacentes; $i <= $pag + $adjacentes; $i++) {
				if ($i == $pag) {
					$paginacao .= '<a class="atual" href="visualizaralavisosl.php?pag=' . $i . '">' . $i . '</a>';
				} else {
					$paginacao .= '<a href="visualizaralavisosl.php?pag=' . $i . '">' . $i . '</a>';
				}
			}
			$paginacao .= '...';
			$paginacao .= '<a href="visualizaralavisosl.php?pag=' . $penultima . '">' . $penultima . '</a>';
			$paginacao .= '<a href="visualizaralavisosl.php?pag=' . $ultima_pag . '">' . $ultima_pag . '</a>';
		} else {
			$inic = $ultima_pag-(4+(2 * $adjacentes));
			if ($inic > 3) {
				$paginacao .= '<a href="visualizaralavisosl.php?pag=1">1</a>';
				$paginacao .= '<a href="visualizaralavisosl.php?pag=1">2</a> ... ';
			} else {
				$inic = 3;
				$paginacao .= '<a href="visualizaralavisosl.php?pag=1">1</a>... ';
			}

			for ($i = $inic; $i <= $ultima_pag; $i++) {
				if ($i == $pag) {
					$paginacao .= '<a class="atual" href="visualizaralavisosl.php?pag=' . $i . '">' . $i . '</a>';
				} else {
					$paginacao .= '<a href="visualizaralavisosl.php?pag=' . $i . '">' . $i . '</a>';
				}
			}
		}
	}

}
else {
	echo "<h1>Sem Registos</h1>";
}
if ($prox <= $ultima_pag && $ultima_pag >= 2) {
	$paginacao .= '<a href="visualizaralavisosl.php?pag=' . $prox . '"><img src="dist/img/Next.png" /></a>';
}

echo $paginacao;

echo '</div></td></tr></table> ';
?>