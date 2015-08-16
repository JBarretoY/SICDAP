<?php 
include_once("clases/Fachada.php");
	class Sesion{

		public function iniciarSesion($usuario,$pass){

			$bd = new Fachada();
			$bd->abrir(BD, SERVIDOR, USUARIO, CLAVE, PUERTO);

			$finalUser = pg_escape_string($usuario);
			$finalPass = pg_escape_string($pass);

			$sql = "SELECT * FROM usuario WHERE usuario = '$finalUser' AND clave = '$finalPass'";
			$resultado = $bd->consultar($sql, 'ARREGLO');

			if ($resultado) {

				session_start();

				$_SESSION['user'] = $finalUser;
				$_SESSION['pass'] = $finalPass;
				$_SESSION['permitido'] = TRUE;
			}
			return $resultado;
		}

		public function cerrarSesion(){
			
			session_start();
			session_destroy();
			session_unset();
			return true;
		}
	}
?>