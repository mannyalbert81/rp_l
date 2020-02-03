$(document).ready(function(){
	
	// creo editor de texto
	CKEDITOR.replace('editor1')
	CKEDITOR.replace('editor2')
	//CKEDITOR.replace('editor3')
    $('.textarea').wysihtml5()
	
		
})




/*******************************************************************************
 * DESDE AQUI MAYCOL
 * 
 *
 */


   
	var numero_juicios;
	var identificacion_clientes;
	var nombre_clientes;
	var numero_titulo_credito_juicios;
	var fecha_titulo_credito_juicios;
	var cuantia_inicial_juicios;
	var orden_cobro_juicios;
	var fecha_oden_cobro_juicios;
	var fecha_auto_pago_juicios;
	var valor_retencion_fondos;
	var fecha_inicio_proceso_juicios;
	var secretario;
	var valorLetras1 = 0;
    var valorLetras = 0;
   

    var f=new Date();
	var dia = f.getDate();
	var hora = f.getHours();
	var minutos = f.getMinutes();
    var meses = new Array ("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
    var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    
    
    // fecha para razón aumentando 1 dia 
    var fecha = new Date();
    fecha.setDate(fecha.getDate()+1);
    var dia_razon = fecha.getDate();
    
    
    // relleno a dos digitos el dia
    if (dia < 10) {
    	dia = '0' + dia;
    }
    
    // relleno a dos digitos el dia
    if (dia_razon < 10) {
    	dia_razon = '0' + dia_razon;
    }
    
    // relleno a dos digitos la hora
    if (hora < 10) {
    	hora = '0' + hora;
    }
    
    
   // relleno a dos digitos los minutos
    if (minutos < 10) {
    	minutos = '0' + minutos;
    }
    
    
    var fecha_actual;
    var fecha_razon;
    var fecha_auto_pago_nueva;
    var fecha_inicio_proceso_juicios_nueva;
    var fecha_titulo_credito_juicios_nueva;
    var fecha_oden_cobro_juicios_nueva;
    
    
    
    
    
    
    
    
    
    
    var id_documentos_generados=$('#id_documentos_generados').val();

    
    if(id_documentos_generados>0){
    	
    	
    	
    }else{
    
	$("#numero_juicios" ).autocomplete({
	 source: 'index.php?controller=AvocoOrdenPago&action=AutocompleteNumeroJuicio',
	  	minLength: 1
	 });
	                    		
	$("#numero_juicios").focusout(function(){
	                    					
	$.ajax({
	url:'index.php?controller=AvocoOrdenPago&action=AutocompleteDevuelveDatos',
	type:'POST',
	dataType:'json',
	data:{numero_juicios:$('#numero_juicios').val()}
	}).done(function(respuesta){
	                  		
	$('#numero_juicios').val(respuesta.numero_juicios);
	$('#id_juicios').val(respuesta.id_juicios);
	$('#identificacion_clientes').val(respuesta.identificacion_clientes);
	$('#id_clientes').val(respuesta.id_clientes);
	$('#nombre_clientes').val(respuesta.nombre_clientes);
	$('#numero_titulo_credito_juicios').val(respuesta.numero_titulo_credito_juicios);
	$('#fecha_auto_pago_juicios').val(respuesta.fecha_auto_pago_juicios);
	$('#valor_retencion_fondos').val(respuesta.valor_retencion_fondos);
	$('#fecha_inicio_proceso_juicios').val(respuesta.fecha_inicio_proceso_juicios);
	
	
	$('#fecha_titulo_credito_juicios').val(respuesta.fecha_titulo_credito_juicios);
	$('#cuantia_inicial_juicios').val(respuesta.cuantia_inicial_juicios);
	$('#orden_cobro_juicios').val(respuesta.orden_cobro_juicios);
	$('#fecha_oden_cobro_juicios').val(respuesta.fecha_oden_cobro_juicios);
	 
	   
	 
	
	
	secretario =  respuesta.secretarios;                   						
	
	
	formato_avoco();
	formato_oficio_1();
	//formato_oficio_2();
	
	}).fail(function(xhr,status, error) {
	       
		$('#numero_juicios').val("");
		$('#id_juicios').val("0");
		$('#identificacion_clientes').val("");
		$('#id_clientes').val("0");
		$('#nombre_clientes').val("");
		$('#numero_titulo_credito_juicios').val("");
		$('#fecha_auto_pago_juicios').val("");
		$('#valor_retencion_fondos').val("");
		$('#fecha_inicio_proceso_juicios').val("");
		
		

		$('#fecha_titulo_credito_juicios').val("");
		$('#cuantia_inicial_juicios').val("");
		$('#orden_cobro_juicios').val("");
		$('#fecha_oden_cobro_juicios').val("");
		 
		   
		$("#aplicar").attr({disabled:true});
		secretario =  ""; 
		
		console.log(xhr.responseText)
		   						                    						
	});
	                    					
	});


   }





	function formato_avoco(){
	
	var formato="";
	 numero_juicios=$('#numero_juicios').val();
	 identificacion_clientes=$('#identificacion_clientes').val();
	 nombre_clientes=$('#nombre_clientes').val();
	 numero_titulo_credito_juicios=$('#numero_titulo_credito_juicios').val();
	 fecha_auto_pago_juicios=$('#fecha_auto_pago_juicios').val();
	 valor_retencion_fondos=$('#valor_retencion_fondos').val();
	 fecha_inicio_proceso_juicios=$('#fecha_inicio_proceso_juicios').val();
	
	 
	 fecha_titulo_credito_juicios=$('#fecha_titulo_credito_juicios').val();
	 cuantia_inicial_juicios=$('#cuantia_inicial_juicios').val();
	 orden_cobro_juicios=$('#orden_cobro_juicios').val();
	 fecha_oden_cobro_juicios=$('#fecha_oden_cobro_juicios').val();
	
	 
	convertir_a_letras_cuantia(cuantia_inicial_juicios);
	var monto_cuantia_letras =  valorLetras1;
	 
	
	convertir_a_letras(valor_retencion_fondos);
	var monto_letras =  valorLetras;
	
	
    separadores = ['-','/'],
    textoseparado = fecha_auto_pago_juicios.split (new RegExp (separadores.join('|'),'g'));
    textoseparado1 = fecha_inicio_proceso_juicios.split (new RegExp (separadores.join('|'),'g'));
    textoseparado2 = fecha_titulo_credito_juicios.split (new RegExp (separadores.join('|'),'g'));
    textoseparado3 = fecha_oden_cobro_juicios.split (new RegExp (separadores.join('|'),'g'));
    
    
    // capturo la fecha actual en letras
     //fecha_actual = diasSemana[f.getDay()] + ", " + dia + " de " + meses[f.getMonth()] + " del " + f.getFullYear() + ", las " + hora + "H" + minutos;
     fecha_actual = dia + " de " + meses[f.getMonth()] + " del " + f.getFullYear() + ", las " + hora + "H" + minutos;
     
     //fecha_razon = diasSemana[fecha.getDay()] + ", " + dia_razon + " de " + meses[fecha.getMonth()] + " del " + fecha.getFullYear();
     fecha_razon = dia_razon + " de " + meses[fecha.getMonth()] + " del " + fecha.getFullYear();
     
     fecha_auto_pago_nueva = textoseparado[2] + " de " + meses[textoseparado[1]-1] + " de " + textoseparado[0];
     fecha_inicio_proceso_juicios_nueva  = textoseparado1[2] + " de " + meses[textoseparado1[1]-1] + " del " + textoseparado1[0];
     fecha_titulo_credito_juicios_nueva = textoseparado2[2] + " de " + meses[textoseparado2[1]-1] + " del " + textoseparado2[0];
     fecha_oden_cobro_juicios_nueva  = textoseparado3[2] + " de " + meses[textoseparado3[1]-1] + " del " + textoseparado3[0];
   
    
	// vacio el texto
	$('#editor1').val("");
	
	formato = 
		
		`<p style="text-align: center;"><b>REPÚBLICA DEL ECUADOR</b></p>`+
		`<p style="text-align: center;"><b>CORPORACIÓN NACIONAL DE TELECOMUNICACIONES CNT EP.</b></p>`+
		`<p style="text-align: center;"><b>JEFATURA DE COACTIVA</b></p>`+
		`<p style="text-align: center;"><b>ORDEN DE PAGO INMEDIATO ${numero_juicios}</b></p>`+

	
	
	`<p style="text-align:justify">&nbsp;</p>`+

	`<p style="text-align: justify;"><b>JEFATURA DE COACTIVA.-</b> Quito, 27 de enero de 2020, las 08:30.-`+
	` VISTOS: Avoco conocimiento del presente proceso en la calidad de Jefe de Coactiva de la Corporación Nacional de Telecomunicaciones CNT EP de conformidad a la Acción de personal: GTH-NSP-10657-2019`+
	 ` de ${fecha_inicio_proceso_juicios_nueva}. Agréguese a los autos la documentación precedente. En lo principal agréguese: 1.-La Orden de Cobro No. ${orden_cobro_juicios} de ${fecha_oden_cobro_juicios_nueva} y el Título de Crédito No. ${numero_titulo_credito_juicios} de ${fecha_titulo_credito_juicios_nueva},`+
	 ` del que consta la razón de notificación correspondiente, remitidas por el JEFE DE COBRANZA EXTRAJUDICIAL; se desprende que <b>${nombre_clientes}</b>,`+
     ` con cédula de ciudadanía No. <b>${identificacion_clientes}</b>; adeuda a la Corporación Nacional de Telecomunicaciones CNT EP., por la prestación de servicios de Telecomunicaciones, sin que a la fecha haya pagado su obligación. Por cuanto la obligación es determinada y actualmente exigible, de conformidad con lo establecido en el artículo 267 del Código Orgánico Administrativo (COA), dicto la presente`+
     ` <b>ORDEN DE PAGO INMEDIATO</b>, en contra de <b>${nombre_clientes}</b>, con cédula de ciudadanía: No. <b>${identificacion_clientes}</b>, disponiendo que pague en la JEFATURA DE COACTIVA, en el término de TRES DÍAS, la cantidad de`+
     ` ${monto_cuantia_letras}, valor al que se sumarán los intereses, honorarios profesionales, derechos y aranceles, gastos procesales y costas judiciales y otros valores adicionales que genere la obligación, hasta la total cancelación de la deuda; o, dimita bienes equivalentes, previniéndole que de no hacerlo se procederá al embargo de bienes. De conformidad a lo previsto en el artículo 281 del Código Orgánico Administrativo (COA), como medidas cautelares, ordeno: a) La retención de los fondos, depósitos e inversiones que el  (la) coactivado (a) mantiene en las entidades del Sistema Financiero, hasta por el valor de`+
     ` <b>${monto_letras}</b>. Para el efecto ofíciese a la Superintendencia de Bancos y Seguros; y, a la Superintendencia de Economía Popular y Solidaria. Las autoridades respectivas comunicarán a esta`+
     ` <b>JEFATURA DE COACTIVA</b>, sobre las cuentas en las que recayeron las retenciones. Designo como Secretaria Abogada Externa a la <b>${secretario}</b>,`+
     ` quién encontrándose presente declara aceptar su cargo y promete cumplir fiel y legalmente sus funciones. Se previene al (a la) coactivado (a), de la obligación de señalar correo electrónico y/o casillero judicial para posteriores notificaciones.-`+
     ` <b>CÚMPLASE OFÍCIESE Y CÍTESE.-</b></p>`+

	
	
	// espacios en blanco para las firmas
    `<p style="text-align:justify">&nbsp;</p>`+	
	`<p style="text-align:justify">&nbsp;</p>`+
	`<p style="text-align:justify">&nbsp;</p>`+
	
	`<p style="text-align:left">Abg. Andrés Efraín Albuja Tintín<br>`+
	`<b>JEFE DE COACTIVA</b><br>`+
	`<b>CORPORACIÓN NACIONAL DE TELECOMUNICACIONES - CNT EP.</b></p>`+
	
	// espacios en blanco para la razòn
	`<p style="text-align:justify">&nbsp;</p>`+
	`<p style="text-align:justify">&nbsp;</p>`+
	`<p style="text-align:justify">&nbsp;</p>`+	
	
	
	`<p style="text-align:left">${secretario}<br>`+
	`<b>LIVENTSIVAL CIA. LTDA.</b><br>`+
	`<b>SECRETARIA-ABOGADA EXTERNA</b><br>`+
	`<b>JEFATURA DE COACTIVA CNT- E.P.</b></p>`;
	
	CKEDITOR.instances.editor1.setData(formato); 
	
	$('#editor1').val(formato);
	
    
	}
	
	
	
	function convertir_a_letras(valor){
		
		var letras="";
		
		$.ajax({
			url:'index.php?controller=AvocoOrdenPago&action=Convierte_a_Letras',
			type:'POST',
			async: false,
			data:{valor:valor}
			}).done(function(respuesta){			                  		
				valorLetras = respuesta.trim();			
			
			}).fail(function(xhr,status, error) {
			    
				console.log(xhr.responseText)
				   						                    						
			});
	}
	
	
	
   function convertir_a_letras_cuantia(valor){
		
		var letras="";
		
		$.ajax({
			url:'index.php?controller=AvocoOrdenPago&action=Convierte_a_Letras',
			type:'POST',
			async: false,
			data:{valor:valor}
			}).done(function(respuesta){			                  		
				valorLetras1 = respuesta.trim();			
			
			}).fail(function(xhr,status, error) {
			    
				console.log(xhr.responseText)
				   						                    						
			});
	}
	
	
	
	
	
	
	/// para oficios


	function formato_oficio_1(){
	
	var formato_1="";
	var monto_letras =  valorLetras;
	var monto_cuantia_letras =  valorLetras1;
	
	
	// vacio el texto
	$('#editor2').val("");
	
	formato_1 = 
	`<p style="text-align: left;">Oficio No. 0000-JC-PIC-2020-LGLC<br>`+
	`D.M. de Quito, a 04 de febrero de 2020</p>`+
	`<p style="text-align: left;">Señor</p>`+
	
	`<p style="text-align:left"><b>SUPERINTENDENTE DE BANCOS<br>`+
	`SUPERINTENDENCIA DE ECONOMÍA POPULAR Y SOLIDARIA</b><br>`+
	`Presente.-</p>`+
	
	`<p style="text-align: left;">De mi consideración:</p>`+
	
	`<p style="text-align: justify;">Por medio del presente, pongo en su conocimiento que en la providencia dictada en el Proceso de Ejecución Coactiva No. <b>${numero_juicios}</b>,`+
	 ` en contra de <b>${nombre_clientes}, con cédula de ciudadanía No. ${identificacion_clientes}</b>, se ha dictado la siguiente providencia:</p>`+
	 `<p style="text-align: justify;">&quot;..JEFATURA DE COACTIVA.- Quito, 27 de enero de 2020, las 08:30.- VISTOS: Avoco conocimiento del presente proceso en la calidad de Jefe de Coactiva de la Corporación Nacional de Telecomunicaciones CNT EP, de conformidad a la Acción de personal: GTH-NSP-10657-2019 de`+
     ` ${fecha_inicio_proceso_juicios_nueva}. Agréguese a los autos la documentación precedente. En lo principal, de la Orden de Cobro No. ${orden_cobro_juicios} de ${fecha_oden_cobro_juicios_nueva} y el Título de Crédito No. ${numero_titulo_credito_juicios} de ${fecha_titulo_credito_juicios_nueva},`+
	 ` del que consta la razón de notificación correspondiente, remitidas por el JEFE DE COBRANZA EXTRAJUDICIAL; se desprende que <b>${nombre_clientes}</b>,`+
     ` con cédula de ciudadanía No. <b>${identificacion_clientes}</b>, adeuda a la Corporación Nacional de Telecomunicaciones CNT EP., por la prestación de servicios de Telecomunicaciones, sin que a la fecha haya pagado su obligación. Por cuanto la obligación es determinada y actualmente exigible, de conformidad con lo establecido en el artículo 267 del Código Orgánico Administrativo (COA), dicto la presente`+
     ` <b>ORDEN DE PAGO INMEDIATO</b>, en contra de <b>${nombre_clientes}</b>, con cédula de ciudadanía No. <b>${identificacion_clientes}</b>, disponiendo que pague en la JEFATURA DE COACTIVA, en el término de TRES DÍAS, la cantidad de`+
     ` ${monto_cuantia_letras}, valor al que se sumarán los intereses, honorarios profesionales, derechos y aranceles, gastos procesales y costas judiciales y otros valores adicionales que genere la obligación, hasta la total cancelación de la deuda; o, dimita bienes equivalentes, previniéndole que de no hacerlo se procederá al embargo de bienes. De conformidad a lo previsto en el artículo 281 del Código Orgánico Administrativo (COA), como medidas cautelares, ordeno: a) La retención de los fondos, depósitos e inversiones que el  (la) coactivado (a) mantiene en las entidades del Sistema Financiero, hasta por el valor de`+
     ` <b>${monto_letras}</b>. Para el efecto ofíciese a la Superintendencia de Bancos y Seguros; y, a la Superintendencia de Economía Popular y Solidaria. Las autoridades respectivas comunicarán a esta`+
     ` <b>JEFATURA DE COACTIVA</b>, sobre las cuentas en las que recayeron las retenciones. Designo como Secretaria Abogada Externa a la <b>${secretario}</b>,`+
     ` quién encontrándose presente declara aceptar su cargo y promete cumplir fiel y legalmente sus funciones. Se previene al (a la) coactivado (a), de la obligación de señalar correo electrónico y/o casillero judicial para posteriores notificaciones.-`+
     ` <b>CÚMPLASE OFÍCIESE Y CÍTESE.-</b>`+
    ` &quot; F) Abg. Andrés Albuja. JEFE DE COACTIVA - CNT E.P.- Certifico.</p>`+

    
     `<p style="text-align: left;">Lo que comunico para fines de Ley.</p>`+
 	 `<p style="text-align: left;">Atentamente,</p>`+
 	
	
	// espacios en blanco para las firmas
	`<p style="text-align:justify">&nbsp;</p>`+
	`<p style="text-align:justify">&nbsp;</p>`+
	`<p style="text-align:justify">&nbsp;</p>`+
	
	
	`<p style="text-align:left">${secretario}<br>`+
	`<b>LIVENTSIVAL CIA. LTDA.</b><br>`+
	`<b>SECRETARIA-ABOGADA EXTERNA</b><br>`+
	`<b>JEFATURA DE COACTIVA CNT- E.P.</b></p>`;
	
	CKEDITOR.instances.editor2.setData(formato_1); 
	
	$('#editor2').val(formato_1);
	
    
	}
	
	
	
	
	
 
	  $("#frm_avoco_orden_pago").on("submit",function(event){
	
	   let id_documentos_generados = $("#id_documentos_generados").val();	  
	   let id_juicios = $("#id_juicios").val();
	   let id_clientes = $("#id_clientes").val();
	   let identificacion_clientes = $("#identificacion_clientes").val();
	   let nombre_clientes = $("#nombre_clientes").val();
	   let numero_titulo_credito_juicios = $("#numero_titulo_credito_juicios").val();
	   let fecha_inicio_proceso_juicios = $("#fecha_inicio_proceso_juicios").val();
	   let fecha_auto_pago_juicios = $("#fecha_auto_pago_juicios").val();
	   let valor_retencion_fondos = $("#valor_retencion_fondos").val();
	   
	   
	   CKEDITOR.instances.editor1.updateElement();
	   CKEDITOR.instances.editor2.updateElement();
	   //CKEDITOR.instances.editor3.updateElement();
	   
	   let editor1 = $("#editor1").val();
	   let editor2 = $("#editor2").val();
	   //let editor3 = $("#editor3").val();
		  
	   
	   
	   
	   
	   if(id_juicios == '' || id_juicios == 0){
		   $("#numero_juicios").notify("Ingrese Nº Juicio",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(id_clientes == '' || id_clientes == 0){
		   $("#numero_juicios").notify("Ingrese Nº Juicio",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }

	   if(identificacion_clientes == '' || identificacion_clientes.length < 10){
		   $("#identificacion_clientes").notify("Actualice la cédula en la Matriz Juicios",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   
	   if(nombre_clientes == '' || nombre_clientes.length < 5){
		   $("#nombre_clientes").notify("Actualice los nombres en la Matriz Juicios",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(fecha_inicio_proceso_juicios == '' || fecha_inicio_proceso_juicios.length == 0){
		   $("#fecha_inicio_proceso_juicios").notify("Actualice la fecha inicio proceso en la Matriz Juicios",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   
	   if(fecha_auto_pago_juicios == '' || fecha_auto_pago_juicios.length == 0){
		   $("#fecha_auto_pago_juicios").notify("Actualice la fecha auto págo en la Matriz Juicios",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(valor_retencion_fondos == '' || valor_retencion_fondos == 0){
		   $("#valor_retencion_fondos").notify("Actualice valor de retención en la Matriz Juicios",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	
		
	var parametros = $(this).serialize();
	
	$.ajax({
		beforeSend:null,
		url:"index.php?controller=AvocoOrdenPago&action=InsertAvoco",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(x){
		
		if(x.error != ''){
			
			swal({text: x.error,
		  		  icon: "error",
		  		  button: "Aceptar",
		  		  dangerMode: true
		  		});
		}
		
		if(x.hasOwnProperty('respuesta')){
			
			
			if(x.mensaje=='Documento Actualizado Correctamente'){
				
				

				
				swal({title:"",text:x.mensaje,icon:"success"})
	    		.then((value) => {
	    			
	    			
	    			let loteUrl = x.respuesta;
	    			let urlReporte = "index.php?controller=AvocoOrdenPago&action=Reporte_Documentos_Generados&id_documentos_generados="+loteUrl;
	    			window.open(urlReporte,"_blank");    			
	    			$('#smartwizard').smartWizard("reset");
	    			window.location.href= 'index.php?controller=DocumentosGenerados&action=index5';
	    		});
				
			}else{
				

				
				swal({title:"",text:x.mensaje,icon:"success"})
	    		.then((value) => {
	    			
	    			
	    			let loteUrl = x.respuesta;
	    			let urlReporte = "index.php?controller=AvocoOrdenPago&action=Reporte_Documentos_Generados&id_documentos_generados="+loteUrl;
	    			window.open(urlReporte,"_blank");    			
	    			$('#smartwizard').smartWizard("reset");
	    			window.location.reload();
	    		});
				
				
			}
			
			
			
			
			
			
			
			
		}
		
		console.log(x);
		
	}).fail(function(xhr,status,error){
		
		let err = xhr.responseText
		
		console.log(err);
	})
	
	
	
	event.preventDefault()
})


	$("#frm_avoco_orden_pago").on("click","#btn_cancelar",function(event){
	
		let botonMain = $(this);
		
		botonMain.attr('disabled',true);
		
	
	swal("¿Esta seguro de Cancelar?", {
		 title:"Petición",
		 icon:"info", 
		 dangerMode: true,
		 text:"Se cancelará todo los datos ingresados",
		  buttons: {
		    cancelar: "Cancelar",
		    aceptar: "Aceptar",
		  },
		})
		.then((value) => {
		  switch (value) {
		 
		    case "cancelar":
		      return;
		    case "aceptar":		      
		    	
		    	botonMain.attr('disabled',false);
	    		swal({title:"Petición Cancelada",text:"",icon:"info", dangerMode:true})
	    		.then((value) => {
	    		  window.open("index.php?controller=AvocoOrdenPago&action=index","_self")
	    
		  });
		}
		  
		});
})
