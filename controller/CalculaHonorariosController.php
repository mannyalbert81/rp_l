<?php

class CalculaHonorariosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

	public function index(){
	
     	$estados=new EstadoModel();     	
					
     	$resultEdit = "";
	
		session_start();
        
	
		if (isset(  $_SESSION['nombre_usuarios']) )
		{

			
			
			$this->view_Juridico("CalculaHonorariosSecretarios",array(
					"resultEdit" =>"","rsModulos"=>""
						
			));
			
				
		}
	else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
	
	}
	public function consultaTipoProcesos(){
		 
		$modulos = new ModulosModel();
		 
		$_id_modulos = (isset($_POST['id_modulos'])) ? $_POST['id_modulos'] : 0;
		$columnas = "id_tipo_procesos, nombre_tipo_procesos";
		$tablas = "core_tipo_procesos";
		$where = " diarios_tipo_procesos = 'TRUE' AND id_modulos = $_id_modulos ";
		$id = "id_modulos";
		 
		$rsTipoProceso = $modulos->getCondiciones($columnas, $tablas, $where, $id);
		$cantidad = count($rsTipoProceso);
		echo json_encode(array('cantidad'=>$cantidad, 'data'=>$rsTipoProceso));
	}
	
	
	public function BuscarJuicios(){
	
			
		
		$juicios = new JuiciosModel();
			
		$_numero_juicios =  (isset($_REQUEST['numero_juicios'])&& $_REQUEST['numero_juicios'] !=NULL)?$_REQUEST['numero_juicios']:'';
		$_identificacion_clientes = "";
		$_nombre_clientes = "";
		$_numero_titulo_credito_juicios = "";
		$_cuantia_inicial_juicios = 0;
		$_id_juicios = 0;
		//validar los campos recibidos para generar diario
		$arrayTabla = array();
		$cantidad = 0;
		$columnas = ' legal_clientes.id_clientes, 
					  legal_juicios.id_juicios, 
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
					  legal_etapa_procesal.nombre_etapa_procesal, 
					  legal_juicios.fecha_ultima_providencia_juicios, 
					  legal_juicios.observaciones_juicios, 
					  legal_estado_procesal.nombre_estado_procesal, 
					  usuarios.nombre_usuarios, 
					  usuarios.usuario_usuarios';
		$tablas = "public.legal_juicios, 
					  public.legal_clientes, 
					  public.legal_etapa_procesal, 
					  public.legal_estado_procesal, 
					  public.usuarios		";
		$where = " legal_clientes.id_clientes = legal_juicios.id_clientes AND
  legal_etapa_procesal.id_etapa_procesal = legal_juicios.id_etapa_procesal AND
  legal_estado_procesal.id_estado_procesal = legal_juicios.id_estado_procesal AND
  usuarios.id_usuarios = legal_juicios.id_usuarios_abogado
				AND  legal_juicios.numero_juicios = '$_numero_juicios' "; 
		
		$id = "legal_juicios.id_juicios";
		$html='';
		$resJuicios = $juicios->getCondiciones($columnas, $tablas, $where, $id);
		
		if ($resJuicios !="")
		{
			foreach ($resJuicios as $res)
			{
				$_identificacion_clientes =  $res->identificacion_clientes;
				$_nombre_clientes = $res->nombre_clientes;
				$_numero_titulo_credito_juicios = $res->numero_titulo_credito_juicios;
				$_cuantia_inicial_juicios = $res->cuantia_inicial_juicios;
				$_id_juicios = $res->id_juicios;
			}
			
			$html.='<div class="row">';
			
			$html.='<div class="col-md-3 col-lg-3 col-xs-12">';
			$html.='<div class="form-group">';
			$html.='<label for="meses_mora" class="control-label">Identificación:</label>';
			$html.='<input type="text" id="identificacion_clientes" name="identificacion_clientes"  value="'.$_identificacion_clientes .'" class="form-control">';
			$html.='<input type="hidden" id="id_juicios" name="id_juicios"  value="'.$_id_juicios .'" class="form-control">';
			$html.='</div>';
			$html.='</div>';
			
			
			$html.='<div class="col-md-3 col-lg-3 col-xs-12">';
			$html.='<div class="form-group">';
			$html.='<label for="meses_mora" class="control-label">Nombres:</label>';
			$html.='<input type="text" id="nombres_clientes" name="nombres_clientes"  value="'.$_nombre_clientes .'" class="form-control">';
			$html.='</div>';
			$html.='</div>';
			
			$html.='<div class="col-md-3 col-lg-3 col-xs-12">';
			$html.='<div class="form-group">';
			$html.='<label for="meses_mora" class="control-label">Título Crédito :</label>';
			$html.='<input type="text" id="numero_titulo_credito_juicios" name="numero_titulo_credito_juicios"  value="'.$_numero_titulo_credito_juicios .'" class="form-control">';
			$html.='</div>';
			$html.='</div>';
			
			
			$html.='<div class="col-md-3 col-lg-3 col-xs-12">';
			$html.='<div class="form-group">';
			$html.='<label for="meses_mora" class="control-label">Cuantía Inicial:</label>';
			$html.='<input type="text" id="cuantia_inicial_juicios" name="cuantia_inicial_juicios"  value="'.$_cuantia_inicial_juicios .'" class="form-control">';
			$html.='</div>';
			$html.='</div>';
			
			$html.='</div>';
			
			
			
		}
		$respuesta = array();
		$respuesta['tabladatos'] =  $html;
		echo json_encode($respuesta);
		die();
		
	
	}
	
	public function GuardarHonorariosSecretarios()
	{
		$CalculoHonorarios = new CalculoHonorariosModel();
		
		
		$_id_juicios							=  (isset($_REQUEST['id_juicios'])&& $_REQUEST['id_juicios'] !=NULL)?$_REQUEST['id_juicios']:'';			
		$_fecha_calculo_honorarios				=  (isset($_REQUEST['fecha_calculo_honorarios'])&& $_REQUEST['fecha_calculo_honorarios'] !=NULL)?$_REQUEST['fecha_calculo_honorarios']:'';
		$_tasa_interes_calculo_honorarios		=  (isset($_REQUEST['tasa_interes_calculo_honorarios'])&& $_REQUEST['tasa_interes_calculo_honorarios'] !=NULL)?$_REQUEST['tasa_interes_calculo_honorarios']:'';
		$_tasa_intres_mora_calculo_honorarios	=  (isset($_REQUEST['tasa_intres_mora_calculo_honorarios'])&& $_REQUEST['tasa_intres_mora_calculo_honorarios'] !=NULL)?$_REQUEST['tasa_intres_mora_calculo_honorarios']:'';
		$_fecha_vencimiento						=  (isset($_REQUEST['fecha_vencimiento'])&& $_REQUEST['fecha_vencimiento'] !=NULL)?$_REQUEST['fecha_vencimiento']:'';
		$_meses_mora_calculo_honorarios			=  (isset($_REQUEST['meses_mora_calculo_honorarios'])&& $_REQUEST['meses_mora_calculo_honorarios'] !=NULL)?$_REQUEST['meses_mora_calculo_honorarios']:'';
		$_saldo_vencido_calculo_honorarios		=  (isset($_REQUEST['saldo_vencido_calculo_honorarios'])&& $_REQUEST['saldo_vencido_calculo_honorarios'] !=NULL)?$_REQUEST['saldo_vencido_calculo_honorarios']:'';
		$_honorario_secretario_coactiva_calculo_honorarios	=  (isset($_REQUEST['honorario_secretario_coactiva_calculo_honorarios'])&& $_REQUEST['honorario_secretario_coactiva_calculo_honorarios'] !=NULL)?$_REQUEST['honorario_secretario_coactiva_calculo_honorarios']:'';
		$_interes_mora_liquidacion_calculo_honorarios		=  (isset($_REQUEST['interes_mora_liquidacion_calculo_honorarios'])&& $_REQUEST['interes_mora_liquidacion_calculo_honorarios'] !=NULL)?$_REQUEST['interes_mora_liquidacion_calculo_honorarios']:'';
		$_iva_factura_calculo_honorarios					=  (isset($_REQUEST['iva_factura_calculo_honorarios'])&& $_REQUEST['iva_factura_calculo_honorarios'] !=NULL)?$_REQUEST['iva_factura_calculo_honorarios']:'';
		$_valor_retencion_fondo_calculo_honorarios			=  (isset($_REQUEST['valor_retencion_fondo_calculo_honorarios'])&& $_REQUEST['valor_retencion_fondo_calculo_honorarios'] !=NULL)?$_REQUEST['valor_retencion_fondo_calculo_honorarios']:'';
		
		$funcion = "ins_calculo_honorarios";
		$parametros = "'$_id_juicios',
		'$_fecha_calculo_honorarios',
		'$_tasa_interes_calculo_honorarios',
		'$_tasa_intres_mora_calculo_honorarios',
		'$_fecha_vencimiento',
		'$_meses_mora_calculo_honorarios',
		'$_saldo_vencido_calculo_honorarios',
		'$_honorario_secretario_coactiva_calculo_honorarios',
		'$_interes_mora_liquidacion_calculo_honorarios',
		'$_iva_factura_calculo_honorarios',
		'$_valor_retencion_fondo_calculo_honorarios'";
		$CalculoHonorarios->setFuncion($funcion);
		$CalculoHonorarios->setParametros($parametros);
		
		
		$resultado=$CalculoHonorarios->llamafuncion();
		$res = $this->ActualizaValor($_id_juicios, $_valor_retencion_fondo_calculo_honorarios, $_fecha_vencimiento);
		
		
		$respuesta = '';
		
		if(!empty($resultado) && count($resultado)){
		
			foreach ($resultado[0] as $k => $v)
			{
				$respuesta=$v;
			}
		
			if (strpos($respuesta, 'OK') !== false) {
				 
				echo json_encode(array('success'=>1,'mensaje'=>$respuesta));
			}else{
				echo json_encode(array('success'=>0,'mensaje'=>$respuesta));
			}
		
		}
		
	}
	
	
	public function CalcularHonorariosSecretarios(){
		session_start();
		$tablaHonorarios = new TablaHonorariosSecretarioModel();
		
		$meses_mora = 0;
		$_minimo_tabla_honorarios = 0;
		$_interes_porcentaje_tabla_honorarios = 0;
		$_exedente_tabla_honorarios = 0;
		$_calculo_porcentaje_exedente = 0;
		$_valor_aplicar = 0;
		$_interes_mora = 0;
		$_variable_honorarios_secretario = 0;
		$_valor_min_recuperado = 0;
		$_iva_factura = 0;
		$_valor_retencion_fondos = 0;
		$id_usuarios = $_SESSION['id_usuarios'];
		$usuario_usuarios = $_SESSION['usuario_usuarios'];
		
		
		
		$honorarios = new TablaHonorariosSecretarioModel();
		$_fecha_calculo_coactiva =  (isset($_REQUEST['fecha_calculo_coactiva'])&& $_REQUEST['fecha_calculo_coactiva'] !=NULL)?$_REQUEST['fecha_calculo_coactiva']:'';
		$_tasa_interes =  (isset($_REQUEST['tasa_interes'])&& $_REQUEST['tasa_interes'] !=NULL)?$_REQUEST['tasa_interes']:'';
		$_tasa_mora =  (isset($_REQUEST['tasa_mora'])&& $_REQUEST['tasa_mora'] !=NULL)?$_REQUEST['tasa_mora']:'';
		$_fecha_vencimiento =  (isset($_REQUEST['fecha_vencimiento'])&& $_REQUEST['fecha_vencimiento'] !=NULL)?$_REQUEST['fecha_vencimiento']:'';
		$_id_juicios =  (isset($_REQUEST['$id_juicios'])&& $_REQUEST['$id_juicios'] !=NULL)?$_REQUEST['$id_juicios']:'';
		$_cuantia_inicial_j =  (isset($_REQUEST['cuantia_inicial_juicios'])&& $_REQUEST['cuantia_inicial_juicios'] !=NULL)?$_REQUEST['cuantia_inicial_juicios']:'';
		$_cuantia_inicial_juicios = round($_cuantia_inicial_j,2);
		
		
		//1. hallar meses en mora
		//strtotime
		$_fecha1 = new DateTime($_fecha_vencimiento);
		 
		$_fecha2 = new DateTime($_fecha_calculo_coactiva); 
		
		
		$interval=$_fecha2->diff($_fecha1);
		$intervalMeses=$interval->format('%a');
		$meses_mora = round($intervalMeses/30 , 2); 
		
		
		//2. calculamos interes por mora
		//=ROUND((D8*D7*($D$5/12)),2)
		$_coeficiente_mora = $_tasa_mora / 100;
		$_interes_mora = round($_cuantia_inicial_juicios * $meses_mora * ($_coeficiente_mora / 12)  ,2);
	
		//3. calculo la variable de honorarios secretario coactiva
		$_variable_honorarios_secretario = $_cuantia_inicial_juicios + $_interes_mora;
		
		//4. comenzamos calculo de honorarios
		
		//a)  revisamos monto 
		
		$columnas = 'id_tabla_honorarios_secretario, valor_min_recuperado, valor_max_recuperado,
						porcentaje, minimo';
		$tablas = " public.legal_tabla_honorarios_secretario";
		$where = "  $_cuantia_inicial_juicios   BETWEEN valor_min_recuperado AND valor_max_recuperado";
		$id = "id_tabla_honorarios_secretario";
		$resTabla = $tablaHonorarios->getCondiciones($columnas, $tablas, $where, $id);

		if ($resTabla !="")
		{
			foreach ($resTabla as $res)
			{
				
				if ($_cuantia_inicial_juicios <= 500.00)
				{
					
					$_interes_porcentaje_tabla_honorarios = $res->porcentaje;
					$_minimo_tabla_honorarios = $res->minimo;
					$_calculo_porcentaje_exedente = round($_variable_honorarios_secretario * ($_interes_porcentaje_tabla_honorarios/100),2);
					$_valor_aplicar = $_minimo_tabla_honorarios + $_calculo_porcentaje_exedente; 
					
				}
				else 
				{
					
					$_valor_min_recuperado = $res->valor_min_recuperado;
					$_interes_porcentaje_tabla_honorarios = $res->porcentaje;
					$_exedente_tabla_honorarios = $_variable_honorarios_secretario - $_valor_min_recuperado;
					$_minimo_tabla_honorarios = $res->minimo;
					$_calculo_porcentaje_exedente = round($_exedente_tabla_honorarios * ($_interes_porcentaje_tabla_honorarios/100),2);
					$_valor_aplicar = $_minimo_tabla_honorarios + $_calculo_porcentaje_exedente;
							
				}
				
				
				$_iva_factura = round($_valor_aplicar * 12 / 100 , 2);
				$_valor_retencion_fondos =round( $_cuantia_inicial_juicios + $_valor_aplicar + $_interes_mora + $_iva_factura , 2);
			}
		
		}
		$html = '';
		
		$html .= '<div class="row">';
		$html .= '<div class="col-md-3 col-lg-3 col-xs-12">';
		$html .= '<div class="form-group">';
		$html .= '<label for="meses_mora" class="control-label">VALORES CALCULADOS:</label>';
		
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<div class="col-md-3 col-lg-3 col-xs-12">';
		$html .= '<div class="form-group">';
		$html .= '<label for="meses_mora" class="control-label">Meses Mora:</label>';
		$html .= '<input readonly type="number" id="meses_mora" name="meses_mora"  value="'.$meses_mora.'" class="form-control">';
		$html .= '</div>';
		$html .= '</div>';
		 
		$html .= '<div class="col-md-3 col-lg-3 col-xs-12">';
		$html .= '<div class="form-group">';
		$html .= '<label for="saldovencido" class="control-label">Saldo vencido:</label>';
		$html .= '<input readonly type="number" id="saldo_vencido" name="saldo_vencido"  value="'. round($_cuantia_inicial_juicios,2).'" class="form-control">';
		$html .= '</div>';
		$html .= '</div>';
		 
		$html .= '<div class="col-md-3 col-lg-3 col-xs-12">';
		$html .= '<div class="form-group">';
		$html .= '<label for="honorariossecretariocoactiva" class="control-label">Honorarios Secretario de Coactiva:</label>';
		$html .= '<input readonly type="number" id="honorarios_secretario_coactiva" name="honorarios_secretario_coactiva"  value="'.$_valor_aplicar.'" class="form-control">';
		$html .= '</div>';
		$html .= '</div>';
			
		
		$html .= '<div class="col-md-3 col-lg-3 col-xs-12">';
		$html .= '<div class="form-group">';
		$html .= '<label for="interesmoraliquidacion" class="control-label">Intereses por mora liquidación:</label>';
		$html .= '<input readonly type="number" id="interes_mora_liquidacion" name="interes_mora_liquidacion"  value="'.$_interes_mora.'" class="form-control">';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<div class="col-md-3 col-lg-3 col-xs-12">';
		$html .= '<div class="form-group">';
		$html .= '<label for="ivafactura" class="control-label">IVA Factura:</label>';
		$html .= '<input readonly type="number" id="iva_factura" name="iva_factura"  value="'.$_iva_factura.'" class="form-control">';
		$html .= '</div>';
		$html .= '</div>';
		
		$html .= '<div class="col-md-3 col-lg-3 col-xs-12">';
		$html .= '<div class="form-group">';
		$html .= '<label for="valorretencionfondos" class="control-label">Valor para la Retención de Fondos:</label>';
		$html .= '<input readonly type="number" id="valor_retencion_fondos" name="valor_retencion_fondos"  value="'.$_valor_retencion_fondos.'" class="form-control">';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
			

		$respuesta = array();
		$respuesta['tabladatos'] =  $html;
		//$respuesta['tabladatos'] = "PRUEBA";
		echo json_encode($respuesta);
		die();

	}
	
	
	public function  ActualizaValor($_id_juicios, $_valor_retencion_fondos, $_fecha_vencimiento)
	{
		$juicios = new JuiciosModel();
		
		$colval = "fecha_vencimiento_juicios = '$_fecha_vencimiento'  , valor_retencion_fondos=  '$_valor_retencion_fondos'";
		$tabla = "legal_juicios";
		$where = "id_juicios = '$_id_juicios'";
		$resultado=$juicios->UpdateBy($colval, $tabla, $where);

		
	}
	
	
	function graficaVista( $paramArrayDatos){
		 
		$_base_imponible = 0;
		$_valor_retenido = 0;
		
		$_base_imponible_renta = 0;
		$_valor_retenido_renta = 0;
		
		$_base_imponible_iva = 0;
		$_valor_retenido_iva = 0;
		
		$cantidad = sizeof($paramArrayDatos);
		$html = "";
		if( $cantidad > 0 ){
			 
			$html.= "<table id='tbl_detalle_diario' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
			$html.= "<thead>";
			$html.= "<tr>";
			$html.='<th style="text-align: center;  font-size: 12px;"></th>';
			$html.='<th style="text-align: center;  font-size: 12px;">IMPUESTO</th>';
		
			$html.='<th style="text-align: center;  font-size: 12px;">CÓDIGO</th>';
			
			$html.='<th style="text-align: center;  font-size: 12px;">BASE IMPONIBLE</th>';
			$html.='<th style="text-align: center;  font-size: 12px;">PORCENTAJE</th>';
			$html.='<th style="text-align: center;  font-size: 12px;">VALOR RETENIDO</th>';
		
			//$html.='<th style="text-align: left;  font-size: 12px;"></th>';
			$html.='</tr>';
			$html.='</thead>';
			$html.='<tbody>';
			 
			$i=0;
			
			
			foreach ($paramArrayDatos as $res){
				 
				$i++;
				$html.='<tr>';
				$html.='<td style="font-size: 11px;">'.$i.'</td>';
				if ($res->impuesto_codigo == "1")
				{
					$html.='<td style="font-size: 11px;  text-align: center;">'.'RENTA'.'</td>';
					$_base_imponible_renta = $_base_imponible_renta +  $res->impuestos_baseimponible;
					$_valor_retenido_renta =  $_valor_retenido_renta +  $res->impuestos_valorretenido;
					
				}
				else
				{
					$html.='<td style="font-size: 11px;  text-align: center;">'.'IVA'.'</td>';
					$_base_imponible_iva = $_base_imponible_iva +  $res->impuestos_baseimponible;
					$_valor_retenido_iva =  $_valor_retenido_iva +  $res->impuestos_valorretenido;
					
				}
				
				$html.='<td style="font-size: 12px; text-align: center;">'.$res->impuesto_codigoretencion.'</td>';
				$html.='<td style="font-size: 12px; text-align: right;">' .'$  ' .$res->impuestos_baseimponible.'</td>';
				$html.='<td style="font-size: 12px; text-align: right;">'.$res->impuesto_porcentaje.'</td>';
				$html.='<td style="font-size: 12px; text-align: right;">'.'$  '.$res->impuestos_valorretenido.'</td>';
				$_base_imponible = $_base_imponible +  $res->impuestos_baseimponible;
				$_valor_retenido =  $_valor_retenido +  $res->impuestos_valorretenido;
				
				$html.='</tr>';
				
				 
			}
			 
			 
			$html.='</tbody>';
			$html.='</table>';
			//$html.=$paramArrayDatos;
			
			$html.='<div class="table-pagination pull-right">';
			$html.='</div>';
			 
			
			$html.= "<table id='tbl_detalle_diario' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
			$html.= "<thead>";
			$html.= "POR CONCEPTO DE RENTA";
			$html.= "<tr>";
			$html.='<th style="text-align: center;  font-size: 12px;">BASE IMPONIBLE</th>';
			$html.='<th style="text-align: center;  font-size: 12px;">VALOR RETENIDO</th>';
			$html.='</tr>';
			$html.='</thead>';
			$html.='<tbody>';
			$html.='<tr>';
			
			
			$html.='<td style="font-size: 12px; text-align: center;">'.'$  '.$_base_imponible_renta.'</td>';
			$html.='<td style="font-size: 12px; text-align: center;">'.'$  '.$_valor_retenido_renta.'</td>';
			$html.='</tr>';
			$html.='</tbody>';
			$html.='</table>';
	
			$html.= "<table id='tbl_detalle_diario' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
			$html.= "<thead>";
			$html.= "POR CONCEPTO DE IVA";
			$html.= "<tr>";
			$html.='<th style="text-align: center;  font-size: 12px;">BASE IMPONIBLE</th>';
			$html.='<th style="text-align: center;  font-size: 12px;">VALOR RETENIDO</th>';
			$html.='</tr>';
			$html.='</thead>';
			$html.='<tbody>';
			$html.='<tr>';
			$html.='<td style="font-size: 12px; text-align: center;">'.'$  '.$_base_imponible_iva.'</td>';
			$html.='<td style="font-size: 12px; text-align: center;">'.'$  '.$_valor_retenido_iva.'</td>';
			$html.='</tr>';
			$html.='</tbody>';
			$html.='</table>';
			
			$html.= "<table id='tbl_detalle_diario' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
			$html.= "<thead>";
			$html.= "TOTALES";
			$html.= "<tr>";
			$html.='<th style="text-align: center;  font-size: 12px;">BASE IMPONIBLE</th>';
			$html.='<th style="text-align: center;  font-size: 12px;">VALOR RETENIDO</th>';
			$html.='</tr>';
			$html.='</thead>';
			$html.='<tbody>';
			$html.='<tr>';
			$html.='<td style="font-size: 12px; text-align: center;">'.'$  '.$_base_imponible.'</td>';
			$html.='<td style="font-size: 12px; text-align: center;">'.'$  '.$_valor_retenido.'</td>';
			$html.='</tr>';
			$html.='</tbody>';
			$html.='</table>';
			

		}else{
			$html.= "<table id='tbl_detalle_diario' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
			$html.= "<thead>";
			$html.= "<tr>";
			
			$html.='</tr>';
			$html.='</thead>';
			$html.='</table>';
		}
		 
		return $html;
	
		 
	}
	
	
	
	
	public function consulta_honorarios(){
	
	
		session_start();
		$id_rol=$_SESSION["id_rol"];
		$usuarios = new UsuariosModel();
		$honorarios = new CalculoHonorariosModel();
	
		$where_to="";
		$columnas = "legal_juicios.numero_juicios, 
					  legal_calculo_honorarios.fecha_calculo_honorarios, 
					  legal_calculo_honorarios.tasa_interes_calculo_honorarios, 
					  legal_calculo_honorarios.tasa_intres_mora_calculo_honorarios, 
					  legal_calculo_honorarios.fecha_vencimiento, 
					  legal_calculo_honorarios.meses_mora_calculo_honorarios, 
					  legal_calculo_honorarios.saldo_vencido_calculo_honorarios, 
					  legal_calculo_honorarios.honorario_secretario_coactiva_calculo_honorarios, 
					  legal_calculo_honorarios.interes_mora_liquidacion_calculo_honorarios, 
					  legal_calculo_honorarios.iva_factura_calculo_honorarios, 
					  legal_calculo_honorarios.valor_retencion_fondo_calculo_honorarios, 
					  legal_calculo_honorarios.creado";
		$tablas   = " public.legal_juicios, 
  					public.legal_calculo_honorarios ";
		$where    = "legal_calculo_honorarios.id_juicios = legal_juicios.id_juicios";
	
		$id       = "creado";
	
	
		 
	
		$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
		$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	
	
		if($action == 'ajax')
		{
	
			if(!empty($search)){
	
	
				$where1=" AND legal_juicios.numero_juicios LIKE '%".$search."%'   ";
	
				$where_to=$where.$where1;
			}else{
	
				$where_to=$where;
	
			}
	
			$html="";
			$resultSet=$honorarios->getCantidad("*", $tablas, $where_to);
			$cantidadResult=(int)$resultSet[0]->total;
	
			$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	
			$per_page = 10; //la cantidad de registros que desea mostrar
			$adjacents  = 9; //brecha entre páginas después de varios adyacentes
			$offset = ($page - 1) * $per_page;
	
			$limit = " LIMIT   '$per_page' OFFSET '$offset'";
	
			$resultSet=$honorarios->getCondicionesPagDesc($columnas, $tablas, $where_to, $id, $limit);
			$count_query   = $cantidadResult;
			$total_pages = ceil($cantidadResult/$per_page);
	
	
	
	
	
			if($cantidadResult>0)
			{
	
				$html.='<div class="pull-left" style="margin-left:15px;">';
				$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
				$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
				$html.='</div>';
				$html.='<div class="col-lg-12 col-md-12 col-xs-12">';
				$html.='<section style="height:425px; overflow-y:scroll;">';
				$html.= "<table id='tabla_retencion' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
				$html.= "<thead>";
				$html.= "<tr>";
				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
				$html.='<th style="text-align: center;  font-size: 12px;">Número de Juicio</th>';
				$html.='<th style="text-align: left;  font-size: 12px;">Fecha Cálculo</th>';
				$html.='<th style="text-align: left;  font-size: 12px;">Tasa Interés</th>';
				$html.='<th style="text-align: left;  font-size: 12px;">Tasa Mora</th>';
				$html.='<th style="text-align: left;  font-size: 12px;">Fecha Vencimiento</th>';
				$html.='<th style="text-align: left;  font-size: 12px;">Meses Mora</th>';
				$html.='<th style="text-align: left;  font-size: 12px;">Saldo Vencido</th>';
				$html.='<th style="text-align: center;  font-size: 12px;">Honorario Secret.</th>';
				$html.='<th style="text-align: center; font-size: 12px;">Interés Mora</th>';
				$html.='<th style="text-align: center; font-size: 12px;">IVA</th>';
				$html.='<th style="text-align: center; font-size: 12px;">Valor Ret. Fondos</th>';
				$html.='<th style="text-align: center; font-size: 12px;">Creado</th>';
				
				 
	
	
	
	
				$html.='</tr>';
				$html.='</thead>';
				$html.='<tbody>';
	
	
				$i=0;
				$importe=0;
				$coreo_envidado="";
				foreach ($resultSet as $res)
				{
	
					$i++;
					$html.='<tr>';
					$html.='<td style="text-align: center; font-size: 11px;">'.$i.'</td>';
					$html.='<td style="text-align: center; font-size: 11px;">'.$res->numero_juicios.'</td>';
					$html.='<td style="text-align: center; font-size: 11px;">'.$res->fecha_calculo_honorarios.'</td>';
					$html.='<td style="font-size: 11px;">'.$res->tasa_interes_calculo_honorarios.'</td>';
					$html.='<td style="font-size: 11px;">'.$res->tasa_intres_mora_calculo_honorarios.'</td>';
					$html.='<td style="text-align: center; font-size: 11px;">'.$res->fecha_vencimiento.'</td>';
					$html.='<td style="text-align: center; font-size: 11px;">'.$res->meses_mora_calculo_honorarios.'</td>';
					$html.='<td style="text-align: center; font-size: 11px;">'.$res->saldo_vencido_calculo_honorarios.'</td>';
					$html.='<td style="text-align: center; font-size: 11px;">'.$res->honorario_secretario_coactiva_calculo_honorarios.'</td>';
					$html.='<td style="text-align: center; font-size: 11px;">'.$res->interes_mora_liquidacion_calculo_honorarios.'</td>';
					$html.='<td style="text-align: center; font-size: 11px;">'.$res->iva_factura_calculo_honorarios.'</td>';
					$html.='<td style="text-align: center; font-size: 11px;">'.$res->valor_retencion_fondo_calculo_honorarios.'</td>';
					$html.='<td style="text-align: center; font-size: 11px;">'.$res->creado.'</td>';
	
	
	
	
	
					$html.='</tr>';
				}
	
	
	
				$html.='</tbody>';
				$html.='</table>';
				$html.='</section></div>';
				$html.='<div class="table-pagination pull-right">';
				$html.=''. $this->paginate_honorarios("index.php", $page, $total_pages, $adjacents).'';
				$html.='</div>';
	
	
	
			}else{
				$html.='<div class="col-lg-6 col-md-6 col-xs-12">';
				$html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
				$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
				$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay Retenciones registradas...</b>';
				$html.='</div>';
				$html.='</div>';
			}
	
	
			echo $html;
			die();
	
		}
	
	
	}
	
	
	public function paginate_honorarios($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_retencion(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_retencion(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_retencion(1)'>1</a></li>";
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
				$out.= "<li><a href='javascript:void(0);' onclick='load_retencion(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_retencion(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_retencion($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_retencion(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
}
?>