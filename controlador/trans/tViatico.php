<?php
	include_once ("../../modelo/constante.php");
	include_once("../../modelo/clases/Fachada.php");
	include_once("../../modelo/Viatico.php");
	// --- Sentencia para capturar cada uno de los parametros enviados en el request --- //
	foreach($_POST as $nombre_campo => $valor){
	   $asignacion = "\$" . $nombre_campo . "='".addslashes($valor)."';";
	   eval($asignacion);
	}
	switch($accion){
		
		case 'registrarSolicitud':
			$obj   = new Viatico();
			$datos = $obj -> registrarSolicitud($lugardes,$fedesde,$fehasta,$motivo,$otro,$otrovu,$hidempleado,$trans,$transvu, $ciu_des, $ciu_ori);
		break;

		case 'listarSolicitudes':
			$obj   = new Viatico();
			$datos = $obj -> listarSolicitudes();
		break;

		case 'listatSolicitudesMesAnio':
			$obj   = new Viatico();
			$datos = $obj -> listatSolicitudesMesAnio($mes, $anio);
		break;

		case 'listatSolicitudesNivelMesAnio':
			$obj   = new Viatico();
			$datos = $obj -> listatSolicitudesNivelMesAnio($mes, $anio, $gen);
		break;

		case 'listatSolicitudesGeneradas':
			$obj   = new Viatico();
			$datos = $obj -> listatSolicitudesGeneradas($mes, $anio);
		break;

		case 'cargarViatico':
			$obj   = new Viatico();
			$datos = $obj -> cargarViatico();
		break;

		case 'registrarPrecios':
			$obj   = new Viatico();
			$datos = $obj -> registrarPrecios($via,$monto,$fecha,$montomax);
		break;

		case 'validarPrecioViatico':
			$obj   = new Viatico();
			$datos = $obj -> validarPrecioViatico($via,$fecha);
		break;

		case 'buscarSolicitud':
			$obj   = new Viatico();
			$datos = $obj -> buscarSolicitud($nSoli);
		break;

		case 'guardarGastos':
			$obj   = new Viatico();
			$datos = $obj -> guardarGastos($ids, $montos, $cants, $totals, $idSoli, $idProyecto);
		break;

		case 'buscarPrecios':
			$obj   = new Viatico();
			$datos = $obj -> buscarPrecios($fecha);
		break;

		case 'listarViaticos':
			$obj   = new Viatico();
			$datos = $obj -> listarViaticos();
		break;

		case 'aprobarViaticos':
			$obj   = new Viatico();
			$datos = $obj -> aprobarViaticos($ids,$status);
		break;

		case 'cancelarViaticos':
			$obj   = new Viatico();
			$datos = $obj -> cancelarViaticos($ids, $status);
		break;

		case 'cargarCiudad':
			$obj   = new Viatico();
			$datos = $obj -> cargarCiudad($ciudad);
		break;

		case 'listarEstados':
			$obj   = new Viatico();
			$datos = $obj -> listarEstados();
		break;

		case 'listarCiudades':
			$obj   = new Viatico();
			$datos = $obj -> listarCiudades($estado,$activa);
		break;

		case 'listarCiudadesSoli':
			$obj   = new Viatico();
			$datos = $obj -> listarCiudadesSoli();
		break;

		case 'pagoDeViaticos':
			$obj   = new Viatico();
			$datos = $obj -> pagoDeViaticos($id_soli, $referencia, $modo, $fecha, $banco);
		break;

		case 'desactivarCiudades':
			$obj   = new Viatico();
			$datos = $obj -> desactivarCiudades($ids);
		break;

		case 'activarCiudades':
			$obj   = new Viatico();
			$datos = $obj -> activarCiudades($ids);
		break;

		case 'enviarCorreo':
			$obj   = new Viatico();
			$datos = $obj -> enviarCorreo($id,$opc);
		break;

		case 'busquedaAvanzasaVia':
			$obj   = new Viatico();
			$datos = $obj -> busquedaAvanzasaVia($mes,$anio,$filtro,$cedula_em,$fedesde,$fehasta,$esta_ori,$ciu_ori,$esta_des,$ciu_des);
		break;

		case 'busquedaZona':
			$obj   = new Viatico();
			$datos = $obj -> busquedaZona($filtro,$fedesde,$fehasta,$esta_des,$ciu_des,$cons);
		break;

		case 'historialDeViaticos':
			$obj   = new Viatico();
			$datos = $obj -> historialDeViaticos($tipo,$cedu,$cod);
		break;

		case 'listarSoliStatus':
			$obj   = new Viatico();
			$datos = $obj -> listarSoliStatus($filtro,$fedesde,$fehasta);
		break;

		case 'ConsolidadoSoliPerso':
			$obj   = new Viatico();
			$datos = $obj -> ConsolidadoSoliPerso($filtro,$fedesde,$fehasta);
		break;

		case 'consolidadoSoliStatus':
			$obj   = new Viatico();
			$datos = $obj -> consolidadoSoliStatus($filtro,$fedesde,$fehasta);
		break;

		case 'buscarStatusSoli':
			$obj   = new Viatico();
			$datos = $obj -> buscarStatusSoli($soli);
		break;   

		case 'enviarCorreos':
			$obj   = new Viatico();
			$datos = $obj -> enviarCorreos($ids,$opc);
		break;

		default:
	    $datos = "Error accion no encontrada";
	}

    $salida = json_encode($datos);
    echo $salida;
    //echo $datos;
?>