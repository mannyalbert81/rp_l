$(document).ready(function(){
	
	ConsultaDocumentosGenerados();

})

function ConsultaDocumentosGenerados(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){/*$("#divLoaderPage").addClass("loader")*/},
		url:"index.php?controller=DocumentosGenerados&action=ConsultaDocumentosGenerados",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		console.log(datos);
		$("#documentos_generados_registrados_tbl").html(datos);		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		//$("#divLoaderPage").removeClass("loader")
		
	})
	
}


$("#id_documentos_generados").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})