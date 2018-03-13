
<div class='box box-default'>
	<div class='box-header with-border'>
		<h3 class='box-title'><i class="fa fa-tag"></i> Evento:</h3>
		<div class="box-tools pull-right">
			<?php
				$id2=$_GET['idev'];
				echo '<a href="vereventos.php?idev='.$id2.'&op=2"><img src="dist/img/edit.png" /></a>';
					
				
			?>
		</div>
	</div>
	<div class='box-body'>
		<div class='row'>
			<div class='box-body pad'>
				<?php 
				if(isset($_GET['op']))
				{
			include 'upeventos.php';				
				}
else {
	include 'vevent.php';
}
				
				?>
			</div>

		</div>
	</div>
</div>