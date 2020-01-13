<?php
class Conectar{
    private $driver;
    private $host, $user, $pass, $database, $charset, $port;
  
    public function __construct() {
        $db_cfg = require_once 'config/database.php';
        $this->driver=$db_cfg["driver"];
        $this->host=$db_cfg["host"];
        $this->user=$db_cfg["user"];
        $this->pass=$db_cfg["pass"];
        $this->database=$db_cfg["database"];
        $this->charset=$db_cfg["charset"];
        $this->port=$db_cfg["port"];
    }
    
    public function conexion(){
       //holas 
        if($this->driver=="pgsql" || $this->driver==null){
            $con = pg_connect("host=3.133.110.247 port=5432 dbname=rp_liventy user=postgres password=.romina.2012");
         	if(!$con){
        		echo "No se puedo Conectar a la Base";
        		exit();
        	} else {
        		
        	}
       
        }
        
        return $con;
	
    }
    
    public function startFluent(){
        require_once "FluentPDO/FluentPDO.php";
        
        if($this->driver=="pgsql" || $this->driver==null){
        	
        	try
        	{
        	    //$pdo = new PDO('pgsql:host=localhost;port=5432;dbname=rp_capremci', 'postgres', 'capremci' );
        	    //$pdo = new PDO('pgsql:host=192.168.1.128;port=5432;dbname=rp_capremci', 'postgres', 'Capremci2018' );
        		$pdo = new PDO('pgsql:host=3.133.110.247;port=5432;dbname=rp_liventy', 'postgres', '.romina.2012' );
         
            	$fpdo = new FluentPDO($pdo);
            	
            }
            
            
            catch(Exception $err)
            {
            	echo "PDO No se puedo Conectar a la Base";
            	exit();
            }
        }
        
        return $fpdo;
    }
}
?>
