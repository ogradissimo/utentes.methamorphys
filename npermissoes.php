
<div class='box box-default'>
	<div class='box-header with-border'>
		<h3 class='box-title'><i class="fa fa-tag"></i> Selecione um Perfil:</h3>
		<div class="box-tools pull-right">
		</div>
	</div>
	<div class='box-body'>
		<div class='row'>
			<form action="verpermissoes.php" method="get">
			<div class='box-body pad'>
				 <div class="form-group">
				<?php 
        include 'cont.php';
        echo' <label>Perfil</label>';
		$STH4 = $DBH -> prepare('SELECT  * FROM  tipo_utilizador');
		$STH4->execute();
		 echo' <select class="form-control" name="perfil">';
		 echo '<option value="000">Selecione o Perfil</option>';
		while ($row4 = $STH4 -> fetch())    
	{
                    
                        echo '<option value="'.$row4['id_tipo'].'">'.$row4['descricao'].'</option>';
	}
                     echo' </select>';	
				?>
</div>
<div class="input-group">
        <input type="submit" value="Ver" class="btn btn-primary" /></div>
			</form> </div>

		</div>
	</div>
</div>