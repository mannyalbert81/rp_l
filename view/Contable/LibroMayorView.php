<!DOCTYPE html>
<html lang="en">
  <head>
   <script lang=javascript src="view/Contable/FuncionesJS/xlsx.full.min.js"></script>
   <script lang=javascript src="view/Contable/FuncionesJS/FileSaver.min.js"></script>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Capremci</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
      
      
   <?php include("view/modulos/links_css.php"); ?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="view/bootstrap/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <style type="text/css">
    .input-group .form-control, .input-group-btn .btn { z-index: inherit !important; }
  </style>
    
   
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
              <h3 class="box-title">Mayor Contable</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
                <form id="frm_libro_mayor" action="<?php echo $helper->url("LibroMayor","index"); ?>" method="post" enctype="multipart/form-data" class="col-lg-12 col-md-12 col-xs-12">
                
                	<div class="row">
                		<div class="col-xs-6 col-md-3 col-lg-3 ">
                			<label for="anio_l_mayor" class="control-label">Desde:</label>
                			<div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" id="fecha_desde" name="fecha_desde" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                            </div>
                		</div>
                		<div class="col-xs-6 col-md-3 col-lg-3 ">
                			<label for="anio_l_mayor" class="control-label">Hasta:</label>
                			<div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" id="fecha_hasta" name="fecha_hasta" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                            </div>
                		</div>
                		
                		<div class="col-xs-6 col-md-3 col-lg-3 ">
                			<label for="anio_l_mayor" class="control-label">Codigo Cuenta:</label>
                			<div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-keyboard-o"></i>
                              </div>
                              <input type="text" class="form-control" id="codigo_cuenta" name="codigo_cuenta" value=""  >
                              <div id="mensaje_codigo_cuenta" class="errores"></div>   
                            </div>
                		</div>
                		
                		<div class="col-xs-6 col-md-3 col-lg-3 ">
                			<label for="anio_l_mayor" class="control-label">Nombre Cuenta:</label>
                			<div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-keyboard-o"></i>
                              </div>
                              <input type="text" class="form-control" id="nombre_cuenta" name="nombre_cuenta" value=""  >
                              <input type="hidden" class="form-control" id="id_cuenta" name="id_cuenta" value=""  >                                
                              <div id="mensaje_nombre_cuenta" class="errores"></div>
                            </div>
                		</div>
                		
                		                		
                	</div>
                	 
                  
                     	<div class="row">
            			    <div class="col-xs-12 col-md-12 col-md-12 " style="margin-top:15px;  text-align: center; ">
                	   		    <div class="form-group">
            	                  <button type="submit" id="btnMayores" name="btnMayores" class="btn btn-default"><i class="fa fa-file-pdf-o " aria-hidden="true"></i> &nbsp; GENERAR MAYORES</button>
            	                  
            	                  <a class="btn btn-danger" href="<?php  echo $helper->url("LibroMayor","index"); ?>">CANCELAR</a>
        	                    </div>
    	        		    </div>
    	        		    
            		    </div>
          		 	
          		 	</form>
          
        			</div>
      			</div>
      			
    		</section>
    		
  </div>
 	<?php include("view/modulos/footer.php"); ?>	
   <div class="control-sidebar-bg"></div>
 </div>
   <?php include("view/modulos/links_js.php"); ?> 
   <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
   <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="view/bootstrap/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="view/bootstrap/bower_components/jquery-ui-1.12.1/jquery-ui.js"></script>
   <script src="view/Contable/FUNCIONESJS/mayorcontable.js?0.1"></script>         	
  </body>
</html>

 