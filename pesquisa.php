<?php
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

	$teste = $_GET['name'];
	include_once "cont.php";
	if (empty($teste)) {


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
$calcula_total = $DBH->prepare("SELECT * FROM utente");
$calcula_total->execute();
$busca_total = $DBH->prepare("SELECT * FROM utente ORDER BY idutente DESC LIMIT " . $inicio . ", " . $limite . "");
$busca_total->execute();
$total = $calcula_total->rowCount(PDO::FETCH_ASSOC);

if ($busca_total->rowcount(PDO::FETCH_ASSOC) > 0) {

							echo "<table class='table table-hover' >
										<tr>
                      <th>ID Utente</th>
                      <th>Nome Utente</th>
                      <th>Idade</th>
                      <th>Opções</th>
										</tr>";

	while ($row = $busca_total->fetch(PDO::FETCH_ASSOC)) {
			$str=strip_tags($row['descr']);
			$str2=ucfirst($str);
		echo " <tr>
		       <td>".$row['idutente']."</td>
              <td>".limitarTexto($row['nome'],$titulolimite)."</td>
              <td>".$row['idade']."</td>	
              <td><input type='button' onclick=\"location.href='editar.php?idut=".$row['idutente']."&nome=".$row['nome']."'\"value='Detalhes' class='btn btn-primary'></td>
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
		$paginacao = '<a href="visualizarutentes.php?pag=' . $ant . '">Anterior</a>';
	}

	if ($ultima_pag <= 5) {
		for ($i = 1; $i < $ultima_pag + 1; $i++) {
			if ($i == $pag) {
				$paginacao .= '<a class="atual" href="visualizarutentes.php?pag=' . $i . '">' . $i . '</a>';
			} else {
				$paginacao .= '<a href="visualizarutentes.php?pag=' . $i . '">' . $i . '</a>';
			}
		}
	}

	if ($ultima_pag > 5) {
		if ($pag < 1+(2 * $adjacentes)) {
			for ($i = 1; $i < 2+(2 * $adjacentes); $i++) {
				if ($i == $pag) {
					if (isset($paginacao)) {
						$paginacao .= '<a class="atual" href="visualizarutentes.php?pag=' . $i . '">' . $i . '</a>';
					} else {
						$paginacao = '<a class="atual" href="visualizarutentes.php?pag=' . $i . '">' . $i . '</a>';
					}
				} else {
					if (isset($paginacao)) {
						$paginacao .= '<a href="visualizarutentes.php?pag=' . $i . '">' . $i . '</a>';
					} else {
						$paginacao = '<a href="visualizarutentes.php?pag=' . $i . '">' . $i . '</a>';
					}
				}
			}

			$paginacao .= '...';
			$paginacao .= '<a href="visualizarutentes.php?pag=' . $penultima . '">' . $penultima . '</a>';
			$paginacao .= '<a href="visualizarutentes.php?pag=' . $ultima_pag . '">' . $ultima_pag . '</a>';
		} elseif ($pag > (2 * $adjacentes) && $pag < $ultima_pag - 3) {
			$paginacao .= '<a href="visualizarutentes.php?pag=1">1</a>';
			$paginacao .= '<a href="visualizarutentes.php?pag=1">2</a> ... ';
			for ($i = $pag - $adjacentes; $i <= $pag + $adjacentes; $i++) {
				if ($i == $pag) {
					$paginacao .= '<a class="atual" href="visualizarutentes.php?pag=' . $i . '">' . $i . '</a>';
				} else {
					$paginacao .= '<a href="visualizarutentes.php?pag=' . $i . '">' . $i . '</a>';
				}
			}
			$paginacao .= '...';
			$paginacao .= '<a href="visualizarutentes.php?pag=' . $penultima . '">' . $penultima . '</a>';
			$paginacao .= '<a href="visualizarutentes.php?pag=' . $ultima_pag . '">' . $ultima_pag . '</a>';
		} else {
			$inic = $ultima_pag-(4+(2 * $adjacentes));
			if ($inic > 3) {
				$paginacao .= '<a href="visualizarutentes.php?pag=1">1</a>';
				$paginacao .= '<a href="visualizarutentes.php?pag=1">2</a> ... ';
			} else {
				$inic = 3;
				$paginacao .= '<a href="visualizarutentes.php?pag=1">1</a>... ';
			}

			for ($i = $inic; $i <= $ultima_pag; $i++) {
				if ($i == $pag) {
					$paginacao .= '<a class="atual" href="visualizarutentes.php?pag=' . $i . '">' . $i . '</a>';
				} else {
					$paginacao .= '<a href="visualizarutentes.php?pag=' . $i . '">' . $i . '</a>';
				}
			}
		}
	}

}
else {
	echo "<h1>Sem Registos</h1>";
}
if ($prox <= $ultima_pag && $ultima_pag >= 2) {
	$paginacao .= '<a href="visualizarutentes.php?pag=' . $prox . '">Pr&oacute;xima &raquo;</a>';
}

echo $paginacao;

echo '</div></td></tr></table> ';



	} else {
		$textolimite = 20;
		$STH = $DBH -> prepare("SELECT idutente , nome , idade FROM utente WHERE nome LIKE '" . $teste . "%'");
		$STH -> execute();
		$total = $STH -> rowCount(PDO::FETCH_ASSOC);
		if ($total == 0) {
			echo "Não foram encontrados resultadors";
		} else {
			echo "<table class='table table-hover' >
										<tr>
                      <th>ID Utente</th>
                      <th>Nome Utente</th>
                      <th>Idade</th>
                      <th>Opções</th>
										</tr>";
			while ($row = $STH -> fetch(PDO::FETCH_ASSOC)) {
			echo " <tr>
		       <td>".$row['idutente']."</td>
              <td>".limitarTexto($row['nome'],$textolimite)."</td>
              <td>".$row['idade']."</td>	
              <td><input type='button' onclick=\"location.href='editar.php?idut=".$row['idutente']."&nome=".$row['nome']."'\"value='Detalhes' class='btn btn-primary'></td>
              <tr>";

	

			}

		}

		echo "</table>";
	}
?>