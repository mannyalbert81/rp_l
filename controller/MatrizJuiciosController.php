	<?php

    class MatrizJuiciosController extends ControladorBase{
	public function __construct() {
		parent::__construct();
		
	}
	
	public function index5(){
	    
	    session_start();
	    if (isset(  $_SESSION['nombre_usuarios']) )
	    {
	        $controladores = new ControladoresModel();
	        $nombre_controladores = "MatrizJuicios";
	        $id_rol= $_SESSION['id_rol'];
	        $resultPer = $controladores->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	        
	        if (!empty($resultPer))
	        {
	            
	            
	            
	            $this->view_Juridico("MatrizJuiciosCordinador",array(
	                ""=>""
	            ));
	            
	        }
	        else
	        {
	            $this->view("Error",array(
	                "resultado"=>"No tiene Permisos de Acceso a consultar una solicitud de prestamo."
	                
	            ));
	            
	        }
	        
	        
	    }
	    else
	    {
	        $error = TRUE;
	        $mensaje = "Te sesión a caducado, vuelve a iniciar sesión.";
	        
	        $this->view("Login",array(
	            "resultSet"=>"$mensaje", "error"=>$error
	        ));
	        
	        
	        die();
	        
	    }
	    
	}
	public function searchadminsuper(){
	    
	    session_start();
	    
	    require_once 'core/DB_Juicios.php';
	    $db = new DB_Juicios();
	    
	    
	    
	    
	    $where_to="";
	    $columnas = " juicios.id_juicios,
								  juicios.orden,
								  juicios.regional,
								  juicios.juicio_referido_titulo_credito,
								  juicios.year_juicios,
								  clientes.id_clientes,
								  clientes.identificacion_clientes,
								  clientes.nombres_clientes,
								  clientes.nombre_garantes,
								  clientes.identificacion_garantes,
								clientes.identificacion_clientes_1,
								clientes.nombre_clientes_1,
								clientes.identificacion_clientes_2,
								clientes.nombre_clientes_2,
								clientes.identificacion_clientes_3,
								clientes.nombre_clientes_3,
								clientes.identificacion_garantes_1,
								clientes.nombre_garantes_1,
								clientes.identificacion_garantes_2,
								clientes.nombre_garantes_2,
								clientes.identificacion_garantes_3,
								clientes.nombre_garantes_3,
								clientes.correo_clientes,
								clientes.correo_clientes_1,
								clientes.correo_clientes_2,
								clientes.correo_clientes_3,
								clientes.direccion_clientes,
								clientes.direccion_clientes_1,
								clientes.direccion_clientes_2,
								clientes.direccion_clientes_3,
									clientes.cantidad_clientes,
								  clientes.cantidad_garantes,
								  clientes.sexo_clientes,
								  clientes.sexo_clientes_1,
								  clientes.sexo_clientes_2,
								  clientes.sexo_clientes_3,
								  clientes.sexo_garantes,
								  clientes.sexo_garantes_1,
								  clientes.sexo_garantes_2,
								  clientes.sexo_garantes_3,
								  provincias.id_provincias,
								  provincias.nombre_provincias,
								  titulo_credito.id_titulo_credito,
								  titulo_credito.numero_titulo_credito,
								  juicios.fecha_emision_juicios,
								  juicios.cuantia_inicial,
								  juicios.riesgo_actual,
								  estados_procesales_juicios.id_estados_procesales_juicios,
								  estados_procesales_juicios.nombre_estados_procesales_juicios,
								  juicios.descripcion_estado_procesal,
								  juicios.fecha_ultima_providencia,
								  juicios.estrategia_seguir,
								  juicios.observaciones,
								  juicios.tipo_leyes,
								  juicios.medida_cautelar,
								  juicios.embargo_bienes,
								  juicios.detalle_embargo_bienes,
								  juicios.observacion,
								  asignacion_secretarios_view.id_abogado,
								  asignacion_secretarios_view.impulsores,
								  asignacion_secretarios_view.id_secretario,
								  asignacion_secretarios_view.secretarios,
								  ciudad.id_ciudad,
								  ciudad.nombre_ciudad,
									clientes.correo_garantes_1,
								  clientes.correo_garantes_2,
								  clientes.correo_garantes_3,
								  clientes.correo_garantes_4,
								  clientes.direccion_garantes_1,
								  clientes.direccion_garantes_2,
								  clientes.direccion_garantes_3,
								  clientes.direccion_garantes_4,
									juicios.id_origen_juicio,
								  origen_juicio.nombre_origen_juicio,
									carton_juicuis.numero_carton_jucios";
	    
	    
	    
	    $tablas=" public.clientes,
							  public.titulo_credito,
							  public.juicios,
							  public.asignacion_secretarios_view,
							  public.estados_procesales_juicios,
							  public.provincias,
							  public.ciudad, public.origen_juicio, public.carton_juicuis";
	    
	    $where="clientes.id_clientes = titulo_credito.id_clientes AND
							clientes.id_provincias = provincias.id_provincias AND
							titulo_credito.id_titulo_credito = juicios.id_titulo_credito AND
							asignacion_secretarios_view.id_ciudad = ciudad.id_ciudad AND
							juicios.id_estados_procesales_juicios = estados_procesales_juicios.id_estados_procesales_juicios AND
							asignacion_secretarios_view.id_abogado = titulo_credito.id_usuarios AND juicios.id_origen_juicio= origen_juicio.id_origen_juicio AND juicios.id_carton_juicios=carton_juicuis.id_carton_juicios";
	    
	    $id="juicios.id_juicios";
	    
	    
	    //$where_to=$where;
	    
	    
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    if($action == 'ajax')
	    {
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND (clientes.identificacion_clientes LIKE '".$search."%' OR clientes.nombres_clientes LIKE '".$search."%' OR clientes.nombre_garantes LIKE '".$search."%' OR juicios.juicio_referido_titulo_credito LIKE '".$search."%'  OR ciudad.nombre_ciudad LIKE '".$search."%' OR  origen_juicio.nombre_origen_juicio LIKE '".$search."%')";
	            
	            $where_to=$where.$where1;
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        
	        $html="";
	        $resultSet=$db->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 10; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$db->getCondicionesPagDesc($columnas, $tablas, $where_to, $id, $limit);
	        $count_query   = $cantidadResult;
	        $total_pages = ceil($cantidadResult/$per_page);
	        
	        if ($cantidadResult>0)
	        {
	            
	           
	            $html.='<div class="pull-left" style="margin-left:11px;">';
	            $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	            $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	            $html.='</div>';
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:350px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_solicitud_prestamos_registrados' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;">Ord.</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Origen</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;"># Juicio</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Año Juicio</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombres Cliente 1</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Sexo 1</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Fecha Última Providencia</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Estrategia a Seguir</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Estado Procesal</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Observaciones</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Impulsor</th>';
	            
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            $i=0;
	            
	            foreach ($resultSet as $res)
	            {
	                
	                $i++;
	                $html.='<tr>';
	                $html.='<td style="font-size: 11px;">'.$i.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_origen_juicio.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->juicio_referido_titulo_credito.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->year_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombres_clientes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->sexo_clientes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_ultima_providencia.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->estrategia_seguir.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_estados_procesales_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->observacion.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->impulsores.'</td>';
	                $html.='</tr>';
	                
	                
	                
	            }
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section>';
	            $html.='</div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents).'';
	            $html.='</div>';
	            
	            
	            
	        }else{
	            $html.='<br>';
	            $html.='<br>';
	            $html.='<br>';
	            $html.='<div class="alert alert-warning alert-dismissable">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> No hay datos para mostrar';
	            $html.='</div>';
	            
	        }
	        
	        echo $html;
	        die();
	        
	    }
	    
	}
	
	   
	public function paginate($reload, $page, $tpages, $adjacents) {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_matriz(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_matriz(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_matriz(1)'>1</a></li>";
	    }
	    // interval
	    if($page>($adjacents+2)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // pages
	    
	    $pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	    $pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	    for($i=$pmin; $i<=$pmax; $i++) {
	        if($i==$page) {
	            $out.= "<li class='active'><a>$i</a></li>";
	        }else if($i==1) {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_matriz(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_matriz(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_matriz($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_matriz(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	

	public function searchadminsuperDoc(){
	    
	    session_start();
	    
	    require_once 'core/DB_Juicios.php';
	    $db = new DB_Juicios();
	    
	    
	    
	    
	    $where_to="";
	    $columnas="ju.regional,tc.id_titulo_credito,ju.id_juicios,tc.numero_titulo_credito, ju.numero_juicios, cl.identificacion_clientes
									,cl.nombres_clientes , asv.id_abogado ,asv.impulsores ,asv.id_secretario ,asv.secretarios
									, pr.id_providencias , pr.firmado_secretario, pr.nombre_archivo_providencias,ju.fecha_emision_juicios
									, pr.ruta_providencias, pr.modificado, pr.nombre_archivo_providencias, pr.creado, pr.ruta_providencias";
	    
	    $tablas=" juicios ju INNER JOIN  titulo_credito tc ON tc.id_titulo_credito = ju.id_titulo_credito
								INNER JOIN clientes cl ON cl.id_clientes = ju.id_clientes
								INNER JOIN provincias pv ON pv.id_provincias = cl.id_provincias
								INNER JOIN providencias pr  ON pr.id_juicios = ju.id_juicios
								INNER JOIN estados_procesales_juicios ep ON ep.id_estados_procesales_juicios = pr.id_estados_procesales_juicios
								INNER JOIN asignacion_secretarios_view asv ON asv.id_abogado = tc.id_usuarios
								INNER JOIN tipo_providencias tpr ON tpr.id_tipo_providencias = pr.id_tipo_providencias
								";
	    
	    $where=" 1=1";
	    $id="ju.id_juicios";
	    
	    
	    //$where_to=$where;
	    
	    
	    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    if($action == 'ajax')
	    {
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND (cl.identificacion_clientes LIKE '".$search."%' OR cl.nombres_clientes LIKE '".$search."%' OR cl.nombre_garantes LIKE '".$search."%' OR ju.juicio_referido_titulo_credito LIKE '".$search."%')";
	            
	            $where_to=$where.$where1;
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        
	        $html="";
	        $resultSet=$db->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 10; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$db->getCondicionesPagDesc($columnas, $tablas, $where_to, $id, $limit);
	        $count_query   = $cantidadResult;
	        $total_pages = ceil($cantidadResult/$per_page);
	        
	        if ($cantidadResult>0)
	        {
	            
	            
	            $html.='<div class="pull-left" style="margin-left:11px;">';
	            $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	            $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	            $html.='</div>';
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:350px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_solicitud_prestamos_registrados' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Ord.</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;"># Juicio</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombre Documento</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cedula Cliente Principal</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombres Cliente Principal</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;"># Operación</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Fecha Creacion Doc</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Fecha Aprobación Secretario</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Impulsor</th>';
	            
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            $i=0;
	            
	            foreach ($resultSet as $res)
	            {
	                
	                $i++;
	                $html.='<tr>';
	                $html.='<td><a target="_blank" href="index.php?controller=MatrizJuicios&action=verDoc&documento='.$res->id_juicios.'-'.$res->ruta_providencias.'-'.$res->nombre_archivo_providencias.'&id_juicios='. $res->id_juicios.' "><img src="view/images/logo_pdf.png" width="40" height="40"></a></td>';
	                $html.='<td style="font-size: 11px;">'.$i.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->numero_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_archivo_providencias.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->identificacion_clientes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombres_clientes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->numero_titulo_credito.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->creado.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->modificado.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->impulsores.'</td>';
	                
	                $html.='</tr>';
	                
	                
	                
	            }
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section>';
	            $html.='</div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginateDoc("index.php", $page, $total_pages, $adjacents).'';
	            $html.='</div>';
	            
	            
	            
	        }else{
	            
	            $html.='<br>';
	            $html.='<br>';
	            $html.='<br>';
	            $html.='<div class="alert alert-warning alert-dismissable">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> No hay datos para mostrar';
	            $html.='</div>';
	            
	        }
	        
	        echo $html;
	        die();
	        
	    }
	    
	}

	
	public function paginateDoc($reload, $page, $tpages, $adjacents) {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_matriz_doc(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_matriz_doc(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_matriz_doc(1)'>1</a></li>";
	    }
	    // interval
	    if($page>($adjacents+2)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // pages
	    
	    $pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	    $pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	    for($i=$pmin; $i<=$pmax; $i++) {
	        if($i==$page) {
	            $out.= "<li class='active'><a>$i</a></li>";
	        }else if($i==1) {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_matriz_doc(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='load_matriz_doc(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='load_matriz_doc($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='load_matriz_doc(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	
	public function verDoc()
	{
	    session_start();
	    if (isset($_SESSION['usuario_usuarios']) )
	    {
	        $id_juicios = $_GET['id_juicios'];
	        $documento = $_GET['documento'];
	        $arraydoc = explode('-', $documento);
	        
	        //para produccion
	        $mi_pdf = 'C:/coactiva/Documentos/'.$arraydoc[1].'/'.$arraydoc[2].'.pdf';
	        
	     
	        if(file_exists($mi_pdf))
	        {
	            header('Content-type: application/pdf');
	            header('Content-Disposition: inline; filename="'.$mi_pdf.'"');
	            readfile($mi_pdf);
	        }else
	        {
	            echo 'ESTIMADO USUARIO SE PRESENTAN INCONVENIENTES PARA ABRIR SU PDF, INTENTELO MAS TARDE.';
	        }
	        
	        
	    }
	}
	
	public function index6(){
	    
	    session_start();
	    if (isset(  $_SESSION['nombre_usuarios']) )
	    {
	        $controladores = new ControladoresModel();
	        $nombre_controladores = "MatrizJuicios";
	        $id_rol= $_SESSION['id_rol'];
	        $resultPer = $controladores->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	        
	        if (!empty($resultPer))
	        {
	            
	            
	            
	            $this->view_Juridico("AgregarJuicios",array(
	                ""=>""
	            ));
	            
	        }
	        else
	        {
	            $this->view("Error",array(
	                "resultado"=>"No tiene Permisos de Acceso"
	                
	            ));
	            
	        }
	        
	        
	    }
	    else
	    {
	        $error = TRUE;
	        $mensaje = "Te sesión a caducado, vuelve a iniciar sesión.";
	        
	        $this->view("Login",array(
	            "resultSet"=>"$mensaje", "error"=>$error
	        ));
	        
	        
	        die();
	        
	    }
	    
	}
	
	public function AgregarJuicio(){
	    
	    session_start();
	    
	    $clientes = new ClientesModel();
	    
	    
	    $nombre_controladores = "MatrizJuicios";
	    $id_rol= $_SESSION['id_rol'];
	    $resultPer = $clientes->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	    
	    if (!empty($resultPer)){

	        $_identificacion_clientes = (isset($_POST["identificacion_clientes"])) ? $_POST["identificacion_clientes"] : "";
	        $_nombre_clientes = (isset($_POST["nombre_clientes"])) ? $_POST["nombre_clientes"] : "" ;
	        $_entidad_origen_juicios = (isset($_POST["entidad_origen_juicios"])) ? $_POST["entidad_origen_juicios"] : "";
	        $_regional_juicios = (isset($_POST["regional_juicios"])) ? $_POST["regional_juicios"] : "" ;
	        $_numero_juicios = (isset($_POST["numero_juicios"])) ? $_POST["numero_juicios"] : "";
	        $_anio_juicios = (isset($_POST["anio_juicios"])) ? $_POST["anio_juicios"] : "" ;
	        $_numero_titulo_credito_juicios = (isset($_POST["numero_titulo_credito_juicios"])) ? $_POST["numero_titulo_credito_juicios"] : "";
	        $_fecha_titulo_credito_juicios = (isset($_POST["fecha_titulo_credito_juicios"])) ? $_POST["fecha_titulo_credito_juicios"] : "" ;
	        $_orden_cobro_juicios = (isset($_POST["orden_cobro_juicios"])) ? $_POST["orden_cobro_juicios"] : "";
	        $_fecha_oden_cobro_juicios = (isset($_POST["fecha_oden_cobro_juicios"])) ? $_POST["fecha_oden_cobro_juicios"] : "" ;
	        $_fecha_auto_pago_juicios = (isset($_POST["fecha_auto_pago_juicios"])) ? $_POST["fecha_auto_pago_juicios"] : "";
	        $_cuantia_inicial_juicios = (isset($_POST["cuantia_inicial_juicios"])) ? $_POST["cuantia_inicial_juicios"] : "" ;
	        $_id_etapa_procesal = (isset($_POST["id_etapa_procesal"])) ? $_POST["id_etapa_procesal"] : 0;
	        $_id_estado_procesal = (isset($_POST["id_estado_procesal"])) ? $_POST["id_estado_procesal"] : 0 ;
	        $_fecha_ultima_providencia_juicios = (isset($_POST["fecha_ultima_providencia_juicios"])) ? $_POST["fecha_ultima_providencia_juicios"] : "";
	        $_id_usuarios_secretario = (isset($_POST["id_usuarios_secretario"])) ? $_POST["id_usuarios_secretario"] : 0 ;
	        $_observaciones_juicios = (isset($_POST["observaciones_juicios"])) ? $_POST["observaciones_juicios"] : "" ;
	        
	        /*si es insertado enviar en cero el id_banco a la funcion*/
	        $funcion = "ins_legal_clientes_juicios";
	        $respuesta = 0 ;
	        $mensaje = "";
	    
	        if(!empty($_identificacion_clientes)){
	            
	            $parametros = " '$_identificacion_clientes',
                                '$_nombre_clientes',
                                '$_entidad_origen_juicios',
                                '$_regional_juicios',
                                '$_numero_juicios',
                                '$_anio_juicios',
                                '$_numero_titulo_credito_juicios',
                                '$_fecha_titulo_credito_juicios',
                                '$_orden_cobro_juicios',
                                '$_fecha_oden_cobro_juicios',
                                '$_fecha_auto_pago_juicios',
                                '$_cuantia_inicial_juicios',
                                '$_id_etapa_procesal',
                                '$_fecha_ultima_providencia_juicios',
                                '$_observaciones_juicios',
                                '$_id_estado_procesal',
                                '$_id_usuarios_secretario'";
	            $clientes->setFuncion($funcion);
	            $clientes->setParametros($parametros);
	            $resultado = $clientes->llamafuncion();
	            
	            if(!empty($resultado) && count($resultado) > 0 ){
	                
	                foreach ( $resultado[0] as $k => $v){
	                    
	                    $respuesta = $v;
	                }
	                
	                //
	            }
	        }
	        
	        
	        if($respuesta > 0 ){
	            
	            
	            if ( $respuesta == 1 ){
	            $mensaje = "Jucio Actualizado Correctamente";
	            }
	            else 
	            {
	                $mensaje = "Jucio Ingresado Correctamente";
	            }
	            
	            echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
	            exit();
	        }
	        
	        echo "Error al Ingresar";
	        exit();
	        
	    }
	    else
	    {
	        $this->view_Inventario("Error",array(
	            "resultado"=>"No tiene Permisos"
	            
	        ));
	        
	        
	    }
	    
	    
	}
	
	public function CargaEtapaProcesal(){
	    
	    $etapa_procesal = null;
	    $etapa_procesal = new EtapaProcesalModel();
	    
	    $query = " SELECT id_etapa_procesal, nombre_etapa_procesal FROM legal_etapa_procesal";
	    
	    $resulset = $etapa_procesal->enviaquery($query);
	    
	    if(!empty($resulset) && count($resulset)>0){
	        
	        echo json_encode(array('data'=>$resulset));
	        
	    }
	}
	
	public function CargaEstadoProcesal(){
	    
	    $estado_procesal = null;
	    $estado_procesal = new EstadoProcesalModel();
	    
	    $query = " SELECT id_estado_procesal, nombre_estado_procesal FROM legal_estado_procesal";
	    
	    $resulset = $estado_procesal->enviaquery($query);
	    
	    if(!empty($resulset) && count($resulset)>0){
	        
	        echo json_encode(array('data'=>$resulset));
	        
	    }
	}
	
	public function CargaUsuariosSecretario(){
	    
	    $usuarios_secretario = null;
	    $usuarios_secretario = new UsuariosModel();
	    
	    $query = " SELECT id_usuarios, nombre_usuarios FROM usuarios WHERE id_rol = 65";
	    
	    $resulset = $usuarios_secretario->enviaquery($query);
	    
	    if(!empty($resulset) && count($resulset)>0){
	        
	        echo json_encode(array('data'=>$resulset));
	        
	    }
	}
	
	public function ConsultaJuicios(){
	    
	    
	    
	    
	    session_start();
	    
	    
	    $clientes = new ClientesModel();
	    
	    $where_to="";
	    $columnas  = "legal_juicios.id_juicios, 
                      legal_clientes.id_clientes, 
                      legal_clientes.identificacion_clientes, 
                      legal_clientes.nombre_clientes, 
                      legal_juicios.entidad_origen_juicios, 
                      legal_juicios.regional_juicios, 
                      legal_juicios.numero_juicios, 
                      legal_juicios.anio_juicios, 
                      legal_juicios.numero_titulo_credito_juicios, 
                      legal_juicios.fecha_titulo_credito_juicios, 
                      legal_juicios.orden_cobro_juicios, 
                      legal_juicios.fecha_oden_cobro_juicios, 
                      legal_juicios.fecha_auto_pago_juicios, 
                      legal_juicios.cuantia_inicial_juicios, 
                      legal_etapa_procesal.id_etapa_procesal, 
                      legal_etapa_procesal.nombre_etapa_procesal, 
                      legal_juicios.fecha_ultima_providencia_juicios, 
                      legal_juicios.observaciones_juicios, 
                      legal_estado_procesal.id_estado_procesal, 
                      legal_estado_procesal.nombre_estado_procesal, 
                      usuarios.id_usuarios, 
                      usuarios.cedula_usuarios, 
                      usuarios.nombre_usuarios, 
                      usuarios.apellidos_usuarios";
	    
	    $tablas    = "public.legal_juicios, 
                      public.legal_clientes, 
                      public.legal_estado_procesal, 
                      public.legal_etapa_procesal, 
                      public.usuarios";
	    
	    $where     = "legal_juicios.id_clientes = legal_clientes.id_clientes AND
                      legal_juicios.id_etapa_procesal = legal_etapa_procesal.id_etapa_procesal AND
                      legal_juicios.id_estado_procesal = legal_estado_procesal.id_estado_procesal AND
                      legal_juicios.id_usuarios_secretario = usuarios.id_usuarios";
	    
	    $id        = "legal_juicios.id_juicios";
	    
	    
	    $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    if($action == 'ajax')
	    {
	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND nombre_clientes ILIKE '".$search."%'";
	            
	            $where_to=$where.$where1;
	            
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        $html="";
	        $resultSet=$clientes->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 10; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$clientes->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
	        $total_pages = ceil($cantidadResult/$per_page);
	        
	        if($cantidadResult > 0)
	        {
	            
	            $html.='<div class="pull-left" style="margin-left:15px;">';
	            $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	            $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	            $html.='</div>';
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:400px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_bancos' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;">#</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Entidad Origen</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Regional</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">N° Juicio</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Año Juicio</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Identificación</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Título Crédito</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Fecha Título Crédito</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Orden de Cobro</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">fecha Orden de Cobro</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Fecha Auto de Pago</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cuantía Inicial</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Etapa Procesal</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Estado Procesal</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Fecha Ultima Providencia</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Abogado</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Observaciones</th>';
	            
	            
	            
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            
	            $i=0;
	            
	            foreach ($resultSet as $res)
	            {
	                
	                $i++;
	                $html.='<tr>';
	                $html.='<td style="font-size: 11px;">'.$i.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->entidad_origen_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->regional_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->numero_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->anio_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->identificacion_clientes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_clientes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->numero_titulo_credito_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_titulo_credito_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->orden_cobro_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_oden_cobro_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_auto_pago_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->cuantia_inicial_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_etapa_procesal.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_estado_procesal.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fecha_ultima_providencia_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_usuarios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->observaciones_juicios.'</td>';
	                
	                
	                /*comentario up */
	                
	                
	                
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate_juicios("index.php", $page, $total_pages, $adjacents,"ConsultaJuicios").'';
	            $html.='</div>';
	            
	            
	            
	        }else{
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay empleados registrados...</b>';
	            $html.='</div>';
	            $html.='</div>';
	        }
	        
	        
	        echo $html;
	        
	    }
	    
	}

	public function paginate_juicios($reload, $page, $tpages, $adjacents, $funcion = "") {
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='$funcion(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='$funcion(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='$funcion(1)'>1</a></li>";
	    }
	    // interval
	    if($page>($adjacents+2)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // pages
	    
	    $pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	    $pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	    for($i=$pmin; $i<=$pmax; $i++) {
	        if($i==$page) {
	            $out.= "<li class='active'><a>$i</a></li>";
	        }else if($i==1) {
	            $out.= "<li><a href='javascript:void(0);' onclick='$funcion(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='$funcion(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='$funcion($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='$funcion(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	}
	
	
    }
	//
	
	?>