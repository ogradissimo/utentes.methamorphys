<!-- Messages: style can be found in dropdown.less-->
<li class="dropdown messages-menu">
	<!-- Menu toggle button -->
	<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-envelope-o"></i> 
			<?php
		function limita($texto, $limite) {
			$texto2 = trim($texto);
			if (strlen($texto2) > $limite) {
				$texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
				return $texto;
			} else {
				return $texto;
			}

		}
		
$slimite=20;
		include_once 'cont.php';
		$STH = $DBH -> prepare("SELECT utilizador.foto, utilizador.id_ut , utilizador.utilizador, mensagens.id_mensagem ,mensagens.mensagem , mensagens.hora,  mensagens.data FROM mensagens, utilizador Where mensagens.id_enviado=utilizador.id_ut and visto=0 and id_destino=? ");
		$id = $_SESSION['idut'];
		$STH -> bindParam(1, $id);
		$STH -> execute();
		$result = $STH -> rowcount();
				echo '<span class="label label-success">'.$result.'</span>';
		if($_SESSION['mensagem']  == 0 & $result != 0)
		{
		echo'<audio src="dist/msg.mp3" autoplay="autoplay">
			';
			$_SESSION['mensagem'] = $result;
		}
		else
		{
			if($_SESSION['mensagem']  < $result)
			{
			echo'<audio src="dist/msg.mp3" autoplay="autoplay">
			';
			$_SESSION['mensagem']  = $result;
			}
			else
			{
		
			$_SESSION['mensagem']  = $result;
			}
	}

             echo'   </a>
                <ul class="dropdown-menu">
                  <li class="header">Mensagens</li>
                  <li>
                    <!-- inner menu: contains the messages -->
                    <ul class="menu">
                      ';
		while ($row = $STH -> fetch(PDO::FETCH_ASSOC)) {
			echo ' <li><!-- start message -->
                        <a href="lermensagem.php?idmen='.$row['id_mensagem'].'&upd=true">
                        <div class="pull-left">
                            <!-- User Image -->
                            <img src="dist/img/' . $row['foto'] . '" class="img-circle" alt="User Image"/>
                          </div>
                          <!-- Message title and timestamp -->
                          <h4>                            
' . $row['utilizador'] . '                           
                          </h4>
                          <!-- The message -->
                          <p>'.limita($row['mensagem'],$slimite).'</p>
                        </a>
                      </li><!-- end message -->   ';
		}
		echo '</ul><!-- /.menu -->';
	?>
</li>
<li class="footer">
	<a href="#">See All Messages</a>
</li>
</ul>
</li><!-- /.messages-menu -->