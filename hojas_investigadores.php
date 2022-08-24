<?php
	/*Formulario con un botón refrescar para ver si existen nuevas hojas de inventario subidas por los investigadores.
	  Guardamos un campo oculto con investigadores para que al recargar la página se quede en esta pestaña*/
	echo '<form id="form-investigadores" class="form-horizontal" onsubmit="mensaje()" role="form" method="POST" action="administracion.php">';
	echo '<div id="id3" class="col-lg-offset-1 col-lg-3">
				<button name="btn_alta" id="btn_alta" type="submit" class="btn btn-default">Refrescar</button>
		   </div>			
				<input type="hidden" name="investigadores" value="investigadores">
			</form>';
?>
<br/><br/>
<p><font color='#9e1b34'><b>HOJAS DE INVENTARIO</b></font></p>


<?php
if(!isset($bd) || $bd==null){
		$bd = Db::getInstance();
	}
	$select = "SELECT * FROM pub_hoja_inventario ORDER BY id ASC";
	
	$c = $bd->ejecutar($select);
	while($row = $bd->obtener_fila($c, MYSQLI_ASSOC)){
		
		echo '<p>'.$row['investigador'].' <a target="_blank" href="'.SRV_DIR_DOWNLOAD_PUB."h/".$row['hoja'].'">Hoja</a> - <a target="_blank" href="'.SRV_DIR_DOWNLOAD_PUB."h/".$row['foto'].'">Foto</a> <a onclick="return eliminar_inventario('.$row['id'].');"><img src="img/cross.png" width=20/></a></p> ';
	}
	
?>