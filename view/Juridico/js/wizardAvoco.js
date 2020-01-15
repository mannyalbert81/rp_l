$(document).ready(function(){
	 
	var formulario = $('#smartwizard').smartWizard({
        selected: 0,  // Initial selected step, 0 = first step 
        keyNavigation:true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
        autoAdjustHeight:true, // Automatically adjust content height
        cycleSteps: false, // Allows to cycle the navigation of steps
        backButtonSupport: true, // Enable the back button support
        useURLhash: true, // Enable selection of the step based on url hash
        lang: {  // Language variables
            next: 'Siguiente', 
            previous: 'Anterior'
        },
        toolbarSettings: {
            toolbarPosition: 'bottom', // none, top, bottom, both
            toolbarButtonPosition: 'right', // left, right
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button
            toolbarExtraButtons: [
									      
		        $('<button></button>').text('Guardar')
						      .addClass('btn btn-success')
						      .attr({ 
						    	  id:"aplicar",name:"aplicar",type:"submit", form:"frm_avoco",
						    	  disabled:true
						    	  })						    	  
						      .append("<i class=\"fa \" aria-hidden=\"true\" ></i>"),
				$('<button></button>').text('Cancelar')
						      .addClass('btn btn-primary')
						      .attr({type:"button",id:"btn_cancelar",name:"btn_cancelar"})
						     
                  ]
        }, 
        anchorSettings: {
            anchorClickable: true, // Enable/Disable anchor navigation
            enableAllAnchors: false, // Activates all anchors clickable all times
            markDoneStep: true, // add done css
            enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
        },            
        contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
        disabledSteps: [],    // Array Steps disabled
        errorSteps: [],    // Highlight step with errors
        theme: 'dots',
        transitionEffect: 'fade', // Effect on navigation, none/slide/fade
        transitionSpeed: '400'
  });
	
	
	formulario.on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
		
		//console.log(stepDirection);
		if(stepNumber==0){
			
			return validaPaso1();
		}
		if(stepNumber==1){
			
			return validaPaso2();
			
		}
      /*if(stepNumber==2){
			
			return validaPaso3();
			
		}*/
    });
	
	
	/*formulario.on("showStep", function(e, anchorObject, stepNumber) {
		if(stepNumber==2){
			$("#btn_distribucion").attr({disabled:false});
			$("#aplicar").attr({disabled:false});
			
			if( typeof resultadosCompra !== 'undefined' && jQuery.isFunction( resultadosCompra ) ) {
			    
				resultadosCompra();
			}
		}
	});*/

    
   function validaPaso1(){
	   
	   let id_juicios = $("#id_juicios").val();
	   let identificacion_clientes = $("#identificacion_clientes").val();
	   let nombre_clientes = $("#nombre_clientes").val();
	   let numero_titulo_credito_juicios = $("#numero_titulo_credito_juicios").val();
	   let fecha_inicio_proceso_juicios = $("#fecha_inicio_proceso_juicios").val();
	   let fecha_auto_pago_juicios = $("#fecha_auto_pago_juicios").val();
	   let valor_retencion_fondos = $("#valor_retencion_fondos").val();
	   let editor1 = $("#editor1").val();
	   let editor2 = $("#editor2").val();
	   //let editor3 = $("#editor3").val();
		  
	   
	   
	   
	   if(id_juicios == '' || id_juicios == 0){
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
	   
		$("#aplicar").attr({disabled:true});
		
		   
	   return true;
   }
   
   function validaPaso2(){
	   
	
	   if(editor1 == '' || editor1.length == 0){
		   $("#editor1").notify("Ingrese Texto para la Providencia",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	  
		$("#aplicar").attr({disabled:false});
		
		   
	   return true;
   }
   
   /*
   function validaPaso3(){
	   
		
	   if(editor2 == '' || editor2.length == 0){
		   $("#editor2").notify("Ingrese Texto para el Primer Oficio",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   
	 	$("#aplicar").attr({disabled:false});
		
	   
	   
	  
	   return true;
   }*/
	
})

