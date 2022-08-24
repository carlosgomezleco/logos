<?php
//PHP CON FORMULARIO PARA DIARIOS OFICIALES Y NORMATIVAS
	
	echo'<div class="modal fade" id="addNormativa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document" style="width: 65%;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="tituloDoc" name="tituloDoc" class="modal-title">Añadir Normativa</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<div class="modal-body">';
	//Hacemos post al archivo administracion.php que es el que contiene todas las tablas y donde se realiza todo el procesamiento
	echo '<form id="form-documento" class="form-horizontal" onsubmit="mensaje()" role="form" method="POST" action="administracion.php" ENCTYPE="multipart/form-data">';
	//Campo oculto para identificar el formulario que se está enviando en este caso un documento.
	echo'<input type="hidden" name="documento" value="documento">';
	//Campo oculto con el tipo de documento que se está enviando en este caso con valor 1 es de tipo Normativa, con valor 0 es Diario OFICIALES
	echo'<input type="hidden" id="tipo" name="tipo" value="1">';
	//Campo oculto para indicar el tipo de acción que se est´realizando en el formulario add si se está añadiendo y edit si se está editando
	echo'<input type="hidden" id="actionDoc" name="actionDoc" value="add">';
	echo'<div class="form-group">
			<label for="nombreIncentivo" class="form-control-label">Normativa</label>
			<input type="text" class="form-control" size="100" name="nom_doc" id="nom_doc"
			title="Se necesita un nombre" placeholder="Indique el nombre (máx. 100 caracteres)" required autofocus
			value="">
		</div>';
	echo'<div class="form-group">
			<label for="documento" class="form-control-label">Documento</label>
				<!--div class="col-lg-10"-->
					<input type="file" name="documento" class="form-control filestyle" id="documento">
				<!--/div-->
		</div>
		<!-- Botón guardar-->			
		<div class="form-group">
			<div class="col-lg-offset-1">
				<button name="btn_alta" id="btn_alta" type="submit" class="btn btn-default">Guardar</button>
				<button type="button" name="btn_cancel" id="btn_cancel" onclick="CerrarNormativa();" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>
		</div>';
			
	echo '</form>';
	echo '		</div>
			</div>
		  </div>
		</div>';
		
		include('resources/modal.php');
?>