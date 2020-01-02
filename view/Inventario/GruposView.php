<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Capremci</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
   <?php include("view/modulos/links_css.php"); ?>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 
   


  <body class="hold-transition skin-blue fixed sidebar-mini">   
  <?php
        
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
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
            <li class="active">Grupos</li>
          </ol>
        </section>
        
        <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Registrar Grupos</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
                <form action="<?php echo $helper->url("Grupos","index"); ?>" method="post" class="col-lg-12 col-md-12 col-xs-12">
          		 	 <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
              		 	 <div class="row">
                         	<div class="col-xs-12 col-lg-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="nombre_grupos" class="control-label">Nombres Grupos:</label>
                                    <input type="text" class="form-control" id="nombre_grupos" name="nombre_grupos" value="<?php echo $resEdit->nombre_grupos; ?>"  placeholder="nombre">
                                    <input type="hidden" name="id_grupos" id="id_grupos" value="<?php echo $resEdit->id_grupos; ?>" class="form-control"/>
    					            <div id="mensaje_nombre_grupos" class="errores"></div>
                                 </div>
                                  </div>
                                  
                              <div class="col-xs-12 col-lg-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="abreviacion_grupos" class="control-label">Abreviacion Grupos:</label>
                                    <input type="text" class="form-control" id="abreviacion_grupos" name="abreviacion_grupos" value="<?php echo $resEdit->abreviacion_grupos; ?>"  placeholder="abreviacion">
                                 </div>
                               </div>
                               
                               <div class="col-xs-12 col-lg-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="codigo_plan_cuentas" class="control-label">Cuenta Contable:</label>
                                    <input type="text" class="form-control" id="codigo_plan_cuentas" name="codigo_plan_cuentas" value="<?php echo $resEdit->codigo_plan_cuentas; ?>"  placeholder="cuenta contable">
                                    <input type="hidden" name="id_plan_cuentas" id="id_plan_cuentas" value="<?php echo $resEdit->id_plan_cuentas; ?>" />
                                 </div>
                               </div>
                               
                                 <div class="col-xs-12 col-md-3 col-lg-3">
                        		   <div class="form-group">
                                      <label for="id_estado" class="control-label">Estado:</label>
                                      <select name="id_estado" id="id_estado"  class="form-control" >
                                      <option value="0" selected="selected">--Seleccione--</option>
    									<?php  foreach($result_Grupos_estados as $res) {?>
    										<option value="<?php echo $res->id_estado; ?>" <?php if ($res->id_estado == $resEdit->id_estado )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_estado; ?> </option>
    							        <?php } ?>
    								   </select> 
                                      <div id="mensaje_id_estados" class="errores"></div>
                                    </div>
                                  </div>
                            
                          </div>
                      <?php } } else {?>                		    
                      	  <div class="row">
                		  	<div class="col-xs-12 col-lg-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="nombre_grupos" class="control-label">Nombres Grupos:</label>
                                  <input type="text" class="form-control" id="nombre_grupos" name="nombre_grupos" value=""  placeholder="Nombre">
                                   <input type="hidden" name="id_grupos" id="id_grupos" value="" class="form-control"/>
                                  <div id="mensaje_nombre_grupos" class="errores"></div>
                                 </div>
                             </div>
                             
                             <div class="col-xs-12 col-lg-3 col-md-3 ">
                    			<div class="form-group">
                                  <label for="abreviacion_grupos" class="control-label">Abreviacion Grupos:</label>
                                  <input type="text" class="form-control" id="abreviacion_grupos" name="abreviacion_grupos" value=""  placeholder="Abreviacion">
                                  <div id="mensaje_abreviacion_grupos" class="errores"></div>
                                 </div>
                             </div>
                             
                             <div class="col-xs-12 col-lg-3 col-md-3 ">
                            	<div class="form-group">
                                	<label for="codigo_plan_cuentas" class="control-label">Cuenta Contable:</label>
                                    <input type="text" class="form-control" id="codigo_plan_cuentas" name="codigo_plan_cuentas" value=""  placeholder="cuenta contable">
                                    <input type="hidden" name="id_plan_cuentas" id="id_plan_cuentas" value="" />
                                 </div>
                               </div>
                             
                             <div class="col-xs-12 col-md-3 col-lg-3">
                        		   <div class="form-group">
                                      <label for="id_estado" class="control-label">Estado:</label>
                                      <select name="id_estado" id="id_estado"  class="form-control" >
                                      <option value="0" selected="selected">--Seleccione--</option>
    									<?php foreach($result_Grupos_estados as $res) {?>
    										<option value="<?php echo $res->id_estado; ?>" ><?php echo $res->nombre_estado; ?> </option>
    							        <?php } ?>
    								   </select> 
                                      <div id="mensaje_id_estado" class="errores"></div>
                                    </div>
                                  </div>
                            </div>	 
                    		            
                     <?php } ?>
                     	
                     	<div class="row">
            			    <div class="col-xs-12 col-md-6 col-md-6" style="margin-top:15px;  text-align: center; ">
                	   		    <div class="form-group">
            	                  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class='glyphicon glyphicon-plus'></i> Guardar</button>
        	                      <a href="index.php?controller=Grupos&action=index" class="btn btn-primary"><i class='glyphicon glyphicon-remove'></i> Cancelar</a>
        	                    </div>
    	        		    </div>
            		    </div>
          		 	
          		 	</form>
          
        			</div>
      			</div>
    		</section>
    		
    <!-- seccion para el listado de roles -->
      <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Listado Grupos</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">

           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activos" data-toggle="tab">Grupos Activos</a></li>
              <li><a href="#inactivos" data-toggle="tab">Grupos Inactivos</a></li>
            </ul>
            
            <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="tab-content">
            <br>
              <div class="tab-pane active" id="activos">
                
					<div class="pull-right" style="margin-right:15px;">
						<input type="text" value="" class="form-control" id="search_activos" name="search_activos" onkeyup="load_grupos_activos(1)" placeholder="search.."/>
					</div>
					<div id="load_grupos_activos" ></div>	
					<div id="grupos_activos_registrados"></div>	
                
              </div>
              
              <div class="tab-pane" id="inactivos">
                
                    <div class="pull-right" style="margin-right:15px;">
					<input type="text" value="" class="form-control" id="search_inactivos" name="search_inactivos" onkeyup="load_grupos_inactivos(1)" placeholder="search.."/>
					</div>
					
					
					<div id="load_grupos_inactivos" ></div>	
					<div id="grupos_inactivos_registrados"></div>
              </div>
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
    <script src="view/bootstrap/bower_components/jquery-ui-1.12.1/jquery-ui.js"></script> 
    <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
    <script src="view/Inventario/js/Grupos.js?4.1" ></script>
  </body>

</html>

