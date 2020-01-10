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
	    
	    
	    $columnas ="j.id_juicios, j.id_clientes, c.identificacion_clientes, j.numero_juicios, c.nombre_clientes, j.numero_titulo_credito_juicios, j.fecha_auto_pago_juicios, j.cuantia_inicial_juicios, a.secretarios";
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
	        $respuesta->cuantia_inicial_juicios = $resultSet[0]->cuantia_inicial_juicios;
	        $respuesta->secretarios = $resultSet[0]->secretarios;
	        
	        echo json_encode($respuesta);
	    }
	    
	}
	
	
	
	
	
	
    }
	//
	
	?>