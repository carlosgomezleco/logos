<?php
	$documento = (isset($_FILES['documento']['name']))? $_FILES['documento']['name'] : "";
	if(isset($_POST['actionDoc']) and $_POST['actionDoc']=='add'){
		//Se recibe el formulario de edición de hoja
		//insertar el código necesario para la subida de ficheros si es necesaria y guardar en una variable los set si existen fichero.
		//No olvidar borrar los ficheros antiguos.
		$sentencia="";
		if(strlen($_FILES['documento']['name']) > 30 ){
			$continue = false;
			echo "<div class='alert alert-danger' role='alert'>El nombre del archivo ".$_FILES['documento']['name']." tiene más de 30 caracteres.</div>";
			break;	
		}else if(isset($_FILES['documento']['name']) && $_FILES['documento']['name']!=""){
			if(!isset($bd) || $bd==null){
				$bd = Db::getInstance();
			}
			$insertar = "INSERT pub_documento (tipo, nombre) VALUES ('".$_POST['tipo']."','".$_POST['nom_doc']."')";
			$resultado = $bd->ejecutar($insertar);
			//Si se ha insertado, muestra el listado
			if($bd->totalAfectados() != 1){						
				echo '<div style="width:94%;" class="alerta2 alert alert-danger">Ha ocurrido un error y el proyecto no se ha actualizado.</div>';
			} else{
				$lastId=$bd->lastID();
				$documento =$lastId."_".$_FILES['documento']['name'];
				$sentencia=" ruta ='".$documento."'";
				$actualizar = "UPDATE pub_documento SET ".$sentencia." WHERE id = '".$lastId."'";
				$resultado = $bd->ejecutar($actualizar);
				if($bd->totalAfectados() != 1){						
					echo '<div style="width:94%;" class="alerta2 alert alert-danger">Ha ocurrido un error y el documento no se ha subido.</div>';
				}else{
					
					if(isset($_FILES['documento']['name']) and $_FILES['documento']['name']!=""){
						$objFtp = new Net_SFTP(SRV_NAME, SRV_PORT);
						if($objFtp != false){
							if (!$objFtp ->login(SRV_USER, SRV_PASS)){
								$error = 1;
								echo '<div class="alert alert-danger" role="alert">Error en el login con el servidor. No se ha subido 
								la documentación. Por favor, póngase en contacto con el Administrador</div>';
								$objFtp->disconnect();
							}
							else{
								
								$strData = file_get_contents($_FILES['documento']['tmp_name']);
								if (!$objFtp->put(SRV_DIR_UPLOAD_PUB.$documento, $strData)){
									$error = 1;
									echo '<div class="alert alert-danger" role="alert">Error al subir el documento. Si el problema persiste, por favor, póngase
									en contacto con el Administrador</div>';
									$objFtp->disconnect();
									//exit(1);
								}
									//}//is sesion convo != files
							}
							$objFtp->disconnect();
						}
					}
				}
			}
		}
	}
?>