<?php
	 //$_SESSION['adju'] =""; 
	echo'<div class="modal fade" id="subirHoja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document" style="width: 65%;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="tituloSubH" name="tituloSubH" class="modal-title">Subir Hoja de Inventario</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<div class="modal-body">';
	echo '<form id="form-subida" class="form-horizontal" role="form" method="POST" action="post_subidaHoja.php" ENCTYPE="multipart/form-data">							
			<!-- Expediente -->
			<div class="form-group">
				<label for="expediente" class="col-lg-2 control-label">Investigador</label>
				<div class="col-lg-7">
					<input type="text" class="form-control" name="investigador" id="investigador"
						placeholder="Introduzca su nombre" required value="" style="width: 360px;">
				</div>
			</div>
				<div class="form-group">
					<label for="hoja" class="col-lg-2 control-label">Hoja (Max 2MB)</label>
						<div class="col-lg-9">
							<input type="file" name="hoja" class="form-control filestyle" id="hoja" style="width: 360px;" required>
							<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
						</div>
				</div>
				<div class="form-group">
					<label for="hoja" class="col-lg-2 control-label">Foto (Max 3MB)</label>
						<div class="col-lg-9">
							<input type="file" name="foto" class="form-control filestyle" id="foto" style="width: 360px;" required>
							<input type="hidden" name="MAX_FILE_SIZE" value="3145728" />
						</div>
				</div>
				<br/>
				<!-- Botones -->			
			<div class="form-group">
				<div class="col-lg-offset-1 col-lg-3">
					<button name="btn_alta" id="btn_alta" type="submit" class="btn btn-default" style="margin-right:0px;">Guardar</button>
					<button type="button" name="btn_cancel" id="btn_cancel" class="btn btn-default" onclick="CerrarInvestigador();">Cancelar</button>
				</div>
			</div>
		</form>';
	echo '		</div>
			</div>
		  </div>
		</div>';
		
		include('resources/modal.php');
?>