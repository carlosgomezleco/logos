<?php
	
	/***************************** Funciones *************************************/
	
	function eliminarInventario($id){
		
		$error = "";
		$bd = null;		
		//Realizamos la conexión y login con el servidor
		$objFtp = false;
		$objFtp = new Net_SFTP(SRV_NAME, SRV_PORT);
		if($objFtp != false){
			if (!$objFtp ->login(SRV_USER, SRV_PASS)){
				$error = "Error en el login con el servidor. Por favor, póngase en contacto con el Administrador</div>";
				$objFtp->disconnect();
			}
			else{					
				$bd = Db::getInstance();
				$sql = "SELECT * FROM pub_hoja_inventario WHERE id='".$id."';";
				$resultado = $bd->ejecutar($sql);
				//if($bd->totalRegistros() > 0){
				while($fila = $bd->obtener_fila($resultado)){
					//Eliminamos el fichero del servidor
					if($fila['ruta'] != ""){ 
						if(!$objFtp->delete(SRV_DIR_UPLOAD_PUB."h/".$fila['ruta'], false)){
							$error .= "La hoja de inventario no se ha eliminado<br>";
						}
					}
				}//end while
				//}//if resultado
				$objFtp->disconnect();
				$sql = "DELETE FROM pub_hoja_inventario WHERE id=".$id;
				$resultado = $bd->ejecutar($sql);
				if($bd->totalAfectados() == 0) $error=1;
				$bd->desconectar();	
			}// end else !$objFtp ->login			
		} //if $objFtp !== false
		else{
			$error = "<div class='alert alert-danger' role='alert'>Error al conectar con el servidor. No se ha eliminado la hoja de inventario. 
			Si el problema persiste, por favor, póngase en contacto con el Administrador</div>";	
		} // end else $objFtp !== false
		//}// if doc != none
		$_SESSION['pest'] = 6;	
		return $error;
	}
	
	function eliminarIncentivo($id){
		//echo "<p>Entrando en eliminar incentivo</p>";
		$error = "";
		$bd = null;
		//if($doc == "yes"){		
		//Realizamos la conexión y login con el servidor		
		$objFtp = new Net_SFTP(SRV_NAME, SRV_PORT);
		if($objFtp != false){
			if (!$objFtp ->login(SRV_USER, SRV_PASS)){
				$error = "Error en el login con el servidor.Por favor, póngase en contacto con el Administrador</div>";
				$objFtp->disconnect();
			}
			else{	 //echo "<p>Login OK</p>";
				//Consultamos las plantillas asociadas al inventarios para eliminar de la Bd y del servidor.
				$bd = Db::getInstance();
				$sql = "SELECT * FROM pub_modelo_hoja WHERE id_incentivo=".$id.";";
				$resultado = $bd->ejecutar($sql);
				if($bd->totalRegistros($resultado) > 0){ //echo "<p>hay registros afectados</p>";
					while($fila = $bd->obtener_fila($resultado)){
						//Eliminamos el fichero del servidor
						if($fila['hoja_inventario'] != ""){ 
							if(!$objFtp->delete(SRV_DIR_UPLOAD_PUB.$fila['hoja_inventario'], false)){
								$error .= "La hoja de inventario no se ha eliminado<br>";
							}
						}
					}//end while
				}//if resultado
				$objFtp->disconnect();
				$sql = "DELETE FROM pub_modelo_hoja WHERE id_incentivo=".$id;
				$resultado = $bd->ejecutar($sql);
				if($bd->totalAfectados() == 0) $error=1;
				
				$sql = "DELETE FROM pub_incentivo WHERE id=".$id;
				$resultado = $bd->ejecutar($sql);
				if($bd->totalAfectados() == 0) $error=2;
				$bd->desconectar();		
			}// end else !$objFtp ->login			
		} //if $objFtp !== false
		else{
			$error = "<div class='alert alert-danger' role='alert'>Error al conectar con el servidor. No se ha eliminado el 
				incentivo. Si el problema persiste, por favor, póngase en contacto con el Administrador</div>";	
		} // end else $objFtp !== false
		//}// if doc != none
		
		return $error;
	}
	
	function eliminarPlantilla($id){
		$error = "";
		$bd = null;
		//if($doc == "yes"){		
		//Realizamos la conexión y login con el servidor		
		$objFtp = new Net_SFTP(SRV_NAME, SRV_PORT);
		if($objFtp != false){
			if (!$objFtp ->login(SRV_USER, SRV_PASS)){
				$error = "Error en el login con el servidor.Por favor, póngase en contacto con el Administrador</div>";
				$objFtp->disconnect();
			}
			else{	 //echo "<p>Login OK</p>";				
				$bd = Db::getInstance();
				$sql = "SELECT * FROM pub_modelo_hoja WHERE id=".$id.";";
				$resultado = $bd->ejecutar($sql);
				if($bd->totalRegistros($resultado) > 0){ 
					while($fila = $bd->obtener_fila($resultado)){
						//Eliminamos el fichero del servidor
						if($fila['hoja_inventario'] != ""){ 
							if(!$objFtp->delete(SRV_DIR_UPLOAD_PUB.$fila['hoja_inventario'], false)){
								$error .= "La hoja de inventario no se ha eliminado<br>";
							}
						}
					}//end while
				}//if resultado
				$objFtp->disconnect();
				$sql = "DELETE FROM pub_modelo_hoja WHERE id=".$id;
				$resultado = $bd->ejecutar($sql);
				if($bd->totalAfectados() == 0) $error.="Error al eliminar de la Base de datos la plantillas";
				
				$bd->desconectar();		
			}// end else !$objFtp ->login			
		} //if $objFtp !== false
		else{
			$error = "<div class='alert alert-danger' role='alert'>Error al conectar con el servidor. No se ha eliminado el 
				incentivo. Si el problema persiste, por favor, póngase en contacto con el Administrador</div>";	
		} // end else $objFtp !== false
		//}// if doc != none
		
		return $error;
	}

?>