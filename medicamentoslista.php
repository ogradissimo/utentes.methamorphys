<script> 
function confirmacao(id, idut) { 
	var resposta = confirm("Deseja remover esse registro?");  
	 if (resposta == true) 
	 { 

	 	window.location.href = "delmedic.php?idtrat="+id+"&ut="+ idut ; 
	 	}
	
	
 }

	  
</script>
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
$calcula_total = $DBH->prepare("SELECT * FROM tratamento Where id_utente = ? ");
$calcula_total -> bindParam(1, $id);
$calcula_total->execute();
$busca_total = $DBH->prepare("SELECT  tratamento.id_tratamento ,medicamentos.descricaoo , momentos.descricao, tratamento.dose   FROM  tratamento, medicamentos , momentos  WHERE medicamentos.id_medicamento =tratamento.id_medicamento and momentos.id_momento=tratamento.id_momento and  id_utente = ? LIMIT " . $inicio . ", " . $limite . "");
$busca_total -> bindParam(1, $id);
$busca_total->execute();
$utente=$id;
$total = $calcula_total->rowCount(PDO::FETCH_ASSOC);

if ($busca_total->rowcount(PDO::FETCH_ASSOC) > 0) {

							echo "<table class='table table-hover' >
											<tr> 
			<th>Medicamento</th>
			<th>Momento</th>
			<th>Dose</th>
			<th>Opções</th>
			<th></th>
			
		</tr>";

	while ($row = $busca_total->fetch(PDO::FETCH_ASSOC)) {
					echo"<tr>
					<td>".limitarTexto($row['descricaoo'],$titulolimite)."</td>
					<td>".$row['descricao']."</td>
					<td>".$row['dose']."</td>
					<td>";
			$STH6 = $DBH -> query('Select * From perfil_pagina Where id_pagina=23');
			$STH6 -> execute();
			while ($row6 = $STH6 -> fetch()) {
				if($row6['id_tipo']==$_SESSION['perfil'])
				{
					echo"<input type='button' onClick='confirmacao(".$row['id_tratamento'].",".$id.")'  value='Eliminar' class='btn btn-primary'>"; 
					
				}
			}	
			
			
			$STH5 = $DBH -> query('Select * From perfil_pagina Where id_pagina=22');
			$STH5 -> execute();
			while ($row5 = $STH5 -> fetch()) {
				if($row5['id_tipo']==$_SESSION['perfil'])
				{
					echo "&nbsp<input type='button' onclick=\"location.href='upmedicamento.php?idtra=".$row['id_tratamento']."&idut=".$id."&voltar=".$ur=end(explode("/", $_SERVER['PHP_SELF']))."'\"value='Alterar' class='btn btn-primary'>";
					
				}
			}	
					echo"
					</td></tr>";
	}

	$prox = $pag + 1;
	$ant = $pag - 1;
	$ultima_pag = ceil($total / $limite);
	$penultima = $ultima_pag - 1;

	$adjacentes = 2;

	echo '<tr>
				<td colspan="4" align="center"><div class="paginacao" >';

	if ($pag > 1) {
		$paginacao = '<a href="medicamentos.php?pag=' . $ant . '&idut='.$utente.'"><img src="dist/img/Back2.png" /></a>';
	}

	if ($ultima_pag <= 5) {
		for ($i = 1; $i < $ultima_pag + 1; $i++) {
			if ($i == $pag) {
				$paginacao .= '<a class="atual" href="medicamentos.php?pag=' . $i . '&idut='.$utente.'">' . $i . '</a>';
			} else {
				$paginacao .= '<a href="medicamentos.php?pag=' . $i . '&idut='.$utente.'">' . $i . '</a>';
			}
		}
	}

	if ($ultima_pag > 5) {
		if ($pag < 1+(2 * $adjacentes)) {
			for ($i = 1; $i < 2+(2 * $adjacentes); $i++) {
				if ($i == $pag) {
					if (isset($paginacao)) {
						$paginacao .= '<a class="atual" href="medicamentos.php?pag=' . $i . '&idut='.$utente.'">' . $i . '</a>';
					} else {
						$paginacao = '<a class="atual" href="medicamentos.php?pag=' . $i . '&idut='.$utente.'">' . $i . '</a>';
					}
				} else {
					if (isset($paginacao)) {
						$paginacao .= '<a href="medicamentos.php?pag=' . $i . '&idut='.$utente.'">' . $i . '</a>';
					} else {
						$paginacao = '<a href="medicamentos.php?pag=' . $i . '&idut='.$utente.'">' . $i . '</a>';
					}
				}
			}

			$paginacao .= '...';
			$paginacao .= '<a href="medicamentos.php?pag=' . $penultima . '&idut='.$utente.'">' . $penultima . '</a>';
			$paginacao .= '<a href="medicamentos.php?pag=' . $ultima_pag . '&idut='.$utente.'">' . $ultima_pag . '</a>';
		} elseif ($pag > (2 * $adjacentes) && $pag < $ultima_pag - 3) {
			$paginacao .= '<a href="medicamentos.php?pag=1">1</a>';
			$paginacao .= '<a href="medicamentos.php?pag=1">2</a> ... ';
			for ($i = $pag - $adjacentes; $i <= $pag + $adjacentes; $i++) {
				if ($i == $pag) {
					$paginacao .= '<a class="atual" href="medicamentos.php?pag=' . $i . '&idut='.$utente.'">' . $i . '</a>';
				} else {
					$paginacao .= '<a href="medicamentos.php?pag=' . $i . '&idut='.$utente.'">' . $i . '</a>';
				}
			}
			$paginacao .= '...';
			$paginacao .= '<a href="medicamentos.php?pag=' . $penultima . '&idut='.$utente.'">' . $penultima . '</a>';
			$paginacao .= '<a href="medicamentos.php?pag=' . $ultima_pag . '&idut='.$utente.'">' . $ultima_pag . '</a>';
		} else {
			$inic = $ultima_pag-(4+(2 * $adjacentes));
			if ($inic > 3) {
				$paginacao .= '<a href="medicamentos.php?pag=1">1</a>';
				$paginacao .= '<a href="medicamentos.php?pag=1">2</a> ... ';
			} else {
				$inic = 3;
				$paginacao .= '<a href="medicamentos.php?pag=1">1</a>... ';
			}

			for ($i = $inic; $i <= $ultima_pag; $i++) {
				if ($i == $pag) {
					$paginacao .= '<a class="atual" href="medicamentos.php?pag=' . $i . '&idut='.$utente.'">' . $i . '</a>';
				} else {
					$paginacao .= '<a href="medicamentos.php?pag=' . $i . '&idut='.$utente.'">' . $i . '</a>';
				}
			}
		}
	}

}
else {
	echo "<p><b>Medicamentos</b></p><li>Sem medicamentos</li>";
}
if ($prox <= $ultima_pag && $ultima_pag >= 2) {
	$paginacao .= '<a href="medicamentos.php?pag=' . $prox . '&idut='.$utente.'"><img src="dist/img/Next.png" /></a>';
}

echo $paginacao;

echo '</div></td></tr></table> ';
?>
