<!DOCTYPE html>
<html lang="en">
  <head>
   <script lang=javascript src="view/Contable/FuncionesJS/xlsx.full.min.js"></script>
   <script lang=javascript src="view/Contable/FuncionesJS/FileSaver.min.js"></script>
    
    
  
   
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Liventy</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">  
      
   <?php include("view/modulos/links_css.php"); ?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="view/bootstrap/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    
   
  </head>

  <body class="hold-transition skin-blue fixed sidebar-mini">

 <?php  $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        $DateString = (string)$fecha;
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
              <h3 class="box-title">Registrar Juicios</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
                <form id="frm_agregar_juicio" action="<?php echo $helper->url("MatrizJuicios","AgregarJuicio"); ?>" method="post" enctype="multipart/form-data" class="col-lg-12 col-md-12 col-xs-12">
          		         	  <div class="row">
          		         	  
    	          <div class="col-lg-3 col-xs-6 col-md-3">
                                 	<div class="form-group">
                                 	
                                        <label for="identificacion_clientes" class="control-label">Cédula:</label>
                                        <input type="text" id="identificacion_clientes" name="identificacion_clientes" value="" class="form-control" placeholder="Cédula">
                                        <div id="mensaje_identificacion_clientes" class="errores"></div>
                                        
                                      </div>
                                </div>
                                
                                <div class="col-lg-3 col-xs-6 col-md-3">
                                	<div class="form-group">
                                        <label for="nombre_clientes" class="control-label">Nombre:</label>
                                        <input type="text" class="form-control" id="nombre_clientes" name="nombre_clientes" value=""  placeholder="Nombre">
                                       
                                      </div>
                        		    
                        	    </div>
                        	    
                        	           <div class="col-lg-3 col-xs-6 col-md-3">
                                	<div class="form-group">
                                        <label for="entidad_origen_juicios" class="control-label">Entidad de Origen:</label>
                                        <input type="text" class="form-control" id="entidad_origen_juicios" name="entidad_origen_juicios" value=""  placeholder="Entidad de Origen">
                                       
                                      </div>
                        		    
                        	    </div>
                      	  
              
						
							  	<div class="col-xs-6 col-md-3 col-lg-3 ">
                    			<div class="form-group">
                                    <label for="regional_juicios" class="control-label">Regional:</label>
                                    <input type="text" class="form-control" id="regional_juicios" name="regional_juicios" value=""  placeholder="Regional" >
                                    <div id="mensaje_regional_juicios" class="errores"></div>
                                 </div>
                             </div>
                      	  
                		 
                             
                         
                             </div>
                                  
                             <div class="row">
                                 
                          	<div class="col-xs-6 col-md-3 col-lg-3 ">
                    			<div class="form-group">
                                    <label for="numero_juicios" class="control-label">N° Juicio</label>
                                    <input type="text" class="form-control" id="numero_juicios" name="numero_juicios" value=""  placeholder="# Juicio" >
                                    <div id="mensaje_numero_juicios" class="errores"></div>
                                 </div>
                             </div>

                            <div class="col-xs-6 col-md-3 col-lg-3 ">
                             		 
                             		 <div class="form-group">
                             		 
                             		 	<label for="anio_juicios" class="control-label">Año de Juicio:</label>
                                        <input type="text" class="form-control" id="anio_juicios" name="anio_juicios" value="" data-fechaactual="<?php echo date('Y');?>" placeholder="Año de Juicio">
                                        <div id="mensaje_anio_juicio" class="errores"></div>
                                        
                                      </div>
                                	
                                   </div>  
                        	    
                        	    
                    		    <div class="col-lg-3 col-xs-6 col-md-3">
                        		    <div class="form-group">
                                          <label for="numero_titulo_credito_juicios" class="control-label">Número Título Crédito:</label>
                                          <input type="text" class="form-control" id="numero_titulo_credito_juicios" name="numero_titulo_credito_juicios" value="" placeholder="Número Título Crédito">
                                          <div id="mensaje_numero_titulo_credito_juicios" class="errores"></div>
                                    </div>
                    		    </div>
                    		    									
                           <div class="col-xs-6 col-md-3 col-lg-3 ">
                             		 
                             		 <div class="form-group">
                             		 
                             		 	<label for="fecha_titulo_credito_juicios" class="control-label">Fecha Título Crédito:</label>
                                        <input type="text" class="form-control" id="fecha_titulo_credito_juicios" name="fecha_titulo_credito_juicios" value="" data-fechaactual="<?php echo date('Y/m/d');?>" placeholder="Fecha Título Crédito">
                                        <div id="mensaje_fecha_titulo_credito_juicios" class="errores"></div>
                                        
                                      </div>
                                	
                                   </div>        
                             	                            
                              </div>
                            
                            	  <div class="row">		
                    		    <div class="col-xs-6 col-md-3 col-lg-3">
                            		<div class="form-group">
                                      <label for="orden_cobro_juicios" class="control-label">Orden de Cobro:</label>
                                      <input type="text" class="form-control" id="orden_cobro_juicios" name="orden_cobro_juicios" value="" placeholder="Orden de Cobro">
                                      <div id="mensaje_orden_cobro_juicios" class="errores"></div>
                                    </div>
                            	</div>
                            	
                            	 <div class="col-xs-6 col-md-3 col-lg-3 ">
                             		 
                             		 <div class="form-group">
                             		 
                             		 	<label for="fecha_oden_cobro_juicios" class="control-label">Fecha Orden de Cobro:</label>
                                        <input type="text" class="form-control" id="fecha_oden_cobro_juicios" name="fecha_oden_cobro_juicios" value="" data-fechaactual="<?php echo date('Y/m/d');?>" placeholder="Fecha Orden de Cobro">
                                        <div id="mensaje_fecha_oden_cobro_juicios" class="errores"></div>
                                        
                                      </div>
                                	
                                   </div>       
                                   
                                   	 <div class="col-xs-6 col-md-3 col-lg-3 ">
                             		 
                             		 <div class="form-group">
                             		 
                             		 	<label for="fecha_auto_pago_juicios" class="control-label">Fecha Auto Pago:</label>
                                        <input type="text" class="form-control" id="fecha_auto_pago_juicios" name="fecha_auto_pago_juicios" value="" data-fechaactual="<?php echo date('Y/m/d');?>"  placeholder="Fecha Auto Pago"/>
                                        <div id="mensaje_fecha_auto_pago_juicios" class="errores"></div>
                                        
                                      </div>
                                	
                                   </div>        
                            	
                            		
                    		    <div class="col-xs-6 col-md-3 col-lg-3">
                            		<div class="form-group">
                                      <label for="cuantia_inicial_juicios" class="control-label">Cuantía Inicial:</label>
                                      <input type="text" class="form-control" id="cuantia_inicial_juicios" name="cuantia_inicial_juicios" value="" placeholder="Cuantía Inicial"/>
                                      <div id="mensaje_cuantia_inicial_juicios" class="errores"></div>
                                    </div>
                            	</div>
                            	
                            	</div>
                            	
                         
                          <div class="row">                		      
                    		
                                   	  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                      	    <label for="id_etapa_procesal" class="control-label">Etapa Procesal:</label>
                      	    <select  class="form-control" id="id_etapa_procesal" name="id_etapa_procesal" required>
                          	<option value="0">--Seleccione--</option>
                      	    </select>                         
                       	   <div id="mensaje_id_etapa_procesal" class="errores"></div>
                       	 </div>
            			  </div>
            			  
            			               	  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                      	    <label for="id_estado_procesal" class="control-label">Estado Procesal:</label>
                      	    <select  class="form-control" id="id_estado_procesal" name="id_estado_procesal" required>
                          	<option value="0">--Seleccione--</option>
                      	    </select>                         
                       	   <div id="mensaje_id_estado_procesal" class="errores"></div>
                       	 </div>
            			  </div>
                                 
                            	
                            		 <div class="col-xs-6 col-md-3 col-lg-3 ">
                             		 <div class="form-group">
                             		 	<label for="fecha_ultima_providencia_juicios" class="control-label">Fecha Última Providencia:</label>
                                        <input type="text" class="form-control" id="fecha_ultima_providencia_juicios" name="fecha_ultima_providencia_juicios" value="" data-fechaactual="<?php echo date('Y/m/d');?>" placeholder="Fecha Última Providencia"/>
                                        <div id="mensaje_fecha_ultima_providencia_juicios" class="errores"></div>
                                      </div>
                                   </div>  
                                   
                                      			               	  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                      	    <label for="id_usuarios_secretario" class="control-label">Abogado Secretario:</label>
                      	    <select  class="form-control" id="id_usuarios_secretario" name="id_usuarios_secretario" required>
                          	<option value="0">--Seleccione--</option>
                      	    </select>                         
                       	   <div id="mensaje_id_usuarios_secretario" class="errores"></div>
                       	 </div>
            			  </div>       
                                   
                                  
            		</div>
                           
                            	  <div class="row">		
                            	    	             	          <div class="col-xs-12 col-md-12 col-lg-12">
                            		<div class="form-group">
                                      <label for="observaciones_juicios" class="control-label">Observaciones:</label>
                                      <input type="text" class="form-control" id="observaciones_juicios" name="observaciones_juicios" value="" placeholder="Observaciones"/>
                                      <div id="mensaje_observaciones_juicios" class="errores"></div>
                                    </div>
                            	</div>
                            	</div>
                        	
                    	<div class="row">
            			    <div class="col-xs-12 col-md-12 col-md-12 " style="margin-top:15px;  text-align: center; ">
                	   		    <div class="form-group">
            	                  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">GUARDAR</button>
            	                  <a class="btn btn-danger" href="<?php  echo $helper->url("MatrizJuicios","index6"); ?>">CANCELAR</a>
        	                    </div>
    	        		    </div>
    	        		    
            		    </div>
          		 	
          		 	</form>
          
        			</div>
      			</div>
      			
      			<div id="resultadosjq">
      			
      			</div>
    		</section>
      <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Listado Usuarios</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
			<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activos" data-toggle="tab">Juicios Activos</a></li>
              <li><a href="#inactivos" data-toggle="tab">Juicios Inactivos</a></li>
            </ul>
            
            <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="tab-content">
             
            <br>
              <div class="tab-pane active" id="activos">
              
                
					<div class="pull-right" style="margin-right:15px;">
					
						<input type="text" value="" class="form-control" id="search" name="search" onkeyup="load_usuarios(1)" placeholder="search.."/>
					</div>
					<div id="load_registrados" ></div>	
					<div id="users_registrados"></div>	
                
              </div>
              
              <div class="tab-pane" id="inactivos">
                
                    <div class="pull-right" style="margin-right:15px;">
					<input type="text" value="" class="form-control" id="search_inactivos" name="search_inactivos" onkeyup="load_usuarios_inactivos(1)" placeholder="search.."/>
					</div>
					
					
					<div id="load_inactivos_registrados" ></div>	
					<div id="users_inactivos_registrados"></div>
                
                
              </div>
             
              <button type="submit" id="btExportar" name="exportar" class="btn btn-info">Exportar</button>
            </div>
            </div>
          </div>
         
            
            </div>
            </div>
            </section>
  </div>
 	<?php include("view/modulos/footer.php"); ?>	
   <div class="control-sidebar-bg"></div>
 </div>
   <?php include("view/modulos/links_js.php"); ?> 
   
   <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="view/bootstrap/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="view/bootstrap/bower_components/jquery-ui-1.12.1/jquery-ui.js"></script> 
    <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
    <script src="view/Juridico/js/AgregarJuicios.js?0.5"></script> 
  </body>
</html>

 