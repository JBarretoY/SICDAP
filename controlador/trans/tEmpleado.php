<?php 
	include_once ("../../modelo/constante.php");
	include_once("../../modelo/clases/Fachada.php");
	include_once("../../modelo/Empleado.php");
	// --- Sentencia para capturar cada uno de los parametros enviados en el request --- //
	foreach($_POST as $nombre_campo => $valor){
	   $asignacion = "\$" . $nombre_campo . "='".addslashes($valor)."';";
	   eval($asignacion);
	}
	switch($accion){

		case 'registrarEmpleado':
			$obj   = new Empleado();
			$datos = $obj -> registrarEmpleado($noms,$apes,$cedu,$fechaNa,$fechaIn,$direc,$tele,$cell,
				                                $correo,$cargo,$turno,$sexo);
		break;

		case 'buscarEmpleado':
			$obj   = new Empleado();
			$datos = $obj -> buscarEmpleado($cedula);
		break;
		case 'actualizarDatosEmp':
			$obj   = new Empleado();
			$datos = $obj -> actualizarDatosEmp($noms,$apes,$cedu,$fechaNa,$fechaIn,$direc,$tele,$cell,
												$correo,$cargo,$turno,$sexo,$idEmp);
		break;
	
		case 'eliminarDatosEmp':
			$obj   = new Empleado();
			$datos = $obj -> eliminarDatosEmp($idEmp);
		break;

		case 'listarEmpleados':
			$obj   = new Empleado();
			$datos = $obj -> listarEmpleados();
		break;

		default:
	    $datos = "Error accion no encontrada";
	}

    $salida = json_encode($datos);
    echo $salida;
    //echo $datos;
?>