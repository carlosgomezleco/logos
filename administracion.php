<?php
		
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	session_start();
	set_include_path(implode(PATH_SEPARATOR, array(
        realpath('../lib/phpseclib'),
        get_include_path(),
	)));
	require('../lib/phpseclib/Net/SFTP.php');	
	include('../lib/Db.php');
	include('../lib/Conf.class.php');
	include('../lib/config.php');
	//include('lib/funciones.php');
	//incluimos el formulario de la plantilla aquí ya que se llama desde dos pestañas y de otra forma no carga correctamente.
	include ('add_hoja.php');
	
	header("Content-Type: text/html;charset=utf-8");
	
	//Inicialización de las pestañas, para que cuando se haga post a este fichero se vaya a la pestaña desde donde se llamó
	if(!isset($_SESSION['tab'])){
		$_SESSION['tab']=1;
	}
	
	  
?>

<html>  
<head>
	<title>Publicidad</title>        
	<meta http-equiv="Content-Type" content="text/html; charset=charset=utf-8" />
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->	
	<script src="js/jquery-1.11.2.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/admin.js"></script>
	<script src="js/jquery.datetables.min.js"></script>
	
	<link rel="stylesheet" href="css/styles.css"/>
	<link rel="stylesheet" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" media="screen" />

	
</head>	
<body>
	<div class="style-container">
		<?php
			include('resources/header.php');
		?>
	
		<section id="main">
			<article>				
				
			   <?php	
			   //menú
			   include('resources/menu.php');
			   //Fin menú
			 //Si estan definidas, hemos realizado el login correctamente 
			 if(isset($_SESSION['user']) and isset($_SESSION['pass'])){ ?>
				<!-- Breadcumbs -->
				<div id="id1">
				<ol class="breadcrumb">
					<li class="active">Inicio</li>
					<li>Administracion</li>
				</ol>
				</div>
				<!-- Fin breadcrumbs -->
				<div id="clear"></div>
<?php 
				//Comprobamos si se ha enviado el formulario mediante el botón guardar
				if($_SERVER["REQUEST_METHOD"] == "POST"){ 
					
					//echo "<p>post hoja es ".$_POST['hoja']."</p>";
					
					if(isset($_POST['incentivo'])){ //echo "<p>post incentivo</p>";
						//procesamiento del incentivo con post incentivo al detectar que el formulario de incentivo es el que se ha enviado
						include('post_incentivo.php');
						$_SESSION['pest']=1;
					}else if(isset($_POST['hoja']) and $_POST['hoja']=="hoja"){  
						//procesamiento de la plantilla con post_hoja al detectar que el formulario de plantilla es el que se ha enviado
						include('post_hoja.php');
						//si el valor archivado es 0 quiere decir que no se ha archivado la plantilla y la pestña correcta es plantillas
						//si el valor archivado es 1 quiere decir que se ha archivado la plantilla y la pestña activa es plantillas archivadas
						if(isset($_POST['archivado']) and $_POST['archivado']==0){ //echo "<p>post hoja es tipo</p>";
							$_SESSION['pest']=2;
						}else if(isset($_POST['archivado']) and $_POST['archivado']==1){ //echo "<p>post hoja es tipo else</p>";
							$_SESSION['pest']=3;
						}
						
					}else if (isset($_POST['documento'])){ //echo "<p>post hoja es documento</p>";
						//procesamiento del documento con post_documento al detectar que el formulatio de documentacion es el que se ha enviado
						include('post_documento.php');
						//si el valor del tipo es 0 quiere decir que es un Diario Oficial el archivo que se etá tratando y Diarios Oficiales es la pestaña correcta.
						//si el valor del tipo es 1 quiere decir que es una Normativa el archivo que se etá tratando y Normatica es la pestaña correcta.
						if(isset($_POST['tipo']) and $_POST['tipo']==0){ 
							$_SESSION['pest']=4;
						}else if(isset($_POST['tipo']) and $_POST['tipo']==1){ 
							$_SESSION['pest']=5;
						}
					}else if (isset($_POST['investigadores'])){
						//Si el post contiene investigadores quiere decir que se ha pulsado el botón refrescar de dicha pestaña que es la número 6
						$_SESSION['pest']=6;
					}
					
				} 
				?>				
				<div id="container-table">
							<ul class="nav nav-tabs">
								<li <?php if((isset($_SESSION['pest']) and $_SESSION['pest']==1) or (!isset($_SESSION['pest'])) ) {
									echo ' class="active" '; 
								} ?> ><a href="#tab1" data-toggle="tab">Incentivos</a></li>
								<li <?php if((isset($_SESSION['pest']) and $_SESSION['pest']==2)){ 
									echo ' class="active" '; 
								}?> ><a href="#tab2" data-toggle="tab">Plantillas</a></li>
								<li <?php if((isset($_SESSION['pest']) and $_SESSION['pest']==3)){ 
									echo ' class="active" '; 
								}?> ><a href="#tab3" data-toggle="tab">Plantillas Archivadas</a></li>
								<li  <?php if((isset($_SESSION['pest']) and $_SESSION['pest']==4)){ 
									echo ' class="active" '; 
								}?>><a href="#tab4" data-toggle="tab">Diarios Oficiales</a></li>
								<li  <?php if((isset($_SESSION['pest']) and $_SESSION['pest']==5)){ 
									echo ' class="active" '; 
								}?>><a href="#tab5" data-toggle="tab">Normativa</a></li>
								<li  <?php if((isset($_SESSION['pest']) and $_SESSION['pest']==6)){ 
									echo ' class="active" '; 
								}?>><a href="#tab6" data-toggle="tab">Hojas</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane<?php if((isset($_SESSION['pest']) and $_SESSION['pest']==1) or (!isset($_SESSION['pest'])) ) echo ' active'; ?>" 
									id="tab1">
									<!--p>Aquí irá la lista con los incentivos creados</p-->
									<?php include('incentivos.php'); ?>
									
								</div>
								<div class="tab-pane<?php if((isset($_SESSION['pest']) and $_SESSION['pest']==2)) echo ' active'; ?>" id="tab2">
									<!-- Lista con las plantillas activas-->
									<?php include('hojas.php'); ?>
									
								</div>
								<div class="tab-pane<?php if((isset($_SESSION['pest']) and $_SESSION['pest']==3)) echo ' active'; ?>" id="tab3">
									<!-- Lista con las plantillas archivadas-->
									<?php include('hojas_archivadas.php'); ?>
									
								</div>
								<div class="tab-pane<?php if((isset($_SESSION['pest']) and $_SESSION['pest']==4)) echo ' active'; ?>" id="tab4">
									<!-- Lista con los diarios oficiales -->
									<?php include('diarios_oficiales.php'); ?>
									
								</div>
								<div class="tab-pane<?php if((isset($_SESSION['pest']) and $_SESSION['pest']==5)) echo ' active'; ?>" id="tab5">
									<!-- Lista con las normativas-->
									<?php include('normativa.php'); ?>
									
								</div>
								<div class="tab-pane<?php if((isset($_SESSION['pest']) and $_SESSION['pest']==6)) echo ' active'; ?>" id="tab6">
									<!-- Lista con las hojas de los investigadores-->
									<?php include('hojas_investigadores.php'); ?>
									
								</div>
							</div>
						<?php  //}  ?>
							<!--/div-->
				</div> <!-- div id="container-table"-->	
			<?php 
				}
				else{ 
					echo '<div id="error">Lo sentimos, pero no tiene permisos para acceder. <a href="index.php"><img src="img/volver.png" alt="Regresar al listado"/></a></div><br>';
				}
			?>
			<br>	
			</article>
		</section>
		<?php
			include('resources/footer.php');
		?>
	</div> <!-- Div container-->
    <div id="clear"><br></div>	
</body>
</html>