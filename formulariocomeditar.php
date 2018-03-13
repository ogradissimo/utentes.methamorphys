<style>
	textarea { resize: none ;}
</style>
<?php
include 'cont.php';

$STH = $DBH -> prepare('select formulario.tabela_associada, tabeladicionario.nome_tabela ,campos.tipovalidacao,tabeladicionario.nome_campo, tipo_controlo.id_tipo_control, tipo_controlo.tipo, tipo_controlo.style ,campos.id_campos,campos.nome_web , campos.id_nome_bd from formulario ,campos, tipo_controlo, tabeladicionario where formulario.id_pagina=? and formulario.id_formulario=campos.id_formulario and campos.id_tipo_controlo=tipo_controlo.id_tipo_control and campos.campo_associado=tabeladicionario.id_dicionario ORDER BY ordem ASC');
$STH -> bindParam(1, $pagid);
$STH -> execute();
$count = $STH -> rowCount();
echo "
	<form action='update.php' method='get' name='formtest'>
	
	<div class='box-body'>";
echo '<input type="hidden" value="' . $pagid . '" name="pagid" id="idutenteup" />';
		$id = $_GET['idut'];
		echo '<input type="hidden" value="' . $id . '" name="idutenteup" id="idutenteup" />';
       $ur=end(explode("/", $_SERVER['PHP_SELF']));
	    echo '<input type="hidden" value="' .$ur . '" name="url" id="url" />';
//Criação do Formulario
while ($row = $STH -> fetch()) {
	$controlotipo[] = $row['id_tipo_control'];
	$tipos[] = $row['tipovalidacao'];
	$nome[] = $row['nome_web'];
	$nometabela[] = $row['nome_tabela'];
	$tipo[] = $row['tipo'];
	$campo[] = $row['nome_campo'];
	$style[] = $row['style'];
	$nomebd[] = $row['id_nome_bd'];
	$tab[] = $row['tabela_associada'];
	$camposdbid[] = $row['id_nome_bd'];
}

for ($e = 0; $e < $count; $e++) {
	$STH33 = $DBH -> prepare('SELECT * FROM tabeladicionario WHERE id_dicionario =' . $nomebd[$e] . '');
	$STH33 -> execute();
	while ($row44 = $STH33 -> fetch()) {
		$nomecampobd = $row44['nome_campo'];
	}
// Se for Checkbox
	if ($controlotipo[$e] == '3') {
		$STH11 = $DBH -> prepare('SELECT  *  FROM tabeladicionario WHERE id_dicionario = ? ');

		$iddi = $camposdbid[$e];
		$STH11 -> bindParam(1, $iddi);
		$STH11 -> execute();
		while ($row11 = $STH11 -> fetch()) {
			$tabela1 = $row11['nome_tabela'];
			$campo1 = $row11['nome_campo'];
		}
		$STH12 = $DBH -> prepare('SELECT  ' . $campo1 . '  FROM ' . $tabela1 . ' WHERE id_utente = ? ');
		$id1 = $_GET['idut'];
		$STH12 -> bindParam(1, $id1);
		$STH12 -> execute();
		while ($row12 = $STH12 -> fetch()) {
			$checkvalor[] = $row12[$campo1];

		}
		$STH2 = $DBH -> prepare('SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE table_schema = "utentes_metha" AND TABLE_NAME = "' . $nometabela[$e] . '" and COLUMN_KEY="PRI"');
		$STH2 -> execute();
		$STH3 = $DBH -> prepare('SELECT * FROM ' . $nometabela[$e] . ' ');
		$STH3 -> execute();
		echo "<div class='form-group'>
				<div class='box-body table-responsive no-padding'>
				<table border='0' cellpadding='' cellspacing='0' > 
						<tr>
								<td colspan='2'><label for='exampleInputEmail1'>" . $nome[$e] . " :</label></td>
						</tr>";
		while ($row2 = $STH2 -> fetch()) {
			$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($nome[$e], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
			while ($row3 = $STH3 -> fetch()) {
				$verf = false;
				for ($a = 0; $a < count($checkvalor); $a++) {
					if ($checkvalor[$a] == $row3[$row2['COLUMN_NAME']]) {
						echo "<tr>
										<td width='20px' align='center'><input name='" . $string . "[]' id='" . $string . "' type='" . $tipo[$e] . "' value='" . $row3[$row2['COLUMN_NAME']] . "' class='flat-red' checked='checked'/></td>
										 <td> <label align='left'> " . $row3[$campo[$e]] . " </label></td>
										 </tr>";
						$verf = true;
					}
				}
				if ($verf == false) {
					echo "<tr>
										<td width='20px' align='center'><input name='" . $string . "[]' id='" . $string . "' type='" . $tipo[$e] . "' value='" . $row3[$row2['COLUMN_NAME']] . "' class='flat-red'/></td>
										 <td> <label align='left'> " . $row3[$campo[$e]] . " </label></td>
										 </tr>";
				}

			}
		}

		echo "</table></div>
		</div>";
	}
// se for diferente checkbox
	if ($controlotipo[$e] != 3) {
		if ($tab[$e] != 'utente') {
			$STH44 = $DBH -> prepare('SELECT  *  FROM ' . $tab[$e] . ' WHERE id_utente = ? ');

		} else {
			$STH44 = $DBH -> prepare('SELECT  *  FROM ' . $tab[$e] . ' WHERE idutente = ? ');

		}
		$STH44 -> bindParam(1, $id);
		$STH44 -> execute();
		$STH44 -> setFetchMode(PDO::FETCH_ASSOC);
		while ($row33 = $STH44 -> fetch()) {
			if ($controlotipo[$e] == 4) {
				$STH2 = $DBH -> prepare('SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE table_schema = "utentes_metha" AND TABLE_NAME = "' . $nometabela[$e] . '" and COLUMN_KEY="PRI"');
				$STH2 -> execute();
				$STH3 = $DBH -> prepare('SELECT * FROM ' . $nometabela[$e] . ' ');
				$STH3 -> execute();
				echo "<div class='form-group'>
				<div class='box-body table-responsive no-padding'>
				<table border='0' cellpadding='' cellspacing='0' > 
						<tr>
								<td colspan='2'><label for='exampleInputEmail1'>" . $nome[$e] . " :</label></td>
						</tr>";
				$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($nome[$e], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));

				while ($row2 = $STH2 -> fetch()) {
					while ($row3 = $STH3 -> fetch()) {
						if ($row3[$row2['COLUMN_NAME']] == $row33[$nomecampobd]) {

							echo "<tr>
										<td width='20px' align='center'><input class='flat-red' name='" . $string . "' type='" . $tipo[$e] . "' value='" . $row3[$row2['COLUMN_NAME']] . "' checked/></td>
										 <td> <label> " . $row3[$campo[$e]] . " </label></td>
										 </tr>";
						} else {

							echo "<tr>
										<td width='20px' align='center'><input class='flat-red' name='" . $string . "' type='" . $tipo[$e] . "' value='" . $row3[$row2['COLUMN_NAME']] . "' /></td>
										 <td> <label> " . $row3[$campo[$e]] . " </label></td>
										 </tr>";

						}
					}
				}

				echo "</table></div>
		</div>";
			}
			if ($controlotipo[$e] == 5) {
				$STH2 = $DBH -> prepare('SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE table_schema = "utentes_metha" AND TABLE_NAME = "' . $nometabela[$e] . '" and COLUMN_KEY="PRI"');
				$STH2 -> execute();
				$STH3 = $DBH -> prepare('SELECT * FROM ' . $nometabela[$e] . ' ');
				$STH3 -> execute();
				echo "<div class='form-group'>
						<label for='exampleInputEmail1'>" . $nome[$e] . " :</label>";
				$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($nome[$e], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
				echo "<select  class='form-control' name='" . $string . "'>";
				echo "<option value='000' selected='selected'>Selecione um Campo</option>";

				while ($row2 = $STH2 -> fetch()) {
					while ($row3 = $STH3 -> fetch()) {
						if ($row3[$row2['COLUMN_NAME']] == $row33[$nomecampobd]) {
							echo "<option value = '" . $row3[$row2['COLUMN_NAME']] . "' selected='selected'>" . $row3[$campo[$e]] . "</option>";
						} else {									echo "<option value = '" . $row3[$row2['COLUMN_NAME']] . "'>" . $row3[$campo[$e]] . "</option>";

						}
					}
				}
				echo "</select>";
				echo "<div>";
			}
			if ($controlotipo[$e] == 8) {
				$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($nome[$e], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));

				echo "<div class='form-group'>
		<label for='exampleInputEmail1'>" . $nome[$e] . "</label>
		<div class='box-body pad'>
		<textarea name='" . $string . "'  class='textarea' style='width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'>" . $row33[$nomecampobd] . "</textarea>
		</div>
		</div>";
			}

			if ($controlotipo[$e] != 8 & $controlotipo[$e] != 5 & $controlotipo[$e] != 4) {

				$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($nome[$e], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
				echo "
	<div class='form-group'>
		<label for='exampleInputEmail1'>" . $nome[$e] . "</label>
		<div class='input-group'>
		 <div class='input-group-addon'>
       	 <i class='" . $style[$e] . "'></i>
        </div>
		<input type='" . $tipo[$e] . "' id='" . $campo[$e] . "' name='" . $string . "' class='form-control' value='" . $row33[$nomecampobd] . "' >
		</div>
		<div>
		";
			}
		}
	}
}
echo "
                  <div class='box-footer'>
                    <input type='submit' value='Alterar' name='env' class='btn btn-primary'></form>";
                                        if(isset($_GET['voltar']))
                   {
                   	    echo" &nbsp <input type='button' onclick=\"location.href='".$_GET['voltar']."?idut=".$id."'\"value='Cancelar' class='btn btn-primary'>";	                  	
                   }
                    
                    echo" </div>";

//Criar a validação do formulario
for ($a = 0; $a < count($tipos); $a++) {
	switch ($tipos[$a]) {
		case 2 :
			$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($nome[$a], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
			$validacao[] = 'frmvalidator.addValidation("' . $string . '","req","Campo ' . $nome[$a] . ' necessario ");';

			break;
		case 3 :
			//trata a string
			$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($nome[$a], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
			$validacao[] = 'frmvalidator.addValidation("' . $string . '","req","Campo ' . $nome[$a] . ' necessario ");';
			$validacao[] = 'frmvalidator.addValidation("' . $string . '","num","O Campo ' . $nome[$a] . ' tem que ser numeros ");';
			$validacao[] = 'frmvalidator.addValidation("' . $string . '","maxlength=9","O Campo ' . $nome[$a] . ' tem que ter 9 numeros ");';
			break;
		case 4 :
			$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($nome[$a], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
			$validacao[] = 'frmvalidator.addValidation("' . $string . '","dontselect=000","Selecione um opção no ' . $nome[$a] . '");';
			break;
		case 5 :
			$string = ereg_replace("[^a-zA-Z0-9_]", "", strtr($nome[$a], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
			$validacao[] = "frmvalidator.addValidation('" . $string . "','selone','Selecione um opção no " . $nome[$a] . "');";
			break;
	}
}

echo '<script  type="text/javascript">
 var frmvalidator = new Validator("formtest");';
//Adiciona as regas de validação aos Campos
for ($e = 0; $e < count($validacao); $e++) {
	echo $validacao[$e];
}
echo 'frmvalidator.EnableMsgsTogether();
</script>';
?>