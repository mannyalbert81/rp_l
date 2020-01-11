$(document).ready(function(){
	
	ConsultaJuicios();
	CargaEtapaProcesal();
	CargaEstadoProcesal();
	
})

$("#frm_agregar_juicio").on("submit",function(event){
	
	
	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

	var $identificacion_clientes = $("#identificacion_clientes").val();
	var $nombre_clientes = $("#nombre_clientes").val();
	var $entidad_origen_juicios = $("#entidad_origen_juicios").val();
	var $regional_juicios = $("#regional_juicios").val();
	var $numero_juicios = $("#numero_juicios").val();
	var $anio_juicios = $("#anio_juicios").val();
	var $numero_titulo_credito_juicios = $("#numero_titulo_credito_juicios").val();
	var $fecha_titulo_credito_juicios = $("#fecha_titulo_credito_juicios").val();
	var $orden_cobro_juicios = $("#orden_cobro_juicios").val();
	var $fecha_oden_cobro_juicios = $("#fecha_oden_cobro_juicios").val();
	var $fecha_auto_pago_juicios = $("#fecha_auto_pago_juicios").val();
	var $cuantia_inicial_juicios = $("#cuantia_inicial_juicios").val();
	var $id_etapa_procesal = $("#id_etapa_procesal").val();
	var $id_estado_procesal = $("#id_estado_procesal").val();
	var $fecha_ultima_providencia_juicios = $("#fecha_ultima_providencia_juicios").val();
	var $fecha_vencimiento_juicios = $("#fecha_vencimiento_juicios").val();

	
	if( $identificacion_clientes == "" ){
		$("#identificacion_clientes").notify("Ingrese una Cédula",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if( $nombre_clientes == "" ){
		$("#nombre_clientes").notify("Ingrese un Nombre",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if( $entidad_origen_juicios == "" ){
		$("#entidad_origen_juicios").notify("Ingrese un Origen",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if( $regional_juicios == "" ){
		$("#regional_juicios").notify("Ingrese una Regional",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if( $numero_juicios == "" ){
		$("#numero_juicios").notify("Ingrese un Número",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if( $anio_juicios == "" ){
		$("#anio_juicios").notify("Ingrese un Año",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if( $numero_titulo_credito_juicios == "" ){
		$("#numero_titulo_credito_juicios").notify("Ingrese un Número",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if( $fecha_titulo_credito_juicios == "" ){
		$("#fecha_titulo_credito_juicios").notify("Ingrese una Fecha",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if( $orden_cobro_juicios == "" ){
		$("#orden_cobro_juicios").notify("Ingrese una Orden",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if( $fecha_oden_cobro_juicios == "" ){
		$("#fecha_oden_cobro_juicios").notify("Ingrese una Fecha",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if( $fecha_auto_pago_juicios == "" ){
		$("#fecha_auto_pago_juicios").notify("Ingrese una Fecha",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if( $cuantia_inicial_juicios == "" ){
		$("#cuantia_inicial_juicios").notify("Ingrese una Cantidad",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if( $id_etapa_procesal == 0 ){
		$("#id_etapa_procesal").notify("Selecione un Dato",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if( $id_estado_procesal == 0 ){
		$("#id_estado_procesal").notify("Selecione un Dato",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if( $fecha_ultima_providencia_juicios == "" ){
		$("#fecha_ultima_providencia_juicios").notify("Ingrese una Fecha",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if( $fecha_vencimiento_juicios == "" ){
		$("#fecha_vencimiento_juicios").notify("Ingrese una Fecha",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}

	
	let _identificacion_clientes = document.getElementById('identificacion_clientes').value;
	let _nombre_clientes = document.getElementById('nombre_clientes').value;
	let _entidad_origen_juicios = document.getElementById('entidad_origen_juicios').value;
	let _regional_juicios = document.getElementById('regional_juicios').value;
	let _numero_juicios = document.getElementById('numero_juicios').value;
	let _anio_juicios = document.getElementById('anio_juicios').value;
	let _numero_titulo_credito_juicios = document.getElementById('numero_titulo_credito_juicios').value;
	let _fecha_titulo_credito_juicios = document.getElementById('fecha_titulo_credito_juicios').value;
	let _orden_cobro_juicios = document.getElementById('orden_cobro_juicios').value;
	let _fecha_oden_cobro_juicios = document.getElementById('fecha_oden_cobro_juicios').value;
	let _fecha_auto_pago_juicios = document.getElementById('fecha_auto_pago_juicios').value;
	let _cuantia_inicial_juicios = document.getElementById('cuantia_inicial_juicios').value;
	let _id_etapa_procesal = document.getElementById('id_etapa_procesal').value;
	let _id_estado_procesal = document.getElementById('id_estado_procesal').value;
	let _fecha_ultima_providencia_juicios = document.getElementById('fecha_ultima_providencia_juicios').value;
	let _observaciones_juicios = document.getElementById('observaciones_juicios').value;
	let _fecha_vencimiento_juicios = document.getElementById('fecha_vencimiento_juicios').value;
	let _fecha_inicio_proceso_juicios = document.getElementById('fecha_inicio_proceso_juicios').value;
	
	
	var parametros = {identificacion_clientes:_identificacion_clientes,
			nombre_clientes:_nombre_clientes,
			entidad_origen_juicios:_entidad_origen_juicios,
			regional_juicios:_regional_juicios,
			numero_juicios:_numero_juicios,
			anio_juicios:_anio_juicios,
			numero_titulo_credito_juicios:_numero_titulo_credito_juicios,
			fecha_titulo_credito_juicios:_fecha_titulo_credito_juicios,
			orden_cobro_juicios:_orden_cobro_juicios,
			fecha_oden_cobro_juicios:_fecha_oden_cobro_juicios,
			fecha_auto_pago_juicios:_fecha_auto_pago_juicios,
			cuantia_inicial_juicios:_cuantia_inicial_juicios,
			id_etapa_procesal:_id_etapa_procesal,
			id_estado_procesal:_id_estado_procesal,
			fecha_ultima_providencia_juicios:_fecha_ultima_providencia_juicios,
			observaciones_juicios:_observaciones_juicios,
			fecha_vencimiento_juicios:_fecha_vencimiento_juicios,
			fecha_inicio_proceso_juicios:_fecha_inicio_proceso_juicios}
	
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=MatrizJuicios&action=AgregarJuicio",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		if (datos.respuesta == 2){
			
			swal({
		  		  title: "Juicios",
		  		  text: datos.mensaje,
		  		  icon: "success",
		  		  button: "Aceptar",
		  		});
		}
		
		else {
	swal({
  		  title: "Juicios",
  		  text: datos.mensaje,
  		  icon: "info",
  		  button: "Aceptar",
  		});
		}
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		document.getElementById("frm_agregar_juicio").reset();	
		ConsultaJuicios();
	})

	event.preventDefault()
})



function CargaEtapaProcesal(){
	
	let $ddlEtapaProcesal = $("#id_etapa_procesal");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=MatrizJuicios&action=CargaEtapaProcesal",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlEtapaProcesal.empty();
		$ddlEtapaProcesal.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlEtapaProcesal.append("<option value=\"" +value.id_etapa_procesal +"\">" + value.nombre_etapa_procesal  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlEtapaProcesal.empty();
	})
	
}


$("#nombre_etapa_procesal").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})

function CargaEstadoProcesal(){
	
	let $ddlEstadoProcesal = $("#id_estado_procesal");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=MatrizJuicios&action=CargaEstadoProcesal",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlEstadoProcesal.empty();
		$ddlEstadoProcesal.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlEstadoProcesal.append("<option value=\"" +value.id_estado_procesal +"\">" + value.nombre_estado_procesal  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlEstadoProcesal.empty();
	})
	
}


$("#nombre_estado_procesal").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})



function ConsultaJuicios(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=MatrizJuicios&action=ConsultaJuicios",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#juicios_registrados").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}


$("#nombre_juicios").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})

function editJuicios(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=MatrizJuicios&action=editJuicios",
		type:"POST",
		dataType:"json",
		data:{id_clientes:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			$("#identificacion_clientes").val(array.identificacion_clientes);			
			$("#nombre_clientes").val(array.nombre_clientes);
			$("#entidad_origen_juicios").val(array.entidad_origen_juicios);			
			$("#regional_juicios").val(array.regional_juicios);
			$("#numero_juicios").val(array.numero_juicios);			
			$("#anio_juicios").val(array.anio_juicios);
			$("#numero_titulo_credito_juicios").val(array.numero_titulo_credito_juicios);			
			$("#fecha_titulo_credito_juicios").val(array.fecha_titulo_credito_juicios);
			$("#orden_cobro_juicios").val(array.orden_cobro_juicios);			
			$("#fecha_oden_cobro_juicios").val(array.fecha_oden_cobro_juicios);
			$("#fecha_auto_pago_juicios").val(array.fecha_auto_pago_juicios);			
			$("#cuantia_inicial_juicios").val(array.cuantia_inicial_juicios);
			$("#id_etapa_procesal").val(array.id_etapa_procesal);			
			$("#id_estado_procesal").val(array.id_estado_procesal);
			$("#fecha_ultima_providencia_juicios").val(array.fecha_ultima_providencia_juicios);			
			$("#observaciones_juicios").val(array.observaciones_juicios);
			$("#fecha_vencimiento_juicios").val(array.fecha_vencimiento_juicios);
			$("#fecha_inicio_proceso_juicios").val(array.fecha_inicio_proceso_juicios);
			
			
			$("html, body").animate({ scrollTop: $(identificacion_clientes).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		ConsultaJuicios();
	})
	
	return false;
	
}

function cedulaCorrecta(objeto){
	
	var OCed = $(objeto);
	var textoCed = OCed.val();
	//console.log(textoCed);
	//console.log(textoCed.length);
	if( textoCed.length >= 10 ){
				
		if( !fnvalidaCedula(OCed.attr("id")) ){
			//OCed.val('');
			console.log("llego Aui");
			OCed.notify("Cedula Incorrecta",{"position":"buttom-left","HideDelay":2000});
		}
		
	}
	
}
