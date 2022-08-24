<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	session_start();
	set_include_path(implode(PATH_SEPARATOR, array(
        realpath('../lib/phpseclib'),
        get_include_path(),
	)));
	require('../lib/phpseclib/Net/SFTP.php');	
	require_once('../lib/Db.php');
	require_once('../lib/Conf.class.php');
	require_once('lib/funciones.php');
	require_once('../lib/config.php');
	
	header("Content-Type: text/html;charset=utf-8");
	
	//Si estan definidas, hemos realizado el login correctamente
	if(isset($_SESSION['user']) and isset($_SESSION['pass'])){
		/*En la petición GET indicamos si el recurso a eliminar (convocatoria o proyecto)
		** y si tiene documentación asociada, la eliminamos, así como el registro de la base de datos
		**Eliminanos el registro de la base de datos.*/		
		$error = null;
		if($_GET['resource'] == "incentivo"){
			eliminarIncentivo($_GET['id']);
			header('location:administracion.php');
		}else if($_GET['resource'] == "modelo"){	
			eliminarPlantilla($_GET['id']);
			header('location:administracion.php');
		}else if($_GET['resource'] == "inventario"){				
			eliminarInventario($_GET['id']);
			header('location:administracion.php');
		}
	} //if session
	else{
		echo '<div id="error">Lo sentimos, pero no tiene permisos para acceder. <a href="index.php"><img src="img/volver.png" alt="Regresar al listado"/></a></div><br>';
	}
?>