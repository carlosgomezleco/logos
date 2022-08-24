<?php

	include('../../lib/Db.php');
	include('../../lib/Conf.class.php');
	header('Content-type: application/json');
	$bd = Db::getInstance();
	switch ($_GET['info']) {
        case 'INCENTIVO' :
			$id=$_GET['id'];
            $sql = "SELECT * FROM pub_incentivo WHERE id='".$id."'";
			$resultado = $bd->ejecutar($sql);
            $fila = $bd->obtener_fila($resultado);
            echo json_encode($fila);
            break;
		
		case 'HOJA' :
			$id=$_GET['id'];
            $sql = "SELECT * FROM pub_modelo_hoja WHERE id='".$id."'";
			$resultado = $bd->ejecutar($sql);
            $fila = $bd->obtener_fila($resultado);
            echo json_encode($fila);
            break;
	}

?>