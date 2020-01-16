	<?php

    class DocumentosGeneradosController extends ControladorBase{
	public function __construct() {
		parent::__construct();
		
	}
	
	public function index5(){
	    
	    session_start();
	    if (isset(  $_SESSION['nombre_usuarios']) )
	    {
	        $controladores = new ControladoresModel();
	        $nombre_controladores = "DocumentosGenerados";
	        $id_rol= $_SESSION['id_rol'];
	        $resultPer = $controladores->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	        
	        if (!empty($resultPer))
	        {
	            
	            
	            
	            $this->view_Juridico("DocumentosGenerados",array(
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
	
	
	
		

	

	
	public function ConsultaDocumentosGenerados(){
	    
	    
	    
	    
	    session_start();
	    
	    
	    $documentos_generados = new DocumentosGeneradosModel();
	    
	    $where_to="";
	    $columnas  = "legal_documentos_generados.id_documentos_generados, 
                      legal_juicios.id_juicios, 
                      legal_clientes.id_clientes, 
                      legal_clientes.identificacion_clientes, 
                      legal_clientes.nombre_clientes, 
                      legal_juicios.numero_juicios, 
                      legal_juicios.numero_titulo_credito_juicios, 
                      legal_juicios.cuantia_inicial_juicios, 
                      legal_juicios.fecha_ultima_providencia_juicios, 
                      legal_tipo_documentos_generados.id_tipo_documentos_generados, 
                      legal_tipo_documentos_generados.nombre_tipo_documentos_generados, 
                      usuarios.id_usuarios, 
                      usuarios.cedula_usuarios, 
                      usuarios.nombre_usuarios, 
                      usuarios.apellidos_usuarios, 
                      legal_documentos_generados.fecha_documentos_generados, 
                      TO_CHAR(legal_documentos_generados.creado,'YYYY-MM-DD HH:MI:SS') as \"creado\",
                      legal_documentos_generados.cuerpo_documentos_generados, 
                      legal_documentos_generados.firma_secretario_documentos_generados, 
                      legal_documentos_generados.firma_cnt_documentos_generados, 
                      legal_documentos_generados.oficio_uno_documentos_generados, 
                      legal_documentos_generados.oficio_dos_documentos_generados";
	    
	    $tablas    = "public.legal_documentos_generados, 
                      public.legal_juicios, 
                      public.legal_tipo_documentos_generados, 
                      public.usuarios, 
                      public.legal_clientes";
	    
	    $where     = "legal_documentos_generados.id_juicios = legal_juicios.id_juicios AND
                      legal_documentos_generados.id_tipo_documentos_generados = legal_tipo_documentos_generados.id_tipo_documentos_generados AND
                      legal_documentos_generados.id_usuarios = usuarios.id_usuarios AND
                      legal_clientes.id_clientes = legal_juicios.id_clientes";
	    
	    $id        = "legal_documentos_generados.id_documentos_generados";
	    
	    
	    $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    if($action == 'ajax')
	    {
	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND numero_juicios ILIKE '".$search."%'";
	            
	            $where_to=$where.$where1;
	            
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        $html="";
	        $resultSet=$documentos_generados->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 10; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$documentos_generados->getCondicionesPagDesc($columnas, $tablas, $where_to, $id, $limit);
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
	            $html.='<th style="text-align: center;  font-size: 12px;">Acciones</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">#</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Identificación</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">N° Juicio</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">N° Título de Crédito</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Cuantía Inicial</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Tipo Documento</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Fecha</th>';
	                
	          
	            
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            
	            $i=0;
	            
	            foreach ($resultSet as $res)
	            {
	                
	                $i++;
	                $html.='<tr>';
	               
	                $html.='<td style="font-size: 14px;"><span class="pull-left"><a href="index.php?controller=Avoco&action=Reporte_Documentos_Generados&id_documentos_generados='.$res->id_documentos_generados.'" target="_blank" class="btn btn-info" style="font-size:65%;" title="Imprimir"><i class="glyphicon glyphicon-print"></i></a></span>
                                                         <span class="pull-right"><a href="index.php?controller=Avoco&action=index&id_documentos_generados='.$res->id_documentos_generados.'" class="btn btn-warning" style="font-size:65%;" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
	                
	                $html.='<td style="font-size: 11px;">'.$i.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->identificacion_clientes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_clientes.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->numero_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->numero_titulo_credito_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->cuantia_inicial_juicios.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->nombre_tipo_documentos_generados.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->creado.'</td>';
	                
	                
	                
	   
	                
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate_documentos_generados("index.php", $page, $total_pages, $adjacents,"ConsultaDocumentosGenerados").'';
	            $html.='</div>';
	            
	            
	            
	        }else{
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay  Registros...</b>';
	            $html.='</div>';
	            $html.='</div>';
	        }
	        
	        
	        echo $html;
	        
	    }
	    
	}

	public function paginate_documentos_generados($reload, $page, $tpages, $adjacents, $funcion = "") {
	 //Steven   
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
    
    ?>