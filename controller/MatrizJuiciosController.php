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
	            
	            
	            
	            $this->view_GestionDocumental("MatrizJuiciosCordinador",array(
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
	            
	            
	            
	            $this->view_GestionDocumental("AgregarJuicios",array(
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
	    if (isset(  $_SESSION['usuario_usuarios']) )
	    {
	        $providencias= new ProvidenciasModel();
	        $asignacion_secretarios = new AsignacionSecretariosModel();
	        
	        if(isset($_POST['agregar']))
	        {
	            
	            $_cuantia_inicial=0;
	            
	            $_identificacion_clientes= $_POST["identificacion_clientes"];
	            $_nombres_clientes= $_POST["nombres_clientes"];
	            $_sexo_clientes= $_POST["sexo_clientes"];
	            $_correo_clientes= $_POST["correo_clientes"];
	            $_direccion_clientes= $_POST["direccion_clientes"];
	            
	            $_identificacion_clientes_1= $_POST["identificacion_clientes_1"];
	            $_nombre_clientes_1= $_POST["nombre_clientes_1"];
	            $_sexo_clientes_1= $_POST["sexo_clientes_1"];
	            $_correo_clientes_1= $_POST["correo_clientes_1"];
	            $_direccion_clientes_1= $_POST["direccion_clientes_1"];
	            
	            
	            $_identificacion_clientes_2= $_POST["identificacion_clientes_2"];
	            $_nombre_clientes_2= $_POST["nombre_clientes_2"];
	            $_sexo_clientes_2= $_POST["sexo_clientes_2"];
	            $_correo_clientes_2= $_POST["correo_clientes_2"];
	            $_direccion_clientes_2= $_POST["direccion_clientes_2"];
	            
	            $_identificacion_clientes_3= $_POST["identificacion_clientes_3"];
	            $_nombre_clientes_3= $_POST["nombre_clientes_3"];
	            $_sexo_clientes_3= $_POST["sexo_clientes_3"];
	            $_correo_clientes_3= $_POST["correo_clientes_3"];
	            $_direccion_clientes_3= $_POST["direccion_clientes_3"];
	            
	            
	            $_identificacion_garantes= $_POST["identificacion_garantes"];
	            $_nombre_garantes= $_POST["nombre_garantes"];
	            $_sexo_garantes= $_POST["sexo_garantes"];
	            
	            $_identificacion_garantes_1= $_POST["identificacion_garantes_1"];
	            $_nombre_garantes_1= $_POST["nombre_garantes_1"];
	            $_sexo_garantes_1= $_POST["sexo_garantes_1"];
	            
	            
	            $_identificacion_garantes_2= $_POST["identificacion_garantes_2"];
	            $_nombre_garantes_2= $_POST["nombre_garantes_2"];
	            $_sexo_garantes_2= $_POST["sexo_garantes_2"];
	            
	            $_identificacion_garantes_3= $_POST["identificacion_garantes_3"];
	            $_nombre_garantes_3= $_POST["nombre_garantes_3"];
	            $_sexo_garantes_3= $_POST["sexo_garantes_3"];
	            
	            $_orden= $_POST["modal_edit_orden"];
	            $_regional= $_POST["regional"];
	            $_juicio_referido_titulo_credito= $_POST["juicio_referido_titulo_credito"];
	            $_year_juicios= $_POST["year_juicios"];
	            
	            
	            $_numero_titulo_credito= $_POST["numero_titulo_credito"];
	            $_fecha_emision_juicios= $_POST["fecha_emision_juicios"];
	            $_cuantia_inicial= $_POST["cuantia_inicial"];
	            $_riesgo_actual= $_POST["riesgo_actual"];
	            
	            $_id_provincias= $_POST["id_provincias"];
	            $_id_estados_procesales_juicios= $_POST["id_estados_procesales_juicios"];
	            $_fecha_emision_juicios= $_POST["fecha_emision_juicios"];
	            $_fecha_ultima_providencia= $_POST["fecha_ultima_providencia"];
	            $_id_abogado= $_POST["id_abogado"];
	            
	            
	            $_id_carton_juicios=1;
	            
	            
	            $_descripcion_estado_procesal= $_POST["descripcion_estado_procesal"];
	            
	            $_estrategia_seguir= $_POST["estrategia_seguir"];
	            $_observaciones= $_POST["observaciones"];
	            $_tipo_leyes= $_POST["tipo_leyes"];
	            $_medida_cautelar= $_POST["medida_cautelar"];
	            $_embargo_bienes= $_POST["embargo_bienes"];
	            $_detalle_embargo_bienes= $_POST["detalle_embargo_bienes"];
	            $_observacion= $_POST["observacion"];
	            $_forma_pago= $_POST["forma_pago"];
	            
	            
	            
	            $_correo_garantes_1= $_POST["correo_garantes_1"];
	            $_correo_garantes_2= $_POST["correo_garantes_2"];
	            $_correo_garantes_3= $_POST["correo_garantes_3"];
	            $_correo_garantes_4= $_POST["correo_garantes_4"];
	            
	            $_direccion_garantes_1= $_POST["direccion_garantes_1"];
	            $_direccion_garantes_2= $_POST["direccion_garantes_2"];
	            $_direccion_garantes_3= $_POST["direccion_garantes_3"];
	            $_direccion_garantes_4= $_POST["direccion_garantes_4"];
	            
	            $numero_carton= $_POST["numero_carton"];
	            $carton_juicios = new CartonJuiciosModel();
	            
	            if(!empty($numero_carton)){
	                
	                
	                $funcion = "ins_carton_juicios";
	                $parametros = "'$numero_carton','$_id_abogado'";
	                $carton_juicios->setFuncion($funcion);
	                $carton_juicios->setParametros($parametros);
	                $resultado=$carton_juicios->Insert();
	                
	                
	                $resultCarton = $carton_juicios->getBy("numero_carton_jucios='$numero_carton' AND id_usuarios='$_id_abogado'");
	                $_id_carton_juicios=$resultCarton[0]->id_carton_juicios;
	                
	            }else{
	                
	                $_id_carton_juicios=1;
	                
	            }
	            
	            
	            
	            
	            
	            $clientes= new ClientesModel();
	            $usuarios = new UsuariosModel();
	            $titulo_credito= new TituloCreditoModel();
	            $juicios = new JuiciosModel();
	            $_id_ciudad=0;
	            $_id_entidades=10;
	            $_id_titulo_credito=0;
	            $_id_estados_titulos_credito= $_POST["id_estados_procesales_juicios"];
	            $_id_estados_auto_pago_juicios= $_POST["id_estados_procesales_juicios"];
	            $_asignado_titulo_credito='true';
	            
	            
	            $resultCiudad = $usuarios->getBy("id_usuarios='$_id_abogado'");
	            $_id_ciudad=$resultCiudad[0]->id_ciudad;
	            
	            
	            $_id_origen_juicio= $_POST["id_origen_juicio"];
	            
	            
	            //$id=$clientes->getNuevo("clientes_id_clientes_seq");
	            //print_r($id);
	            //die();
	            
	            
	            try {
	                
	                ////////INSERTO CLIENTE
	                $funcion = "ins_clientes_liventy";
	                $parametros = "'$_identificacion_clientes','$_nombres_clientes','$_direccion_clientes','$_correo_clientes','$_sexo_clientes','$_identificacion_clientes_1','$_nombre_clientes_1','$_direccion_clientes_1','$_correo_clientes_1','$_sexo_clientes_1','$_identificacion_clientes_2','$_nombre_clientes_2','$_direccion_clientes_2','$_correo_clientes_2','$_sexo_clientes_2','$_identificacion_clientes_3','$_nombre_clientes_3','$_direccion_clientes_3','$_correo_clientes_3','$_sexo_clientes_3','$_identificacion_garantes','$_nombre_garantes','$_sexo_garantes','$_identificacion_garantes_1','$_nombre_garantes_1','$_sexo_garantes_1','$_identificacion_garantes_2','$_nombre_garantes_2','$_sexo_garantes_2','$_identificacion_garantes_3','$_nombre_garantes_3','$_sexo_garantes_3','$_id_ciudad','$_id_provincias','$_correo_garantes_1','$_correo_garantes_2','$_correo_garantes_3','$_correo_garantes_4','$_direccion_garantes_1','$_direccion_garantes_2', '$_direccion_garantes_3','$_direccion_garantes_4'";
	                $clientes->setFuncion($funcion);
	                $clientes->setParametros($parametros);
	                $resultado=$clientes->Insert();
	                
	                
	            }
	            catch(Exception $e){
	                
	                $this->view("Error",array(
	                    "resultado"=>"Eror al Insertar Clientes ->". $e
	                ));
	                exit();
	            }
	            
	            $resultClientes = $clientes->getBy("identificacion_clientes='$_identificacion_clientes' AND sexo_clientes='$_sexo_clientes' AND sexo_garantes='$_sexo_garantes' AND nombres_clientes='$_nombres_clientes' AND direccion_clientes='$_direccion_clientes' AND nombre_garantes='$_nombre_garantes' AND identificacion_garantes='$_identificacion_garantes' AND id_provincias='$_id_provincias' AND id_ciudad='$_id_ciudad'
			AND identificacion_clientes_1='$_identificacion_clientes_1'
			AND nombre_clientes_1='$_nombre_clientes_1'
			AND identificacion_clientes_2 ='$_identificacion_clientes_2'
			AND nombre_clientes_2 ='$_nombre_clientes_2'
			AND identificacion_clientes_3 ='$_identificacion_clientes_3'
			AND nombre_clientes_3  ='$_nombre_clientes_3'
			AND identificacion_garantes_1 ='$_identificacion_garantes_1'
			AND nombre_garantes_1 ='$_nombre_garantes_1'
			AND identificacion_garantes_2 ='$_identificacion_garantes_2'
			AND nombre_garantes_2 ='$_nombre_garantes_2'
			AND identificacion_garantes_3 ='$_identificacion_garantes_3'
			AND nombre_garantes_3 ='$_nombre_garantes_3'
			AND correo_clientes ='$_correo_clientes'
			AND correo_clientes_1 ='$_correo_clientes_1'
			AND correo_clientes_2 ='$_correo_clientes_2'
			AND correo_clientes_3 ='$_correo_clientes_3'
			AND direccion_clientes_1 ='$_direccion_clientes_1'
			AND direccion_clientes_2 ='$_direccion_clientes_2'
			AND direccion_clientes_3 ='$_direccion_clientes_3'
			AND sexo_clientes_1 ='$_sexo_clientes_1'
			AND sexo_clientes_2 ='$_sexo_clientes_2'
			AND sexo_clientes_3 ='$_sexo_clientes_3'
			AND sexo_garantes_1 ='$_sexo_garantes_1'
			AND sexo_garantes_2 ='$_sexo_garantes_2'
			AND sexo_garantes_3 ='$_sexo_garantes_3'
			AND  correo_garantes_1='$_correo_garantes_1'
			AND correo_garantes_2='$_correo_garantes_2'
			AND correo_garantes_3='$_correo_garantes_3'
			AND correo_garantes_4='$_correo_garantes_4'
			AND direccion_garantes_1='$_direccion_garantes_1'
			AND direccion_garantes_2='$_direccion_garantes_2'
			AND direccion_garantes_3='$_direccion_garantes_3'
			AND direccion_garantes_4='$_direccion_garantes_4'");
	            
	            $_id_clientes=$resultClientes[0]->id_clientes;
	            $_orden= $_id_clientes;
	            
	            
	            $_cantidad_clientes = 0;
	            $_cantidad_garantes = 0;
	            
	            
	            if ( $_nombres_clientes !=""  )
	            {
	                $_cantidad_clientes = 1;
	            }
	            
	            if ( $_nombre_clientes_1 !=""  )
	            {
	                $_cantidad_clientes = 2;
	            }
	            
	            if ( $_nombre_clientes_2 !=""  )
	            {
	                $_cantidad_clientes = 3;
	            }
	            
	            if ( $_nombre_clientes_3 !=""  )
	            {
	                $_cantidad_clientes = 4;
	            }
	            
	            
	            
	            if ( $_nombre_garantes !=""  )
	            {
	                $_cantidad_garantes = 1;
	            }
	            
	            if ( $_nombre_garantes_1 !=""  )
	            {
	                $_cantidad_garantes = 2;
	            }
	            
	            if ( $_nombre_garantes_2 !=""  )
	            {
	                $_cantidad_garantes = 3;
	            }
	            
	            
	            if ( $_nombre_garantes_3 !=""  )
	            {
	                $_cantidad_garantes = 4;
	            }
	            
	            
	            
	            
	            
	            if($_id_clientes>0){
	                
	                
	                
	                $colval11="cantidad_clientes='$_cantidad_clientes',
				cantidad_garantes='$_cantidad_garantes'";
	                $tabla11="clientes";
	                $where11="id_clientes='$_id_clientes'";
	                
	                
	                try {
	                    
	                    $resultado=$clientes->UpdateBy($colval11, $tabla11, $where11);
	                    
	                    
	                }catch(Exception $e){
	                    
	                    $this->view("Error",array(
	                        "resultado"=>"Eror al Actualizar Cliente ->". $e
	                    ));
	                    exit();
	                }
	                
	                
	                
	                
	                
	                if($_fecha_emision_juicios!="" && $_fecha_ultima_providencia!=""){
	                    
	                    try {
	                        
	                        //// INSERTO TITULO DE CREDITO
	                        
	                        $funcion2 = "ins_titulo_credito_liventy";
	                        $parametros2 = "'$_id_ciudad','$_id_entidades','$_id_abogado','$_id_estados_titulos_credito','$_fecha_emision_juicios','$_fecha_emision_juicios','$_id_clientes','$_asignado_titulo_credito','$_numero_titulo_credito','$_fecha_ultima_providencia'";
	                        $titulo_credito->setFuncion($funcion2);
	                        $titulo_credito->setParametros($parametros2);
	                        $resultado2=$titulo_credito->Insert();
	                        
	                        
	                        
	                    }catch(Exception $e){
	                        
	                        $this->view("Error",array(
	                            "resultado"=>"Eror al Insertar Titulo Credito ->". $e
	                        ));
	                        exit();
	                    }
	                    
	                }else{
	                    
	                    $_fecha_emision_juicios= 'null';
	                    $_fecha_ultima_providencia= 'null';
	                    
	                    try {
	                        
	                        //// INSERTO TITULO DE CREDITO
	                        
	                        $funcion2 = "ins_titulo_credito_liventy";
	                        $parametros2 = "'$_id_ciudad','$_id_entidades','$_id_abogado','$_id_estados_titulos_credito', $_fecha_emision_juicios, $_fecha_emision_juicios,'$_id_clientes','$_asignado_titulo_credito','$_numero_titulo_credito', $_fecha_ultima_providencia";
	                        $titulo_credito->setFuncion($funcion2);
	                        $titulo_credito->setParametros($parametros2);
	                        $resultado2=$titulo_credito->Insert();
	                        
	                        
	                        
	                    }catch(Exception $e){
	                        
	                        $this->view("Error",array(
	                            "resultado"=>"Eror al Insertar Titulo Credito ->". $e
	                        ));
	                        exit();
	                    }
	                    
	                    
	                }
	                
	                
	                
	                
	                $resultTituloCredito = $titulo_credito->getBy("id_ciudad='$_id_ciudad' AND id_usuarios='$_id_abogado' AND id_clientes='$_id_clientes' AND numero_titulo_credito='$_numero_titulo_credito'");
	                $_id_titulo_credito=$resultTituloCredito[0]->id_titulo_credito;
	                
	                
	                
	                if($_id_titulo_credito > 0){
	                    
	                    
	                    
	                    
	                    $_fecha_emision_juicios= $_POST["fecha_emision_juicios"];
	                    $_fecha_ultima_providencia= $_POST["fecha_ultima_providencia"];
	                    
	                    
	                    if($_fecha_emision_juicios !="" && $_fecha_ultima_providencia!=""){
	                        
	                        try {
	                            
	                            //// INSERTO JUICIO
	                            
	                            $funcion3 = "ins_juicios_liventy";
	                            $parametros3 = "'$_id_entidades','$_id_ciudad','$_juicio_referido_titulo_credito','$_id_abogado','$_id_titulo_credito','$_id_clientes','$_id_estados_procesales_juicios','$_fecha_emision_juicios','$_id_estados_auto_pago_juicios','$_juicio_referido_titulo_credito','$_year_juicios','$_fecha_ultima_providencia','$_estrategia_seguir','$_observaciones','$_tipo_leyes','$_medida_cautelar','$_embargo_bienes','$_detalle_embargo_bienes','$_observacion','$_forma_pago','$_descripcion_estado_procesal','$_orden','$_regional','$_cuantia_inicial','$_riesgo_actual', '$_id_origen_juicio', '$_id_carton_juicios'";
	                            $juicios->setFuncion($funcion3);
	                            $juicios->setParametros($parametros3);
	                            $resultado3=$juicios->Insert();
	                            
	                            
	                            
	                            
	                            $resultJuicios = $juicios->getBy("id_ciudad='$_id_ciudad' AND id_usuarios='$_id_abogado' AND id_clientes='$_id_clientes' AND id_titulo_credito='$_id_titulo_credito'");
	                            $_id_juicios=$resultJuicios[0]->id_juicios;
	                            
	                            
	                            $historial_juicios = new HistorialJuiciosModel();
	                            
	                            $funcion = "ins_historial_juicios";
	                            $parametros = " '$_id_juicios', '$_id_estados_procesales_juicios', '$_fecha_ultima_providencia'";
	                            $historial_juicios->setFuncion($funcion);
	                            $historial_juicios->setParametros($parametros);
	                            $resultado=$historial_juicios->Insert();
	                            
	                            
	                            $traza=new TrazasModel();
	                            $_nombre_controlador = "MATRIZ JUICIOS";
	                            $_accion_trazas  = "INSERTO NUEVO JUICIO";
	                            $_parametros_trazas = $_id_juicios;
	                            $resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
	                            
	                            
	                        }catch(Exception $e){
	                            
	                            $this->view("Error",array(
	                                "resultado"=>"Eror al Insertar Juicio ->". $e
	                            ));
	                            exit();
	                        }
	                        
	                    }
	                    
	                    
	                    if($_fecha_emision_juicios !="" && $_fecha_ultima_providencia ==""){
	                        
	                        //$_fecha_emision_juicios='null';
	                        $_fecha_ultima_providencia='null';
	                        
	                        
	                        try {
	                            
	                            //// INSERTO JUICIO
	                            
	                            $funcion3 = "ins_juicios_liventy";
	                            $parametros3 = "'$_id_entidades','$_id_ciudad','$_juicio_referido_titulo_credito','$_id_abogado','$_id_titulo_credito','$_id_clientes','$_id_estados_procesales_juicios', '$_fecha_emision_juicios','$_id_estados_auto_pago_juicios','$_juicio_referido_titulo_credito','$_year_juicios',$_fecha_ultima_providencia,'$_estrategia_seguir','$_observaciones','$_tipo_leyes','$_medida_cautelar','$_embargo_bienes','$_detalle_embargo_bienes','$_observacion','$_forma_pago','$_descripcion_estado_procesal','$_orden','$_regional','$_cuantia_inicial','$_riesgo_actual', '$_id_origen_juicio', '$_id_carton_juicios'";
	                            $juicios->setFuncion($funcion3);
	                            $juicios->setParametros($parametros3);
	                            $resultado3=$juicios->Insert();
	                            
	                            
	                            
	                            
	                            $resultJuicios = $juicios->getBy("id_ciudad='$_id_ciudad' AND id_usuarios='$_id_abogado' AND id_clientes='$_id_clientes' AND id_titulo_credito='$_id_titulo_credito'");
	                            $_id_juicios=$resultJuicios[0]->id_juicios;
	                            
	                            
	                            $historial_juicios = new HistorialJuiciosModel();
	                            
	                            $funcion = "ins_historial_juicios_dos";
	                            $parametros = " '$_id_juicios', '$_id_estados_procesales_juicios'";
	                            $historial_juicios->setFuncion($funcion);
	                            $historial_juicios->setParametros($parametros);
	                            $resultado=$historial_juicios->Insert();
	                            
	                            
	                            $traza=new TrazasModel();
	                            $_nombre_controlador = "MATRIZ JUICIOS";
	                            $_accion_trazas  = "INSERTO NUEVO JUICIO";
	                            $_parametros_trazas = $_id_juicios;
	                            $resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
	                            
	                        }catch(Exception $e){
	                            
	                            $this->view("Error",array(
	                                "resultado"=>"Eror al Insertar Juicio ->". $e
	                            ));
	                            exit();
	                        }
	                        
	                    }
	                    
	                    
	                    
	                    
	                    
	                    
	                    if($_fecha_emision_juicios =="" && $_fecha_ultima_providencia !=""){
	                        
	                        $_fecha_emision_juicios='null';
	                        //$_fecha_ultima_providencia='null';
	                        
	                        
	                        try {
	                            
	                            //// INSERTO JUICIO
	                            
	                            $funcion3 = "ins_juicios_liventy";
	                            $parametros3 = "'$_id_entidades','$_id_ciudad','$_juicio_referido_titulo_credito','$_id_abogado','$_id_titulo_credito','$_id_clientes','$_id_estados_procesales_juicios', $_fecha_emision_juicios,'$_id_estados_auto_pago_juicios','$_juicio_referido_titulo_credito','$_year_juicios','$_fecha_ultima_providencia','$_estrategia_seguir','$_observaciones','$_tipo_leyes','$_medida_cautelar','$_embargo_bienes','$_detalle_embargo_bienes','$_observacion','$_forma_pago','$_descripcion_estado_procesal','$_orden','$_regional','$_cuantia_inicial','$_riesgo_actual', '$_id_origen_juicio', '$_id_carton_juicios'";
	                            $juicios->setFuncion($funcion3);
	                            $juicios->setParametros($parametros3);
	                            $resultado3=$juicios->Insert();
	                            
	                            
	                            
	                            
	                            $resultJuicios = $juicios->getBy("id_ciudad='$_id_ciudad' AND id_usuarios='$_id_abogado' AND id_clientes='$_id_clientes' AND id_titulo_credito='$_id_titulo_credito'");
	                            $_id_juicios=$resultJuicios[0]->id_juicios;
	                            
	                            
	                            $historial_juicios = new HistorialJuiciosModel();
	                            
	                            $funcion = "ins_historial_juicios";
	                            $parametros = " '$_id_juicios', '$_id_estados_procesales_juicios', '$_fecha_ultima_providencia'";
	                            $historial_juicios->setFuncion($funcion);
	                            $historial_juicios->setParametros($parametros);
	                            $resultado=$historial_juicios->Insert();
	                            
	                            
	                            $traza=new TrazasModel();
	                            $_nombre_controlador = "MATRIZ JUICIOS";
	                            $_accion_trazas  = "INSERTO NUEVO JUICIO";
	                            $_parametros_trazas = $_id_juicios;
	                            $resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
	                            
	                        }catch(Exception $e){
	                            
	                            $this->view("Error",array(
	                                "resultado"=>"Eror al Insertar Juicio ->". $e
	                            ));
	                            exit();
	                        }
	                        
	                    }
	                    
	                    
	                    
	                    
	                    
	                    
	                    if($_fecha_emision_juicios =="" && $_fecha_ultima_providencia ==""){
	                        
	                        $_fecha_emision_juicios='null';
	                        $_fecha_ultima_providencia='null';
	                        
	                        
	                        try {
	                            
	                            //// INSERTO JUICIO
	                            
	                            $funcion3 = "ins_juicios_liventy";
	                            $parametros3 = "'$_id_entidades','$_id_ciudad','$_juicio_referido_titulo_credito','$_id_abogado','$_id_titulo_credito','$_id_clientes','$_id_estados_procesales_juicios', $_fecha_emision_juicios,'$_id_estados_auto_pago_juicios','$_juicio_referido_titulo_credito','$_year_juicios',$_fecha_ultima_providencia,'$_estrategia_seguir','$_observaciones','$_tipo_leyes','$_medida_cautelar','$_embargo_bienes','$_detalle_embargo_bienes','$_observacion','$_forma_pago','$_descripcion_estado_procesal','$_orden','$_regional','$_cuantia_inicial','$_riesgo_actual', '$_id_origen_juicio', '$_id_carton_juicios'";
	                            $juicios->setFuncion($funcion3);
	                            $juicios->setParametros($parametros3);
	                            $resultado3=$juicios->Insert();
	                            
	                            
	                            
	                            
	                            $resultJuicios = $juicios->getBy("id_ciudad='$_id_ciudad' AND id_usuarios='$_id_abogado' AND id_clientes='$_id_clientes' AND id_titulo_credito='$_id_titulo_credito'");
	                            $_id_juicios=$resultJuicios[0]->id_juicios;
	                            
	                            
	                            $historial_juicios = new HistorialJuiciosModel();
	                            
	                            $funcion = "ins_historial_juicios_dos";
	                            $parametros = " '$_id_juicios', '$_id_estados_procesales_juicios'";
	                            $historial_juicios->setFuncion($funcion);
	                            $historial_juicios->setParametros($parametros);
	                            $resultado=$historial_juicios->Insert();
	                            
	                            
	                            $traza=new TrazasModel();
	                            $_nombre_controlador = "MATRIZ JUICIOS";
	                            $_accion_trazas  = "INSERTO NUEVO JUICIO";
	                            $_parametros_trazas = $_id_juicios;
	                            $resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
	                            
	                        }catch(Exception $e){
	                            
	                            $this->view("Error",array(
	                                "resultado"=>"Eror al Insertar Juicio ->". $e
	                            ));
	                            exit();
	                        }
	                        
	                    }
	                    
	                    
	                }
	                
	            }
	            
	            
	            
	        }
	        
	        $this->redirect("MatrizJuicios", "index3");
	        
	    }
	    
	    else
	    {
	        $this->view("Login",array(
	            "resultado"=>"Debe Iniciar Sesión"
	            
	        ));
	        
	        exit();
	    }
	    
	    
	}
	
	
	
	?>