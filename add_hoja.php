<?php
//PHP CON FORMULARIO PARA HOJAS DE INVENTARIO
	
	echo'<div class="modal fade" id="addHoja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:none;">
			<div class="modal-dialog" role="document" style="width: 65%;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="tituloHoj" name="tituloHoj" class="modal-title">Editar Plantilla</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<div class="modal-body">';
	//Hacemos post al archivo administracion.php que es el que contiene toda las tablas 
	echo '<form id="form-hoja" class="form-horizontal" onsubmit="mensaje()" role="form" method="POST" action="administracion.php" ENCTYPE="multipart/form-data">';
	//Input oculto para identificar el tipo de formulario que se está enviando.
	echo'<input type="hidden" name="hoja" id="hoja" value="hoja">';
	//Input con el id de la plantilla en la BD
	echo'<input type="hidden" id="idHoj" name="idHoj" value="">';
	//Input para diferenciar la acción que se esté realizando add si se está añadiendo y edit si se está modificando
	echo'<input type="hidden" id="actionHoj" name="actionHoj" value="">';
	//Select con el listado de todos los incentivos que existen en la BD. Si se está editando el incentivo no podrá modificarse y el campo aparecerá como deshabilitado.
	echo '<div class="form-group">
				<label for="sincentivo" class="form-control-label">Incentivo</label>
					<select name="sincentivo" id="sincentivo" class="form-control" required disabled>Incentivo';
					if(!isset($bd) || $bd==null){
						$bd = Db::getInstance();
					}
					$select = "SELECT * FROM pub_incentivo ORDER BY id ASC";
					
					$c = $bd->ejecutar($select);
					while($fila = $bd->obtener_fila($c, MYSQLI_ASSOC)){

						echo '<option value="'.$fila['id'].'">'.$fila['Incentivo'].'</option>';
					}
		echo '</select>
			  </div>';
	  /*Dos radiobuttons para indicar si la plantilla está disponible o está archivada. 0 No archivada, 1 Archivada
		Área de tecxto para indicar las posibles observaciones que pueda haber. Este campo solo estará visible 
		cuando se seleccione en el radio button la opción archivado y se utiliza para indicar lo concerniente a la
		plantilla y los datos por los que se encuentra archivada. */
	echo '<div class="form-group" id="radio_arch_no" name="radio_arch_no">
				<label class="radio-inline"><input type="radio" id="noarchivado" name="archivado" value="0">Activa</label>
				<label class="radio-inline"><input type="radio" id="archivado" name="archivado" value="1">Archivada</label>
		  </div>
		  <div class="form-group">
				<label for="observ" id="textobserv" name="textobserv">Observaciones:</label>
				<textarea class="form-control" rows="5" id="observ" name="observ"></textarea>
		  </div>';
	/*Campo para subir una nueva plantilla, con el enlace si existe a la plantilla que se encuentra en el servidor.
	  Además se incluye el campo oculto hijaInv para guardar la plantilla existente y saber cual hay que eliminar 
	  del servidor en caso de que se sustituya.	*/
	echo'<div class="checkbox" id="todoChbHoj">
			<label>							
				<input type="checkbox" value="" id="chb_hoj"> <div id="textChx_hoj">Solo si desea modificarla, active la casilla.</div><a id="hrefHoj" name="hrefHoj" href="">Hoja asignada</a>
			</label>
		</div>
		<input id="hojaInv" name="hojaInv" type="hidden" value="">
		<div class="form-group">
			<label for="hoja" class="form-control-label">Plantilla</label>
				<!--div class="col-lg-10"-->
					<input type="file" name="plant_hoja" class="form-control filestyle" id="plant_hoja">
				<!--/div-->
		</div>
		<!-- Botón guardar-->			
		<div class="form-group">
			<div class="col-lg-offset-1">
				<button name="btn_alta" id="btn_alta" type="submit" class="btn btn-default">Guardar</button>
				<button type="button" name="btn_cancel" id="btn_cancel" onclick="CerrarHoja();" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>
		</div>';
			
	echo '</form>';
	echo '		</div>
			</div>
		  </div>
		</div>';
		
		include('resources/modal.php');
?>