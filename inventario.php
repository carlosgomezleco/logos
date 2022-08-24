<?php
	
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	session_start();
	/*set_include_path(implode(PATH_SEPARATOR, array(
        realpath('../lib/phpseclib'),
        get_include_path(),
	)));
	include('../lib/Net/SFTP.php');*/
	include('../lib/Db.php');
	include('../lib/Conf.class.php');
	include('../lib/config.php');
	header("Content-Type: text/html;charset=utf-8");	

?>
<html>  
<head>
	<title>Tabla de logos</title>        
	<meta http-equiv="Content-Type" content="text/html; charset=charset=utf-8" />
	<script src="js/jquery-1.11.2.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<!--script src="js/editproyecto.js"></script-->
	<script src="js/jquery.datetables.min.js"></script>
	
	<link rel="stylesheet" href="css/styles.css"/>
	<link rel="stylesheet" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" media="screen" />
	<script type="text/javascript">
	function AddInvestigador(){
		$('#subirHoja').modal('show');
	}
	
	function CerrarInvestigador(){
		$('#subirHoja').modal('hide');
		$('#form-subida')[0].reset();

	}


	$(document).ready(function(){
		
		$('#hoja').change(function () {
				if(this.files[0].size > 2097152)
					alert('¡Atención! Revise el tamaño de la hoja (máximo 2MB).');
		});
		
		$('#foto').change(function () {
				if(this.files[0].size > 3145728)
					alert('¡Atención! Revise el tamaño de la foto (máximo 3MB).');
		});

		$('#TableLogo_filter').hide();
	$('#TableLogo').DataTable({ 
				
		stateSave: true, 
		
		
		"order": [[ 0, "desc" ]],
								
		"language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ (total _TOTAL_ registros)",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "", 
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},					 
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}						
	} );
	
	   // Remove accented character from search input as well
      $('#myInput').keyup( function () {
        table
          .search(
            jQuery.fn.DataTable.ext.type.search.string( this.value )
          )
          .draw()
      } );
	
});
	</script>
	
</head>	
<body>
	<div class="style-container">
		<?php
			include('resources/header.php');
		?>
		<section id="main">
			<article>
			<div id="container-table">
				<br/>
				<div class="col-lg-offset-5"><button id="btn_alta" name="btn_alta" class="btn btn-default"  onclick="AddInvestigador();">Subir Hoja Inventario</button></div>
				<br/>
				<?php
					if(isset($_SESSION['error_investigador']) and $_SESSION['error_investigador']!= ""){
						//echo para mostrar los posibles errores o el mensaje de hoja subida correctamente por los investigadores
						echo $_SESSION['error_investigador'];
					}
				?>
				<br/>
				<table border='0' id='TableLogo' class='stripe hover'>
				<thead>
				<tr>
				<th width='150'><b>Incentivo</b></th>
				<th width='50'><b>Hoja de inventario</b></th>
				</tr>
				</thead>
				<tbody>
				<?php 
				 //Conexion a la base de datos
				  $bd = Db::getInstance();
				  //Hacemos el select solo mostrando las plantillas que se encuentran activas, las que tienen el campo archivado igual a 0
				  $select = "SELECT m.hoja_inventario as hoja, i.Incentivo as inc FROM pub_modelo_hoja m inner join pub_incentivo i on (m.id_incentivo = i.id) WHERE m.archivado =0";
				  $c = $bd->ejecutar($select);
				  while($row = $bd->obtener_fila($c)){
					
					$hoja = ($row['hoja'] != "")? "<a target='_blank' href='".SRV_DIR_DOWNLOAD_PUB.$row['hoja']."'>Descargar</a>" : "--";
					echo "<tr>";
					echo "<td width='50'>".$row['inc']."</td>";
					echo "<td width='50'>".$hoja."</td>";
					echo "</tr>";
				  }
				?>
				</tbody>
				</table>
			</div>
			</article>
		</section>
		<?php
			include('resources/footer.php');
		?>
	</div> <!-- Div container-->
    <div id="clear"><br></div>	
</body>
</html> 
<?php
	//echo $tabla[1][1];
	include('subidaHoja.php');
?>