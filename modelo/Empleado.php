<?php 
include_once("clases/Fachada.php");

	class Empleado{

		public function registrarEmpleado($noms,$apes,$cedu,$fechaNa,$fechaIn,$direc,$tele,$cell,$correo,$cargo,$turno,$sexo){

			$bd = new Fachada();
			$bd->abrir(BD, SERVIDOR, USUARIO, CLAVE, PUERTO);

			$finalNoms = pg_escape_string($noms);
			$finalApes = pg_escape_string($apes);
			$finalCedu = pg_escape_string($cedu);
			$finalFechaNa = pg_escape_string($fechaNa);
			$finalFechaIn = pg_escape_string($fechaIn);
			$finalDirec = pg_escape_string($direc);
			$finalTele  = pg_escape_string($tele);
			$finalCell  = pg_escape_string($cell);
			$finalCorreo = pg_escape_string($correo);
			$finalCargo = pg_escape_string($cargo);
			$finalTurno = pg_escape_string($turno);
			$finalSexo  = pg_escape_string($sexo);

			/*$sql[]="INSERT INTO empleado (nombres,apellidos,cedula,fecha_na,fecha_ing,direcion,telefono,correo,celular,sexo) 
			VALUES('$finalNoms','$finalApes','$finalCedu','$finalFechaNa','$finalFechaIn','$finalDirec','$finalTele','$finalCorreo',
				'$finalCell','$finalCorreo','$finalSexo')";

			$sql[]="INSERT INTO cargo (cargo,turno,id_emp)
				VALUES('$finalCargo', '$finalTurno',(SELECT last_value FROM empleado_id_emp_seq))";*/
			/*$bd = new Datos(BD, SERVIDOR, USUARIO, CLAVE, PUERTO);
			$bd->conectar();
			$resultado = $bd->consultasMultiples($sql);
			return $resultado;*/

			$arreglo = array(
					'nombres'   => $finalNoms,
					'apellidos' => $finalApes,
					'cedula'    => $finalCedu,
					'fecha_na'  => $finalFechaNa,
					'fecha_ing' => $finalFechaIn,
					'direcion'  => $finalDirec,
					'telefono'  => $finalTele,
					'correo'	=> $finalCorreo,
					'celular'   => $finalCell,
					'sexo'      => $finalSexo);
			$resultado = $bd->insertar('empleado',$arreglo);
			
			//return $resultado;
			if ($resultado) {
				$sql = "SELECT * FROM empleado WHERE cedula = '$finalCedu'";
				$resultado_query = $bd->consultar($sql, 'ARREGLO');

				$id_aux = $resultado_query[0]['id_emp'];

				$arreglo_cur = array('cargo'  => $finalCargo,
									 'turno'  => $finalTurno,
									 'id_emp' => $id_aux
								 );
				$resultado_cur = $bd->insertar('cargo',$arreglo_cur);
				return $resultado_cur;
			}
		}

		public function buscarEmpleado($cedula){

			$bd = new Fachada();
			$bd->abrir(BD, SERVIDOR, USUARIO, CLAVE, PUERTO);

			$finalCedula = pg_escape_string($cedula);

			$sql = "SELECT * FROM empleado AS E JOIN cargo AS C ON (E.id_emp = C.id_emp) WHERE E.cedula = '$finalCedula'";
			$resultado = $bd->consultar($sql, 'ARREGLO');
			return $resultado;
		}

		public function actualizarDatosEmp($noms,$apes,$cedu,$fechaNa,$fechaIn,$direc,$tele,$cell,$correo,$cargo,$turno,$sexo,
										   $idEmp){
			$bd = new Fachada();
			$bd->abrir(BD, SERVIDOR, USUARIO, CLAVE, PUERTO);
			
			$arreglo = array('nombres'   => $noms,
							 'apellidos' => $apes,
							 'cedula'    => $cedu,
							 'fecha_na'  => $fechaNa,
							 'fecha_ing' => $fechaIn,
							 'direcion'  => $direc,
							 'telefono' => $tele,
							 'correo'   => $correo,
							 'celular'  => $cell,
							 'sexo'     => $sexo);
			$condicion = "id_emp=$idEmp";
			$resultado = $bd->modificar('empleado',$arreglo, $condicion);
			
			if($resultado){
				$arreglo_tur = array('turno' => $turno,
									 'cargo' => $cargo);
				
				$condicion = "id_emp=$idEmp";
			    $resultado = $bd->modificar('cargo',$arreglo_tur, $condicion);
				return $resultado;
			}
			return $resultado;
		}

		public function eliminarDatosEmp($idEmp){
			$bd = new Fachada();
			$bd->abrir(BD, SERVIDOR, USUARIO, CLAVE, PUERTO);

			$condicion = "id_emp=$idEmp";
				$resultado = $bd->eliminar('empleado', $condicion);
				if ($resultado) {
					return '1';
				}else{
					return '0';
				}
	    }

	    public function listarEmpleados(){
	    	$bd = new Fachada();
			$bd->abrir(BD, SERVIDOR, USUARIO, CLAVE, PUERTO);

			$sql = "SELECT * FROM empleado";
			$resultado = $bd->consultar($sql, 'ARREGLO');
			return $resultado;
	    }
	}
?>