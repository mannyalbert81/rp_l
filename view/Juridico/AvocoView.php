<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Liventy - Avoco</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
    
     <style type="text/css">
 	  .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('view/images/ajax-loader.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;
        }
 	</style> 
    
     
   <?php include("view/modulos/links_css.php"); ?>
  
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <link href="view/bootstrap/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" type="text/css" /> 
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
                <li class="active">Avoco</li>
            </ol>
        </section>
        
        
        
        
        <section class="content">
    <form id="frm_avoco" action="<?php echo $helper->url("Avoco","InsertAvoco"); ?>" method="post" enctype="multipart/form-data"  class="form form-horizontal">
    
    	<div id="smartwizard">
            <ul>
                <li><a href="#step-1">Datos Cliente<br /><small> </small></a></li>
                <li><a href="#step-2">Revisión Providencia<br /><small></small></a></li>
                <li><a href="#step-3">Revisión Primer Oficio<br /><small></small></a></li>
                <li><a href="#step-4">Revisión Segundo Oficio<br /><small></small></a></li>
            </ul>
         
            <div>
                <div id="step-1" class="">
                
                	<div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title"></h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    <div class="box-body">
                    	
                    <div class="row">
        	    	  <div class="col-lg-6 col-md-6 col-xs-12">
                		
                		 <div class="form-group "> 
                    			 <div class="form-group-sm">
                    				<label for="numero_juicios" class="col-sm-4 control-label" >N° Juicio:</label>
                    				<div class="col-sm-4">
                    				  <input type="text" class="form-control" id="numero_juicios" name="numero_juicios"  value="">
                                      <input type="hidden" id="id_juicios" name="id_juicios" value="0">
                                    </div>
                    			 </div>        			 
                		  </div>
                		
                		
                			<div class="form-group "> 
                    			 <div class="form-group-sm">
                    				<label for="identificacion_clientes" class="col-sm-4 control-label" >Identificación:</label>
                    				<div class="col-sm-4">
                    				  <input type="text" class="form-control" id="identificacion_clientes" name="identificacion_clientes"  value="" readonly>
                                      <input type="hidden" id="id_clientes" name="id_clientes" value="0">
                    				</div>
                    			 </div>        			 
                			</div>
                         
                           <div class="form-group "> 
                    			 <div class="form-group-sm">
                    				<label for="nombre_clientes" class="col-sm-4 control-label" >Apellidos y Nombres:</label>
                    				<div class="col-sm-6">
                    				  <input type="text" class="form-control" id="nombre_clientes" name="nombre_clientes"  value="" readonly>
                                    </div>
                    			 </div>        			 
                		  </div>
                      
                      </div>
                            
                            
                            
                            
                                	
                		<div class="col-lg-6 col-md-6 col-xs-12">
                		   <div class="form-group "> 
                    			 <div class="form-group-sm">
                    				<label for="numero_titulo_credito_juicios" class="col-sm-4 control-label" >N° Titulo Crédito:</label>
                    				<div class="col-sm-4">
                    				   <input type="text" class="form-control" id="numero_titulo_credito_juicios" name="numero_titulo_credito_juicios"  value="" readonly>
                                    </div>
                    			 </div>        			 
                		  </div>
                         
                         <div class="form-group "> 
                    			 <div class="form-group-sm">
                    				<label for="fecha_inicio_proceso_juicios" class="col-sm-4 control-label" > Fecha Inicio Proceso:</label>
                    				<div class="col-sm-4">
                    				  <input type="text" class="form-control" id="fecha_inicio_proceso_juicios" name="fecha_inicio_proceso_juicios" value="" readonly>
                    				</div>
                    			 </div>        			 
                			</div> 
                         
                         
                			<div class="form-group "> 
                    			 <div class="form-group-sm">
                    				<label for="fecha_auto_pago_juicios" class="col-sm-4 control-label" > Fecha Auto Pago:</label>
                    				<div class="col-sm-4">
                    				  <input type="text" class="form-control" id="fecha_auto_pago_juicios" name="fecha_auto_pago_juicios" value="" readonly>
                    				</div>
                    			 </div>        			 
                			</div> 
                    		
                			
                			<div class="form-group "> 
                    			 <div class="form-group-sm">
                    				<label for="valor_retencion_fondos" class="col-sm-4 control-label" > Valor Retención:</label>
                    				<div class="col-sm-4">
                    				  <input type="text" class="form-control" id="valor_retencion_fondos" name="valor_retencion_fondos" value="" readonly>
                    				</div>
                    			 </div>        			 
                			</div> 
                		</div>
        		
        		
        		
        			</div>
            	</div>
            </div>
                	
                	
                </div>
                <div id="step-2" class="">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title"></h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row">
            	
            	        	<div class="col-lg-12 col-md-12 col-xs-12">
            	            <div class="box-body pad">
            	                    <textarea id="editor1" name="editor1" rows="15" cols="80"></textarea>
            	                    <div id="mensaje_editor1" class="errores"></div>
            	            </div>
            	       		</div>
	        
               			  </div>
               			</div>
               		</div>
                </div>
                
                  <div id="step-3" class="">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title"></h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row">
            	
            	        	<div class="col-lg-12 col-md-12 col-xs-12">
            	            <div class="box-body pad">
            	                    <textarea id="editor2" name="editor2" rows="15" cols="80"></textarea>
            	                    <div id="mensaje_editor2" class="errores"></div>
            	            </div>
            	       		</div>
	        
               			  </div>
               			</div>
               		</div>
                </div>
                  <div id="step-4" class="">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title"></h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row">
            	
            	        	<div class="col-lg-12 col-md-12 col-xs-12">
            	            <div class="box-body pad">
            	                    <textarea id="editor3" name="editor3" rows="15" cols="80"></textarea>
            	                    <div id="mensaje_editor3" class="errores"></div>
            	            </div>
            	       		</div>
	        
               			  </div>
               			</div>
               		</div>
                </div>
                
            </div>
        </div>
    		
    </form>
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
	<script type="text/javascript" src="view/bootstrap/smartwizard/dist/js/jquery.smartWizard.min.js"></script>
	<script type="text/javascript" src="view/Juridico/js/Avoco.js?0.78"></script>
	<script type="text/javascript" src="view/Juridico/js/wizardAvoco.js?0.67"></script>
  
  
    <script src="view/bootstrap/bower_components/ckeditor/ckeditor.js"></script>
	<script src="view/bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  
  
  
  
  </body>
</html>

 