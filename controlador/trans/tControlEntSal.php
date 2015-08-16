<?php 
	include_once ("../../modelo/constante.php");
	include_once("../../modelo/clases/Fachada.php");
	include_once("../../modelo/ControlEntSal.php");
	// --- Sentencia para capturar cada uno de los parametros enviados en el request --- //
	foreach($_POST as $nombre_campo => $valor){
	   $asignacion = "\$" . $nombre_campo . "='".addslashes($valor)."';";
	   eval($asignacion);
	}

	switch($accion){

		case 'verificarCedulaEmp':
			$obj   = new ControlEntSal();
			$datos = $obj -> verificarCedulaEmp($cedu,$tipo);
		break;

		default:
	    $datos = "Error accion no encontrada";
	}

    $salida = json_encode($datos);
    echo $salida;
    //echo $datos;
?>