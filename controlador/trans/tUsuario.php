<?php 
	include_once ("../../modelo/constante.php");
	include_once("../../modelo/clases/Fachada.php");
	include_once("../../modelo/Usuario.php");

	// --- Sentencia para capturar cada uno de los parametros enviados en el request --- //

	foreach($_POST as $nombre_campo => $valor){
	   $asignacion = "\$" . $nombre_campo . "='".addslashes($valor)."';";
	   eval($asignacion);
	}

	switch($accion){

		case 'verificarEmpUsuExisten':
			$obj   = new Usuario();
			$datos = $obj -> verificarEmpUsuExisten($cedula,$usu);
		break;

		case 'guadarDatosUsuario':
			$obj   = new Usuario();
			$datos = $obj -> guadarDatosUsuario($user,$pass,$cedu,$tipo);
		break;

		case 'buscarUsuario':
			$obj   = new Usuario();
			$datos = $obj -> buscarUsuario($usu_aux);
		break;

		case 'actualizarDatosUsuario':
			$obj   = new Usuario();
			$datos = $obj -> actualizarDatosUsuario($idUsu_aux,$usu,$pass,$tipo);
		break;

		case 'eliminarDatosUsuario':
			$obj   = new Usuario();
			$datos = $obj -> eliminarDatosUsuario($idUsu_aux);
		break;

		case 'listarUsuarios':
			$obj   = new Usuario();
			$datos = $obj -> listarUsuarios();
		break;

		default:
	    $datos = "Error accion no encontrada";
	}

    $salida = json_encode($datos);
    echo $salida;
    //echo $datos;
?>