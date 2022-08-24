function editar_modificacion(idm, idp, idc){
	//window.location.href = "edit_documentacion.php?idp="+idp+"&idc="+idc+"&idd="+idd;
	$.get('ajax/DatosJSON.php?info=MODIFICACION&id='+idm,function(resp){
		
		$('#tituloMod').text('Editar Modificacion');
		$('#observacionMOD').val(resp.observacion);
		$('#idMod').val(idm);
		$('#actionMod').val('edit');
		//Añadir el link con el documento si lo tiene.
		if(resp.solicitud!=""){
			$('#hrefSolMod').attr("href", "/docs/"+idc+"/"+idp+"/m/"+resp.solicitud);
			$('#solMod').val(resp.solicitud);
			$('#todoChbSol').show();
			$('#chb_sol').show();
			$('#hrefSolMod').show();
			$("#solicitud").attr('disabled',true);
			$('#hrefSolMod').text('Solicitud asignada');
			$('#textChx_sol').text('Solo si desea modificarla, active la casilla.');
		}else{
			$('#chb_sol').hide();
			$('#hrefSolMod').text('');
			$('#textChx_sol').text('');
			$('#hrefSolMod').hide();
			$('#todoChbRes').hide();
		}
		if(resp.resolucion!=""){
			$('#hrefResMod').attr("href", "/docs/"+idc+"/"+idp+"/m/"+resp.resolucion);
			$('#resMod').val(resp.resolucion);
			//$('#chb_res').show();
			//$('#hrefResMod').show();
			$("#resolucion").attr('disabled',true);
			$('#hrefResMod').text('Resolucion asignada');
			$('#textChx_res').text('Solo si desea modificarla, active la casilla.');
			$('#todoChbRes').show();
		}else{
			$('#chb_res').hide();
			$('#hrefResMod').text('');
			$('#textChx_res').text('');
			$('#hrefResMod').hide();
			$('#todoChbRes').hide();
		}
		$('#addModificacion').modal('show');
	});
}

function editar_documentacion(idd, idp, idc){
	//window.location.href = "edit_documentacion.php?idp="+idp+"&idc="+idc+"&idd="+idd;
	$.get('ajax/DatosJSON.php?info=DOCUMENTACION&id='+idd,function(resp){
		
		$('#tituloDoc').text('Editar Documento');
		$('#tipoDoc').val(resp.id_tipo_documento);
		$('#observacionDOC').val(resp.observaciones);
		$('#idDoc').val(idd);
		$('#actionDoc').val('edit');
		$('#fechaJusDoc').val(resp.subida);
		if(resp.ruta!=""){
			$('#hrefDoc').attr("href", "/docs/"+idc+"/"+idp+"/d/"+resp.ruta);
			$('#fileDoc').val(resp.ruta);
			$('#chb_doc').show();
			$('#hrefDoc').show();
			$('#todoChbDoc').show();
			$("#documentacion").attr('disabled',true);
			$('#hrefDoc').text('Documentacion asignada');
			$('#textChx_doc').text('Solo si desea modificarla, active la casilla.');
		}else{
			$('#chb_doc').hide();
			$('#hrefDoc').text('');
			$('#textChx_doc').text('');
			$('#hrefDoc').hide();
			$('#todoChbDoc').hide();
		}
		
		$('#addDocumentacion').modal('show');
	});
}

function editar_factura(idf, idp, idc){
	//window.location.href = "edit_documentacion.php?idp="+idp+"&idc="+idc+"&idd="+idd;
	$.get('ajax/DatosJSON.php?info=FACTURA&id='+idf,function(resp){
		
		$('#tituloFac').text('Editar Factura');
		$('#tipoFac').val(resp.id_tipo_documento);
		$('#observacionFAC').val(resp.observaciones);
		$('#idFac').val(idf);
		$('#fechaJusFac').val(resp.subida);
		$('#actionFac').val('edit');
		//Añadir el link con el documento si lo tiene.
		if(resp.factura!=""){
			$('#hrefFacFac').attr("href", "/docs/"+idc+"/"+idp+"/f/"+resp.factura);
			$('#facFac').val(resp.factura);
			$('#chb_fac').show();
			$('#hrefFacFac').show();
			$("#factura").attr('disabled',true);
			$('#hrefFacFac').text('Factura asignada');
			$('#textChx_fac').text('Solo si desea modificarla, active la casilla.');
			$('#todoChbFac').show();
		}else{
			$('#chb_fac').hide();
			$('#hrefFacFac').text('');
			$('#textChx_fac').text('');
			$('#hrefFacFac').hide();
			$('#todoChbFac').hide();
		}
		if(resp.acreditacion_pago!=""){
			$('#hrefAcpFac').attr("href", "/docs/"+idc+"/"+idp+"/f/"+resp.acreditacion_pago);
			$('#acpFac').val(resp.acreditacion_pago);
			$('#chb_acp').show();
			$('#hrefAcpFac').show();
			$("#acreditacion_pago").attr('disabled',true);
			$('#hrefAcpFac').text('Pago asignado');
			$('#textChx_acp').text('Solo si desea modificarla, active la casilla.');
			$('#todoChbAcp').show();
		}else{
			$('#chb_acp').hide();
			$('#hrefAcpFac').text('');
			$('#textChx_acp').text('');
			$('#hrefAcpFac').hide();
			$('#todoChbAcp').hide();
		}
		$('#addFactura').modal('show');
	});
}

function editar_inventario(idi, idp, idc){
	//window.location.href = "edit_documentacion.php?idp="+idp+"&idc="+idc+"&idd="+idd;
	$.get('ajax/DatosJSON.php?info=INVENTARIO&id='+idi,function(resp){
		
		$('#tituloInv').text('Editar Inventario');
		$('#tipoInv').val(resp.id_tipo_documento);
		$('#observacionINV').val(resp.observaciones);
		$('#fechaJusInv').val(resp.subida);
		if(resp.imagen!=""){
			$('#hrefImgInv').attr("href", "/docs/"+idc+"/"+idp+"/i/"+resp.imagen);
			$('#imgInv').val(resp.imagen);
			$('#chb_img').show();
			$('#hrefImgInv').show();
			$('#todoChbInv').show();
			$("#imagen").attr('disabled',true);
			$('#hrefImgInv').text('Imagen asignada');
			$('#textChx_img').text('Solo si desea modificarla, active la casilla.');
		}else{
			$('#chb_img').hide();
			$('#hrefImgInv').text('');
			$('#textChx_img').text('');
			$('#hrefImgInv').hide();
			$('#todoChbInv').hide();
		}
		$('#idInv').val(idi);
		$('#actionInv').val('edit');
		//Añadir el link con el documento si lo tiene.
		$('#addDocumentacion').modal('show');
	});

}

function editar_auditoria(ida, idp, idc){
	//window.location.href = "edit_documentacion.php?idp="+idp+"&idc="+idc+"&idd="+idd;
	$.get('ajax/DatosJSON.php?info=AUDITORIA&id='+ida,function(resp){
		
		$('#tituloAud').text('Editar Auditoria');
		$('#observacionAUD').val(resp.observacion);
		$('#idAud').val(ida);
		$('#actionAud').val('edit');
		//Añadir el link con el documento si lo tiene.
		if(resp.auditor!=""){
			$('#hrefAudAud').attr("href", "/docs/"+idc+"/"+idp+"/a/"+resp.auditor);
			$('#audAud').val(resp.auditor);
			$('#todoChbAud').show();
			$('#chb_aud').show();
			$('#hrefAudAud').show();
			$("#auditor").attr('disabled',true);
			$('#hrefAudAud').text('Auditor asignado');
			$('#textChx_aud').text('Solo si desea modificarla, active la casilla.');
		}else{
			$('#chb_aud').hide();
			$('#hrefAudAud').text('');
			$('#textChx_aud').text('');
			$('#hrefAudAud').hide();
			$('#todoChbAud').hide();
		}
		if(resp.doc_aportados!=""){
			$('#hrefDApAud').attr("href", "/docs/"+idc+"/"+idp+"/a/"+resp.doc_aportados);
			$('#dapAud').val(resp.doc_aportados);
			//$('#chb_res').show();
			//$('#hrefResMod').show();
			$("#doc_aportados").attr('disabled',true);
			$('#hrefDApAud').text('Documentos Aportados asignados');
			$('#textChx_dap').text('Solo si desea modificarla, active la casilla.');
			$('#todoChbDAp').show();
		}else{
			$('#chb_dap').hide();
			$('#hrefDApAud').text('');
			$('#textChx_dap').text('');
			$('#hrefDApAud').hide();
			$('#todoChbDAp').hide();
		}
		if(resp.inf_final!=""){
			$('#hrefInFAud').attr("href", "/docs/"+idc+"/"+idp+"/a/"+resp.inf_final);
			$('#infAud').val(resp.inf_final);
			$('#todoChbInF').show();
			$('#chb_inf').show();
			$('#hrefInFAud').show();
			$("#inf_final").attr('disabled',true);
			$('#hrefInFAud').text('Informe Final asignado');
			$('#textChx_inf').text('Solo si desea modificarla, active la casilla.');
		}else{
			$('#chb_inf').hide();
			$('#hrefInFAud').text('');
			$('#textChx_inf').text('');
			$('#hrefInFAud').hide();
			$('#todoChbInF').hide();
		}
		$('#addAuditoria').modal('show');
	});
}

function editar_justificacion(idj, idp, idc){
	
	$.get('ajax/DatosJSON.php?info=JUSTIFICACION&id='+idj,function(resp){
		
		$('#tituloJus').text('Editar Justificacion');
		$('#n_solicitud').val(resp.n_solicitud);
		$('#fechaJus').val(resp.fecha);
		$('#observacionJUS').val(resp.observaciones);
		$('#idJus').val(idj);
		$('#actionJus').val('edit');
		//Añadir el link con el documento si lo tiene.
		if(resp.documento!=""){
			$('#hrefDocJus').attr("href", "/docs/"+idc+"/"+idp+"/j/"+resp.documento);
			$('#docJus').val(resp.documento);
			$('#todoChbJus').show();
			$('#chb_jus').show();
			$('#hrefDocJus').show();
			$("#documentacionJus").attr('disabled',true);
			$('#hrefDocJus').text('Documentacion asignada');
			$('#textChx_jus').text('Solo si desea modificarla, active la casilla.');
		}else{
			$('#chb_jus').hide();
			$('#hrefDocJus').text('');
			$('#textChx_jus').text('');
			$('#hrefDocJus').hide();
			$('#todoChbJus').hide();
		}
		$('#addJustificacion').modal('show');
	});
}

function editar_reintegro(idr, idp, idc){
	//window.location.href = "edit_documentacion.php?idp="+idp+"&idc="+idc+"&idd="+idd;
	$.get('ajax/DatosJSON.php?info=REINTEGRO&id='+idr,function(resp){
		
		$('#tituloRei').text('Editar Reintegro');
		$('#observacionREI').val(resp.observaciones);
		$('#idRei').val(idr);
		$('#actionRei').val('edit');
		//Añadir el link con el documento si lo tiene.
		if(resp.solicitud!=""){
			$('#hrefSolRei').attr("href", "/docs/"+idc+"/"+idp+"/j/"+resp.solicitud);
			$('#solRei').val(resp.solicitud);
			$('#chb_sor').show();
			$('#hrefSolRei').show();
			$("#solicitudRei").attr('disabled',true);
			$('#hrefSolRei').text('Solicitud asignada');
			$('#textChx_sor').text('Solo si desea modificarla, active la casilla.');
			$('#todoChbSoR').show();
		}else{
			$('#chb_sor').hide();
			$('#hrefSolRei').text('');
			$('#textChx_sor').text('');
			$('#hrefSolRei').hide();
			$('#todoChbSoR').hide();
		}
		if(resp.pago!=""){
			$('#hrefPagRei').attr("href", "/docs/"+idc+"/"+idp+"/j/"+resp.pago);
			$('#pagRei').val(resp.pago);
			$('#chb_par').show();
			$('#hrefPagRei').show();
			$("#pagoRei").attr('disabled',true);
			$('#hrefPagRei').text('Pago asignado');
			$('#textChx_par').text('Solo si desea modificarla, active la casilla.');
			$('#todoChbPaR').show();
		}else{
			$('#chb_par').hide();
			$('#hrefPagRei').text('');
			$('#textChx_par').text('');
			$('#hrefPagRei').hide();
			$('#todoChbPaR').hide();
		}
		$('#addReintegro').modal('show');
	});
}

function eliminar_modificacion(idm, idp, idc){
		if(confirm("¿Está seguro de que desea eliminar la modificacion ("+idm+")?") == true)   
			window.location.href = "eliminar.php?idm="+idm+"&idp="+idp+"&idc="+idc+"&resource=mod";
}

function eliminar_documentacion(idd, idp, idc){
		if(confirm("¿Está seguro de que desea eliminar la documentacion ("+idd+")?") == true)   
			window.location.href = "eliminar.php?idd="+idd+"&idp="+idp+"&idc="+idc+"&resource=doc";
}

function eliminar_factura(idf, idp, idc){
		if(confirm("¿Está seguro de que desea eliminar la factura ("+idf+")?") == true)   
			window.location.href = "eliminar.php?idf="+idf+"&idp="+idp+"&idc="+idc+"&resource=fac";
}

function eliminar_inventario(idi, idp, idc){
		if(confirm("¿Está seguro de que desea eliminar el elemento de inventario ("+idi+")?") == true)   
			window.location.href = "eliminar.php?idi="+idi+"&idp="+idp+"&idc="+idc+"&resource=inv";
}

function eliminar_auditoria(ida, idp, idc){
		if(confirm("¿Está seguro de que desea eliminar la auditoria ("+ida+")?") == true)   
			window.location.href = "eliminar.php?ida="+ida+"&idp="+idp+"&idc="+idc+"&resource=aud";
}

function eliminar_justificacion(idj, idp, idc){
		if(confirm("¿Está seguro de que desea eliminar la justificacion documental ("+idj+")?") == true)   
			window.location.href = "eliminar.php?idj="+idj+"&idp="+idp+"&idc="+idc+"&resource=jus";
}

function eliminar_reintegro(idr, idp, idc){
		if(confirm("¿Está seguro de que desea eliminar el reintegro ("+idr+")?") == true)   
			window.location.href = "eliminar.php?idr="+idr+"&idp="+idp+"&idc="+idc+"&resource=rei";
}

function AddModificacion(){
	$('#tituloMod').text('Añadir Modificacion');
	$('#actionMod').val('add');
	$("#solicitud").attr('disabled',false);
	$("#resolucion").attr('disabled',false);
	///////////////
	//$('#chb_sol').hide();
	//$('#hrefSolMod').text('');
	//$('#textChx_sol').text('');
	//$('#hrefSolMod').hide();
	//$('#textChx_sol').hide();
	$('#todoChbSol').hide();
	////////////////////
	//$('#chb_res').hide();
	//$('#hrefResMod').text('');
	//$('#textChx_res').text('');
	//$('#hrefResMod').hide();
	//$('#textChx_res').hide();
	$('#todoChbRes').hide();
	/////////////////////
	$('#addModificacion').modal('show');
}

function CerrarModificacion(){
	$('#addModificacion').modal('hide');
	$('#form-modificacion')[0].reset();
	//$('#tab2').class
}

function AddDocumentacion(){
	$('#tituloDoc').text('Añadir Documentacion');
	$('#actionDoc').val('add');
	$('#chb_doc').hide();
	$('#hrefDoc').text('');
	$('#textChx_doc').text('');
	$('#hrefDoc').hide();
	$('#todoChbDoc').hide();
	$('#addDocumentacion').modal('show');
}

function CerrarDocumentacion(){
	$('#addDocumentacion').modal('hide');
	$('#form-documentacion')[0].reset();
}

function AddFactura(){
	$('#tituloFac').text('Añadir Factura');
	$('#actionFac').val('add');
	///////////////
	$('#chb_fac').hide();
	$('#hrefFacFac').text('');
	$('#textChx_fac').text('');
	$('#hrefFacFac').hide();
	$('#todoChbFac').hide();
	////////////////////
	$('#chb_acp').hide();
	$('#hrefAcpFac').text('');
	$('#textChx_acp').text('');
	$('#hrefAcpFac').hide();
	$('#todoChbAcp').hide();
	/////////////////////
	$('#addFactura').modal('show');
}

function CerrarFactura(){
	$('#addFactura').modal('hide');
	$('#form-factura')[0].reset();
}

function AddInventario(){
	$('#tituloInv').text('Añadir Inventario');
	$('#actionInv').val('add');
	$('#chb_img').hide();
	$('#hrefImgInv').text('');
	$('#textChx_img').text('');
	$('#hrefImgInv').hide();
	$('#todoChbInv').hide();
	$('#addInventario').modal('show');
}

function CerrarInventario(){
	$('#addInventario').modal('hide');
	$('#form-inventario')[0].reset();
}

function AddAuditoria(){
	$('#tituloAud').text('Añadir Auditoria');
	$('#actionAud').val('add');
	$('#chb_aud').hide();
	$('#chb_dap').hide();
	$('#chb_inf').hide();
	$('#hrefImgInv').text('');
	$('#textChx_img').text('');
	$('#hrefImgInv').hide();
	$('#todoChbAud').hide();
	$('#todoChbDAp').hide();
	$('#todoChbInF').hide();
	$('#addAuditoria').modal('show');
}

function CerrarAuditoria(){
	$('#addAuditoria').modal('hide');
	$('#form-auditoria')[0].reset();
}

function AddJustificacion(){
	$('#tituloJus').text('Añadir Justificacion');
	$('#actionJus').val('add');
	//$('#chb_aud').hide();
	//$('#hrefImgInv').text('');
	//$('#textChx_img').text('');
	//$('#hrefImgInv').hide();
	$('#todoChbJus').hide();
	$('#addJustificacion').modal('show');
}

function CerrarJustificacion(){
	$('#addJustificacion').modal('hide');
	$('#form-justificacion')[0].reset();
}

function AddReintegro(){
	$('#tituloRei').text('Añadir Justificacion');
	$('#actionRei').val('add');
	//$('#chb_aud').hide();
	//$('#hrefImgInv').text('');
	//$('#textChx_img').text('');
	//$('#hrefImgInv').hide();
	$('#todoChbSoR').hide();
	$('#todoChbPaR').hide();
	$('#addReintegro').modal('show');
}

function CerrarReintegro(){
	$('#addReintegro').modal('hide');
	$('#form-reintegro')[0].reset();
}

$(function() {

	var chb_a = $("#chb_a");
	
	//Checkbox de la adjudicacion
	
	chb_a.on('click', function(){
		if ( chb_a.is(':checked') ) {
			$("#adjudicacion").attr('disabled',false);
		}
		else{
			$("#adjudicacion").attr('disabled',true);
		}
	});
	
	var chb_se = $("#chb_se");
	
	//Checkbox del seguimiento
	
	chb_se.on('click', function(){
		if ( chb_se.is(':checked') ) {
			$("#seguimiento").attr('disabled',false);
		}
		else{
			$("#seguimiento").attr('disabled',true);
		}
	});
	
	var chb_img = $("#chb_img");
	
	//Checkbox de la imagen del inventario
	
	chb_img.on('click', function(){
		if ( chb_img.is(':checked') ) {
			$("#imagen").attr('disabled',false);
		}
		else{
			$("#imagen").attr('disabled',true);
		}
	});
	
	var chb_doc = $("#chb_doc");
	
	//Checkbox de la documentacion del proyecto
	
	chb_doc.on('click', function(){
		if ( chb_doc.is(':checked') ) {
			$("#documentacion").attr('disabled',false);
		}
		else{
			$("#documentacion").attr('disabled',true);
		}
	});
	
	var chb_fac = $("#chb_fac");
	
	//Checkbox de la factura del proyecto
	
	chb_fac.on('click', function(){
		if ( chb_fac.is(':checked') ) {
			$("#factura").attr('disabled',false);
		}
		else{
			$("#factura").attr('disabled',true);
		}
	});
	
	var chb_acp = $("#chb_acp");
	
	//Checkbox de la acreditacion de pago de la factura del proyecto
	
	chb_acp.on('click', function(){
		if ( chb_acp.is(':checked') ) {
			$("#acreditacion_pago").attr('disabled',false);
		}
		else{
			$("#acreditacion_pago").attr('disabled',true);
		}
	});
	
	var chb_sol = $("#chb_sol");
	//Checkbox de la solicitud de modificacion del proyecto
	
	chb_sol.on('click', function(){
		if ( chb_sol.is(':checked') ) {
			$("#solicitud").attr('disabled',false);
		}
		else{
			$("#solicitud").attr('disabled',true);
		}
	});
	
	var chb_res = $("#chb_res");
	
	//Checkbox de la resolucion de modificacion del proyecto
	
	chb_res.on('click', function(){
		if ( chb_res.is(':checked') ) {
			$("#resolucion").attr('disabled',false);
		}
		else{
			$("#resolucion").attr('disabled',true);
		}
	});
	
	var chb_aud = $("#chb_aud");
	
	//Checkbox del auditor del proyecto
	
	chb_aud.on('click', function(){
		if ( chb_aud.is(':checked') ) {
			$("#auditor").attr('disabled',false);
		}
		else{
			$("#auditor").attr('disabled',true);
		}
	});
	
	var chb_dap = $("#chb_dap");
	
	//Checkbox de la acreditacion de pago de la factura del proyecto
	
	chb_dap.on('click', function(){
		if ( chb_dap.is(':checked') ) {
			$("#doc_aportados").attr('disabled',false);
		}
		else{
			$("#doc_aportados").attr('disabled',true);
		}
	});
	
	var chb_inf = $("#chb_inf");
	
	//Checkbox del informe final de auditoria del proyecto
	
	chb_inf.on('click', function(){
		if ( chb_inf.is(':checked') ) {
			$("#inf_final").attr('disabled',false);
		}
		else{
			$("#inf_final").attr('disabled',true);
		}
	});
	
	
	var chb_jus = $("#chb_jus");
	
	//Checkbox del documento de justificacion
	
	chb_jus.on('click', function(){
		if ( chb_jus.is(':checked') ) {
			$("#documentacionJus").attr('disabled',false);
		}
		else{
			$("#documentacionJus").attr('disabled',true);
		}
	});
	
	var chb_sor = $("#chb_sor");
	
	//Checkbox de la solicitud de reintegro
	
	chb_sor.on('click', function(){
		if ( chb_sor.is(':checked') ) {
			$("#solicitudRei").attr('disabled',false);
		}
		else{
			$("#solicitudRei").attr('disabled',true);
		}
	});
	
	var chb_par = $("#chb_par");
	
	//Checkbox del pago de reintegro
	
	chb_par.on('click', function(){
		if ( chb_par.is(':checked') ) {
			$("#pagoRei").attr('disabled',false);
		}
		else{
			$("#pagoRei").attr('disabled',true);
		}
	});
	
	
	$('#TableA').DataTable({ 
				
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
	
	$('#TableM').DataTable({ 
				
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
	
	$('#TableDoc').DataTable({ 
				
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
	
	$('#TableF').DataTable({ 
				
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
	
	$('#TableI').DataTable({ 
				
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
	
	$('#TableJ').DataTable({ 
				
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
	
	$('#TableR').DataTable({ 
				
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
	
		   // Remove accented character from search input as well
      $('#myInput').keyup( function () {
        table
          .search(
            jQuery.fn.DataTable.ext.type.search.string( this.value )
          )
          .draw()
      } );
	
});