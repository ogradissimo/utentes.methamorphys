
<li class="dropdown notifications-menu" >
	<!-- Menu toggle button -->
	
	<a href="#" class="dropdown-toggle" data-toggle="dropdown"  > <i class="fa fa-bell-o"></i> <?php
	
		include 'cont.php';
		$STH = $DBH -> prepare("SELECT * FROM avisos  Where  id_utilizador_dest = ? and visto = 0");
		$id = $_SESSION['idut'];
		$STH -> bindParam(1, $id);
		$STH -> execute();
		$result2 = $STH -> rowcount();
			echo '<span class="label label-danger">' . $result2 . '</span>';
		
		if($_SESSION['aviso'] == 0 & $result2!=0)
		{
						echo'<audio src="dist/aviso.mp3" autoplay="autoplay">';
			
			$_SESSION['aviso'] = $result2;
		}
		else
		{
			if($_SESSION['aviso']  < $result2)
			{
			echo'<audio src="dist/aviso.mp3" autoplay="autoplay">
			';
			$_SESSION['aviso']  = $result2;
			}
			else
			{
		
			$_SESSION['aviso']  = $result2;
			}
	}
echo'</a>
                <ul class="dropdown-menu">
                  <li class="header"><b>Avisos</b></li>';
		echo ' <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">';
		if ($result2 == 0) {
			echo '<li><!-- start notification -->
                   
                          <i class="fa fa-fw fa-warning text-red "></i>Sem Avisos
                        
                      </li>';
		} else {

			while ($row = $STH -> fetch(PDO::FETCH_ASSOC)) {
				echo ' <li><!-- start notification -->
                        <a href="veravisopag.php?avisovisto=' . $row['id_aviso'] . '&idav=' . $row['id_aviso'] . '">
                          <i class="fa fa-fw fa-warning text-red "></i> ' . $row['titulo_aviso'] . '
                        </a>
                      </li>';

			}
		}
		echo "        </ul>
                                
             ";
	?>
	 </ul>
 </li>
	<!-- end notification -->
