<?php
	
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	session_start();
	set_include_path(implode(PATH_SEPARATOR, array(
        realpath(dirname(__FILE__) . '../lib/phpseclib'),
        get_include_path(),
	)));
	//include('Net/SFTP.php');
	include('../lib/Db.php');
	include('../lib/Conf.class.php');
	header("Content-Type: text/html;charset=utf-8");	
	
	  //Conexion a la base de datos
	  $bd = Db::getInstance();
	  
	  $select = "SELECT * FROM pub_anho order by id DESC limit 5";
	  $c = $bd->ejecutar($select);
	  while($row = $bd->obtener_fila($c, MYSQLI_ASSOC)){
		//echo $row['id_anho']." ".$row['id_incentivo']." ".$row['Hoja_inventario']."<br/>";
		$anhos[$row['id']]=$row['anho'];
		$id_anhos[]=$row['id'];
	}
	  
	  $select = "SELECT * FROM pub_incentivo";
	  $c = $bd->ejecutar($select);
	  while($row = $bd->obtener_fila($c, MYSQLI_ASSOC)){
		
		$incentivos[$row['id']]=$row['Incentivo'];
		$id_incentivos[]=$row['id'];
	  }
	
	  $select = "SELECT * FROM pub_incentivo_anho";
	
	$c = $bd->ejecutar($select);
	while($row = $bd->obtener_fila($c, MYSQLI_ASSOC)){
		//echo $row['id_anho']." ".$row['id_incentivo']." ".$row['Hoja_inventario']."<br/>";
		$tabla[$row['id_anho']][$row['id_incentivo']]=$row['Hoja_inventario'];
	}
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
		window.location.href = "subidaHoja.php";
	}
	
	$(document).ready(function(){
		
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
				<br/><br/>
				<table border='0' id='TableLogo' class='stripe hover'>
				<thead>
				<tr>
				<th width='150'><b>Incentivo</b></th>
				<?php for($z=0;$z<count($id_anhos);$z++){  ?>
				<th width='50'><b><?php echo $anhos[$id_anhos[$z]]; ?></b></th>
				<?php } ?>
				</tr>
				</thead>
				<tbody>
				<?php 
					for($i=0;$i<count($id_incentivos);$i++){
				echo '<tr>';
					echo "<td width='50'>".$incentivos[$id_incentivos[$i]]."</td>";
					
					for($j=0; $j<count($id_anhos);$j++){
						$celda = ($tabla[$id_anhos[$j]][$id_incentivos[$i]] != "")? "<a target='_blank' href='".SRV_DIR_DOWNLOAD_PUB.$tabla[$id_anhos[$j]][$id_incentivos[$i]]."'>Descargar</a>" : "--";
						echo "<td width='50'>".$celda."</td>";
					}
				echo '</tr>';
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
?>