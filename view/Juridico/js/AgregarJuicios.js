$(document).ready(function(){
	
	consultaJucios();
	
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
	
	
	var parametros = {nombre_forma_pago:_nombre_forma_pago,id_forma_pago:_id_forma_pago}
	
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=MatrizJuicios&action=InsertaJuicios",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Juicios",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		document.getElementById("frm_agregar_juicio").reset();	
		consultaJucios();
	})

	event.preventDefault()
})