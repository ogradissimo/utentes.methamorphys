<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mensagens
          
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <?php include 'menumensagem.php';?>
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Mensagem</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                 <form action="inserirmensagem.php" method="get" name="formtest">
                  <div class="form-group">

						<?php
						include 'cont.php';
						echo ' <label>Destino</label>';
						$STH4 = $DBH -> prepare('SELECT  * FROM  utilizador');
						$STH4 -> execute();
						echo ' <select class="form-control" name="destino">';
						echo '<option value="000">Selecione o Destino</option>';
						while ($row4 = $STH4 -> fetch()) {
							if(isset($_GET['idev']))
							{
								if($_GET['idev']==$row4['id_ut'])
								{
								echo '<option value="' . $row4['id_ut'] . '" selected >' . $row4['utilizador'] . '</option>';	
								}
								else {
								echo '<option value="' . $row4['id_ut'] . '" >' . $row4['utilizador'] . '</option>';	
									
								}
							}
							else
							{
														echo '<option value="' . $row4['id_ut'] . '">' . $row4['utilizador'] . '</option>';
								
							}
						}
						echo ' </select>
';
						?>
						                  </div>
                  <div class="form-group">
                    <textarea id="compose-textarea" class="form-control" style="height: 300px" name="texto" id="auto">
                    </textarea>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <div class="pull-right">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button></form>
                    <script  type="text/javascript">
 var frmvalidator = new Validator("formtest");
frmvalidator.addValidation("destino","dontselect=000","Selecione um Destino");
frmvalidator.EnableMsgsTogether();
</script>
                  </div>
							<input type='button' onclick="location.href='mensagens.php'" value='Cancelar'  class='btn btn-primary'>
                </div><!-- /.box-footer -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->