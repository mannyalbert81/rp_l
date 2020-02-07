$(document).ready(function(){ 	 
	
	let tasa_interes = $("#tasa_interes");
	let tasa_mora = $("#tasa_mora");
	let _mora = tasa_interes.val() * 1.5;
	$("#tasa_mora").val(_mora) ;
	
	
	$('#div_ingreso_informacion').fadeOut()
	$('#div_detalle_calculo_boton').fadeOut()
	
	 load_honorarios(1);
	
});

$("#tasa_interes").on("change",function(){
	
	let tasa_interes = $("#tasa_interes");
	
	let tasa_mora = $("#tasa_mora");
	let _mora = tasa_interes.val() * 1.5;
	$("#tasa_mora").val(_mora) ;
	 
	}

)



$("#btnBuscarJuicios").on("click",function(event){
	

	let $numero_juicios = $("#numero_juicios");
	$divResultados = $("#div_detalle_juicio");
	$divResultados.html();
	
	$('#div_ingreso_informacion').fadeIn();
	if($numero_juicios.val() == ""	){
		$modulo.notify("Ingrese Número de Juicio",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	
	
	
	console.log("hola");
	
	$.ajax({
		 url:"index.php?controller=CalculaHonorarios&action=BuscarJuicios",
		 type:"POST",
		 dataType:"json",
		 data:{numero_juicios:$numero_juicios.val()}
		
	 }).done(function(x){
	
		// console.log(x);
		 
		 if ( x.hasOwnProperty( 'tabladatos' ) || ( x.tabladatos != '' ) ) {
			 $divResultados.html(x.tabladatos);
			 setTableStyle("tbl_detalle_diario");
			 
		 };
		 
		 
		 
	 }).fail(function(xhr,status,error){
		 let err = xhr.responseText;
		 var mensaje = /<message>(.*?)<message>/.exec(err.replace(/\n/g,"|"))
		 console.log("ERROR: " + error )
		 console.log(x);
		 var mensaje = /<message>(.*?)<message>/.exec(err.replace(/\n/g,"|"))
		 if( mensaje !== null ){
			 var resmsg = mensaje[1];
			 swal( {
				 title:"Error",
				 dangerMode: true,
				 text: resmsg.replace("|","\n"),
				 icon: "error"
				})
		 }
	 })
})



$("#btnCalcular").on("click",function(event){
	
	
	let $fecha_calculo_coactiva = $("#fecha_calculo_coactiva"),
		$tasa_interes = $("#tasa_interes"),
		$tasa_mora = $("#tasa_mora"),
		$fecha_vencimiento = $("#fecha_vencimiento"),
		$id_juicios = $("#id_juicios"),
		$cuantia_inicial_juicios = $("#cuantia_inicial_juicios");
	$divResultados = $("#div_detalle_calculo");
	$divResultados.html();
	$('#div_detalle_calculo_boton').fadeIn()
	
	
	console.log("hola: " + $cuantia_inicial_juicios.val() );
	
	
	$.ajax({
		 url:"index.php?controller=CalculaHonorarios&action=CalcularHonorariosSecretarios",
		 type:"POST",
		 dataType:"json",
		 data:{fecha_calculo_coactiva: $fecha_calculo_coactiva.val(), 
			 tasa_interes: $tasa_interes.val(),
			 tasa_mora: $tasa_mora.val(),
			 fecha_vencimiento: $fecha_vencimiento.val(),
			 id_juicios: $id_juicios.val(),
			 cuantia_inicial_juicios: $cuantia_inicial_juicios.val()	 
		 }
		
	 }).done(function(x){
	
		 //console.log(JSON.stringify(x));
		// console.log(x);
		 if ( x.hasOwnProperty( 'tabladatos' ) || ( x.tabladatos != '' ) ) {
			 $divResultados.html(x.tabladatos);
			 setTableStyle("tbl_detalle_diario");
		 };
		 
		 
		 
	 }).fail(function(xhr,status,error){
		 let err = xhr.responseText;
		 console.log("ERROR: " + error)
		 console.log(x);
		 var mensaje = /<message>(.*?)<message>/.exec(err.replace(/\n/g,"|"))
		 if( mensaje !== null ){
			 var resmsg = mensaje[1];
			 swal( {
				 title:"Error",
				 dangerMode: true,
				 text: resmsg.replace("|","\n"),
				 icon: "error"
				})
		 }
	 })
})


$("#btnGuardar").on("click",function(event){
	console.log("Hola");
	
	let $_id_juicios = $("#id_juicios"),
		$_fecha_calculo_honorarios 							= $("#fecha_calculo_coactiva"),
		$_tasa_interes_calculo_honorarios					= $("#tasa_interes"),
		$_tasa_intres_mora_calculo_honorarios				= $("#tasa_mora"),
		$_fecha_vencimiento									= $("#fecha_vencimiento"),
		$_meses_mora_calculo_honorarios					 	= $("#meses_mora"),
		$_saldo_vencido_calculo_honorarios					= $("#saldo_vencido"),
		$_honorario_secretario_coactiva_calculo_honorarios  = $("#honorarios_secretario_coactiva"),  
		$_interes_mora_liquidacion_calculo_honorarios		= $("#interes_mora_liquidacion"),	
		$_iva_factura_calculo_honorarios					= $("#iva_factura"),
		$_valor_retencion_fondo_calculo_honorarios			= $("#valor_retencion_fondos");	

	
	
	//console.log("hola: " + $cuantia_inicial_juicios.val() );
	console.log("Hola");
	
	$.ajax({
		 url:"index.php?controller=CalculaHonorarios&action=GuardarHonorariosSecretarios",
		 type:"POST",
		 dataType:"text",
		 data:{ id_juicios: $_id_juicios.val(),   
				fecha_calculo_honorarios:	$_fecha_calculo_honorarios.val(),
				tasa_interes_calculo_honorarios: $_tasa_interes_calculo_honorarios.val(),
				tasa_intres_mora_calculo_honorarios: $_tasa_intres_mora_calculo_honorarios.val(),
				fecha_vencimiento: $_fecha_vencimiento.val(),					
				meses_mora_calculo_honorarios: $_meses_mora_calculo_honorarios.val(),		
				saldo_vencido_calculo_honorarios: $_saldo_vencido_calculo_honorarios.val(),	
				honorario_secretario_coactiva_calculo_honorarios: $_honorario_secretario_coactiva_calculo_honorarios.val(),  
				interes_mora_liquidacion_calculo_honorarios: $_interes_mora_liquidacion_calculo_honorarios.val(),	
				iva_factura_calculo_honorarios: $_iva_factura_calculo_honorarios.val(),
				valor_retencion_fondo_calculo_honorarios: $_valor_retencion_fondo_calculo_honorarios.val() }
		
	 }).done(function(x){
	
		 
			$('#div_ingreso_informacion').fadeOut();
			$('#div_detalle_juicio').fadeOut();
			
			$('#div_detalle_calculo').fadeOut();
			$('#div_detalle_calculo_boton').fadeOut();
			
		 //console.log(JSON.stringify(x));
		// console.log(x);
		 /*
		 if ( x.hasOwnProperty( 'tabladatos' ) || ( x.tabladatos != '' ) ) {
			 $divResultados.html(x.tabladatos);
			 setTableStyle("tbl_detalle_diario");
		 };
		 */
		 
		 
	 }).fail(function(xhr,status,error){
		 let err = xhr.responseText;
		 console.log("ERROR: " + error)
		 console.log(x);
		 var mensaje = /<message>(.*?)<message>/.exec(err.replace(/\n/g,"|"))
		 if( mensaje !== null ){
			 var resmsg = mensaje[1];
			 swal( {
				 title:"Error",
				 dangerMode: true,
				 text: resmsg.replace("|","\n"),
				 icon: "error"
				})
		 }
	 })
})




function validafecha(){
	let $anio = $("#anio_procesos"),
		$mes = $("#mes_procesos");	
	 var year = new Date().getFullYear();
     var mes = new Date().getMonth()+1;
     	
	let $fechapeticion = $anio.val()+'-'+$mes.val()+'-'+'01';
	let $fechaServer = year+'-'+mes+'-'+'01';
	
	var datepeticion = new Date($fechapeticion);
	var datesever  = new Date($fechaServer);
	
	 var fecha1ms=datepeticion.getTime();
     var fecha2ms=datesever.getTime();
     var diff = fecha2ms-fecha1ms;
     if (diff < 0){
            return false; 
     }else{
            return true;
     }
	
}


function load_honorarios(pagina){

	   var search=$("#search_honorarios").val();
    var con_datos={
				  action:'ajax',
				  page:pagina
				  };
		  
  $("#load_honorarios").fadeIn('slow');
  
  $.ajax({
            beforeSend: function(objeto){
              $("#load_honorarios").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');
            },
            url: 'index.php?controller=CalculaHonorarios&action=consulta_honorarios&search='+search,
            type: 'POST',
            data: con_datos,
            success: function(x){
              $("#honorarios_registrados_detalle").html(x);
              $("#load_honorarios").html("");
              $("#tabla_honorarios").tablesorter(); 
              
            },
           error: function(jqXHR,estado,error){
             $("#honorarios_registrados_detalle").html("Ocurrio un error al cargar la informacion de Detalle Honorarios..."+estado+"    "+error);
           }
         });
}




	