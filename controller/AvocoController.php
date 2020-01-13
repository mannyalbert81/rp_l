	<?php

	class AvocoController extends ControladorBase{
	public function __construct() {
		parent::__construct();
		
	}
	
	
	
	
	public function index(){
	    
	    session_start();
	    if (isset(  $_SESSION['nombre_usuarios']) )
	    {
	        $controladores = new ControladoresModel();
	        $nombre_controladores = "Avoco";
	        $id_rol= $_SESSION['id_rol'];
	        $resultPer = $controladores->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	        
	        if (!empty($resultPer))
	        {
	            
	            $this->view_Juridico("Avoco",array(
	                ""=>""
	            ));
	            
	        }
	        else
	        {
	            $this->view("Error",array(
	                "resultado"=>"No tiene Permisos de Acceso."
	                
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


	
	
	public function Convierte_a_Letras(){
	    $juicios = new JuiciosModel();
	    $valor_letras="";
	    
	        $valor = $_POST['valor'];
	        $valor_letras=$juicios->convertir_a_letras($valor);
	        echo $valor_letras;
	        exit();
	  
	    	    
	}
	
	
	
	public function AutocompleteNumeroJuicio(){
	    
	    session_start();
	    $_id_usuarios= $_SESSION['id_usuarios'];
	    $juicios = new JuiciosModel();
	    $numero_juicios = $_GET['term'];
	    
	    $columnas ="numero_juicios";
	    $tablas ="legal_juicios";
	    $where ="numero_juicios ILIKE '$numero_juicios%' ";
       //AND id_usuarios_abogado='$_id_usuarios'";
	    $id ="numero_juicios";
	    
	    
	    $resultSet=$juicios->getCondiciones($columnas, $tablas, $where, $id);
	    
	   // $_respuesta = new stdClass();
	    
	    if(!empty($resultSet)){
	        
	        foreach ($resultSet as $res){
	            
	            $_respuesta[] = $res->numero_juicios;
	        }
	        echo json_encode($_respuesta);
	    }
	    
	}
	
	public function AutocompleteDevuelveDatos(){
	    session_start();
	    
	    $juicios = new JuiciosModel();
	    $numero_juicios = $_POST['numero_juicios'];
	    
	    
	    $columnas ="j.id_juicios, j.id_clientes, c.identificacion_clientes, j.numero_juicios, c.nombre_clientes, j.fecha_inicio_proceso_juicios, j.numero_titulo_credito_juicios, j.fecha_auto_pago_juicios, j.valor_retencion_fondos, a.secretarios";
	    $tablas ="legal_juicios j 
                    inner join legal_clientes c on j.id_clientes=c.id_clientes
                    inner join asignacion_secretarios_usuarios_view a on j.id_usuarios_abogado=a.id_abogado";
	    $where ="j.numero_juicios='$numero_juicios'";
	    $id ="j.id_juicios";
	    
	    
	    $resultSet=$juicios->getCondiciones($columnas, $tablas, $where, $id);
	    
	    
	    $respuesta = new stdClass();
	    
	    if(!empty($resultSet)){
	        
	        
	        $respuesta->numero_juicios = $resultSet[0]->numero_juicios;
	        
	        $respuesta->id_juicios = $resultSet[0]->id_juicios;
	        $respuesta->id_clientes = $resultSet[0]->id_clientes;
	        $respuesta->identificacion_clientes = $resultSet[0]->identificacion_clientes;
	        $respuesta->nombre_clientes = $resultSet[0]->nombre_clientes;
	        $respuesta->numero_titulo_credito_juicios = $resultSet[0]->numero_titulo_credito_juicios;
	        $respuesta->fecha_auto_pago_juicios = $resultSet[0]->fecha_auto_pago_juicios;
	        $respuesta->valor_retencion_fondos = $resultSet[0]->valor_retencion_fondos;
	        $respuesta->secretarios = $resultSet[0]->secretarios;
	        
	        $respuesta->fecha_inicio_proceso_juicios = $resultSet[0]->fecha_inicio_proceso_juicios;
	        
	        
	      
	        echo json_encode($respuesta);
	    }
	    
	}
	
	
	
	
	public function InsertAvoco(){
	    
	    session_start();
	    $juicios = new JuiciosModel();
	    
	    $_id_juicios = (isset($_POST['id_juicios'])) ? $_POST['id_juicios'] : null;
	    $_editor1 = (isset($_POST['editor1'])) ? $_POST['editor1'] : null;
	    $_editor2 = (isset($_POST['editor2'])) ? $_POST['editor2'] : null;
	    $_editor3 = (isset($_POST['editor3'])) ? $_POST['editor3'] : null;
	    
	    
	    $id_usuarios = $_SESSION["id_usuarios"];
	    date_default_timezone_set('America/Guayaquil');
	    $fechaActual = date('Y-m-d');
	    
	    
	    
	    if(!empty($_id_juicios)){
	        
	    }else{
	        
	        echo  json_encode(array('error'=>'Numero de Juicio No Existe.'));
	        exit();
	    }
	    
	    
	    if(!empty($_editor1)){
	        
	    }else{
	        
	        echo  json_encode(array('error'=>'Ingrese Texto Para la Providencia'));
	        exit();
	    }
	    
	    if(!empty($_editor2)){
	        
	    }else{
	        
	        echo  json_encode(array('error'=>'Ingrese Texto Para el Primer Oficio'));
	        exit();
	    }
	    
	    
	    if(!empty($_editor3)){
	        
	    }else{
	        
	        echo  json_encode(array('error'=>'Ingrese Texto Para el Segundo Oficio'));
	        exit();
	    }
	    
	   
	    $funcion = "ins_legal_documentos_generados";
	    $parametros = "
                    '$_id_juicios',
                    '1',
                    '$id_usuarios',
                    '$fechaActual',
                    '$_editor1','$_editor2','$_editor3'
                    ";
	    
	    $juicios->setFuncion($funcion);
	    $juicios->setParametros($parametros);
	    
	    $resultado = $juicios->llamafuncionPG();
	    
	   
	     if((int)($resultado[0]) == 0 || is_null($resultado)){
	        
	         echo json_encode(array('error'=>"Error Generando Documento"));
	        exit();
	    }
	    else{
	        
	        $id = $resultado[0];
	      
	        echo json_encode(array('respuesta'=>$id,'mensaje'=>"Documento Generado Correctamente"));
	        exit();
	    }
	    
	    echo json_encode(array('error'=>"Revisar Datos Enviados"));
	    
	}
	
	
	
	public function nodatapdf($mensaje=""){
	    
	    $texto = ($mensaje=="") ? "Documento No Encontrado" : $mensaje;
	    
	    include dirname(__FILE__).'\..\view\fpdf\fpdf.php';
	    $pdf = new FPDF();
	    $pdf->AddPage();
	    $pdf->SetFont("Times", "B", 14);
	    $ancho = $pdf->GetPageWidth()-20;
	    $alto = $pdf->GetPageHeight()/3;
	    $pdf->Cell( $ancho, $alto,$texto,0,1,'C');
	    
	    $pdf->Output();
	}
	
	
	Public function Reporte_Documentos_Generados(){
	    
	    $juicios = new LegalDocumentosGeneradosModel();
	   
	    session_start();
	    
	    $_id_documentos_generados = (isset($_GET['id_documentos_generados'])) ? $_GET['id_documentos_generados'] : null;
	    
	    
	    if(is_null($_id_documentos_generados) ){
	        
	        $this->nodatapdf();
	        
	        exit();
	    }
	    
	    //PARA OBTENER DATOS DE LA EMPRESA
	    $datos = array();
	    $rsdatos = $juicios->getBy("id_documentos_generados = '$_id_documentos_generados'");
	    
	   
	    
	    
	    if(!empty($rsdatos) && count($rsdatos)>0){
	     
	        $datos['fecha_documentos_generados']=$rsdatos[0]->fecha_documentos_generados;
	        $datos['cuerpo_documentos_generados']=$rsdatos[0]->cuerpo_documentos_generados;
	        $datos['oficio_uno_documentos_generados']=$rsdatos[0]->oficio_uno_documentos_generados;
	        $datos['oficio_dos_documentos_generados']=$rsdatos[0]->oficio_dos_documentos_generados;
	        
	    }
	    
	    
	    
	    
	    $this->verReporte("Avoco", array('datos'=>$datos));
	    
	}
	
	
	
    }
	
	
	?>