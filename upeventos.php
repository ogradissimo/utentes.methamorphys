<?php
include 'cont.php';
$STH = $DBH->prepare("SELECT calendario.id_evento, calendario.data_inicio, calendario.data_fim, calendario.hora, calendario.horafim, calendario.descricao_evento , utilizador.utilizador FROM calendario , utilizador Where calendario.id_utilizador=utilizador.id_ut and id_evento = ?");
$id=$_GET['idev']; 
$STH -> bindParam(1, $id);
$STH->execute();
	while ($row = $STH->fetch()) {
			echo '<form action="updateevento.php" method="get" name="formtest">
			<input type="hidden" class="form-control" name="id" value="'.$id.'">
               <div class="form-group">
               <label>Data Inicio :</label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    <input type="date" class="form-control" name="data1" value="'.$row['data_inicio'].'">
                  </div>
                    <label>Data Fim :</label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    <input type="date" class="form-control" name="data2" value="'.$row['data_fim'].'">
                  </div>
                 <label>Hora Inicio: </label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-clock-o"></i></span>
                    <input type="time" class="form-control" name="hora1" value="'.$row['hora'].'">
                  </div>
                  <label>Hora Fim: </label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-clock-o"></i></span>
                    <input type="time" class="form-control" name="hora2" value="'.$row['horafim'].'">
                  </div>
                 <label>Evento : </label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                    <input type="text" class="form-control" name="evento" value="'.$row['descricao_evento'].'">
                  </div>
                  <br>
                  <div class="input-group">
        <input type="submit" value="Enviar" class="btn btn-primary" />&nbsp';
        echo" <input type='button' onclick=\"location.href='vereventos.php?idev=".$id."&todos=true'\"value='Cancelar ' class='btn btn-primary'>
                </div>

                </div>

	</form>";
		
	}

?>
