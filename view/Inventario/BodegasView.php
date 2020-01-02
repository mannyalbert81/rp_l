    <!DOCTYPE HTML>
	<html lang="es">
    <head>
        
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Capremci</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
  
    <?php include("view/modulos/links_css.php"); ?>	
	</head>
 
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
        <li class="active">Bodegas</li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Registrar Bodegas</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        
        <div class="box-body">
       
        <form action="<?php echo $helper->url("Bodegas","InsertaBodegas"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
                                <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
                                
                                <div class="row">
                        		    
                        		    
                        		    <div class="col-xs-12 col-md-3 col-md-3 ">
                        		    <div class="form-group">
                                                          <label for="nombre_bodegas" class="control-label">Nombre Bodegas</label>
                                                          <input type="text" class="form-control" id="nombre_bodegas" name="nombre_bodegas" value="<?php echo $resEdit->nombre_bodegas; ?>"  placeholder="Nombre Bodegas">
                                                          <input type="hidden" name="id_bodegas" id="id_bodegas" value="<?php echo $resEdit->id_bodegas; ?>" class="form-control"/>
					                                      <div id="mensaje_nombre_bodegas" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		    <div class="col-xs-12 col-md-3 col-lg-3">
                        		   <div class="form-group">
                                      <label for="id_estado" class="control-label">Estado:</label>
                                      <select name="id_estado" id="id_estado"  class="form-control" >
                                      <option value="0" selected="selected">--Seleccione--</option>
    									<?php  foreach($result_Bodegas_estados as $res) {?>
    										<option value="<?php echo $res->id_estado; ?>" <?php if ($res->id_estado == $resEdit->id_estado )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_estado; ?> </option>
    							        <?php } ?>
    								   </select> 
                                      <div id="mensaje_id_estados" class="errores"></div>
                                    </div>
                                  </div>
                                  
									<div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                       
                                                          <label for="id_provincias" class="control-label">Provincia</label>
                                                          <select name="id_provincias" id="id_provincias"  class="form-control">
                                                            <option value="0" selected="selected">--Seleccione--</option>
																<?php foreach($resultProv as $res) {?>
				 												<option value="<?php echo $res->id_provincias; ?>" <?php if ($res->id_provincias == $resEdit->id_provincias )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_provincias; ?> </option>
													            <?php } ?>
								    					  </select>
		   		   										  <div id="mensaje_id_provincias" class="errores"></div>
                                    </div>
                                    </div>  
                        		    
                        		    <div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                       
                                                          <label for="id_cantones" class="control-label">Cantón</label>
                                                          <select name="id_cantones" id="id_cantones"  class="form-control">
                                                            <option value="0" selected="selected">--Seleccione--</option>
																<?php foreach($resultCant as $res) {?>
				 												<option value="<?php echo $res->id_cantones; ?>" <?php if ($res->id_cantones == $resEdit->id_cantones )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_cantones; ?> </option>
													            <?php } ?>
								    					  </select>
		   		   										  <div id="mensaje_id_cantones" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                 </div>
                                    
                        		    <div class="row">
                        		    <div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                       
                                                          <label for="id_parroquias" class="control-label">Parroquias</label>
                                                          <select name="id_parroquias" id="id_parroquias"  class="form-control">
                                                            <option value="0" selected="selected">--Seleccione--</option>
																<?php foreach($resultParr as $res) {?>
				 												<option value="<?php echo $res->id_parroquias; ?>" <?php if ($res->id_parroquias == $resEdit->id_parroquias )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_parroquias; ?> </option>
													            <?php } ?>
								    					  </select>
		   		   										  <div id="mensaje_id_parroquias" class="errores"></div>
                                    </div>
                                    </div>                   			
                        	
                        	    </div>
                    		     <?php } } else {?>
                    		    
                    		   
								 <div class="row">
                        		    
                        		    
                        		   <div class="col-xs-12 col-md-3 col-md-3 ">
                        		    <div class="form-group">
                                                          <label for="nombre_bodegas" class="control-label">Nombre Bodegas</label>
                                                          <input type="text" class="form-control" id="nombre_bodegas" name="nombre_bodegas" value=""  placeholder="Nombre Bodegas">
                                                           <div id="mensaje_nombre_bodegas" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		    <div class="col-xs-12 col-md-3 col-lg-3">
                        		   <div class="form-group">
                                      <label for="id_estado" class="control-label">Estado:</label>
                                      <select name="id_estado" id="id_estado"  class="form-control" >
                                      <option value="0" selected="selected">--Seleccione--</option>
    									<?php foreach($result_Bodegas_estados as $res) {?>
    										<option value="<?php echo $res->id_estado; ?>" ><?php echo $res->nombre_estado; ?> </option>
    							        <?php } ?>
    								   </select> 
                                      <div id="mensaje_id_estados" class="errores"></div>
                                    </div>
                                  </div>
									
                        			
                        			<div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                          <label for="id_provincias" class="control-label">Provincia</label>
                                                          <select name="id_provincias" id="id_provincias"  class="form-control">
                                                            <option value="0" selected="selected">--Seleccione--</option>
																<?php foreach($resultProv as $res) {?>
				 												<option value="<?php echo $res->id_provincias; ?>"  ><?php echo $res->nombre_provincias; ?> </option>
													            <?php } ?>
								    					  </select>
		   		   										   <div id="mensaje_id_provincias" class="errores"></div>
                                    </div>
                                    </div>
                        		    
                        		    <div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                          <label for="id_cantones" class="control-label">Cantón</label>
                                                          <select name="id_cantones" id="id_cantones"  class="form-control">
                                                            <option value="0" selected="selected">--Seleccione--</option>
																<?php foreach($resultCant as $res) {?>
				 												<option value="<?php echo $res->id_cantones; ?>"  ><?php echo $res->nombre_cantones; ?> </option>
													            <?php } ?>
								    					  </select>
		   		   										   <div id="mensaje_id_cantones" class="errores"></div>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    <div class="row">
                        		    
                        		    <div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                          <label for="id_parroquias" class="control-label">Parroquias</label>
                                                          <select name="id_parroquias" id="id_parroquias"  class="form-control">
                                                            <option value="0" selected="selected">--Seleccione--</option>
																<?php foreach($resultParr as $res) {?>
				 												<option value="<?php echo $res->id_parroquias; ?>"  ><?php echo $res->nombre_parroquias; ?> </option>
													            <?php } ?>
								    					  </select>
		   		   										   <div id="mensaje_id_parroquias" class="errores"></div>
                                    </div>
                                    </div>
                        		  
									</div>
              	                     	           	
                    		     <?php } ?>
                    		    <br>  
                    		    <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; ">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Guardar</button>
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
              <h3 class="box-title">Listado Bodegas</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activos" data-toggle="tab">Bodegas Activas</a></li>
              <li><a href="#inactivos" data-toggle="tab">Bodegas Inactivas</a></li>
            </ul>
            
            <div class="col-md-5 col-lg-12 col-xs-5">
            <div class="tab-content">
            <br>
              <div class="tab-pane active" id="activos">
                
					<div class="pull-right" style="margin-right:15px;">
						<input type="text" value="" class="form-control" id="search_activos" name="search_activos" onkeyup="load_bodegas_activos(1)" placeholder="search.."/>
					</div>
					<div id="load_bodegas_activos" ></div>	
					<div id="bodegas_activos_registrados"></div>	
                
              </div>
              
              <div class="tab-pane" id="inactivos">
                
                    <div class="pull-right" style="margin-right:15px;">
					<input type="text" value="" class="form-control" id="search_inactivos" name="search_inactivos" onkeyup="load_bodegas_inactivos(1)" placeholder="search.."/>
					</div>
					<div id="load_bodegas_inactivos" ></div>	
					<div id="bodegas_inactivos_registrados"></div>
                
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
    
	<script src="view/Inventario/js/Bodegas.js?3.2" ></script>
  </body>
</html>   

 