<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
    .scrollable-menu {
    height: auto;
    max-height: 200px;
    overflow-x: hidden;
}

	ul{
        list-style-type:none;
      }
  li{
    list-style-type:none;
    }
    
    </style>
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
    <title>Calculo Honorarios</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
   <?php include("view/modulos/links_css.php"); ?>
   


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
            <li class="active">Formulario B17</li>
          </ol>
        </section>
        
        <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="text-center"><b>FÓRMULA DE CÁLCULO PARA LA APLICACIÓN DE LA
								MEDIDA CAUTELAR DE RETENCIÓN DE FONDOS </b></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            <div class="box-body">
           		
           		 <div class="row">
					<div class="col-md-4 col-lg-4 col-xs-12" >
			         	
			         	 <div class="input-group input-group-lg" >
					        
		                    <input type="text" id="numero_juicios"  name="numero_juicios"  value="" placeholder="Número de Juicio a Buscar..." class="form-control">
					      	<span class="input-group-btn">
					        	<button style="text-align: center;" class="btn btn-info" id="btnBuscarJuicios"  name="btnBuscarJuicios" type="button">Buscar</button>
					     	</span>
					    </div>
			         	
			         	
			         </div>
			  	</div>     
				<br>
		        <div id="div_detalle_juicio"></div>
			   	<br>

				 
				 
				<div class="row">
				<div class="col-md-offset-4 col-lg-offset-4 col-md-2 col-lg-2 col-xs-12">
				<div class="form-group">
				<button type="button" id="btnCalcular" name="btnCalcular" class="btn btn-block btn-warning" ><i class="glyphicon glyphicon-usd" aria-hidden="true"></i> Calcular</button>
				</div>
				</div>
				</div>
			   	
			   	
			   	</div>	     
                <div id="div_detalle_calculo"></div>
                <div id="div_detalle_calculo_boton">
	                <div class="row">
					<div class="col-md-offset-4 col-lg-offset-4 col-md-2 col-lg-2 col-xs-12">
					<div class="form-group">
					<button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-block btn-success"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i> Guardar</button>
					</div>
					</div>
					</div>
		        </div>        
                
           
        	</div>
      	</div>
    </section>
    		
    <!-- seccion para el listado de roles -->
    <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Honorarios Calculados</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
             <div class="box-body">
	           <div class="nav-tabs-custom">
	            <ul class="nav nav-tabs">
	            </ul>
	            <div class="col-md-12 col-lg-12 col-xs-12">
	            <div class="tab-content">
	            <br>
	              <div class="tab-pane active" id="honorarios">
	                
						<div class="pull-right" style="margin-right:15px;">
							<input type="text" value="" class="form-control" id="search_honorarios" name="search_honorarios" onkeyup="load_honorarios(1)" placeholder="buscar.."/>
						</div>
						<div id="load_honorarios" ></div>	
						<div id="honorarios_registrados_detalle"></div>	
						<div id="divLoaderPage"></div>	
	                
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
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
  <script src="view/Juridico/js/calculaHonorarios.js?1.10"></script>
  

  </body>

</html>
