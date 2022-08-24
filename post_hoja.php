<?php  

error_reporting(E_ALL);
	ini_set('display_errors', '1');
	
	$hoja = (isset($_FILES['plant_hoja']['name']))? $_FILES['plant_hoja']['name'] : "";
	if(isset($_POST['actionHoj']) and ($_POST['actionHoj']=='add')){
		//Se recibe el formulario de edición de hoja
		//insertar el código necesario para la subida de ficheros si es necesaria y guardar en una variable los set si existen fichero.
		//No olvidar borrar los ficheros antiguos.
		$sentencia="";
		//echo "entro en el action<br/>"; 
		/*if($hoja =="" && isset($_POST['hojaInv'])){
			$hoja= $_POST['hojaInv'];
		}*/
		if(strlen($_FILES['plant_hoja']['name']) > 30 ){
			$continue = false;
			echo "<div class='alert alert-danger' role='alert'>El nombre del archivo ".$_FILES['plant_hoja']['name']." tiene más de 30 caracteres.</div>";
			break;	
		} else{
				
			if(!isset($bd) || $bd==null){
				$bd = Db::getInstance();
			}
			
						
			$insertar = "INSERT pub_modelo_hoja (id_incentivo, archivado, observaciones) VALUES (".$_POST['sincentivo'].",'".$_POST['archivado']."','".$_POST['observ']."')";
			//echo $insertar;
			$resultado = $bd->ejecutar($insertar);
			//Si se ha insertado, muestra el listado
			if($bd->totalAfectados() != 1){						
				echo '<div style="width:94%;" class="alerta2 alert alert-danger">Ha ocurrido un error y el modelo no se ha insertado.</div>';
			}else{
				$lastId=$bd->lastID();
				if($hoja != ""){
					$hoja =$lastId."_".$hoja;
				
					$actualizar = "UPDATE pub_modelo_hoja SET hoja_inventario='".$hoja."' WHERE id = '".$lastId."'";
					$resultado = $bd->ejecutar($actualizar);
					if($bd->totalAfectados() != 1){						
						echo '<div style="width:94%;" class="alerta2 alert alert-danger">Ha ocurrido un error y el documento no se ha subido.</div>';
					}else{					
						if(isset($_FILES['plant_hoja']['name']) and $_FILES['plant_hoja']['name']!=""){
							$objFtp = new Net_SFTP(SRV_NAME, SRV_PORT);
							if($objFtp != false){
								if (!$objFtp ->login(SRV_USER, SRV_PASS)){
									$error = 1;
									echo '<div class="alert alert-danger" role="alert">Error en el login con el servidor. No se ha subido 
									la documentación. Por favor, póngase en contacto con el Administrador</div>';
									$objFtp->disconnect();
								}
								else{
									
									$strData = file_get_contents($_FILES['plant_hoja']['tmp_name']);
									if (!$objFtp->put(SRV_DIR_UPLOAD_PUB.$hoja, $strData)){
										$error = 1;
										echo '<div class="alert alert-danger" role="alert">Error al subir la hoja. Si el problema persiste, por favor, póngase
										en contacto con el Administrador</div>';
										
										//exit(1);
									}
									$objFtp->disconnect();
								}
								
							}
						}
					}
				}
			}			
		}
	}
	else if(isset($_POST['actionHoj']) and $_POST['actionHoj']=='edit'){
		//Se recibe el formulario de edición de hoja
		//insertar el código necesario para la subida de ficheros si es necesaria y guardar en una variable los set si existen fichero.
		//No olvidar borrar los ficheros antiguos.
		//echo "entro en edit";
		$sentencia="";
		//$hoja="";
		//echo "antes de hoja";
		/*if($hoja =="" && isset($_POST['hojaInv'])){
			$hoja= $_POST['hojaInv'];
			//echo "hoja  igual al post";
		}*/
		if(isset($_FILES['plant_hoja']) and (strlen($_FILES['plant_hoja']['name']) > 30 )){
			
			echo "<div class='alert alert-danger' role='alert'>El nombre del archivo ".$_FILES['plant_hoja']['name']." tiene más de 30 caracteres.</div>";
			break;	
		}
		else{
			//echo "antes de bd<br/>";
			if(!isset($bd) || $bd==null){
				$bd = Db::getInstance();
			}
				//echo "conecto de bd<br/>";
			if(isset($_POST['archivado']) and ($_POST['archivado']==1)){
				//si el valor de archivado es 1 quiere decir que la plantilla está archivada y se incluyen las observaciones.
				$sentencia="archivado=1, observaciones='".$_POST['observ']."'";
				//echo $sentencia."<br/>";
			}else{
				//si el valor es 0 es que la plantilla está activa y no debe haber observaciones.
				$sentencia="archivado=0, observaciones=''";
				//echo $sentencia."<br/>";
			}
			if(isset($_FILES['plant_hoja']['name']) && $_FILES['plant_hoja']['name']!=""){
				//echo "hoja no vacia<br/>";
				$hoja = $_POST['idHoj']."_".$_FILES['plant_hoja']['name'];
				$sentencia.=", hoja_inventario ='".$hoja."'";
				//echo "hoja = $hoja <br/>";
				//echo "sentencia = $sentencia <br/>";
			}
			//echo $sentencia;
			$actualizar = "UPDATE pub_modelo_hoja SET ".$sentencia." WHERE id = '".$_POST['idHoj']."'";
			//echo $actualizar;
			$resultado = $bd->ejecutar($actualizar);
			if($bd->totalAfectados() != 1){				
				echo '<div style="width:94%;" class="alerta2 alert alert-danger">Ha ocurrido un error y la plantilla no se ha actualizado.</div>';
			}else{
				
				if(isset($_FILES['plant_hoja']['name']) and $_FILES['plant_hoja']['name']!=""){
					$objFtp = new Net_SFTP(SRV_NAME, SRV_PORT);
					if($objFtp != false){
						if (!$objFtp ->login(SRV_USER, SRV_PASS)){
							$error = 1;
							echo '<div class="alert alert-danger" role="alert">Error en el login con el servidor. No se ha subido 
							la documentación. Por favor, póngase en contacto con el Administrador</div>';
							$objFtp->disconnect();
						}
						else{
							
							$strData = file_get_contents($_FILES['plant_hoja']['tmp_name']);
							if (!$objFtp->put(SRV_DIR_UPLOAD_PUB.$hoja, $strData)){
								$error = 1;
								echo '<div class="alert alert-danger" role="alert">Error al subir la hoja. Si el problema persiste, por favor, póngase
								en contacto con el Administrador</div>';
								$objFtp->disconnect();
								//exit(1);
							}
							else{
								//elimino la antigua del server
								if(isset($_POST['hojaInv']) and $_POST['hojaInv']!=""){
									$objFtp->delete(SRV_DIR_UPLOAD_PUB.$_POST['hojaInv'], false);
								}
							}//if put solicitud
								//}//is sesion convo != files
						}
						$objFtp->disconnect();
					}
				}
			}
			}
		}
		?>