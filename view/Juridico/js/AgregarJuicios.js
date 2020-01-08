$(document).ready(function(){
	
	CargaEtapaProcesal();
	CargaEstadoProcesal();
	CargaUsuariosSecretario();
	
})

$("#frm_agregar_juicio").on("submit",function(event){
	
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
	let _id_usuarios_secretario = document.getElementById('id_usuarios_secretario').value;
	let _observaciones_juicios = document.getElementById('observaciones_juicios').value;
	
	
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
			id_usuarios_secretario:_id_usuarios_secretario,
			observaciones_juicios:_observaciones_juicios}
	
	
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
		consultaJucios();
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

function CargaUsuariosSecretario(){
	
	let $ddlUsuariosSecretario = $("#id_usuarios_secretario");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=MatrizJuicios&action=CargaUsuariosSecretario",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlUsuariosSecretario.empty();
		$ddlUsuariosSecretario.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlUsuariosSecretario.append("<option value=\"" +value.id_usuarios +"\">" + value.nombre_usuarios  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlUsuariosSecretario.empty();
	})
	
}


$("#nombre_usuarios").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})

