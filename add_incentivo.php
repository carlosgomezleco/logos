<?php
//PHP CON FORMULARIO PARA INCENTIVOS
	
	echo'<div class="modal fade" id="addIncentivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document" style="width: 65%;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="tituloInc" name="tituloInc" class="modal-title">Añadir Incentivo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<div class="modal-body">';
	//Hacemos post a administración.php que es el archivo que contiene todas las tablas y desde donde se realiza todo el procesamiento.
	echo '<form id="form-incentivo" class="form-horizontal" onsubmit="mensaje()" role="form" method="POST" action="administracion.php">';
	//Campo oculto incentivo para identificar el formulario que se está tratando.
	echo'<input type="hidden" name="incentivo" value="incentivo">';
	//Campo oculto en caso de que se esté editando para guardar el Identificador del incentivo.
	echo'<input type="hidden" id="idInc" name="idInc" value="">';
	//Campo oculto para identificar la acción que se está realizando add si se está añadiendo y edit si se está editando.
	echo'<input type="hidden" id="actionInc" name="actionInc" value="add">';
		
	echo'<div class="form-group">
			<label for="nombreIncentivo" class="form-control-label">Incentivo</label>
			<input type="text" class="form-control" size="100" name="nom_incentivo" id="nom_incentivo"
			title="Se necesita un nombre" placeholder="Indique el incentivo (máx. 100 caracteres)" required autofocus
			value="">
		</div>
		<!-- Botón guardar-->			
		<div class="form-group">
			<div class="col-lg-offset-1">
				<button name="btn_alta" id="btn_alta" type="submit" class="btn btn-default">Guardar</button>
				<button type="button" name="btn_cancel" id="btn_cancel" onclick="CerrarIncentivo();" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>
		</div>';
			
	echo '</form>';
	echo '		</div>
			</div>
		  </div>
		</div>';
		
		include('resources/modal.php');
?>