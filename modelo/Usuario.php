<?php 
	include_once("clases/Fachada.php");

	class Usuario{

		public function verificarEmpUsuExisten($cedula,$usu){

			$bd = new Fachada();
			$bd->abrir(BD, SERVIDOR, USUARIO, CLAVE, PUERTO);

			$finalCedula = pg_escape_string($cedula);
			$finalUsu    = pg_escape_string($usu);

			$sql = "SELECT * FROM empleado WHERE cedula = '$finalCedula'";
			$resultado = $bd->consultar($sql, 'ARREGLO');

			if ($resultado) {
				$sqlUsu = "SELECT * FROM usuario WHERE usuario = '$finalUsu'";
				$resultadoUsu = $bd->consultar($sqlUsu, 'ARREGLO');

				if ($resultadoUsu) {
					return 'E001';
				}else{
					return 'E002';
				}
			}else{
				return 'E003';
			}
		}

		public function guadarDatosUsuario($user,$pass,$cedu,$tipo){

			$bd = new Fachada();
			$bd->abrir(BD, SERVIDOR, USUARIO, CLAVE, PUERTO);

			$finalUser = pg_escape_string($user);
			$finalPass = pg_escape_string($pass);
			$finalCedu = pg_escape_string($cedu);
			$finalTipo = pg_escape_string($tipo);

			$sql = "SELECT * FROM empleado WHERE cedula = '$finalCedu'";
			$resultado = $bd->consultar($sql, 'ARREGLO');

			$id_aux = $resultado[0]['id_emp'];

			if ($resultado) {
				
				$arreglo = array(

					'usuario' => $finalUser,
					'clave'   => $finalPass,
					'tipo'    => $finalTipo,
					'id_emp'  => $id_aux);

			       $resultado_ins = $bd->insertar('usuario',$arreglo);
			       return $resultado_ins;
			}
			return $resultado;
		}

		public function buscarUsuario($usu_aux){

			$bd = new Fachada();
			$bd->abrir(BD, SERVIDOR, USUARIO, CLAVE, PUERTO);

			$finalUserAux = pg_escape_string($usu_aux);

			$sql = "SELECT * FROM usuario AS U JOIN empleado AS E ON (U.id_emp = E.id_emp) WHERE 
			usuario = '$finalUserAux'";
			
			$resultado = $bd->consultar($sql, 'ARREGLO');
			return $resultado;
		}

		public function actualizarDatosUsuario($idUsu_aux,$usu,$pass,$tipo){

			$bd = new Fachada();
			$bd->abrir(BD, SERVIDOR, USUARIO, CLAVE, PUERTO);

			$finalUsuario = pg_escape_string($usu);
			$finalClave   = pg_escape_string($pass);
			$finalTipo    = pg_escape_string($tipo);

			$arreglo = array('usuario' => $finalUsuario,
							 'tipo'	   => $finalTipo,
							 'clave'   => $finalClave
						    );
			
			$condicion = "id_usu=$idUsu_aux";
			$resultado = $bd->modificar('usuario',$arreglo, $condicion);
			return $resultado;
		}

		public function eliminarDatosUsuario($idUsu_aux){

			$bd = new Fachada();
			$bd->abrir(BD, SERVIDOR, USUARIO, CLAVE, PUERTO);

			$finalId = pg_escape_string($idUsu_aux);

			$arreglo = array('eliminado' => 1);	
			$condicion = "id_usu=$finalId";	
			$resultado = $bd->modificar('usuario',$arreglo, $condicion);
			return $resultado;
		}

		public function listarUsuarios(){
			$bd = new Fachada();
			$bd->abrir(BD, SERVIDOR, USUARIO, CLAVE, PUERTO);

			$sql = "SELECT * FROM usuario";
			$resultado = $bd->consultar($sql, 'ARREGLO');
			return $resultado;
		}
	}
?>