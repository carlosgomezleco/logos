<?php
	echo '<div id="id3" class="col-lg-offset-1 col-lg-3"><button class="btn btn-default" onclick="AddPlantilla();">Añadir Plantilla</button></div>
		  <div id="clear"></div>
		  <br/>';
	echo "<table border='0' id='TableHojArch' class='stripe hover'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th width='10'><b>ID</b></th>";
	echo "<th width='50'><b>Incentivo</b></th>";
	echo "<th width='50'><b>Observaciones</b></th>";
	echo "<th width='50'><b>Hoja</b></th>";
	echo "<th width='30'></th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	
	if(!isset($bd) || $bd==null){
		$bd = Db::getInstance();
	}
	//Select con todos los campos de la tabla de las plantillas con el tipo 1 que indica que son plantillas archivadas
	$select = "SELECT mh.id as idm, mh.hoja_inventario as hoja, i.incentivo as inc, mh.observaciones as obs FROM pub_modelo_hoja mh INNER JOIN pub_incentivo i on (i.id=id_incentivo) WHERE mh.archivado=1 ORDER BY idm ASC";
	
	$c = $bd->ejecutar($select);
	while($row = $bd->obtener_fila($c)){
		
		$hoja = ($row['hoja'] != "")? "<a target='_blank' href='".SRV_DIR_DOWNLOAD_PUB.$row['hoja']."'>Descargar</a>" : "--";
		echo "<tr>";
		echo "<td width='10'>".$row['idm']."</td>";
		echo "<td width='50'>".$row['inc']."</td>";
		echo "<td width='50'>".$row['obs']."</td>";
		echo "<td width='50'>".$hoja."</td>";
		echo "<td width='30'><a onclick='return eliminar_plantilla(".$row['idm'].");'><img src='img/cross.png' width=20/></a><a onclick='return editar_plantilla(".$row['idm'].");'><img src='img/edit.png' width=20/></a></td>"; 
		echo "</tr>";
	} 
	echo "</tbody>";
	echo "</table>";
	//$bd->desconectar();
	//require ('add_hoja.php');
?>