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
            
                <form id="frm_juicio" action="<?php echo $helper->url("MatrizJuicios","AgregarJuicio"); ?>" method="post" enctype="multipart/form-data" class="col-lg-12 col-md-12 col-xs-12">
          		         	  <div class="row">
                      	  
                      	   <div class="col-xs-6 col-md-3 col-lg-3">
 						 <div class='form-group'>
			  			 <label for='id_origen_juicio' class='control-label'>Origen Juicio</label>
			  			<select name="id_origen_juicio" id="id_origen_juicio"  class="form-control" >
			  			 <option value="" selected="selected">--Seleccione--</option>
						<?php foreach($resultOrigen as $res) {?>
						<option value="<?php echo $res->id_origen_juicio; ?>" ><?php echo $res->nombre_origen_juicio; ?></option>
						            
						<?php } ?>
						</select> 
						  <div id="mensaje_id_origen_juicio" class="errores"></div>
			  			</div>
						</div>
						
							  	<div class="col-xs-6 col-md-3 col-lg-3 ">
                    			<div class="form-group">
                                    <label for="regional_juicios" class="control-label">Regional:</label>
                                    <input type="text" class="form-control" id="regional_juicios" name="regional_juicios" value=""  placeholder="Regional" >
                                     <input type="hidden"  id="regional_juicios" name="regional_juicios" value="0" >
                                    <div id="mensaje_cedula_usuarios" class="errores"></div>
                                 </div>
                             </div>
                      	  
                		  	<div class="col-xs-6 col-md-3 col-lg-3 ">
                    			<div class="form-group">
                                    <label for="numero_usuarios" class="control-label">N° Juicio</label>
                                    <input type="text" class="form-control" id="numero_usuarios" name="numero_usuarios" value=""  placeholder="# Juicio" >
                                     <input type="hidden"  id="id_juicios" name="id_juicios" value="0" >
                                    <div id="mensaje_cedula_usuarios" class="errores"></div>
                                 </div>
                             </div>

                            <div class="col-xs-6 col-md-3 col-lg-3 ">
                             		 
                             		 <div class="form-group">
                             		 
                             		 	<label for="anio_juicio" class="control-label">Año de Juicio:</label>
                                        <input type="text" class="form-control" id="anio_juicio" name="anio_juicio" value="" data-fechaactual="<?php echo date('Y');?>" placeholder="Año de Juicio">
                                        <div id="mensaje_anio_juicio" class="errores"></div>
                                        
                                      </div>
                                	
                                   </div>  
                             
                         
                             </div>
                                  
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
                                        <label for="telefono_usuarios" class="control-label">Nombre:</label>
                                        <input type="text" class="form-control" id="telefono_usuarios" name="telefono_usuarios" value=""  placeholder="Nombre">
                                       
                                      </div>
                        		    
                        	    </div>
                        	    
                        	    
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                        		    <div class="form-group">
                                          <label for="correo_usuarios" class="control-label">Título Crédito:</label>
                                          <input type="email" class="form-control" id="correo_usuarios" name="correo_usuarios" value="" placeholder="Título Crédito">
                                          <div id="mensaje_correo_usuarios" class="errores"></div>
                                    </div>
                    		    </div>
                    		    									
                           <div class="col-xs-6 col-md-3 col-lg-3 ">
                             		 
                             		 <div class="form-group">
                             		 
                             		 	<label for="fecha_nacimiento_usuarios" class="control-label">Fecha Título Crédito:</label>
                                        <input type="text" class="form-control" id="fecha_nacimiento_usuarios" name="fecha_nacimiento_usuarios" value="" data-fechaactual="<?php echo date('Y/m/d');?>" placeholder="Fecha Título Crédito">
                                        <div id="mensaje_fecha_nacimiento_usuarios" class="errores"></div>
                                        
                                      </div>
                                	
                                   </div>        
                             	                            
                              </div>
                            
                            	  <div class="row">		
                    		    <div class="col-xs-6 col-md-3 col-lg-3">
                            		<div class="form-group">
                                      <label for="clave_usuarios" class="control-label">Orden Cobro:</label>
                                      <input type="password" class="form-control" id="clave_usuarios" name="clave_usuarios" value="" placeholder="Orden Cobro">
                                      <div id="mensaje_clave_usuarios" class="errores"></div>
                                    </div>
                            	</div>
                            	
                            	 <div class="col-xs-6 col-md-3 col-lg-3 ">
                             		 
                             		 <div class="form-group">
                             		 
                             		 	<label for="fecha_nacimiento_usuarios" class="control-label">Fecha Orden Cobro:</label>
                                        <input type="text" class="form-control" id="fecha_nacimiento_usuarios" name="fecha_nacimiento_usuarios" value="" data-fechaactual="<?php echo date('Y/m/d');?>" placeholder="Fecha Orden Cobro">
                                        <div id="mensaje_fecha_nacimiento_usuarios" class="errores"></div>
                                        
                                      </div>
                                	
                                   </div>       
                                   
                                   	 <div class="col-xs-6 col-md-3 col-lg-3 ">
                             		 
                             		 <div class="form-group">
                             		 
                             		 	<label for="fecha_nacimiento_usuarios" class="control-label">Fecha Auto Pago:</label>
                                        <input type="text" class="form-control" id="fecha_nacimiento_usuarios" name="fecha_nacimiento_usuarios" value="" data-fechaactual="<?php echo date('Y/m/d');?>"  placeholder="Fecha Auto Pago"/>
                                        <div id="mensaje_fecha_nacimiento_usuarios" class="errores"></div>
                                        
                                      </div>
                                	
                                   </div>        
                            	
                            		
                    		    <div class="col-xs-6 col-md-3 col-lg-3">
                            		<div class="form-group">
                                      <label for="clave_usuarios" class="control-label">Cuantía Inicial:</label>
                                      <input type="password" class="form-control" id="clave_usuarios" name="clave_usuarios" value="" placeholder="Cuantía Inicial"/>
                                      <div id="mensaje_clave_usuarios" class="errores"></div>
                                    </div>
                            	</div>
                            	
                            	</div>
                            	
                          
                          <div class="row">                		      
                    		
                                <div class="col-xs-6 col-md-3 col-lg-3">
                            		<div class="form-group">
                                      <label for="clave_usuarios" class="control-label">Etapa Procesal:</label>
                                      <input type="password" class="form-control" id="clave_usuarios" name="clave_usuarios" value="" placeholder="Etapa Procesal"/>
                                      <div id="mensaje_clave_usuarios" class="errores"></div>
                                    </div>
                            	</div>
                                
                    		    <div class="col-xs-12 col-md-3 col-lg-3">
                        		   <div class="form-group">
                                      <label for="id_estado" class="control-label">Estado Procesal:</label>
                                      <select name="id_estado" id="id_estado"  class="form-control" >
                                      <option value="0" selected="selected">--Seleccione--</option>
    									<?php foreach($resEstado as $res) {?>
    										<option value="<?php echo $res->id_estado; ?>" ><?php echo $res->nombre_estado; ?> </option>
    							        <?php } ?>
    								   </select> 
                                      <div id="mensaje_id_estados" class="errores"></div>
                                    </div>
                                  </div>
                                  
                          <div class="col-xs-6 col-md-3 col-lg-3">
                            		<div class="form-group">
                                      <label for="clave_usuarios" class="control-label">N° Operación:</label>
                                      <input type="password" class="form-control" id="clave_usuarios" name="clave_usuarios" value="" placeholder="N° Operación"/>
                                      <div id="mensaje_clave_usuarios" class="errores"></div>
                                    </div>
                            	</div>
                            	
                            	          <div class="col-xs-6 col-md-3 col-lg-3">
                            		<div class="form-group">
                                      <label for="clave_usuarios" class="control-label">Embargo Bienes:</label>
                                      <input type="password" class="form-control" id="clave_usuarios" name="clave_usuarios" value="" placeholder="Embargo Bienes"/>
                                      <div id="mensaje_clave_usuarios" class="errores"></div>
                                    </div>
                            	</div>
                            	
                            		</div>
                            		
                            		  <div class="row">		
                            	          <div class="col-xs-6 col-md-3 col-lg-3">
                            		<div class="form-group">
                                      <label for="clave_usuarios" class="control-label">Detalle Embargo Bienes:</label>
                                      <input type="password" class="form-control" id="clave_usuarios" name="clave_usuarios" value="" placeholder="Detalle Embargo Bienes"/>
                                      <div id="mensaje_clave_usuarios" class="errores"></div>
                                    </div>
                            	</div>
                        
                        	
                        	 	 <div class="col-xs-6 col-md-3 col-lg-3 ">
                             		 <div class="form-group">
                             		 	<label for="fecha_nacimiento_usuarios" class="control-label">Fecha Última Providencia:</label>
                                        <input type="text" class="form-control" id="fecha_nacimiento_usuarios" name="fecha_nacimiento_usuarios" value="" data-fechaactual="<?php echo date('Y/m/d');?>" placeholder="Fecha Última Providencia"/>
                                        <div id="mensaje_fecha_nacimiento_usuarios" class="errores"></div>
                                      </div>
                                   </div>     
                                   
                                          	          <div class="col-xs-6 col-md-3 col-lg-3">
                            		<div class="form-group">
                                      <label for="clave_usuarios" class="control-label">Abogado Impulsor:</label>
                                      <input type="password" class="form-control" id="clave_usuarios" name="clave_usuarios" value="" placeholder="Abogado Impulsor"/>
                                      <div id="mensaje_clave_usuarios" class="errores"></div>
                                    </div>
                            	</div>
                            	
                            	             	          <div class="col-xs-6 col-md-3 col-lg-3">
                            		<div class="form-group">
                                      <label for="clave_usuarios" class="control-label">Secretario:</label>
                                      <input type="password" class="form-control" id="clave_usuarios" name="clave_usuarios" value="" placeholder="Secretario"/>
                                      <div id="mensaje_clave_usuarios" class="errores"></div>
                                    </div>
                            	</div>
                            	</div>
                            	  <div class="row">		
                            	    	             	          <div class="col-xs-6 col-md-3 col-lg-3">
                            		<div class="form-group">
                                      <label for="clave_usuarios" class="control-label">Observaciones:</label>
                                      <input type="password" class="form-control" id="clave_usuarios" name="clave_usuarios" value="" placeholder="Observaciones"/>
                                      <div id="mensaje_clave_usuarios" class="errores"></div>
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
  </body>
</html>

 