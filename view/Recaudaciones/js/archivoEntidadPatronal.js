$GLOBAL_id_archivo_recaudaciones = 0;
$(document).ready(function(){
	init();
})

function init(){
	 $("body").tooltip({ selector: '[data-toggle=tooltip]' });
	consultaArchivosRecaudacion();
	//consultaArchivos();
	
}

function validaCambioMes(){
	
	let ddlMes = $("#mes_recaudacion");
	let ddlEntidadPatronal = $("#id_entidad_patronal");
	if( $("#mes_recaudacion").val() == 0 ){ddlEntidadPatronal.attr("disabled","true"); ddlEntidadPatronal.val(0)}else{ddlEntidadPatronal.removeAttr("disabled")}
	
}

function validaTipoArchivo(){
	/* not implement yet */
	let ddlEntidadPatronal = $("#id_entidad_patronal");	
	if(ddlEntidadPatronal.val() == 0){
		ddlEntidadPatronal.notify("Seleccione Una entidad",{ position:"buttom left", autoHideDelay: 2000});
	}else{
		/*matriz a devolver opcion 1 o 2 */
		
	}
} 

$("#btnGenerar").on("click",function(){
	
	var $formulario = $("#frm_recaudacion");
	if ( $formulario.data('locked') && $formulario.data('locked') != undefined ){
		console.log("formulario bloaqueado"); return false;
	}
	
	let $entidadPatronal 	= $("#id_entidad_patronal"),
		$anioRecaudacion 	= $("#anio_recaudacion"),
		$mesRecaudacion 	= $("#mes_recaudacion"),
		$formatoRecaudacion	= $("#formato_recaudacion");
	
	if($mesRecaudacion.val() == 0 ){
		$mesRecaudacion.notify("Seleccione Periodo A generar",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	
	if($entidadPatronal.val() == 0 ){
		$entidadPatronal.notify("Seleccione Entidad Patronal",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	
	if($formatoRecaudacion.val() == 0 ){
		$formatoRecaudacion.notify("Seleccione formato aportacion",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	
	var parametros ={id_entidad_patronal:$entidadPatronal.val(),
			anio_recaudacion:$anioRecaudacion.val(),
			mes_recaudacion:$mesRecaudacion.val(),
			formato_recaudacion:$formatoRecaudacion.val(),
			}   
	
	$.ajax({
		beforeSend:function(){ $formulario.data('locked', true); fnBeforeAction('Estamos procesado la informacion') },
		url:"index.php?controller=Recaudacion&action=GenerarRecaudacion",
		type:"POST",
		dataType:"json",
		data:parametros,
		complete:function(xhr,status){ $formulario.data('locked', false); }
	}).done(function(x){
		console.log(x)
		if(x.respuesta == 1){
			
			swal( {
				 title:"ARCHIVO",
				 text: x.mensaje,
				 icon: "success",
				 timer: 2000,
				 button: false,
				});	
			
			let id_archivo = (x.id_archivo != undefined && x.id_archivo > 0 ) ? x.id_archivo : 0;
			$GLOBAL_id_archivo_recaudaciones=id_archivo;
			buscarDatosInsertados(1);
			//buscarDatos();
			consultaArchivosRecaudacion(1);
				
		}
		if(x.respuesta == 2){
			swal( {
				 title:"ARCHIVO",
				 text: x.mensaje,
				 icon: "info",
				 timer: 2000,
				 button: false,
				});
				
			buscarDatos();	
		}
		if(x.respuesta != undefined && x.respuesta == 3){
			swal( {
				title:"ARCHIVO RECAUDACIONES",
				text: "No hay datos para generar el archivo",
				icon: "info"
			   });
		}
		if( x.mensajeAportes != undefined &&  x.mensajeAportes != "" ){
			
			swal.close();
			let modalAportes = $("#mod_participes_sin_aportes");			
			let arrayAportesIncompletos = x.dataAportes;
			let cantidadRegistros		= arrayAportesIncompletos.length;
			let tblParticipesAportes = $("#tbl_participes_sin_aportacion");
			tblParticipesAportes.find("#catidad_sin_aportes").text(cantidadRegistros);
			tblParticipesAportes.find("tbody").html("");
			$.each( arrayAportesIncompletos , function(index, value) {
				
				let $filaAportes = "<tr><td>" + (index + 1) +"</td><td>" +value.cedula_participes +"</td><td>" 
					+value.nombre_participes +"</td><td>" +value.apellido_participes +"</td></tr>";
				tblParticipesAportes.find("tbody").append($filaAportes);	
	  		});			
			modalAportes.modal("show");
			
			//console.log(arrayAportesIncompletos);
		}
		
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		swal.close();
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
	
	event.preventDefault();
})

function buscarDatosInsertados(pagina=1){
	
	/* se hace una consulta a la variable global la cual debe estar seteada antes de llamar el metodo */
	let $id_archivo = $GLOBAL_id_archivo_recaudaciones;
	
	if($id_archivo <= 0){swal({title:"ERROR ARCHIVO",text:"identificador de tabla (datos recaudacion) no encontrado",dangerMode:true}); return false;}
		
	let $busqueda				= $("#mod_txtBuscarDatos_insertados"),
		$modal					= $("#mod_datos_archivo_insertados"),
		$cantidadRegistros		= $("#mod_cantidad_registros_insertados");
	
	let $divResultados = $("#mod_div_datos_recaudacion_insertados");	
	$divResultados.html('');
	
	var parametros ={
		page:pagina,		
		busqueda:$busqueda.val(),
		id_archivo_recaudaciones:$id_archivo
		} 
	
	$.ajax({
		url:"index.php?controller=Recaudacion&action=ConsultaDatosArchivo",
		type:"POST",
		dataType:"json",
		data:parametros,
		complete:function(xhr,status){ toDataTableInsertados(); }
	}).done(function(x){
		console.log(x)
		$divResultados.html(x.tablaHtml);
		$cantidadRegistros.text(x.cantidadRegistros);
		$modal.modal('show');
		
	}).fail(function(xhr,status,error){
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
	
}

function consultaArchivosRecaudacion( pagina=1){	
	
	let $divResultados = $("#div_tabla_archivo_txt");
	$divResultados.html('');
	
	let $ddlEntidadBuscar = $("#ddl_id_entidad_patronal"), $txtAnioBuscar = $("#txt_anio_buscar"), $ddlmesBuscar = $("#ddl_mes_buscar");
	let valEntidad,valAnio,valMes;
	valEntidad = ($ddlEntidadBuscar.val() == 0 || $ddlEntidadBuscar.val() == undefined ) ? 0 : $ddlEntidadBuscar.val();
	valAnio    = ($txtAnioBuscar.val() == "" || $txtAnioBuscar.val() == undefined ) ? 0 : $txtAnioBuscar.val();
	valMes     = ($ddlmesBuscar.val() == 0 || $ddlmesBuscar.val() == undefined ) ? 0 : $ddlmesBuscar.val();
	
	var parametros ={page:pagina,peticion:'ajax',busqueda:"",id_entidad_patronal:valEntidad,anio_recaudacion:valAnio,mes_recaudacion:valMes}
	
	
	$.ajax({
		url:"index.php?controller=Recaudacion&action=ConsultaArchivoRecaudaciones",
		type:"POST",
		dataType:"json",
		data:parametros,
		complete:function(xhr,status){
			setStyleTabla("tbl_documentos_recaudaciones");
		}
	}).done(function(x){
		console.log(x)
		$divResultados.html(x.tablaHtml);	
		
	}).fail(function(xhr,status,error){
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
	
}

function genArchivoDetallado(linkArchivo){
	
	let $link = $(linkArchivo);
	let parametros;
	
	if(parseInt($link.data("idarchivo")) > 0){
		
		parametros = {"id_archivo_recaudaciones":$link.data("idarchivo")}
		
	}else{ return false; }	
	
	$.ajax({
		url:"index.php?controller=Recaudacion&action=genArchivoDetallado",
		type:"POST",
		dataType:"json",
		data:parametros,
		complete:function(xhr,status){}
	}).done(function(x){
		console.log(x)
		if(x.mensaje != undefined && x.mensaje == "archivo generado" ){
			
			swal( {
				 title:"ARCHIVO RECAUDACIONES",
				 dangerMode: false,
				 text: " Archivo generado ",
				 icon: "info"
				})
			var formParametros = {"id_archivo_recaudaciones":$link.data("idarchivo"),"tipo_archivo_recaudaciones":"detalle"};
			var form = document.createElement("form");
		    form.setAttribute("method", "post");
		    form.setAttribute("action", "index.php?controller=Recaudacion&action=descargarArchivo");
		    form.setAttribute("target", "_blank");   
		    
		    for (var i in formParametros) {
		        if (formParametros.hasOwnProperty(i)) {
		            var input = document.createElement('input');
		            input.type = 'hidden';
		            input.name = i;
		            input.value = formParametros[i];
		            form.appendChild(input);
		        }
		    }
		    
		    document.body.appendChild(form); 
		    form.submit();    
		    document.body.removeChild(form);
			
		}
				
	}).fail(function(xhr,status,error){
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
	
	
}

function genArchivoEntidad(linkArchivo){
	
	let $link = $(linkArchivo);
	let parametros;
	
	if(parseInt($link.data("idarchivo")) > 0){
		
		parametros = {"id_archivo_recaudaciones":$link.data("idarchivo")}
		
	}else{ return false; }	
	
	$.ajax({
		url:"index.php?controller=Recaudacion&action=genArchivoEntidad",
		type:"POST",
		dataType:"json",
		data:parametros,
		complete:function(xhr,status){}
	}).done(function(x){
		console.log(x)
		if(x.mensaje != undefined && x.mensaje == "archivo generado" ){
			
			swal( {
				 title:"ARCHIVO RECAUDACIONES",
				 dangerMode: false,
				 text: " Archivo generado ",
				 icon: "info"
				})
			
			var formParametros = {"id_archivo_recaudaciones":$link.data("idarchivo"),"tipo_archivo_recaudaciones":"entidad"};
			var form = document.createElement("form");
		    form.setAttribute("method", "post");
		    form.setAttribute("action", "index.php?controller=Recaudacion&action=descargarArchivo");
		    form.setAttribute("target", "_blank");   
		    
		    for (var i in formParametros) {
		        if (formParametros.hasOwnProperty(i)) {
		            var input = document.createElement('input');
		            input.type = 'hidden';
		            input.name = i;
		            input.value = formParametros[i];
		            form.appendChild(input);
		        }
		    }
		    
		    document.body.appendChild(form); 
		    form.submit();    
		    document.body.removeChild(form);
			
		}
				
	}).fail(function(xhr,status,error){
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
	
	
}

function ValidarEdicionGenerados(linkArchivo){
	
	let $link = $(linkArchivo);
	let parametros;
	
	if(parseInt($link.data("idarchivo")) > 0){
		
		parametros = {"id_archivo_recaudaciones":$link.data("idarchivo")}
		
	}else{ return false; }	
	
	$.ajax({
		url:"index.php?controller=Recaudacion&action=validaDatosGenerados",
		type:"POST",
		dataType:"json",
		data:parametros,
		complete:function(xhr,status){}
	}).done(function(x){
		console.log(x)
		if(x.mensaje != undefined && x.mensaje == "OK" ){
			
			$GLOBAL_id_archivo_recaudaciones=$link.data("idarchivo");
			$("#mod_txtBuscarDatos").val("");
			mostarGenerados();
		}
				
	}).fail(function(xhr,status,error){
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
	
	
}

function mostarGenerados(pagina=1){	
	
	var id_archivo_recaudaciones = $GLOBAL_id_archivo_recaudaciones; //se toma el dato de la variable global la cual de estar seteada antes de empezar funcion 	
	let $divResultados = $("#mod_div_datos_recaudacion"),
		$modal				= $("#mod_datos_archivo"),
		$busqueda			= $("#mod_txtBuscarDatos"),
		$cantidadRegistros	= $("#mod_cantidad_registros");	
	$divResultados.html('');
	
	console.log("DATOS GLOBAL -->"+id_archivo_recaudaciones);
	
	$.ajax({
		url:"index.php?controller=Recaudacion&action=ConsultaDatosEditar",
		type:"POST",
		dataType:"json",
		data:{"id_archivo_recaudaciones":id_archivo_recaudaciones,"page":pagina,"busqueda":$busqueda.val()},
		complete:function(xhr,status){ setStyleTabla("tbl_archivo_recaudaciones"); }
	}).done(function(x){
		console.log("llego aca fn mostrarGenerados");
		console.log(x);
		if(x.tablaHtml != undefined && x.tablaHtml != "" ){
			$divResultados.html(x.tablaHtml);	
			$cantidadRegistros.text(x.cantidadRegistros);
			$modal.modal('show');
		}		
				
	}).fail(function(xhr,status,error){
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
	
	
}

function eliminarRegistro(linkArchivo){
	
	let $link = $(linkArchivo);
	let parametros;
	
	if(parseInt($link.data("idarchivo")) > 0){
		
		parametros = {"id_archivo_recaudaciones":$link.data("idarchivo")}
		
	}else{ return false; }
	
	swal({
		 title: "Eliminar Registro Seleccionado?", 
		 text: "los datos relacionados a este registro se perderan", 
		 type: "warning",		 
		 closeModal: false,
		 buttons: [
		        'No',
		        'Si,Continuar!'
		      ],
	     /*dangerMode: true,*/
	   }).then((isConfirm) => {
	          if (isConfirm) {
	        	  $.ajax({
			      		url:"index.php?controller=Recaudacion&action=eliminarRegistro",
			      		type:"POST",
			      		dataType:"json",
			      		data:parametros,
			      		complete:function(xhr,status){}
			      	}).done(function(x){
			      		console.log(x)
			      		if(x.mensaje != undefined && x.mensaje == "OK" ){			      			
			      			swal({
			      				 title:"RESPUESTA",
			      				 text: "Archivo de datos de la Entidad Patronal han sido eliminados",
			      				 icon: "info"
			      				})
			      				consultaArchivosRecaudacion(1);
			      		}
			      				
			      	}).fail(function(xhr,status,error){
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
			      	});
	            } else {
	              swal("Datos no eliminados");
	            }
      });

	
}

function consultaArchivos( pagina=1,search=""){	
	
	var parametros ={page:pagina,peticion:'ajax',busqueda:search,}
	
	let $divResultados = $("#div_tabla_archivo_txt");
		$divResultados.html('');	
	
	$.ajax({
		url:"index.php?controller=Recaudacion&action=ConsultaArchivosGenerados",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(x){
		console.log(x)
		$divResultados.html(x.tablaHtml);
		setStyleTabla("tbl_documentos_recaudaciones");
		
	}).fail(function(xhr,status,error){
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
	
}



$("#txtBuscarhistorial").on("keyup",function(){
	$valorBuscar = $(this).val();
	consultaArchivos(1,$valorBuscar);
})

function editAporte(ObjLink){
	
	/* fn llamada en lado del controlador */
	/* fn para mostrar la ventana modal para cambiarvalor del archivo */
	
	//ObjLink.preventDefault();	
	let $link = $(ObjLink);
	
	$.ajax({
		url:"index.php?controller=Recaudacion&action=BuscarDatosArchivo",
		type:"POST",
		dataType:"json",
		data:{id_archivo_rcaudaciones_detalle:$link.data("idarchivo")}		
	}).done(function(x){
		
		console.log(x)
		mostrarModalCambioValor(x);
		
	}).fail(function(xhr,status,error){
		let err = xhr.responseText;
		console.log(err);
	});
	
	
}

function mostrarModalCambioValor(objJson){
	
	/* el parametro debe ser objeto json
	 * array de nombre es 'rsRecaudaciones' */
	let $modal	= $("#mod_recaudacion"),
		$array	= objJson.rsRecaudaciones[0],
		$tituloModal	= $modal.find('h4.modal-title');
	
	$tituloModal.text('VALORES APORTES A CAMBIAR');
	
	$modal.find('#mod_cedula_participes').val($array.cedula_participes);
	$modal.find('#mod_nombres_participes').val($array.nombre_participes);
	$modal.find('#mod_apellidos_participes').val($array.apellido_participes);
	$modal.find('#mod_id_archivo_detalle').val($array.id_archivo_recaudaciones_detalle);
	$modal.find('#mod_valor_sistema').val($array.valor_sistema_archivo_recaudaciones_detalle);
	$modal.find('#mod_valor_edit').val($array.valor_final_archivo_recaudaciones_detalle);
	
	$modal.modal("show");
	
}

$("#btnEditRecaudacion").on("click",function(){
	
	let $miboton = $(this);
		$miboton.attr("disabled",true);
	let $modal = $("#mod_recaudacion");
	
	let $idArchivo = $modal.find('#mod_id_archivo_detalle'),
		$valorNuevo = $modal.find('#mod_valor_edit');	
	
	if(isNaN($valorNuevo.val())){
		$valorNuevo.notify("Ingrese Cantidad Valida",{ position:"buttom left", autoHideDelay: 2000});
		$miboton.attr("disabled",false);
		return false;
	}else{
		if($valorNuevo.val() <= 0){
			$valorNuevo.notify("Cantidad no puede ser igual o menor ",{ position:"buttom left", autoHideDelay: 2000});
			$miboton.attr("disabled",false);
			return false;
		}
	}
		
	var parametros = {id_archivo_recaudaciones_detalle:$idArchivo.val(),valor_final_archivo_recaudaciones_detalle:$valorNuevo.val()}
	
	$.ajax({
		url:"index.php?controller=Recaudacion&action=editAporte",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(x){
		//console.log(x)
		$modal.modal('hide');
		//console.log('llego');
		mostarGenerados();	
		swal( {
			 title:"ACTUALIZACION VALOR ARCHIVO",
			 text: x.mensaje,
			 icon: "info"
				})
				
	}).fail(function(xhr,status,error){
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
	}).always(function(){
		$miboton.attr("disabled",false);
	})
	
})

$("#btnDescargar").on("click",function(event){
	
	swal({
        title: "ARCHIVO RECAUDACION",
        text: "Se procedera a generar el archivo",
        icon: "warning",
        buttons: true,
      })
      .then((willContinue) => {
        if (willContinue) {
        	
        	DescargaArchivo();
        	
        } else {
        	swal.close();
        }
      }); 
	
})

function DescargaArchivo(){
	
	let $entidadPatronal 	= $("#id_entidad_patronal"),
	$anioRecaudaciones 		= $("#anio_recaudacion"),
	$mesRecaudaciones 		= $("#mes_recaudacion"),
	$formatoRecaudacion		= $("#formato_recaudacion");       	
	
	var parametros ={
		id_entidad_patronal:$entidadPatronal.val(),
		anio_recaudaciones:$anioRecaudaciones.val(),
		mes_recaudaciones:$mesRecaudaciones.val(),
		formato_recaudaciones:$formatoRecaudacion.val()
		} 
	

	$.ajax({
		beforeSend:fnBeforeAction("Estamos procesando Archivo"),
		url:"index.php?controller=Recaudacion&action=GeneraArchivo",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(x){
		console.log(x)    		
		swal( {
				 title:"RECAUDACIONES",
				 text: "Archivo generado",
				 icon: "success"
				});
		
		consultaArchivos();
				
	}).fail(function(xhr,status,error){
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
	});   	
		
	
}


function verArchivo(linkArchivo){

	//objeto link
	let $link = $(linkArchivo);
	let parametros;
	
	if(parseInt($link.data("idarchivo")) > 0){
		
		parametros = {"id_archivo_recaudaciones":$link.data("idarchivo")}
		
	}else{ return false; }	
	
	var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "index.php?controller=Recaudacion&action=descargarArchivo");
    form.setAttribute("target", "_blank");   
    
    for (var i in parametros) {
        if (parametros.hasOwnProperty(i)) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = i;
            input.value = parametros[i];
            form.appendChild(input);
        }
    }
    
    document.body.appendChild(form); 
    form.submit();    
    document.body.removeChild(form);
}

function fnBeforeAction(mensaje){
	/*funcion que se ejecuta antes de realizar peticion ajax*/
	swal({
        title: "RECAUDACIONES",
        text: mensaje,
        icon: "view/images/ajax-loader.gif",        
      })
}


function setStyleTabla(ObjTabla){
	
	//objetoTabla.dataTable().fnDestroy();
	if ( ! $.fn.DataTable.isDataTable( "#"+ObjTabla) ) {
		var objetoTabla = $("#"+ObjTabla);
		objetoTabla.DataTable({
			scrollY: '50vh',
			/*"scrollX": true,*/
			"scrollCollapse": true,
			"ordering":false,
			"paging":false,
			"searching":false,
			"info":false
			});
	}	
			
 }

function toDataTableInsertados(){
	/*verificar el nombre de la tabla a dar formato*/
	if ( ! $.fn.DataTable.isDataTable( "#tbl_archivo_recaudaciones_insertados" ) ) {
		var objetoTabla = $("#tbl_archivo_recaudaciones_insertados");
		objetoTabla.DataTable({
			scrollY: '50vh',
			/*"scrollX": true,*/
			"scrollCollapse": true,
			"ordering":false,
			"paging":false,
			"searching":false,
			"info":false
			});
	}	
}

function toDataTableInsertados(nombreTabla){
	/*verificar el nombre de la tabla a dar formato*/
	var tabla = $("#");
	if ( ! $.fn.DataTable.isDataTable( "#"+ObjTabla) ) {
		var objetoTabla = $("#"+ObjTabla);
		objetoTabla.DataTable({
			scrollY: '50vh',
			/*"scrollX": true,*/
			"scrollCollapse": true,
			"ordering":false,
			"paging":false,
			"searching":false,
			"info":false
			});
	}	
}

function toDataTableInsertados(){
	/*verificar el nombre de la tabla a dar formato*/
	if ( ! $.fn.DataTable.isDataTable( "#tbl_documentos_recaudaciones" ) ) {
		var objetoTabla = $("#tbl_documentos_recaudaciones");
		objetoTabla.DataTable({
			scrollY: '50vh',
			/*"scrollX": true,*/
			"scrollCollapse": true,
			"ordering":false,
			"paging":false,
			"searching":false,
			"info":false
			});
	}	
}
