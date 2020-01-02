var id_participe;
var disponible_participe;
var solicitud;
var modal=0;
var garante_seleccionado=false;
var ci_garante="";
var renovacion_credito=false;
var capacidad_pago_garante_suficiente=false;

$(document).ready( function (){
	
	$(":input").inputmask();
	GetTipoCreditos();
	
		
});

$('#cedula_participe').keypress(function(event){
	  if(event.keyCode == 13){
	    $('#buscar_participe').click();
	  }
	});




$("#myModalCreditosActivos").on("hidden.bs.modal", function () {
	
document.getElementById("cuerpo").classList.add('modal-open');
console.log("CERRADO CREDITOS");
var credito_renovar=$('#info_credito_renovar').html();
if(credito_renovar=="")
	{
	$("#tipo_credito").val("");
	}
	
});

$("#myModalSimulacion").on("hidden.bs.modal", function () {
	$("#monto_credito").val("");
	$("#tipo_credito").val("");
	$("#fecha_corte").val("");
	$("#select_cuotas").html("");
	$("#tabla_amortizacion").html("");
	$("#info_solicitud").html("");
	if (modal==0) document.getElementById("cuerpo").classList.remove('modal-open');
	
});
$("#myModalAnalisis").on("hidden.bs.modal", function () {
	
	var modal = $('#myModalAnalisis');
	modal.find("#sueldo_liquido").val("");
	modal.find("#cuota_vigente").val("");
	modal.find("#fondos").val("");
	modal.find("#decimos").val("");
	modal.find("#rancho").val("");
	modal.find("#ingresos_notarizados").val("");
	document.getElementById("cuerpo").classList.add('modal-open');
	console.log("analisis closed");
});

$("#myModalInsertar").on("hidden.bs.modal", function () {
	var modal = $('#myModalInsertar');
	modal.find("#observacion_confirmacion").val("");
	modal.find("#codigo_confirmacion").val("");
	document.getElementById("cuerpo").classList.add('modal-open');
	
});

function GetTipoCreditos()
{
	$.ajax({
	    url: 'index.php?controller=SimulacionCreditos&action=getTipoCredito',
	    type: 'POST',
	    data: {
	    },
	})
	.done(function(x) {
		$('#tipo_creditos').html(x);
		SetTipoCreditos();
		
		
	})
	.fail(function() {
	    console.log("error");
	});
}

function SetTipoCreditos()
{
console.log("SET TIPO CREDITOS");
var tipo_credito_solicitud=$("#tipo_credito_solicitud").html();
tipo_credito_solicitud=tipo_credito_solicitud.split(" : ");
tipo_credito_solicitud=tipo_credito_solicitud[1];
switch (tipo_credito_solicitud)
{
case "ORDINARIO":
$("#tipo_credito").val("ORD");
break;
case "EMERGENTE":
	$("#tipo_credito").val("EME");
	break;
case "HIPOTECARIO":
	$("#tipo_credito").val("PH");
	break;
}

TipoCredito();

}


function AgregarGaranteRenovacion()
{
	var bci="<label for=\"cedula_garante\" class=\"control-label\">Añadir garante:</label>" +
	"<div id=\"mensaje_cedula_garante\" class=\"errores\"></div>" +
	"<div class=\"input-group\">"
  +"<input type=\"text\" data-inputmask=\"'mask': '9999999999'\" class=\"form-control\" id=\"cedula_garante\" name=\"cedula_garante\" placeholder=\"C.I.\">"
  +"<span class=\"input-group-btn\">"      			
  +"<button type=\"button\" class=\"btn btn-primary\" id=\"buscar_garante\" name=\"buscar_garante\" onclick=\"BuscarGarante()\">"
  +"<i class=\"glyphicon glyphicon-plus\"></i>"
  +"</button>"
  +"<button type=\"button\" class=\"btn btn-danger\" id=\"borrar_cedula\" name=\"borrar_cedula\" onclick=\"BorrarCedulaGarante()\">"
  +"<i class=\"glyphicon glyphicon-arrow-left\"></i>"
  +"</button>"
  +"</span>"
  +"</div>";
	$('#info_garante').html(bci);
	$(":input").inputmask();
	$('#cedula_garante').keypress(function(event){
		  if(event.keyCode == 13){
			  console.log("garante")
		    $('#buscar_garante').click();
		  }
		});
}

function BorrarCedula()
{
	$('#cedula_participe').val("");
}

function BorrarCedulaGarante()
{
	$('#cedula_garante').val("");
}

function TipoCredito()
{   
	
	$("#select_cuotas").html("");
	$("#monto_credito").val("");
	$("#tabla_amortizacion").html("");
	var interes=$("#tipo_credito").val();
	console.log(interes+"===>TIPO CREDITO");
	$("#capacidad_pago_garante").html("");
	renovacion_credito=false;
	
	if(interes!="")
		{
		var boton='<div class="col-xs-6 col-md-3 col-lg-3 text-center">'+
		'<div class="form-group">'+
    		'<label for="monto_credito" class="control-label">Capacidad de pago Participe:</label>'+
    		'<button align="center" class="btn bg-olive" title="Análisis crédito"  onclick="AnalisisCreditoParticipe()"><i class="glyphicon glyphicon-new-window"></i></button>'+
  			'<div id="mensaje_sueldo_participe" class="errores"></div></div></div>';
		$("#capacidad_de_pago_participe").html(boton);
		}
	else
		{
		$("#capacidad_de_pago_participe").html("");
		$("#select_cuotas").html("");
		$("#monto_credito").val("");
		}
	var bci="<label for=\"cedula_garante\" class=\"control-label\">Añadir garante:</label>" +
			"<div id=\"mensaje_cedula_garante\" class=\"errores\"></div>" +
			"<div class=\"input-group\">"
          +"<input type=\"text\" data-inputmask=\"'mask': '9999999999'\" class=\"form-control\" id=\"cedula_garante\" name=\"cedula_garante\" placeholder=\"C.I.\">"
          +"<span class=\"input-group-btn\">"      			
          +"<button type=\"button\" class=\"btn btn-primary\" id=\"buscar_garante\" name=\"buscar_garante\" onclick=\"BuscarGarante()\">"
          +"<i class=\"glyphicon glyphicon-plus\"></i>"
          +"</button>"
          +"<button type=\"button\" class=\"btn btn-danger\" id=\"borrar_cedula\" name=\"borrar_cedula\" onclick=\"BorrarCedulaGarante()\">"
          +"<i class=\"glyphicon glyphicon-arrow-left\"></i>"
          +"</button>"
          +"</span>"
          +"</div>";
	if(interes=="ORD")
		{
		$('#info_credito_renovar').html("");
		$('#info_garante').html(bci);
		$(":input").inputmask();
		$('#cedula_garante').keypress(function(event){
			  if(event.keyCode == 13){
				  console.log("garante")
			    $('#buscar_garante').click();
			  }
			});
		
		}
	else if(interes=="PH")
		{
		var tipo_credito_hipotecario="<label for=\"cedula_garante\" class=\"control-label\">Modalidad:</label>" +
		"<select name=\"tipo_credito_hipotecario\" id=\"tipo_credito_hipotecario\"  class=\"form-control\" onchange=\"ModalidadCreditoHP()\">"+
		"<option value=\"\" selected=\"selected\">--Seleccione--</option>"+
		"<option value=\"1\" >COMPRA DE BIEN O TERRENO</option>"+
		"<option value=\"2\" >MEJORAS Y/O REPAROS</option>"
		"<div id=\"mensaje_tipo_hipotecario\" class=\"errores\"></div>";
		$('#info_garante').html(tipo_credito_hipotecario);
		}
	else
		{
		$('#info_credito_renovar').html("");
		$('#info_garante').html("");
		var monto="Cta Individual : "+disponible_participe;
		if (disponible_participe < 150)
		{
		document.getElementById("disponible_participe").classList.remove('bg-olive');
		document.getElementById("disponible_participe").classList.add('bg-red');
		}
		$("#monto_disponible").html(monto);
		}
}

function ModalidadCreditoHP()
{
	var tipo_ph=$("#tipo_credito_hipotecario").val();
	$.ajax({
	    url: 'index.php?controller=SimulacionCreditos&action=GetAvaluoHipotecario',
	    type: 'POST',
	    data: {
	    	id_solicitud: solicitud,
	    	tipo_credito_hipotecario: tipo_ph
	    },
	})
	.done(function(x) {
		$('#info_garante').html(x);
		
		
	})
	.fail(function() {
	    console.log("error");
	});
}

function GetCreditosActivos(id)
{
	console.log("CreditosActivos==>"+id);
	$('#tabla_creditos_activos').html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');
	$.ajax({
	    url: 'index.php?controller=SimulacionCreditos&action=CreditosActivosParticipeRenovacion',
	    type: 'POST',
	    data: {
	    	   id_participe: id,
	    	   page: 1
	    },
	})
	.done(function(x) {
		$('#tabla_creditos_activos').html(x);
		
		
	})
	.fail(function() {
	    console.log("error");
	});
	
}

function SeleccionarCreditoRenovacion()
{
	var interes=$('#tipo_credito').val();
	$('#cerrar_renovar_credito').click();
	console.log(id_participe+"===id_participe");
	$.ajax({
	    url: 'index.php?controller=SimulacionCreditos&action=GetInfoCreditoRenovar',
	    type: 'POST',
	    data: {
	    	   id_participe: id_participe,
	    	   tipo_creditos: interes
	    },
	})
	.done(function(x) {
		$('#info_credito_renovar').html(x);
		
		
	})
	.fail(function() {
	    console.log("error");
	});
}

function SimulacionCredito()
{
	$("#myModalSimulacion").modal();
	InfoParticipe();
}

function RenovacionCredito()
{
	renovacion_credito=true;
	$("#myModalSimulacion").modal();
	InfoParticipe();
}

function CambiarCreditoRenovacion()
{
	$('#info_garante').html("");
	$("#myModalCreditosActivos").modal();
	GetCreditosActivos(id_participe);
}

function QuitarCreditoRenovacion()
{
	$('#info_credito_renovar').html("");
	$("#tipo_credito").val("");	
}

function QuitarGarante()
{
	var bci="<label for=\"cedula_garante\" class=\"control-label\">Añadir garante:</label>" +
	"<div id=\"mensaje_cedula_garante\" class=\"errores\"></div>" +
	"<div class=\"input-group\">"
  +"<input type=\"text\" data-inputmask=\"'mask': '9999999999'\" class=\"form-control\" id=\"cedula_garante\" name=\"cedula_garante\" placeholder=\"C.I.\">"
  +"<span class=\"input-group-btn\">"      			
  +"<button type=\"button\" class=\"btn btn-primary\" id=\"buscar_garante\" name=\"buscar_garante\" onclick=\"BuscarGarante()\">"
  +"<i class=\"glyphicon glyphicon-plus\"></i>"
  +"</button>"
  +"<button type=\"button\" class=\"btn btn-danger\" id=\"borrar_cedula\" name=\"borrar_cedula\" onclick=\"BorrarCedulaGarante()\">"
  +"<i class=\"glyphicon glyphicon-arrow-left\"></i>"
  +"</button>"
  +"</span>"
  +"</div>";
	$('#info_garante').html(bci);
	$(":input").inputmask();
	$('#cedula_garante').keypress(function(event){
		  if(event.keyCode == 13){
			  console.log("garante")
		    $('#buscar_garante').click();
		  }
		});
	var monto="Disponible : "+disponible_participe;
	var aportes=document.getElementById("aportes_participes");
	if (parseFloat(disponible_participe) < 150 || aportes!=null)
	{
	document.getElementById("disponible_participe").classList.remove('bg-olive');
	document.getElementById("disponible_participe").classList.add('bg-red');
	}
	else
		{
		document.getElementById("disponible_participe").classList.remove('bg-red');
		document.getElementById("disponible_participe").classList.add('bg-olive');
		}
	$("#monto_disponible").html(monto);
	garante_seleccionado=false;
}

function InfoParticipe()
{
	var modal = $('#myModalSimulacion');
	var ciparticipe=$('#cedula_participe').val();
	$.ajax({
	    url: 'index.php?controller=SimulacionCreditos&action=CreditoParticipe',
	    type: 'POST',
	    data: {
	    	cedula_participe:ciparticipe
	    },
	})
	.done(function(x) {
		modal.find("#info_participe").html(x);
		var limite=document.getElementById("monto_disponible").innerHTML;
		var elementos=limite.split(" : ");
		limite=elementos[1];
		disponible_participe=limite;
		console.log("disponible participe "+limite);
		var lista=document.getElementById("disponible_participe").classList;
		lista=lista.value;
		if(lista.includes('bg-red'))
			{
			swal({
		  		  title: "Advertencia!",
		  		  text: "El participe no puede acceder a un crédito en este momento",
		  		  icon: "warning",
		  		  button: "Aceptar",
		  		});
			}
		
	})
	.fail(function() {
	    console.log("error");
	});
}

function Redondeo(monto)
{
	monto=$("#monto_credito").val();
	var residuo=monto%10;
	
	monto=parseFloat(monto)-parseFloat(residuo);
		
		
	$("#monto_credito").val(monto);
	
}

function SimularCredito()
{
	var monto=$("#monto_credito").val();
	var interes=$("#tipo_credito").val();
	if (interes=="R") interes=9;	
	var cuota_credito=$("#cuotas_credito").val();
	$.ajax({
	    url: 'index.php?controller=SimulacionCreditos&action=SimulacionCredito',
	    type: 'POST',
	    data: {
	    	monto_credito:monto,
	    	tipo_credito:interes,
	    	plazo_credito:cuota_credito,
	    	renovacion_credito:renovacion_credito
	    },
	})
	.done(function(x) {
		$("#tabla_amortizacion").html(x);
		if(garante_seleccionado)
			{
			var cuota=$('#cuota_a_pagar2').html();
			var desgravamen=$('#desgravamen2').html();
			
			var sueldo_garante=$('#sueldo_garante').val();
			sueldo_garante=sueldo_garante/2;
			cuota=cuota.replace(",", "");
			desgravamen=desgravamen.replace(",", "");
			cuota=parseFloat(cuota)-parseFloat(desgravamen);
			
			if(parseFloat(cuota)>parseFloat(sueldo_garante))
				{
					document.getElementById("sueldo_garante").style= "background-color: #F5B7B1";
					}
				else
					{
					document.getElementById("sueldo_garante").style= "background-color: #82E0AA";
					}
				
			}
		swal("Tabla cargada", {
		      icon: "success",
		      buttons: false,
		      timer: 1000
		    });
		
	})
	.fail(function() {
	    console.log("error");
	});
}

function GetCuotas()
{
	var garante_pago=true;
	var ciparticipe=$('#cedula_participe').val();
	var monto=$("#monto_credito").val();
	Redondeo(monto);
	
	monto=$("#monto_credito").val();
	var interes=$("#tipo_credito").val();
	var limite="";
	if(interes=="PH")
		{
		limite=document.getElementById("monto_disponible2").innerHTML;
		}
	else
		{
		if(renovacion_credito)
		{
			limite=document.getElementById("monto_disponible").innerHTML;
		}
		else
			{
			limite=document.getElementById("monto_disponible1").innerHTML;
			}
		}
	
	var elementos=limite.split(" : ");
	var lista=document.getElementById("disponible_participe").classList;
	var sueldo_participe=$("#sueldo_participe").val();
	if(sueldo_participe===undefined) sueldo_participe="";
	console.log(sueldo_participe+"===>sueldo participe");
	lista=lista.value;
	limite=elementos[1];
	if(garante_seleccionado)
		{
		var limite_garante=document.getElementById("monto_garante_disponible").innerHTML;
		var elementos1=limite_garante.split(" : ");
		limite_garante=elementos1[1];
		limite=parseFloat(limite)+parseFloat(limite_garante);
		}
	
	console.log("LIMITE CREDITO "+limite);
	
	/*if(interes=="R")
	{
	var monto_credito_renovar=document.getElementById("saldo_credito_a_renovar").innerHTML;
	monto_credito_renovar=monto_credito_renovar.replace('.', '');
	monto_credito_renovar=parseFloat(monto_credito_renovar);
	var monto_credito=parseFloat(monto);
	console.log(monto_credito_renovar+" "+monto_credito);
	
	if(monto_credito < monto_credito_renovar)
	{
		renovacion=false;
		swal({
	  		  title: "Advertencia!",
	  		  text: "El monto del nuevo credito debe ser mayor\nal monto del credito a renovar",
	  		  icon: "warning",
	  		  button: "Aceptar",
	  		});
		
	}
	}*/
	if(monto=="" || parseFloat(monto)<150 || parseFloat(monto)>parseFloat(limite) )
		{
		$("#mensaje_monto_credito").text("Monto no valido");
		$("#mensaje_monto_credito").fadeIn("slow");
		$("#mensaje_monto_credito").fadeOut("slow");
		}
	if(interes=="EME" && parseFloat(monto)>7000)
		{
		$("#mensaje_monto_credito").text("Monto no valido");
		$("#mensaje_monto_credito").fadeIn("slow");
		$("#mensaje_monto_credito").fadeOut("slow");
		}
	if(interes=="")
	{
	$("#mensaje_tipo_credito").text("Escoja un tipo");
	$("#mensaje_tipo_credito").fadeIn("slow");
	$("#mensaje_tipo_credito").fadeOut("slow");
	}
	if(sueldo_participe=="")
	{
	$("#mensaje_sueldo_participe").text("Ingrese monto");
	$("#mensaje_sueldo_participe").fadeIn("slow");
	$("#mensaje_sueldo_participe").fadeOut("slow");
	}
	if(garante_seleccionado)
		{
		var sueldo_garante=$("#sueldo_garante").val();

		if(sueldo_garante===undefined) sueldo_garante="";
		if(sueldo_garante=="")
		{
		garante_pago=false;	
		$("#mensaje_sueldo_garante").text("Ingrese monto");
		$("#mensaje_sueldo_garante").fadeIn("slow");
		$("#mensaje_sueldo_garante").fadeOut("slow");
		}
		}
	if(monto!="" && parseFloat(monto)>150 && parseFloat(monto)<=parseFloat(limite) && interes!="" && garante_pago && sueldo_participe!="")
		{
		if(lista.includes('bg-red'))
			{
			swal({
		  		  title: "Advertencia!",
		  		  text: "El participe no puede acceder a un crédito en este momento",
		  		  icon: "warning",
		  		  button: "Aceptar",
		  		});
			}
		else
			{
			if(interes=="EME" && parseFloat(monto)>7000)
				{
				
				}
			else
				{
				if (!garante_seleccionado)
					{
					$.ajax({
					    url: 'index.php?controller=SimulacionCreditos&action=GetCuotas',
					    type: 'POST',
					    data: {
					    	monto_credito:monto,
					    	cedula_participe:ciparticipe,
					    	sueldo_participe:sueldo_participe,
					    	tipo_credito:interes
					    	
					    },
					})
					.done(function(x) {
						x=JSON.parse(x);
						
						$("#select_cuotas").html(x[1]);
						$("#monto_credito").val(x[0]);
						swal({
							  title: "Simulación de Crédito",
							  text: "Cargando tabla de amortización",
							  icon: "view/images/capremci_load.gif",
							  buttons: false,
							  closeModal: false,
							  allowOutsideClick: false
							});
						SimularCredito();
						
						
					})
					.fail(function() {
					    console.log("error");
					});
					}
				else
					{
					$.ajax({
					    url: 'index.php?controller=SimulacionCreditos&action=GetCuotasGarante',
					    type: 'POST',
					    data: {
					    	monto_credito:monto,
					    	cedula_participe:ciparticipe,
					    	sueldo_participe:sueldo_participe,
					    	tipo_credito:interes,
					    	cedula_garante:ci_garante,
					    	sueldo_garante:sueldo_garante
					    	
					    },
					})
					.done(function(x) {
						x=JSON.parse(x);
						
						$("#select_cuotas").html(x[1]);
						$("#monto_credito").val(x[0]);
						if(x[2]==0)
							{
							document.getElementById("sueldo_garante").style= "background-color: #F5B7B1";
							}
						else
							{
							document.getElementById("sueldo_garante").style= "background-color: #82E0AA";
							capacidad_pago_garante_suficiente=true;
							
							}
						swal({
							  title: "Simulación de Crédito",
							  text: "Cargando tabla de amortización",
							  icon: "view/images/capremci_load.gif",
							  buttons: false,
							  closeModal: false,
							  allowOutsideClick: false
							});
						SimularCredito();
						
						
					})
					.fail(function() {
					    console.log("error");
					});
					}
				
				}
				
				
			
			}
		
		}
	
}

function CuotaVigente(cuota_credito)
{
	var modal = $('#myModalAnalisis');
	modal.find("#cuota_vigente").val(cuota_credito);
	SumaIngresos();
}

function SumaIngresos()
{
	var modal = $('#myModalAnalisis');
	var sueldo_liquido=modal.find("#sueldo_liquido").val();
	var cuota_vigente=modal.find("#cuota_vigente").val();
	var fondos=modal.find("#fondos").val();
	var decimos=modal.find("#decimos").val();
	var rancho=modal.find("#rancho").val();
	var ingresos_notarizados=modal.find("#ingresos_notarizados").val();
	if (sueldo_liquido=="") sueldo_liquido=0;
	if (cuota_vigente=="") cuota_vigente=0;
	if (fondos=="") fondos=0;
	if (decimos=="") decimos=0;
	if (rancho=="") rancho=0;
	if (ingresos_notarizados=="") ingresos_notarizados=0;
	
	var total=parseFloat(sueldo_liquido)+parseFloat(cuota_vigente)+parseFloat(fondos)+parseFloat(decimos)+parseFloat(rancho)+parseFloat(ingresos_notarizados);
	total=Math.round(Math.round(total * 1000) / 10) / 100;
	modal.find("#total_ingreso").html(total);

}

function EnviarCapacidadPagoParticipe()
{
	var total_ingresos=$("#total_ingreso").html();
	console.log(total_ingresos);
	var capacidad_pago='<div class="col-xs-6 col-md-3 col-lg-3 text-center">'+
	'<div class="form-group">'+
	'<label for="monto_credito" class="control-label">Capacidad de pago Participe:</label>'+
	'<div id="mensaje_sueldo_participe" class="errores"></div>'+
	'<div class="input-group">'+
	'<input type=number step=1 class="form-control" id="sueldo_participe" name="sueldo_participe" style="background-color: #FFFFF;" readonly>'
	 +'<span class="input-group-btn">'      			
     +'<button type="button" class="btn bg-olive" id="nueva_capacidad_pago" name="nueva_capacidad_pago" onclick="AnalisisCreditoParticipe()">'
     +'<i class="glyphicon glyphicon-refresh"></i>'
     +'</button>'
     +'</span>'+
     '</div>'+
	'</div></div>';
	$("#capacidad_de_pago_participe").html(capacidad_pago);
	$("#sueldo_participe").val(total_ingresos);
	$("#cerrar_analisis").click();
}

function EnviarCapacidadPagoGarante()
{
	var total_ingresos=$("#total_ingreso").html();
	console.log(total_ingresos);
	var capacidad_pago='<div class="col-xs-6 col-md-3 col-lg-3 text-center">'+
	'<div class="form-group">'+
	'<label for="monto_credito" class="control-label">Capacidad de pago Garante:</label>'+
	'<div id="mensaje_sueldo_garante" class="errores"></div>'+
	'<div class="input-group">'+
	'<input type=number step=1 class="form-control" id="sueldo_garante" name="sueldo_garante" style="background-color: #FFFFF;" readonly>'
	 +'<span class="input-group-btn">'      			
     +'<button type="button" class="btn bg-olive" id="nueva_capacidad_pago" name="nueva_capacidad_pago" onclick="AnalisisCreditoGarante()">'
     +'<i class="glyphicon glyphicon-refresh"></i>'
     +'</button>'
     +'</span>'+
     '</div>'+
	'</div></div>';
	$("#capacidad_pago_garante").html(capacidad_pago);
	$("#sueldo_garante").val(total_ingresos);
	$("#cerrar_analisis").click();
}

function AnalisisCreditoParticipe()
{
	
	$("#myModalAnalisis").modal();
	swal({
		  icon: "view/images/capremci_load.gif",
		  buttons: false,
		  closeModal: false,
		  allowOutsideClick: false
		});
	var boton_enviar='<button type="button" id="enviar_capacidad_pago" name="enviar_capacidad_pago" class="btn btn-primary" onclick="EnviarCapacidadPagoParticipe()"><i class="glyphicon glyphicon-ok"></i> ACEPTAR</button>'
		$("#boton_capacidad_pago").html(boton_enviar);
	var interes=$("#tipo_credito").val();
	var tipo_credito="";
	
		tipo_credito=interes;
	console.log(tipo_credito);
	
	var ciparticipe=$('#cedula_participe').val();
	$.ajax({
	    url: 'index.php?controller=SimulacionCreditos&action=cuotaParticipe',
	    type: 'POST',
	    data: {
	    	cedula_participe:ciparticipe,
	    	tipo_credito:tipo_credito
	    },
	})
	.done(function(x) {
		x=x.trim();
		console.log("cuota :"+x);
		CuotaVigente(x);
		swal({
				text:" ",
		      icon: "success",
		      buttons: false,
		      timer: 1000
		    });
		
		if(x!=0)
			{
			renovacion_credito=true;
			var limite=document.getElementById("monto_disponible").innerHTML;
			var elementos=limite.split(" : ");
			var lista=document.getElementById("disponible_participe").classList;
			limite=elementos[1];
			$("#monto_credito").val(limite);
			
			SeleccionarCreditoRenovacion();
			
			
			
			}
		console.log(renovacion_credito);
		
	})
	.fail(function() {
	    console.log("error");
	});
	
}

function AnalisisCreditoGarante()
{
	
	$("#myModalAnalisis").modal();
	swal({
		  icon: "view/images/capremci_load.gif",
		  buttons: false,
		  closeModal: false,
		  allowOutsideClick: false
		});
	var boton_enviar='<button type="button" id="enviar_capacidad_pago_garante" name="enviar_capacidad_pago_garante" class="btn btn-primary" onclick="EnviarCapacidadPagoGarante()"><i class="glyphicon glyphicon-ok"></i> ACEPTAR</button>'
		$("#boton_capacidad_pago").html(boton_enviar);
		
	var ciparticipe=$('#cedula_participe').val();
	$.ajax({
	    url: 'index.php?controller=SimulacionCreditos&action=cuotaGarante',
	    type: 'POST',
	    data: {
	    	cedula_participe:ci_garante
	    },
	})
	.done(function(x) {
		x=x.trim();
		console.log("cuota :"+x);
		CuotaVigente(x);
		swal({
			text:" ",
	      icon: "success",
	      buttons: false,
	      timer: 1000
	    });
		
	})
	.fail(function() {
	    console.log("error");
	});
	
}


function InfoSolicitud(cedula,id_solicitud)
{
	$('#cedula_participe').val(cedula);
	BuscarParticipe();
	SimulacionCredito();
	solicitud=id_solicitud;
	$.ajax({
	    url: 'index.php?controller=BuscarParticipes&action=InfoSolicitud',
	    type: 'POST',
	    data: {
	    	id_solicitud:id_solicitud
	    },
	})
	.done(function(x) {
		$("#info_solicitud").html(x);
	})
	.fail(function() {
	    console.log("error");
	});
	
}

function BuscarParticipe()
{
	var ciparticipe=$('#cedula_participe').val();
	
	if(ciparticipe=="" || ciparticipe.includes('_'))
		{
		$("#mensaje_cedula_participe").text("Ingrese cédula");
		$("#mensaje_cedula_participe").fadeIn("slow");
		$("#mensaje_cedula_participe").fadeOut("slow");
		}
	else
		{
		console.log(ciparticipe);
		$.ajax({
		    url: 'index.php?controller=BuscarParticipes&action=BuscarParticipe',
		    type: 'POST',
		    data: {
		    	   cedula: ciparticipe
		    },
		})
		.done(function(x) {
			var y=$.parseJSON(x);
			console.log(y);
			$('#participe_encontrado').html(y[0]);
		     id_participe=y[1];
			AportesParticipe(id_participe, 1)
			CreditosActivosParticipe(id_participe, 1)
			
		})
		.fail(function() {
		    console.log("error");
		});
		}
}

function BuscarGarante()
{
	var ciparticipe=$('#cedula_garante').val();
	ci_garante=ciparticipe;
	var cicredito=$('#cedula_credito').html();
	cicredito=cicredito.split(" : ");
	cicredito=cicredito[1];	
	if(ciparticipe=="" || ciparticipe.includes('_'))
		{
		$("#mensaje_cedula_garante").text("Ingrese cédula");
		$("#mensaje_cedula_garante").fadeIn("slow");
		$("#mensaje_cedula_garante").fadeOut("slow");
		}
	else
		{
	    if (ciparticipe==cicredito)
	    {
	    	C
	    }
	    else
	    	{
	    	$.ajax({
			    url: 'index.php?controller=SimulacionCreditos&action=BuscarGarante',
			    type: 'POST',
			    data: {
			    	   cedula_garante: ciparticipe
			    },
			})
			.done(function(x) {
				x=x.trim();
				if(!(x.includes("Participe no encontrado")))
					{
					if(x=="Garante no disponible")
					{
						swal({
					  		  title: "Advertencia!",
					  		  text: "El participe ya es garante activo",
					  		  icon: "warning",
					  		  button: "Aceptar",
					  		});
					}
						else
						
						{
						$("#info_garante").html(x);
						var edad_garante=$("#edad_garante").html();
						edad_garante=edad_garante.split(" : ");
						edad_garante=edad_garante[1].split(", ");
						edad_garante=edad_garante[0].split(" ");
						edad_garante=edad_garante[0];	
						console.log(edad_garante);
						var limite=document.getElementById("monto_disponible").innerHTML;
						var elementos=limite.split(" : ");
						limite=elementos[1];
						var limite_garante=document.getElementById("monto_garante_disponible").innerHTML;
						elementos=limite_garante.split(" : ");
						limite_garante=elementos[1];
						console.log(limite_garante);
						var limite_total=parseFloat(limite_garante)+parseFloat(limite);
						limite_total=limite_total.toString()
						elementos=limite_total.split(".");
						elementos[1]=elementos[1].substring(0, 2);
						limite_total=elementos[0]+"."+elementos[1];
						var aportes=document.getElementById("aportes_participes");
						var aportes_garante=document.getElementById("aportes_garante");
						if (limite_total>150 && edad_garante<75 && aportes==null && aportes_garante==null)
							{
							document.getElementById("disponible_participe").classList.remove('bg-red');
							document.getElementById("disponible_participe").classList.add('bg-olive');
							garante_seleccionado=true;
							var pago_garante='<div class="col-xs-6 col-md-3 col-lg-3 text-center">'+
							'<div class="form-group">'+
					    		'<label for="monto_credito" class="control-label">Capacidad de pago Garante:</label>'+
					    		'<button align="center" class="btn bg-olive" title="Análisis crédito"  onclick="AnalisisCreditoGarante()"><i class="glyphicon glyphicon-new-window"></i></button>'+
					  			'<!--<input type=number step=1 class="form-control" id="sueldo_participe" name="sueldo_participe" style="background-color: #FFFFF;">  -->'+
					  			'<div id="mensaje_sueldo_garante" class="errores"></div></div></div>';
							
							$("#capacidad_pago_garante").html(pago_garante);
							}
						if(edad_garante<75 && aportes_garante!=null)
						{
							document.getElementById("disponible_participe").classList.remove('bg-olive');
							document.getElementById("disponible_participe").classList.add('bg-red');
							swal({
						  		  title: "Advertencia!",
						  		  text: "El participe no cumple las condiciones\npara ser garante",
						  		  icon: "warning",
						  		  button: "Aceptar",
						  		});
						}
						}
					
				}
				else
					{
					swal({
				  		  title: "Advertencia!",
				  		  text: "Participe no está registrado o no se encuentra activo",
				  		  icon: "warning",
				  		  button: "Aceptar",
				  		});
					}
			})
			.fail(function() {
			    console.log("error");
			});
	    	}
		
		
		}
}

function AportesParticipe(id, page)
{
	$.ajax({
	    url: 'index.php?controller=BuscarParticipes&action=AportesParticipe',
	    type: 'POST',
	    data: {
	    	   id_participe: id,
	    	   page: page
	    },
	})
	.done(function(x) {
		$('#aportes_participe').html(x);
		
		
	})
	.fail(function() {
	    console.log("error");
	});
}

function CreditosActivosParticipe(id, page)
{
	$.ajax({
	    url: 'index.php?controller=BuscarParticipes&action=CreditosActivosParticipe',
	    type: 'POST',
	    data: {
	    	   id_participe: id,
	    	   page: page
	    },
	})
	.done(function(x) {
		$('#creditos_participe').html(x);
		
		
	})
	.fail(function() {
	    console.log("error");
	});
}

function ConfirmarCodigo()
{
	$("#info_credito_confirmar").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');
	var monto=$("#monto_credito").val();
	var interes=$("#tipo_credito").val();
	var cuota_credito=$("#cuotas_credito").val();
	var ciparticipe=$('#cedula_participe').val();
	var nombre_participe=$("#nombre_participe_credito").html();
	$.ajax({
	    url: 'index.php?controller=SimulacionCreditos&action=genera_codigo',
	    type: 'POST',
	    data: {
	    	tipo_credito:interes
	    },
	})
	.done(function(x) {
		console.log(x);
		x=JSON.parse(x);
		var informacion="<h3>Se procedera a generar un crédito para "+nombre_participe+"</h3>" +
				"<h3>Con cédula de identidad número "+ciparticipe+"</h3>" +
				"<h3>Por el monto de "+monto+" USD</h3>" +
				"<h3>A un plazo de "+cuota_credito+" meses con interes del "+x[1]+"%</h3>" +
				"<h3>Para confirmar ingrese el siguiente código</h3>" +
				"<h2 id=\"codigo_generado\">"+x[0]+"</h2>";
		$("#info_credito_confirmar").html(informacion);	
	})
	.fail(function() {
	    console.log("error");
	});
}

function GuardarCredito()
{
console.log("Guardar Credito");
if(garante_seleccionado)
	{
	console.log(capacidad_pago_garante_suficiente+"=====>boolean");
	if (capacidad_pago_garante_suficiente)
	{
swal({
	title: "Advertencia!",
	  text: "Se precedera con el registro del crédito",
	  icon: "warning",
	  buttons: {
	    cancel: "Cancelar",
	    aceptar: {
	      text: "Aceptar",
	      value: "aceptar",
	    }
	  },
	})
	.then((value) => {
	  switch (value) {
	 
	    case "aceptar":
	    	ConfirmarCodigo();
	    	$("#myModalInsertar").modal();
	      break;
	 
	    default:
	      swal("Crédito no registrado");
	  }
	});
	}
	else{
		swal({
			  title: "Advertencia!",
			  text: "El garante no tiene la capacidad de pago suficiente",
			  icon: "warning",
			  button: "Aceptar",
			});
	}
	}
else
	{
	swal({
		title: "Advertencia!",
		  text: "Se precedera con el registro del crédito",
		  icon: "warning",
		  buttons: {
		    cancel: "Cancelar",
		    aceptar: {
		      text: "Aceptar",
		      value: "aceptar",
		    }
		  },
		})
		.then((value) => {
		  switch (value) {
		 
		    case "aceptar":
		    	ConfirmarCodigo();
		    	$("#myModalInsertar").modal();
		      break;
		 
		    default:
		      swal("Crédito no registrado");
		  }
		});
	}

}

function SubirInformacionCredito()  //proceso para los registros del credito
{
	var monto=$("#monto_credito").val();
	var interes=$("#tipo_credito").val();
	var fecha_corte=$("#fecha_corte").val();
	var cuota_credito=$("#cuotas_credito").val();
	var ciparticipe=$('#cedula_participe').val();
	var observacion=$('#observacion_confirmacion').val();
	id_solicitud=solicitud;
	if (!renovacion_credito)
		{
		$.ajax({
		    url: 'index.php?controller=SimulacionCreditos&action=SubirInformacionCredito',
		    type: 'POST',
		    data: {
		    	monto_credito: monto,
		    	tipo_credito: interes,
		    	fecha_pago: fecha_corte,
		    	cuota_credito: cuota_credito,
		    	cedula_participe: ciparticipe,
		    	observacion_credito: observacion,
		    	id_solicitud:id_solicitud,
		    	con_garante:garante_seleccionado,
		    	cedula_garante:ci_garante
		    	
		    },
		})
		.done(function(x) {
			console.log(x);
			x=x.trim();
			if(x=="OK")
				{
				swal({
			  		  title: "Crédito Registrado",
			  		  text: "La solicitud de crédito ha sido procesada",
			  		  icon: "success",
			  		  button: "Aceptar",
			  		}).then((value) => {
			  			window.open('index.php?controller=SolicitudPrestamo&action=index5', '_self');
						 });
				}
			else
				{
				swal({
			  		  title: "Advertencia!",
			  		  text: "Hubo un error en el proceso de la solicitud",
			  		  icon: "warning",
			  		  button: "Aceptar",
			  		});
				}
		})
		.fail(function() {
		    console.log("error");
		});
		}
	else
		{
		$.ajax({
		    url: 'index.php?controller=SimulacionCreditos&action=SubirInformacionRenovacionCredito',
		    type: 'POST',
		    data: {
		    	monto_credito: monto,
		    	tipo_credito: interes,
		    	fecha_pago: fecha_corte,
		    	cuota_credito: cuota_credito,
		    	cedula_participe: ciparticipe,
		    	observacion_credito: observacion,
		    	id_solicitud:id_solicitud,
		    	con_garante:garante_seleccionado,
		    	cedula_garante:ci_garante
		    	
		    },
		})
		.done(function(x) {
			console.log(x);
			x=x.trim();
			if(x=="OK")
				{
				swal({
			  		  title: "Crédito Registrado",
			  		  text: "La solicitud de crédito ha sido procesada",
			  		  icon: "success",
			  		  button: "Aceptar",
			  		}).then((value) => {
			  			window.open('index.php?controller=SolicitudPrestamo&action=index5', '_self');
						 });
				}
			else
				{
				swal({
			  		  title: "Advertencia!",
			  		  text: "Hubo un error en el proceso de la solicitud",
			  		  icon: "warning",
			  		  button: "Aceptar",
			  		});
				}
		})
		.fail(function() {
		    console.log("error");
		});
		}
	
	
	
}

function RegistrarCredito()
{
 var codigo_generado=$("#codigo_generado").html();
 var codigo_insertado=$("#codigo_confirmacion").val();
 if(codigo_insertado=="" || codigo_insertado.includes("_"))
	 {
	 swal("Inserte código");
	 }
 else if(codigo_insertado!="" && !(codigo_insertado.includes("_")) && codigo_insertado==codigo_generado)
	 {
	 	SubirInformacionCredito()
	 }
 else
	 {
	 swal("Código incorrecto");
	 }
}