<?php
	echo '<div id="id3" class="col-lg-offset-1 col-lg-3"><button class="btn btn-default" onclick="AddNormativa();">Añadir Normativa</button></div>
		  <div id="clear"></div>
		  <br/>';
?>
<p><font color='#9e1b34'><b>NORMATIVA</b></font></p>

<?php
	if(!isset($bd) || $bd==null){
		$bd = Db::getInstance();
	}
	//Select con los documentos con tipo 1 que son las normativas si fuese tipo 0 serían Diarios Oficiales
	$select = "SELECT * FROM pub_documento WHERE tipo=1 ORDER BY id ASC";
	
	$c = $bd->ejecutar($select);
	while($row = $bd->obtener_fila($c, MYSQLI_ASSOC)){
		
		echo '<p><a target="_blank" href="'.SRV_DIR_DOWNLOAD_PUB.$row['ruta'].'">'.$row['nombre'].'</a></p>';
	}
	include ('add_normativa.php');
?>
