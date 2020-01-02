<!DOCTYPE html>
<html lang="en">
  <head>
   <script lang=javascript src="view/Contable/FuncionesJS/xlsx.full.min.js"></script>
      <script lang=javascript src="view/Contable/FuncionesJS/FileSaver.min.js"></script>
    
    
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Capremci - Mayor Auxiliar</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
      
      
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
              <h3 class="box-title">Mayor Auxiliar Contable</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
                <form id="frm_libro_mayor" action="<?php echo $helper->url("LibroMayorAuxuliar","index"); ?>" method="post" enctype="multipart/form-data" class="col-lg-12 col-md-12 col-xs-12">
                
                
                
                 <div class="row">
        			  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		      <label for="codigo_plan_cuentas" class="control-label">Cuentas:</label>
                          <select  class="form-control" id="codigo_plan_cuentas" name="codigo_plan_cuentas">
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_codigo_plan_cuentas" class="errores"></div>
                        </div>
            		  </div>
            		  
            		   <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		      <label for="codigo_sub_plan_cuentas" class="control-label">SubCuentas:</label>
                          <select  class="form-control" id="codigo_sub_plan_cuentas" name="codigo_sub_plan_cuentas">
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_codigo_sub_plan_cuentas" class="errores"></div>
                        </div>
            		  </div>
            		  
            		   <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		      <label for="codigo_plan_cuentas_hijos" class="control-label">Filtro:</label>
                          <select  class="form-control" id="codigo_plan_cuentas_hijos" name="codigo_plan_cuentas_hijos">
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_codigo_plan_cuentas_hijos" class="errores"></div>
                        </div>
            		  </div>
            	  </div>
                
                	<div class="row">
                     <div class="col-xs-6 col-md-3 col-lg-3 ">
                        	<div class="form-group">
                            	<label for="desde_diario" class="control-label">Desde:</label>                            	
                                <input type="date"  class="form-control" id="desde_diario" name="desde_diario" value="" max="<?php echo date('Y-m-d')?>" >                                
                                <div id="mensaje_desde_diario" class="errores"></div>
                             </div>
                         </div>
                         
                         <div class="col-xs-6 col-md-3 col-lg-3 ">
                        	<div class="form-group">
                            	<label for="hasta_diario" class="control-label">Hasta:</label>                            	
                                <input type="date" max="<?php echo date('Y-m-d')?>" class="form-control" id="hasta_diario" name="hasta_diario" value=""  >                                
                                <div id="mensaje_desde_diario" class="errores"></div>
                             </div>
                         </div>
                     </div>
                	
                        
                     	<div class="row">
            			    <div class="col-xs-12 col-md-12 col-md-12 " style="margin-top:15px;  text-align: center; ">
                	   		    <div class="form-group">
            	                  <button type="button" id="btnMayores" name="btnMayores" class="btn btn-default"><i class="fa fa-check-square " aria-hidden="true"></i> &nbsp; GENERAR MAYORES</button>
            	                  
            	                  <a class="btn btn-danger" href="<?php  echo $helper->url("LibroMayorAuxiliar","index"); ?>">CANCELAR</a>
        	                    </div>
    	        		    </div>
    	        		    
            		    </div>
          		 	
          		 	</form>
          
        			</div>
      			</div>
      			
    		</section>
    		 <section class="content">
		      	<div class="box box-primary">
		      		<div class="box-header with-border">
		      			<h3 class="box-title">Detalle de la Cuenta</h3>      			
		            </div> 
		            <div class="box-body">
		    			<div class="pull-right" style="margin-right:15px;">
							<input type="text" value="" class="form-control" id="search" name="search" onkeyup="load_tabla(1)" placeholder="Buscar.."/>
		    			</div>            	
		            	<div id="load_detalle" ></div>	
						<div id="registrados_detalle"></div>	
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
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
   <script src="view/Contable/FuncionesJS/mayorcontableauxiliar.js?0.16"></script>         	
  </body>
</html>

 