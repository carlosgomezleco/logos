<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors', '1');
	session_start();
	set_include_path(implode(PATH_SEPARATOR, array(
        realpath('../lib/phpseclib'),
        get_include_path(),
	)));
	//include('Net/SFTP.php');
	include('../lib/Db.php');
	include('../lib/Conf.class.php');
	include('../lib/config.php');
	include('../lib/funciones.php');
	require('../lib/phpseclib/Net/SFTP.php');
	
	$_SESSION['error_investigador']="";
	$enviado=false;
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		if($_FILES['hoja']['error'] == 2){
			$_SESSION['error_investigador'] = '<div style="width:94%;" class="alerta2 alert alert-danger">Error el archivo subido a la hoja tiene más de 2MB.</div> <br/>';
		}else if($_FILES['foto']['error'] == 2){
			$_SESSION['error_investigador'] = '<div style="width:94%;" class="alerta2 alert alert-danger">Error la foto subida tiene más de 3MB.</div> <br/>';
		}else{
			  $bd = Db::getInstance();
			  //echo $_POST['investigador']."<br/>";
			  //echo $_FILES['hoja']['name'];
			  $insertar = "INSERT INTO pub_hoja_inventario (investigador, fecha) VALUES ('".$_POST['investigador']."', NOW())";
			//echo "error antes de insertar";
			$resultado = $bd->ejecutar($insertar);
			//echo "eror antes de lastID";
			$lastID = $bd->lastID();
			
			
			//Si se ha insertado, muestra el listado
			if($bd->totalAfectados() != 1){						
				$_SESSION['error_investigador'] = '<div style="width:94%;" class="alerta2 alert alert-danger">Ha ocurrido un error con la base de datos y la hoja de inventario y la foto no se han enviado.</div> <br/>';
				//echo "error con la BD";
			}else if($_FILES['hoja']['name']!="" and $_FILES['foto']['name']!=""){
				
				$objFtp = new Net_SFTP(SRV_NAME, SRV_PORT);
				
				if($objFtp != false){
					// Login
					
					if (!$objFtp ->login(SRV_USER, SRV_PASS)){
						$_SESSION['error_investigador'] .= '<div style="width:94%;" class="alerta2 alert alert-danger">Ha ocurrido un error en la conexión con el servidor, vuelva a intentarlo más tarde</div> <br/>';
						$objFtp->disconnect();
						
					}
					else{
						$hoja=$lastID."_hoja_".$_FILES['hoja']['name'];
						$foto=$lastID."_foto_".$_FILES['foto']['name'];
						$actualizar = "UPDATE pub_hoja_inventario SET hoja ='".$hoja."', foto ='".$foto."'  WHERE id ='".$lastID."'";
						$resultado = $bd->ejecutar($actualizar);
						
						if(isset($_FILES['hoja']['name']) and $_FILES['hoja']['name']!=""){
						
							$strData = file_get_contents($_FILES['hoja']['tmp_name']);
							//Subimos el archivo al servidor a la carpeta h para diferenciar las hojas de inventario subidas por los investigadores
							if(!$objFtp->put(SRV_DIR_UPLOAD_PUB."h/".$hoja, $strData)){
								
								$error = 1;
								$_SESSION['error_investigador'] .='<div class="alert alert-danger" role="alert">Error al subir la hoja de inventario. Si el problema persiste, por favor, póngase
								en contacto con mcarmen.garcia@sc.uhu.es o carlos.gomez@sc.uhu.es</div><br/>';											
								$objFtp->disconnect();
								//exit(1);
							}else{
								//Enviar email a José María y otr@s
								$enviado=true;
							}
							
						}
						
						if(isset($_FILES['foto']['name']) and $_FILES['foto']['name']!=""){
						
							$strData = file_get_contents($_FILES['foto']['tmp_name']);
							//Subimos el archivo al servidor a la carpeta h para diferenciar las fotos subidas por los investigadores
							if(!$objFtp->put(SRV_DIR_UPLOAD_PUB."h/".$foto, $strData)){
								
								$error = 1;
								$_SESSION['error_investigador'] .='<div class="alert alert-danger" role="alert">Error al subir la foto. Si el problema persiste, por favor, póngase
								en contacto con mcarmen.garcia@sc.uhu.es o carlos.gomez@sc.uhu.es</div><br/>';											
								$objFtp->disconnect();
								//exit(1);
							}else{
								if($enviado){//Enviar email a José María y otr@s
										mail("adm.id@sc.uhu.es","Intranet Publicidad","Se ha recibido una hoja de inventario con foto");
										//mail("mcarmen.garcia@sc.uhu.es","Intranet Publicidad","Se ha recibido una nueva foto de inventario");
										
										$_SESSION['error_investigador'] ='<div class="alert alert-success">
													<strong>Su hoja de inventario y su foto han sido enviadas correctamente.</strong>
											  </div>';
								}
							}
							
						}
					}
				}
			}else{
				$_SESSION['error_investigador'].='<div class="alert alert-danger" role="alert">Error al subir la hoja de inventario, no se ha detectado correctamente el fichero. Si el problema persiste, por favor, póngase
								en contacto con mcarmen.garcia@sc.uhu.es o carlos.gomez@sc.uhu.es</div><br/>';
			}
		}
	}
	header('Location: inventario.php');
?>