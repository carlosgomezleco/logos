<?php
	if(isset($_POST['actionInc']) and $_POST['actionInc']=='add'){
	
		$insertar = "INSERT INTO pub_incentivo (Incentivo) VALUES ('".$_POST['nom_incentivo']."')";
		if(!isset($bd) || $bd==null){
			$bd = Db::getInstance() ;
		}
		
		$resultado = $bd->ejecutar($insertar);
		//Si se ha insertado, muestra el listado
		if($bd->totalAfectados() != 1){						
			echo '<div style="width:94%;" class="alerta2 alert alert-danger">Ha ocurrido un error y el incentivo no se creado.</div>';
		}
		
		
	}else if(isset($_POST['actionInc']) and $_POST['actionInc']=='edit'){
		
		if(!isset($bd) || $bd==null){
			$bd = Db::getInstance();
		}
		
		$actualizar = "UPDATE pub_incentivo SET Incentivo='".$_POST['nom_incentivo']."' WHERE id = '".$_POST['idInc']."'";
		$resultado = $bd->ejecutar($actualizar);
		if($bd->totalAfectados() != 1){						
			echo '<div style="width:94%;" class="alerta2 alert alert-danger">Ha ocurrido un error y el incentivo no se ha actualizado.</div>';			
		}
	}
?>