$(document).ready(function(){
	
	// creo editor de texto
	CKEDITOR.replace('editor1')
	CKEDITOR.replace('editor2')
	CKEDITOR.replace('editor3')
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
	var fecha_auto_pago_juicios;
	var valor_retencion_fondos;
	var fecha_inicio_proceso_juicios;
	var secretario;
    var valorLetras = 0;

    var f=new Date();
	var dia = f.getDate();
	var hora = f.getHours();
	var minutos = f.getMinutes();
    var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
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
   
    
    
    
    
    
    
    
    
    
    
    

	$("#numero_juicios" ).autocomplete({
	 source: 'index.php?controller=Avoco&action=AutocompleteNumeroJuicio',
	  	minLength: 1
	 });
	                    		
	$("#numero_juicios").focusout(function(){
	                    					
	$.ajax({
	url:'index.php?controller=Avoco&action=AutocompleteDevuelveDatos',
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
	
	
	secretario =  respuesta.secretarios;                   						
	
	
	formato_avoco();
	formato_oficio_1();
	formato_oficio_2();
	
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
		
		$("#aplicar").attr({disabled:true});
		secretario =  ""; 
		
		console.log(xhr.responseText)
		   						                    						
	});
	                    					
	});






	function formato_avoco(){
	
	var formato="";
	 numero_juicios=$('#numero_juicios').val();
	 identificacion_clientes=$('#identificacion_clientes').val();
	 nombre_clientes=$('#nombre_clientes').val();
	 numero_titulo_credito_juicios=$('#numero_titulo_credito_juicios').val();
	 fecha_auto_pago_juicios=$('#fecha_auto_pago_juicios').val();
	 valor_retencion_fondos=$('#valor_retencion_fondos').val();
	 fecha_inicio_proceso_juicios=$('#fecha_inicio_proceso_juicios').val();
	
	
	convertir_a_letras(valor_retencion_fondos);
	var monto_letras =  valorLetras;
	
	
    separadores = ['-','/'],
    textoseparado = fecha_auto_pago_juicios.split (new RegExp (separadores.join('|'),'g'));
    textoseparado1 = fecha_inicio_proceso_juicios.split (new RegExp (separadores.join('|'),'g'));
    
    
    // capturo la fecha actual en letras
     fecha_actual = diasSemana[f.getDay()] + ", " + dia + " de " + meses[f.getMonth()] + " del " + f.getFullYear() + ", las " + hora + "H" + minutos;
     fecha_razon = diasSemana[fecha.getDay()] + ", " + dia_razon + " de " + meses[fecha.getMonth()] + " del " + fecha.getFullYear();
     fecha_auto_pago_nueva = textoseparado[2] + " de " + meses[textoseparado[1]-1] + " del " + textoseparado[0];
     fecha_inicio_proceso_juicios_nueva  = textoseparado1[2] + " de " + meses[textoseparado1[1]-1] + " del " + textoseparado1[0];
   
    
	// vacio el texto
	$('#editor1').val("");
	
	formato = `<p style="text-align: center;"><b>JUICIO COACTIVO No. ${numero_juicios}</b></p>`+

//	`<p style="text-align:justify">&nbsp;</p>`+

	`<p style="text-align: justify;"><b>CORPORACIÓN NACIONAL DE TELECOMUNICACIONES - CNT EP. - JEFATURA DE COACTIVA.-</b> Quito, ${fecha_actual}`+
	` Vistos. - Avoco conocimiento en la calidad en que suscribo en conformidad con la acción de personal No. ${numero_juicios}`+
	 ` de ${fecha_inicio_proceso_juicios_nueva}. El presente proceso coactivo se tramitará de acuerdo a lo previsto en la Segunda Disposición Transitoria del`+
	 ` Código Orgánico Administrativo (COA), que textualmente dice: <em><b>"SEGUNDA.-</b> Los procedimientos que se encuentran en trámite a la fecha de`+
	 ` vigencia de este Código, continuarán sustanciándose hasta su conclusión conforme con la normativa vigente al momento de su inicio<b>"</b></em>.`+
     ` Designo como Secretaria Abogada Externa a la ${secretario}, quien encontrándose presente, declara aceptar su cargo y`+
     ` promete cumplir fiel y legalmente sus funciones.- En lo principal se dispone: <b>1.-</b>  Cúmplase con todo lo actuado en Auto de Pago de`+
     ` fecha ${fecha_auto_pago_nueva}, ordenado en contra de <b>${nombre_clientes}, con cédula de ciudadanía No. ${identificacion_clientes},`+
     ` además dicto en su contra las siguientes medidas cautelares ampliatorias: a).-</b> La retención de fondos, depósitos  o cualquier`+
     ` otro tipo de inversiones que la coactivada mantiene en las entidades del Sistema Financiero, Cooperativas, hasta por el`+
     ` monto de <b>${monto_letras}</b>, para dicho efecto`+
     ` remítase atento oficio a la Superintendencia de Bancos y a la Superintendencia de Economía Popular y Solidaria, para`+
     ` su cumplimiento inmediato, entidades que informarán a esta Jefatura sobre las retenciones realizadas; <b>b).-</b> Ofíciese al`+
     ` señor Director Ejecutivo de la Agencia Nacional de Regulación del Transporte Terrestre, Tránsito y Seguridad Vial,`+
     ` a fin de que inscriba la prohibición de enajenar sobre los vehículos que tenga o llegare a obtener el coactivado <b>${nombre_clientes},`+
     ` con cédula de ciudadanía No. ${identificacion_clientes}</b> y dispongan a quien corresponda, que un plazo de ocho días, certifiquen sobre los vehículos registrados a su nombre.-`+
     ` <b>c).-</b> En atención a la disposición del artículo 9 de la Ley Orgánica de Servicio Público, referente a la inhabilidad por mora`+
     ` para el ingreso al servicio público, y retirada en el artículo 7 del Reglamento General, infórmese al Ministerio de Trabajo`+
     ` que la señora <b>${nombre_clientes}, con cédula de ciudadanía No. ${identificacion_clientes}</b>, mantiene obligaciones en mora con esta`+
     ` entidad de control, en tal virtud ofíciese al Ministerio de Trabajo a fin de que se registre en los archivos a su cargo`+
     ` el impedimento para ejercer cargo público; y más datos generales.- <b>CÚMPLASE Y OFÍCIESE.-</b></p>`+

	
	
	// espacios en blanco para las firmas
	`<p style="text-align:justify">&nbsp;</p>`+
	`<p style="text-align:justify">&nbsp;</p>`+
	
	
	
	`<p style="text-align:left">Abogado<br>`+
	`Andrés Abuja Tintín<br>`+
	`<b>JEFE DE COACTIVA</b><br>`+
	`<b>CORPORACIÓN NACIONAL DE TELECOMUNICACIONES - CNT EP.</b></p>`+
	
	// espacios en blanco para la razòn
	`<p style="text-align:justify">&nbsp;</p>`+

			
	 
	`<b>Razón:</b> Quito, ${fecha_razon}, no se notifica la providencia que antecede ya que el coactivado,`+
	` no ha cumplido con su obligación de señalar correo electrónico.- <b>CERTIFICO.-</b>`+


	
	// espacios en blanco para las firmas
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
			url:'index.php?controller=Avoco&action=Convierte_a_Letras',
			type:'POST',
			async: false,
			data:{valor:valor}
			}).done(function(respuesta){			                  		
				valorLetras = respuesta.trim();			
			
			}).fail(function(xhr,status, error) {
			    
				console.log(xhr.responseText)
				   						                    						
			});
	}
	
	
	
	
	/// para oficios


	function formato_oficio_1(){
	
	var formato_1="";
	var monto_letras =  valorLetras;
	
	
	// vacio el texto
	$('#editor2').val("");
	
	formato_1 = 
	`<p style="text-align: left;">Oficio No. ${numero_juicios}</p>`+
	`<p style="text-align: left;">D.M. de Quito, a ${fecha_razon}</p>`+
	`<p style="text-align: left;">Señor</p>`+
	
	`<p style="text-align:left"><b>SUPERINTENDENTE DE BANCOS<br>`+
	`SUPERINTENDENCIA DE ECONOMÍA POPULAR Y SOLIDARIA<br>`+
	`DIRECTOR EJECUTIVO DE LA AGENCIA NACIONAL DE TRANSPORTE TERRESTRE, TRÁNSITO Y SEGURIDAD VIAL<br>`+
	`Presente.-</p>`+
	
	`<p style="text-align: left;">De mi consideración:</p>`+
	
	`<p style="text-align: justify;">Por medio del presente, pongo en su conocimiento que dentro del Juicio Coactivo No. <b>${numero_juicios}</b>`+
	 ` en contra de <b>${nombre_clientes}, con cédula de ciudadanía No. ${identificacion_clientes}</b>, se ha dictado la siguiente providencia:</p>`+
	 `<p style="text-align: justify;">&quot;..En lo principal se dispone: <b>1.-</b>  Cúmplase con todo lo actuado en Auto de Pago de`+
     ` fecha ${fecha_auto_pago_nueva},`+
	 ` ordenado en contra de <b>${nombre_clientes}, con cédula de ciudadanía No. ${identificacion_clientes},`+
     ` además dicto en su contra las siguientes medidas cautelares ampliatorias: a).-</b> La retención de fondos, depósitos  o cualquier`+
     ` otro tipo de inversiones que la coactivada mantiene en las entidades del Sistema Financiero, Cooperativas, hasta por el`+
     ` monto de <b>${monto_letras}</b>, para dicho efecto`+
     ` remítase atento oficio a la Superintendencia de Bancos y a la Superintendencia de Economía Popular y Solidaria, para`+
     ` su cumplimiento inmediato, entidades que informarán a esta Jefatura sobre las retenciones realizadas; <b>b).-</b> Ofíciese al`+
     ` señor Director Ejecutivo de la Agencia Nacional de Regulación del Transporte Terrestre, Tránsito y Seguridad Vial,`+
     ` a fin de que inscriba la prohibición de enajenar sobre los vehículos que tenga o llegare a obtener el coactivado <b>${nombre_clientes},`+
     ` con cédula de ciudadanía No. ${identificacion_clientes}</b> y dispongan a quien corresponda, que un plazo de ocho días, certifiquen sobre los vehículos registrados a su nombre.-`+
     ` <b>c).-</b> En atención a la disposición del artículo 9 de la Ley Orgánica de Servicio Público, referente a la inhabilidad por mora`+
     ` para el ingreso al servicio público, y retirada en el artículo 7 del Reglamento General,`+
     ` que la señora <b>${nombre_clientes}, con cédula de ciudadanía No. ${identificacion_clientes}</b>, mantiene obligaciones en mora con esta`+
     ` entidad de control, en tal virtud ofíciese al Ministerio de Trabajo a fin de que se registre en los archivos a su cargo`+
     ` el impedimento para ejercer cargo público; y más datos generales.- <b>CÚMPLASE Y OFÍCIESE.-</b> " F) Abg. Andrés Albuja.  JEFE DE COACTIVA - CNT E.P.- Certifico.</p>`+

     `<p style="text-align: left;">Lo que comunico para fines de Ley.</p>`+
 	 `<p style="text-align: left;">Atentamente,</p>`+
 	
	
	// espacios en blanco para las firmas
	`<p style="text-align:justify">&nbsp;</p>`+
	`<p style="text-align:justify">&nbsp;</p>`+
	
	
	`<p style="text-align:left">${secretario}<br>`+
	`<b>LIVENTSIVAL CIA. LTDA.</b><br>`+
	`<b>SECRETARIA-ABOGADA EXTERNA</b><br>`+
	`<b>JEFATURA DE COACTIVA CNT- E.P.</b></p>`;
	
	CKEDITOR.instances.editor2.setData(formato_1); 
	
	$('#editor2').val(formato_1);
	
    
	}
	
	
	
	
	
	
	
	
	function formato_oficio_2(){
		
		var formato_2="";
		var monto_letras =  valorLetras;
		
		
		// vacio el texto
		$('#editor3').val("");
		
		formato_2 = 
		`<p style="text-align: left;">Oficio No. ${numero_juicios}</p>`+
		`<p style="text-align: left;">D.M. de Quito, a ${fecha_razon}</p>`+
		`<p style="text-align: left;">Señor</p>`+
		
		`<p style="text-align:left"><b>MINISTRO DEL TRABAJO<br>`+
		`DIRECTOR NACIONAL DE REGISTRO CIVIL<br>`+
		`CONSEJO NACIONAL ELECTORAL<br>`+
		`Presente.-</p>`+
		
		`<p style="text-align: left;">De mi consideración:</p>`+
		
		`<p style="text-align: justify;">Por medio del presente, pongo en su conocimiento que dentro del Juicio Coactivo No. <b>${numero_juicios}</b>`+
		 ` en contra de <b>${nombre_clientes}, con cédula de ciudadanía No. ${identificacion_clientes}</b>, se ha dictado la siguiente providencia:</p>`+
		 `<p style="text-align: justify;">&quot;..En lo principal se dispone: <b>1.-</b>  Cúmplase con todo lo actuado en Auto de Pago de`+
	     ` fecha ${fecha_auto_pago_nueva},`+
		 ` ordenado en contra de <b>${nombre_clientes}, con cédula de ciudadanía No. ${identificacion_clientes},`+
	     ` además dicto en su contra las siguientes medidas cautelares ampliatorias: a).-</b> La retención de fondos, depósitos  o cualquier`+
	     ` otro tipo de inversiones que la coactivada mantiene en las entidades del Sistema Financiero, Cooperativas, hasta por el`+
	     ` monto de <b>${monto_letras}</b>, para dicho efecto`+
	     ` remítase atento oficio a la Superintendencia de Bancos y a la Superintendencia de Economía Popular y Solidaria, para`+
	     ` su cumplimiento inmediato, entidades que informarán a esta Jefatura sobre las retenciones realizadas; <b>b).-</b> Ofíciese al`+
	     ` señor Director Ejecutivo de la Agencia Nacional de Regulación del Transporte Terrestre, Tránsito y Seguridad Vial,`+
	     ` a fin de que inscriba la prohibición de enajenar sobre los vehículos que tenga o llegare a obtener el coactivado <b>${nombre_clientes},`+
	     ` con cédula de ciudadanía No. ${identificacion_clientes}</b> y dispongan a quien corresponda, que un plazo de ocho días, certifiquen sobre los vehículos registrados a su nombre.-`+
	     ` <b>c).-</b> En atención a la disposición del artículo 9 de la Ley Orgánica de Servicio Público, referente a la inhabilidad por mora`+
	     ` para el ingreso al servicio público, y retirada en el artículo 7 del Reglamento General, infórmese al Ministerio de Trabajo`+
	     ` que la señora <b>${nombre_clientes}, con cédula de ciudadanía No. ${identificacion_clientes}</b>, mantiene obligaciones en mora con esta`+
	     ` entidad de control, en tal virtud ofíciese al Ministerio de Trabajo a fin de que se registre en los archivos a su cargo`+
	     ` el impedimento para ejercer cargo público;`+
	     
	     ` <b>2.-</b> Remítase atento oficio al Consejo Nacional Electoral a fin que certifique la información suficiente respecto del domicilio actual, del coactivado <b>${nombre_clientes},`+
         ` con cédula de ciudadanía No. ${identificacion_clientes}</b>, y más datos generales;`+
         
         ` <b>3.-</b> Remítase atento oficio a la Dirección General del Registro Civil a fin que certifique datos filiales, del coactivado <b>${nombre_clientes},`+
         ` con cédula de ciudadanía No. ${identificacion_clientes}</b>, y más datos generales;`+
        
         ` <b>4.-</b> Remítase atento oficio con el fin de que indique si el coactivado <b>${nombre_clientes},`+
         ` con cédula de ciudadanía No. ${identificacion_clientes}</b>, salió del país o consta en el registro consular, si se verifica que es así.-`+
	      
	      
	     ` <b>CÚMPLASE Y OFÍCIESE.-</b> " F) Abg. Andrés Albuja.  JEFE DE COACTIVA - CNT E.P.- Certifico.</p>`+

	     `<p style="text-align: left;">Lo que comunico para fines de Ley.</p>`+
	 	 `<p style="text-align: left;">Atentamente,</p>`+
	 	
		
		// espacios en blanco para las firmas
		`<p style="text-align:justify">&nbsp;</p>`+
		`<p style="text-align:justify">&nbsp;</p>`+
		
		
		`<p style="text-align:left">${secretario}<br>`+
		`<b>LIVENTSIVAL CIA. LTDA.</b><br>`+
		`<b>SECRETARIA-ABOGADA EXTERNA</b><br>`+
		`<b>JEFATURA DE COACTIVA CNT- E.P.</b></p>`;
		
		CKEDITOR.instances.editor3.setData(formato_2); 
		
		$('#editor3').val(formato_2);
		
	    
		}
	
 
	  $("#frm_avoco").on("submit",function(event){
	
	   let id_juicios = $("#id_juicios").val();
	   let id_clientes = $("#id_clientes").val();
	   let identificacion_clientes = $("#identificacion_clientes").val();
	   let nombre_clientes = $("#nombre_clientes").val();
	   let numero_titulo_credito_juicios = $("#numero_titulo_credito_juicios").val();
	   let fecha_inicio_proceso_juicios = $("#fecha_inicio_proceso_juicios").val();
	   let fecha_auto_pago_juicios = $("#fecha_auto_pago_juicios").val();
	   let valor_retencion_fondos = $("#valor_retencion_fondos").val();
	   let editor1 = $("#editor1").val();
	   let editor2 = $("#editor2").val();
	   let editor3 = $("#editor3").val();
		  
	   
	   
	   
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
		url:"index.php?controller=Avoco&action=InsertAvoco",
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
			
			swal({title:"",text:x.mensaje,icon:"success"})
    		.then((value) => {
    			
    			
    			let loteUrl = x.respuesta;
    			let urlReporte = "index.php?controller=Avoco&action=Reporte_Documentos_Generados&id_documentos_generados="+loteUrl;
    			window.open(urlReporte,"_blank");    			
    			$('#smartwizard').smartWizard("reset");
    			window.location.reload();
    		});
			
		}
		
		console.log(x);
		
	}).fail(function(xhr,status,error){
		
		let err = xhr.responseText
		
		console.log(err);
	})
	
	
	
	event.preventDefault()
})


	$("#frm_avoco").on("click","#btn_cancelar",function(event){
	
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
	    		  window.open("index.php?controller=Avoco&action=index","_self")
	    
		  });
		}
		  
		});
})
