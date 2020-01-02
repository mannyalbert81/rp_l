<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Capremci</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
      
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
   <?php include("view/modulos/links_css.php"); ?>
   <link href="//oss.maxcdn.com/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css" rel="stylesheet"></link
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
  
    
   
  </head>

  <body class="hold-transition skin-blue fixed sidebar-mini">

 <?php  $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
  ?>
    
    
    <div class="wrapper">

  <header class="main-header">
  
      <?php include("view/modulos/logo.php"); ?>
      <?php include("view/modulos/head.php"); ?>	
    
  </header>

   <aside class="main-sidebar">
    <section class="sidebar">
     <?php include("view/modulos/menu_profile.php"); ?>
      <br>
     <?php include("view/modulos/menu.php"); ?>
    </section>
  </aside>

  <div class="content-wrapper">
   		<section class="content-header">
            <h1>
            
            	<small><?php echo $fecha; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Usuarios</li>
            </ol>
        </section>
        
        <!-- comienza diseño controles usuario -->
        
        <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Registrar Compras</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            <form id="frm_guardacompra" action="<?php echo $helper->url("MovimientosInv","insertacompra"); ?>" method="post" >
                 <div class="box-body">
            
                
          		 	 
              		 	 <div class="row">
              		 	 
              		 	 	<div class="col-xs-6 col-md-3 col-lg-3 ">
                            	<div class="form-group">
                                	<label for="numero_compra" class="control-label">Digite CI/Nombre Proveedor:</label>
                                    <input type="text" class="form-control" id="proveedor" name="proveedor" value=""  >
                                    <input type="hidden" id="id_proveedor" name="id_proveedor" value=""  >
                                    <input type="hidden"  id="cantidad_compra" name="cantidad_compra" value="0"  >
                                    <div id="mensaje_proveedor" class="errores"></div>
                                 </div>
                             </div> 
                             
                             <div class="col-xs-6 col-md-3 col-lg-3 ">
                            	<div class="form-group" id="datos_proveedor" style="display:none;">
                                	<label for="numero_compra" class="control-label">Proveedor:</label>
                                    <input type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor" value=""  >                                   
                                    <div id="mensaje_proveedor" class="errores"></div>
                                 </div>
                             </div> 
                             
                         </div>
              		 	 
              		 	  <div class="row">	                            
                             <div class="col-xs-6 col-md-3 col-lg-3 ">
                            	<div class="form-group">
                                	<label for="fecha_compra" class="control-label">Fecha Compra:</label>
                                    <input type="text" class="form-control" id="fecha_compra" name="fecha_compra" value=""  >
                                    <div id="mensaje_fecha_compra" class="errores"></div>
                                 </div>
                             </div>
                             
                             <div class="col-xs-6 col-md-3 col-lg-3 ">
                            	<div class="form-group">
                                	<label for="numero_factura_compra" class="control-label">No Factura:</label>
                                    <input type="text" class="form-control" id="numero_factura_compra" name="numero_factura_compra" value=""  placeholder="no. factura.." >
                                    <div id="mensaje_numero_factura" class="errores"></div>
                                 </div>
                             </div> 
                             
                             <div class="col-xs-6 col-md-3 col-lg-3 ">
                            	<div class="form-group">
                                	<label for="numero_autorizacion_factura" class="control-label">No Autorización:</label>
                                    <input type="text" class="form-control" id="numero_autorizacion_factura" name="numero_autorizacion_factura" value="" maxlength="50" placeholder="autorizacion" >
                                    <div id="mensaje_autorizacion_factura" class="errores"></div>
                                 </div>
                             </div>
                             
                             <div class="col-xs-6 col-md-3 col-lg-3 ">
                            	<div class="form-group">
                                	<label for="estado_compra" class="control-label">Estado:</label>
                                	<select id="estado_compra" name="estado_compra" class="form-control">
                                		<option value="PENDIENTE">PENDIENTE</option>
                                		<option value="PAGADA">PAGADA</option>
                                		
                                	</select>                                    
                                    <div id="mensaje_estado_compras" class="errores"></div>
                                 </div>
                             </div> 
                             
                             
                          </div>
                          
                         <div class="row">
                         	<div class="col-md-12 col-lg-12 col-xs-12">
                                <div class="pull-right">
                                	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#agregar_nuevo">
                						<span class="fa  fa-plus"></span> Agregar Detalle
              						</button>
                                	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#mod_agregar_producto">
                            			<span class="fa fa-pencil-square"></span> Registrar Producto
                          			</button>
                                   
                                </div>	
    						</div>
                         </div>
                         
        			</div>
      			
      		 </div>
    		</section>
    		
    		<section class="content">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Detalles Compra</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fa fa-minus"></i></button>
                    
                  </div>
                </div>
                
                <div class="box-body">             
                	
                    <span style="float:right">
                    	
                    	
              		</span>
              	</div>
                	
                 <div class="box-body">
                      <div id="resultados" ></div>
                      
                      <!-- parte inferior de subtotales -->
                      <div class="row pull-left" id="resultados_totales">
                      	
                      </div>
                          
                          <div class="row">
            			    <div class="col-xs-12 col-md-12 col-md-12 " style="margin-top:15px;  text-align: center; ">
                	   		    <div class="form-group">
            	                  <button type="submit" form="frm_guardacompra" id="Guardar" name="Guardar" class="btn btn-success">GUARDAR</button>
            	                  <a class="btn btn-danger" href="<?php  echo $helper->url("MovimientosInv","cancelarcompra"); ?>">CANCELAR</a>
        	                    </div>
    	        		    </div>
    	        		    
            		    </div>
                   </div>
                
                </form>
                </div>
            </section>
    		
    		
    		
    		
     
    	
    
  </div>
  
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
 
 <!-- para los modales -->
 
<div class="modal fade" id="agregar_nuevo">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Default Modal</h4>
          </div>
          <div class="modal-body">
          	<div class="pull-right" style="margin-right:15px;">
				<input type="text" value="" class="form-control" id="search_productos" name="search_productos" onkeyup="load_productos(1)" placeholder="search.."/>
			</div>
          	
			<div id="load_productos_registrados" ></div>	
			<div id="productos_registrados"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="mod_agregar_producto">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">AGREGAR PRODUCTO</h4>
          </div>
          <div class="modal-body">
          <!-- empieza el formulario modal productos -->
          	<form class="form-horizontal" method="post" id="frm_guardar_producto" name="frm_guardar_producto">
          	
          	<div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Grupos:</label>
				<div class="col-sm-8">
				 <select class="form-control" id="mod_id_grupo" name="mod_id_grupo" required>
					<option value="0">-- Selecciona estado --</option>					
				  </select>
				</div>
			  </div>
			 
			 <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Bodega:</label>
				<div class="col-sm-8">
				 <select class="form-control" id="mod_id_bodegas" name="mod_id_bodegas" required>
					<option value="0">-- Selecciona Bodega --</option>					
				  </select>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Unidad Medida</label>
				<div class="col-sm-8">
				 <select class="form-control" id="mod_unidad_medida" name="mod_unidad_medida" required>
					<option value="0">-- Selecciona estado --</option>					
				  </select>
				</div>
			  </div>
			  	
			  <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Código</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_codigo_producto" name="mod_codigo_producto" placeholder="Código del producto" required>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Marca</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="mod_marca_producto" name="mod_marca_producto" placeholder="Código del producto" required>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="mod_nombre_producto" name="mod_nombre_producto" placeholder="Nombre del producto" required maxlength="20" ></textarea>
				  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Descripcion</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="mod_descripcion_producto" name="mod_descripcion_producto" placeholder="Descripcion del producto" required maxlength="20" ></textarea>
				  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Ult. precio</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="mod_precio_producto" name="mod_precio_producto" placeholder="Precio de venta del producto" maxlength="10" required  title="Ingresa sólo números con 0 ó 2 decimales" />
				  
				</div>
			  </div>
			  
          	</form>
          	<!-- termina el formulario modal productos -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" form="frm_guardar_producto" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
</div>
     
   <?php include("view/modulos/links_js.php"); ?>
 
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="view/bootstrap/otros/uitable/bootstable.js"></script>
  
  <script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
  
  <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.js"></script>    
     <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
     <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.numeric.extensions.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    
    <script src="//oss.maxcdn.com/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
    
    <!-- <script src="view/bootstrap/otros/validate/jquery.validate.js"></script> -->
    <script src="view/bootstrap/otros/inventario/compras.js?2.0"></script> 
   
  
   
   <!-- para el autocompletado -->
    


             
 	
  </body>
</html>

 