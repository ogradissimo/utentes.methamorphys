 <li class="header">Gestão dos Utentes           

           <?php
           include ("cont.php");
				$STH = $DBH -> query('Select * From  Agre ');
				$STH -> execute();
			    $STH -> setFetchMode(PDO::FETCH_ASSOC);
				while ($row = $STH -> fetch()) {
					if($row['id_agre']!=1)
					{
				$STH2 = $DBH -> query('Select paginas.nome , paginas.link From  perfil_pagina , paginas where perfil_pagina.id_pagina = paginas.id_pagina and id_local=1 and id_agre='.$row['id_agre'].' and id_tipo = '.$_SESSION['perfil'].' ');
				$STH2 -> execute();
				$result=$STH2->rowCount();
				if($result !='0' )
				{
				echo '<li >
              <a href="#">'.$row['des'].' <i class="fa fa-angle-left pull-right"></i> </a>
               <ul class="treeview-menu"> ';	
				$STH2 -> setFetchMode(PDO::FETCH_ASSOC);
				while ($row2 = $STH2 -> fetch()) {
							echo"<li><a href='".$row2['link']."'><span>".$row2['nome']."</span></a></li>";
									
								}
			echo "  </ul>
						</li>
	</li>
						";
				}
	}
				}

           ?>
</li>
 <li class="header">Gestão do Pessoal           
           <?php
           include_once ("cont.php");
				$STH = $DBH -> query('Select * From  Agre ');
				$STH -> execute();
			    $STH -> setFetchMode(PDO::FETCH_ASSOC);
				while ($row = $STH -> fetch()) {
					if($row['id_agre']!=1)
					{
				$STH2 = $DBH -> query('Select paginas.nome , paginas.link From  perfil_pagina , paginas where perfil_pagina.id_pagina = paginas.id_pagina and id_local=9 and id_agre='.$row['id_agre'].' and id_tipo = '.$_SESSION['perfil'].' ');
				$STH2 -> execute();
				$result=$STH2->rowCount();
				if($result !='0' )
				{
				echo '<li >
              <a href="#">'.$row['des'].' <i class="fa fa-angle-left pull-right"></i> </a>
               <ul class="treeview-menu"> ';	
				$STH2 -> setFetchMode(PDO::FETCH_ASSOC);
				while ($row2 = $STH2 -> fetch()) {
							echo"<li><a href='".$row2['link']."'><span>".$row2['nome']."</span></a></li>";
									
								}
			echo "  </ul>
						</li>
	</li>
						";
				}
	}
				}

           ?>
</li>