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
		$html .= '<input type="number" id="meses_mora" name="meses_mora"  value="'.$meses_mora.'" class="form-control">';
		$html .= '</div>';
		$html .= '</div>';
		 
		$html .= '<div class="col-md-3 col-lg-3 col-xs-12">';
		$html .= '<div class="form-group">';
		$html .= '<label for="saldovencido" class="control-label">Saldo vencido:</label>';
		$html .= '<input type="number" id="saldo_vencido" name="saldo_vencido"  value="'. round($_cuantia_inicial_juicios,2).'" class="form-control">';
		$html .= '</div>';
		$html .= '</div>';
		 
		$html .= '<div class="col-md-3 col-lg-3 col-xs-12">';
		$html .= '<div class="form-group">';
		$html .= '<label for="honorariossecretariocoactiva" class="control-label">Honorarios Secretario de Coactiva:</label>';
		$html .= '<input type="number" id="honorarios_secretario_coactiva" name="honorarios_secretario_coactiva"  value="'.$_valor_aplicar.'" class="form-control">';
		$html .= '</div>';
		$html .= '</div>';
			
		
		$html .= '<div class="col-md-3 col-lg-3 col-xs-12">';
		$html .= '<div class="form-group">';
		$html .= '<label for="interesmoraliquidacion" class="control-label">Intereses por mora liquidación:</label>';
		$html .= '<input type="number" id="interes_mora_liquidacion" name="interes_mora_liquidacion"  value="'.$_interes_mora.'" class="form-control">';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<div class="col-md-3 col-lg-3 col-xs-12">';
		$html .= '<div class="form-group">';
		$html .= '<label for="ivafactura" class="control-label">IVA Factura:</label>';
		$html .= '<input type="number" id="iva_factura" name="iva_factura"  value="'.$_iva_factura.'" class="form-control">';
		$html .= '</div>';
		$html .= '</div>';
		
		$html .= '<div class="col-md-3 col-lg-3 col-xs-12">';
		$html .= '<div class="form-group">';
		$html .= '<label for="valorretencionfondos" class="control-label">Valor para la Retención de Fondos:</label>';
		$html .= '<input type="number" id="valor_retencion_fondos" name="valor_retencion_fondos"  value="'.$_valor_retencion_fondos.'" class="form-control">';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
			
		$html .= '<div class="row">';
		$html .= '<div class="col-md-offset-4 col-lg-offset-4 col-md-2 col-lg-2 col-xs-12">';
		$html .= '<div class="form-group">';
		$html .= '<button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-block btn-default" ><i class="fa fa-desktop" aria-hidden="true"></i>Guardar</button>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		
		$respuesta = array();
		$respuesta['tabladatos'] =  $html;
		//$respuesta['tabladatos'] = "PRUEBA";
		echo json_encode($respuesta);
		die();

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
	
	
}
?>