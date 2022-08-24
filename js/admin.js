function AddIncentivo(){
	$('#tituloInc').text('Añadir Incentivo');
	$('#actionInc').val('add');
	$('#addIncentivo').modal('show');
}

function CerrarIncentivo(){
	$('#addIncentivo').modal('hide');
	$('#form-incentivo')[0].reset();
}

function editar_incentivo(idi){
	//window.location.href = "edit_documentacion.php?idp="+idp+"&idc="+idc+"&idd="+idd;
	$.get('lib/DatosJSON.php?info=INCENTIVO&id='+idi,function(resp){
		
		$('#tituloInc').text('Editar Incentivo');
		$('#nom_incentivo').val(resp.Incentivo);
		$('#idInc').val(idi);
		$('#actionInc').val('edit');
		$('#addIncentivo').modal('show');
	});
}

function eliminar_incentivo(idi){
	if(confirm("¿Está seguro de que desea eliminar el incentivo ("+idi+")?") == true)   
			window.location.href = "eliminar.php?id="+idi+"&resource=incentivo";
}

function AddPlantilla(){
		
	$('#tituloHoj').text('Añadir Plantilla');
	$('#actionHoj').val('add');
	$("#plant_hoja").removeAttr('disabled');
	$('#sincentivo').removeAttr('disabled');
	//Añadir el link con el documento si lo tiene.
	$('#noarchivado').attr('checked', true);
	$('#observ').hide();
	$('#textobserv').hide();
	$('#chb_hoj').hide();
	$('#hrefHoj').text('');
	$('#textChx_hoj').text('');
	$('#hrefHoj').hide();
	$('#todoChbHoj').hide();
	$('#addHoja').modal('show');
}

function editar_plantilla(idh){
	//window.location.href = "edit_documentacion.php?idp="+idp+"&idc="+idc+"&idd="+idd;
	$.get('lib/DatosJSON.php?info=HOJA&id='+idh,function(resp){
		
		$('#tituloHoj').text('Editar Plantilla');
		$('#idHoj').val(idh);
		$('#actionHoj').val('edit');
		$('#sincentivo').val(resp.id_incentivo);
		$('#sincentivo').attr('disabled', 'disabled');
		//Añadir el link con el documento si lo tiene.
		//Si archivado es igual a 0 la plantilla está activada y se ocultan las observaciones
		if(resp.archivado==0){
			//No archivado
			$('#noarchivado').attr('checked', true);
			$('#observ').hide();
			$('#textobserv').hide();
		}else{
			//archivado. Mostrar campo de observaciones
			$('#archivado').attr('checked', true);
			$('#observ').text(resp.observaciones);
			$('#observ').show();
			$('#textobserv').show();
		}
		/*Si hay un documento subido incluimos la referencia mostramos el checkbox para modificar y deshabilitamos el enlace de subida
		  en caso de que no haya habilitar el enlace de subida y ocultar el checkbox*/
		if(resp.hoja_inventario!=""){
			$('#hrefHoj').attr("href", "docs/"+resp.hoja_inventario);
			$('#hojaInv').val(resp.hoja_inventario);
			$('#chb_hoj').show();
			$('#hrefHoj').show();
			$('#plant_hoja').attr('disabled',true);
			$('#hrefHoj').text('Hoja asignada');
			$('#textChx_hoj').text('Solo si desea modificarla, active la casilla.');
			$('#todoChbHoj').show();
			
		}else{
			$('#chb_hoj').hide();
			$('#hrefHoj').text('');
			$('#textChx_hoj').text('');
			$('#hrefHoj').hide();
			$('#todoChbHoj').hide();
			$('#plant_hoja').attr('disabled',false);
		}
		$('#addHoja').modal('show');
	});
}

function eliminar_plantilla(idm){
	if(confirm("¿Está seguro de que desea eliminar la plantilla ("+idm+")?") == true)   
			window.location.href = "eliminar.php?id="+idm+"&resource=modelo";
}

function CerrarHoja(){
	$('#addHoja').modal('hide');
	$('#form-hoja')[0].reset();
}

function CerrarDocumento(){
	$('#addDocumento').modal('hide');
	$('#form-documento')[0].reset();
}

function AddDiario(){
	$('#tituloDoc').text('Añadir Diario');
	$('#tipo').val('0');
	$('#addDocumento').modal('show');
}

function AddNormativa(){
	$('#tituloDoc').text('Añadir Normativa');
	$('#tipo').val('1');
	$('#addNormativa').modal('show');
}

function CerrarNormativa(){
	$('#addNormativa').modal('hide');
	$('#form-documento')[0].reset();
}

function eliminar_inventario(id){
	if(confirm("¿Está seguro de que desea eliminar la hoja de inventario ("+id+")?") == true)   
			window.location.href = "eliminar.php?id="+id+"&resource=inventario";
}

$(function() {

	var chb_h = $("#chb_hoj");
	
	//Checkbox de la hoja de inventario para habilitar la subida si el check está seleccionado
	
	chb_h.on('click', function(){
		if ( chb_h.is(':checked') ) {
			$("#plant_hoja").removeAttr('disabled');;
		}
		else{
			$("#plant_hoja").attr('disabled','disabled');
		}
	});
	
	/*$('#archivado').change(function(){
		if($('#archivado').is(':checked')){
			
			$('#observ').show();
			$('#textobserv').show();
		}else{
			
			$('#observ').hide();
			$('#textobserv').hide();
		}
	});*/
	
	/*funcion change de radiobutton archivado si no está seleccionado archivado ocultamos observaciones
	  en caso de que esté seleccionado archivado mostrar las observaciones*/
	$('#radio_arch_no').change(function(){
		selected_value = $("input[name='archivado']:checked").val();
		if(selected_value==0){
			//no archivado
			$('#observ').hide();
			$('#textobserv').hide();
		}else{
			//archivado
			$('#observ').show();
			$('#textobserv').show();
		}
	});

	$('#TableInc').DataTable({ 
				
		stateSave: true, 
						
		"search": {
			"caseInsensitive": true,
		},
								
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
	
	
	$('#TableHoj').DataTable({ 
				
		stateSave: true, 
						
		"search": {
			"caseInsensitive": true,
		},
								
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
	} )
	
	$('#TableHojArch').DataTable({ 
				
		stateSave: true, 
						
		"search": {
			"caseInsensitive": true,
		},
								
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
	} )
	
	// Remove accented character from search input as well
      $('#myInput').keyup( function () {
        table
          .search(
            jQuery.fn.DataTable.ext.type.search.string( this.value )
          )
          .draw()
      } );
	
});