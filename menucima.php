
 <script >
	window.onload = function() {
		
		var nome = window.location.href.match(/(\w+)\.php/);
		if (nome)
			nome = nome[0];
		var $scores = $("#refresh");
		setInterval(function() {
			$scores.load(nome + " #refresh");
		}, 5000); }


</script>

          <div class="navbar-custom-menu" id="refresh">

            <ul class="nav navbar-nav" >
              <?php include 'menumesagens.php' ?>
              <!-- Notifications Menu -->
				<?php include 'menuavisos.php'?>
              <!-- Tasks Menu -->
				<?php include 'menutarefas.php'?>                    

				<?php include 'menuprofile.php'?>
            </ul></div>
  