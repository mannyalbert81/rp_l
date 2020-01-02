$(document).ready(function(){ 	 
	  
});



function setTableStyle(ObjTabla){	
	
	var objetoTabla = $("#"+ObjTabla);
	objetoTabla.dataTable().fnDestroy();
	$("#"+ObjTabla).DataTable({
		"scrollY": "50vh",
		"scrollX": true,
		"scrollCollapse": true,
		"ordering":false,
		"paging":false,
		"searching":false,
		"info":false
    });
	
	ChangeCssTable(ObjTabla);
}


function ChangeCssTable(ObjTabla){
	var objeto = $("#"+ObjTabla);
	objeto.find("tbody tr td").css({
		"height":"6px",
		"padding":"0px",
		"margin":"0px",
	});
	
	$("#"+ObjTabla).on('shown.bs.collapse', function () {
		   $($.fn.dataTable.tables(true)).DataTable()
		      .columns.adjust();
		});
}

$("#verDiario").on("click",function(event){
		
	let $anioProcesos = $("#anio_procesos"),
		$mesProcesos = $("#mes_procesos"),
		$divResultados = $("#div_detalle_procesos");
	
	$divResultados.html();	
	
	if($anioProcesos.val() == ''){
		$anioProcesos.notify("Digite anio",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if($mesProcesos.val() == '0'){
		$mesProcesos.notify("Seleccione mes de proceso",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	
	if(!validafecha()){
		$mesProcesos.notify("Fecha Invalida/Fecha Fuera de periodo",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	
	
	$.ajax({
		 url:"index.php?controller=Nomina&action=DiarioPagoNomina",
		 type:"POST",
		 dataType:"json",
		 data:{peticion:'simulacion',anio_procesos: $anioProcesos.val(),mes_procesos: $mesProcesos.val()}
	 }).done(function(x){
		 console.log(x)
		 if ( x.hasOwnProperty( 'mensaje' ) || ( x.mensaje != '' ) ) {
			
			 if( x.mensaje == 'EXISTE PROCESO' ){
				 
				swal( {
					title:"COMPROBANTE GENERADO ",
					text: "comprobante ya se encuentra generado",
					icon: "info"
				});

			 }
			 
		 	if( x.mensaje == 'NO EXISTE PROCESO' ){
				 
		 		graficaDiarioPago($anioProcesos.val(),$mesProcesos.val());
			 }
			 
		 };
		
		 
		 
	 }).fail(function(xhr,status,error){
		 let err = xhr.responseText;
		 console.log(err);
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

function graficaDiarioPago(_anio,_mes){
	
	let $modal = $("#mod_diario"),$divResultados = $("#mod_div_contenido");
		
	$.ajax({
		 url:"index.php?controller=Nomina&action=graficaDiarioPagoNomina",
		 type:"POST",
		 dataType:"json",
		 data:{anio_procesos: _anio,mes_procesos: _mes}
	 }).done(function(x){
		 console.log(x)
		 
		 if ( x.hasOwnProperty( 'html' ) || ( x.html != '' ) ) {
			 
			 $divResultados.html(x.html);
			 
			 $modal.modal('show');
			 
			 setTimeout(function(){ setTableStyle("tblDiario");  }, 250);
			 
			
			 
		 }
		 
		 
	 }).fail(function(xhr,status,error){
		 let err = xhr.responseText;
		 console.log(err);
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
	
}

$("#btngenera").on("click",function(event){
	
	let $modulos = $("#id_modulos"),
		$procesos = $("#id_tipo_procesos"),
		$anioProcesos = $("#anio_procesos"),
		$mesProcesos = $("#mes_procesos"),
		$divResultados = $("#div_detalle_procesos");
	$divResultados.html();
	
	$("#btngenera").attr('disabled',true);
	
	if($modulos.val() == '0'){
		$modulos.notify("Seleccione el modulo",{ position:"buttom left", autoHideDelay: 2000});
		$("#btngenera").attr('disabled',false);
		return false;
	}	
	if($procesos.val() == '0'){
		$procesos.notify("Seleccione el proceso",{ position:"buttom left", autoHideDelay: 2000});
		$("#btngenera").attr('disabled',false);
		return false;
	}
	if($anioProcesos.val() == ''){
		$anioProcesos.notify("Digite anio",{ position:"buttom left", autoHideDelay: 2000});
		$("#btngenera").attr('disabled',false);
		return false;
	}
	if($mesProcesos.val() == '0'){
		$mesProcesos.notify("Seleccione mes de proceso",{ position:"buttom left", autoHideDelay: 2000});
		$("#btngenera").attr('disabled',false);
		return false;
	}
	
	if(!validafecha()){
		$mesProcesos.notify("Fecha Invalida/Fecha Fuera de periodo",{ position:"buttom left", autoHideDelay: 2000});
		$("#btngenera").attr('disabled',false);
		return false;
	}
	
	swal({
		title: "¿Generar Diario?",
		text: "La siguiente accion no se revertira!",
		icon:"view/images/capremci_load.gif",
		dangerMode:true,
		buttons: {
		    Cancelar:"Cancelar",		    
		    continuar: "Continuar",		    
		  },
	}).then((value) => {
		  switch (value) {		 
		    case "Cancelar":
		    	$("#btngenera").attr('disabled',false);
		      break;		 
		    case "continuar":
		    	generaDiario($procesos.val(), $modulos.val(), $anioProcesos.val(), $mesProcesos.val());
		    	$("#btngenera").attr('disabled',false);
		      break;
		    default:
		      return;
		  }
		});
	
	
	
})

function generaComprobante(){

	let $tabla  = $("#tblDiario");	
	let $filas = $tabla.find("tbody > tr ");	
	let data = [];	
	let error = true;
	let _sumatoriaMonto	= 0;
	
	$filas.each(function(){
		
		var _id_plan_cuentas	= $(this).attr("id").split('_')[1],
			_valor_cuenta_debito    = $(this).find("td:eq(3)").html(),
			_valor_cuenta_credito   = $(this).find("td:eq(4)").html();

		let monto_debito  =  Number.parseFloat(_valor_cuenta_debito.replace(",","").trim());
		let monto_credito =  Number.parseFloat(_valor_cuenta_credito.replace(",","").trim());
		let monto_total   = 0.00;
		let naturaleza_cuenta   = (monto_debito > 0) ? "D" : (( monto_credito > 0 ) ? "C" : "N");        		
		monto_total = monto_debito*1+monto_credito*1;
		//console.log("sumatoria = "+monto_credito+" + "+_sumatoriaMonto  +" resultado es: " + Number.parseFloat((monto_credito+_sumatoriaMonto).toFixed(2)));
		_sumatoriaMonto	+= Number.parseFloat((monto_credito ).toFixed(2));
		
		item = {};
	
		if(!isNaN(_id_plan_cuentas)){
		
			item ["id_plan_cuentas"] 		= _id_plan_cuentas;
			item ["naturaleza_cuentas"]     = naturaleza_cuenta;
			item ['valor_cuentas'] 		    = monto_total;
			
			data.push(item);
		}else{			
			error = false; return false;
		}			
	})
	
	// validar datos antes de enviar al controlador
	
	if(!error){	return false;}
	
	parametros 	= new FormData();
	arrayDatos 	= JSON.stringify(data); 
	parametros.append('lista_nomina', arrayDatos);
	parametros.append('valor_comprobante', Number.parseFloat((_sumatoriaMonto ).toFixed(2)));
	parametros.append('mes_nomina', $("#mes_procesos").val());
	
	$.ajax({
		data: parametros,
		type: 'POST',
		url : "index.php?controller=Nomina&action=GeneraComprobanteNomina",
		processData: false, 
		contentType: false,
		dataType: "json"
	}).done(function(x){
		
		if ( x.mensaje !== undefined ){
			$("#mod_diario").modal("hide");
			$("#div_detalle_procesos").html('');

			swal( {
				title:"COMPROBANTE GENERADO",
				text: "comprobante pago nomina generado",
				icon: "success"
			});
		}		
		
	}).fail(function(xhr, status, error){
		
		var err = xhr.responseText
		console.log(err)
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
	
	//console.log(data);
}

function generaDiario(in_proceso,in_modulo,in_anio,in_mes){
		
	$.ajax({
		 url:"index.php?controller=ProcesosMayorizacion&action=detallesDiarioTipo",
		 type:"POST",
		 dataType:"json",
		 data:{peticion:"generar",id_tipo_procesos:in_proceso,id_modulos:in_modulo,anio_procesos: in_anio,mes_procesos: in_mes}
	 }).done(function(x){
		 console.log(x)		 
		 if( x.valor == 1){
			 resetFields();
			 swal({
				 title:"Procesos Mensuales",
				 text:x.mensaje,
				 icon:"success"
			 })
			 
		 }
		 if( x.valor == 2){
			 swal({
				 title:"Procesos Mensuales",
				 text:"Diario ya Generado revise los detalles en la tabla",
				 icon:"warning"
			 })
			 
			 buscaDiario(x.id_ccomprobantes);
			 
		 }
	 }).fail(function(xhr,status,error){
		 let err = xhr.responseText;
		 console.log(err);
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
	
}

function buscaDiario(in_comprobante){
	
	let $divResultados = $("#div_detalle_procesos");
	$divResultados.html();
	
	$.ajax({
		 url:"index.php?controller=ProcesosMayorizacion&action=graficaDiarioExistente",
		 type:"POST",
		 dataType:"json",
		 data:{id_ccomprobantes:in_comprobante}
	 }).done(function(x){
		 $divResultados.html(x.tabladatos);
	 }).fail(function(xhr,status,error){
		 let err = xhr.responseText;
		 console.log(err);
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
	
}


function resetFields(){
	$("#id_modulos").val(0);
	$("#id_tipo_procesos").val(0);
}

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

