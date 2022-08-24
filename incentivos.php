<?php
	echo '<div id="id3" class="col-lg-offset-1 col-lg-3"><button class="btn btn-default" onclick="AddIncentivo();">Añadir Incentivo</button></div>
		  <div id="clear"></div>
		  <br/>';
	echo "<table border='0' id='TableInc' class='stripe hover'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th width='10'><b>ID</b></th>";
	echo "<th width='50'><b>Incentivo</b></th>";
	echo "<th width='30'></th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	
	if(!isset($bd) || $bd==null){
		$bd = Db::getInstance();
	}
	$select = "SELECT * FROM pub_incentivo ORDER BY id ASC";
	
	$c = $bd->ejecutar($select);
	while($row = $bd->obtener_fila($c)){
						
		echo "<tr>";
		echo "<td width='10'>".$row['id']."</td>";
		echo "<td width='50'>".$row['Incentivo']."</td>";
		echo "<td width='30'><a onclick='return eliminar_incentivo(".$row['id'].");'><img src='img/cross.png' width=20/></a><a onclick='return editar_incentivo(".$row['id'].");'><img src='img/edit.png' width=20/></a></td>";
		echo "</tr>";
	} 
	echo "</tbody>";
	echo "</table>";
	//$bd->desconectar();
	include ('add_incentivo.php');
?>