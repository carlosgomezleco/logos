<?php
	echo '<div id="id3" class="col-lg-offset-1 col-lg-3"><button class="btn btn-default" onclick="AddDiario();">Añadir Diario</button></div>
		  <div id="clear"></div>
		  <br/>';
?>
<p><font color='#9e1b34'><b>DIARIOS OFICIALES</b></font></p>

<?php
if(!isset($bd) || $bd==null){
		$bd = Db::getInstance();
	}
	//Seleccionamos en pub documento el tipo 0 que son los diarios oficiales, el tipo 1 son normativas
	$select = "SELECT * FROM pub_documento WHERE tipo=0 ORDER BY id ASC";
	
	$c = $bd->ejecutar($select);
	while($row = $bd->obtener_fila($c, MYSQLI_ASSOC)){
		
		echo '<p><a target="_blank" href="'.SRV_DIR_DOWNLOAD_PUB.$row['ruta'].'">'.$row['nombre'].'</a></p>';
	}
	include ('add_documentacion.php');
?>
