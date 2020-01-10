   <!DOCTYPE HTML>
	<html lang="en">
    <head>
        
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cálculo Honorarios - Juridico</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
    <?php include("view/modulos/links_css.php"); ?>		
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
   <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
       
   
 
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
        <li class="active">Procesos Mayorizacion</li>
      </ol>
    </section>

   <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">FÓRMULA DE CÁLCULO PARA LA APLICACIÓN DE LA
								MEDIDA CAUTELAR DE RETENCIÓN DE FONDOS</h3>          
        </div>
        
           
         <div class="box-body">
         
         <form id="form_movimientos_contable" action="<?php echo $helper->url("TributarioGeneraAts","index"); ?>" method="post" enctype="multipart/form-data" class="col-lg-12">
          
          <div class="row">
			<div class="col-md-4 col-lg-4 col-xs-12">
	         	
	         	 <div class="input-group input-group-lg">
			        
                    <input type="text" id="numero_juicios"  name="numero_juicios"  value="" placeholder="Nuúmero de Juicio a Buscar..." class="form-control">
			      	<span class="input-group-btn">
			        	<button class="btn btn-info" id="btnBuscarJuicios"  name="btnBuscarJuicios" type="button">Buscar</button>
			     	</span>
			    </div>
	         	
	         	
	         </div>
	  	</div>     
		<div class="box-body">
        	<div id="div_detalle_juicio"></div>
	    </div>  
	    
	   	<br>
	   	<div class="row">
		<div class="col-md-3 col-lg-3 col-xs-12">
		<div class="form-group">
		<label for="meses_mora" class="control-label">INGRESO DE INFORMACIÓN:</label>
		
		</div>
		</div>
		</div>
		<div class="row">
		<div class="col-md-3 col-lg-3 col-xs-12">
		<div class="form-group">
		<label for="id_juicios" class="control-label">Fecha de Cálculo Coactiva:</label>
		<input type="date" id="fecha_calculo_coactiva" name="fecha_calculo_coactiva"  value"" class="form-control">
		</div>
		</div>
		 
		 
		 
		<div class="col-md-3 col-lg-3 col-xs-12">
		<div class="form-group">
		<label for="tasa_interes" class="control-label">Tasa de Interés Legal:</label>
		<div class="input-group input-group-lg">
		<input type="text" id="tasa_interes" name="tasa_interes"  value="8.02" class="form-control">
		<span class="input-group-addon">%</span>
		</div>
		
		
		</div>
		</div>
		
		<div class="col-md-3 col-lg-3 col-xs-12">
		<div class="form-group">
		<label for="tasa_mora" class="control-label">Tasa de interés por Mora:</label>
		<div class="input-group input-group-lg">
		<input readonly 		type="text" id="tasa_mora" name="tasa_mora"  value="" class="form-control">
		<span class="input-group-addon">%</span>
		</div>
		
		</div>
		</div>
		 
		<div class="col-md-3 col-lg-3 col-xs-12">
		<div class="form-group">
		<label for="tasa_mora" class="control-label">Fecha Vencimiento:</label>
		<input type="date" id="fecha_vencimiento" name="fecha_vencimiento"  value="" class="form-control">
		</div>
		</div>
		</div>
		 
		 
		<div class="row">
		<div class="col-md-offset-4 col-lg-offset-4 col-md-2 col-lg-2 col-xs-12">
		<div class="form-group">
		<button type="button" id="btnCalcular" name="btnCalcular" class="btn btn-block btn-default" ><i class="fa fa-desktop" aria-hidden="true"></i>Calcular</button>
		</div>
		</div>
		</div>
	   	
		<div class="box-body">
        	<div id="div_detalle_calculo"></div>
	    </div>  
		
		
	     
	     		 </form>
	 </div>
	      
	   
        
       </div>
    </section>
    
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Detalles</h3>        
        </div>
	    <div class="box-body">
        	<div id="div_detalle_procesos" ></div>
	    </div>
	   </div>
    </section>
        
  </div>
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 
     
   
  <?php include("view/modulos/links_js.php"); ?>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
  <script src="view/Juridico/js/calculaHonorarios.js?0.47"></script>
  
	
 </body>
</html>