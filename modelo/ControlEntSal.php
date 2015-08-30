<?php 
/*CLASE DE CONTROL DE ENTRADA Y SALIDA DE EMPLEADOS*/
class ControlEntSal{

	public function verificarCedulaEmp($cedu,$tipo){
		/*
			******ERRORES******

			0 = cedula no encontrada
			1 = operacion exitosa
			2 = entrar primero
			3 = salir primero
			4 = error al entrar
			5 = error al salir
			6 = registro de entrada exitosamente
			7 = registro de salida exitosamente
			8 = error no se pudo hacer la entrada
			9 = error no se pudo hacer la salida
		*/
		$bd = new Fachada();
		$bd->abrir(BD, SERVIDOR, USUARIO, CLAVE, PUERTO);

		$sql = "SELECT * FROM empleado WHERE cedula ='$cedu'";
		$resultado = $bd->consultar($sql, 'ARREGLO');
		if($resultado){

			$id_aux_emp = $resultado[0]['id_emp'];
			$id_reg_con = $resultado[0]['id_con'];
			$hoy = date("Y-m-d");
			$sqlVeriCon = "SELECT * FROM control WHERE fecha = '$hoy' AND id_emp = $id_aux_emp";
			$resul_VeriCon = $bd->consultar($sqlVeriCon, 'ARREGLO');

			if($resul_VeriCon){

				$horaEn  = $resul_VeriCon[0]['hora_en'];
				$horaSal = $resul_VeriCon[0]['hora_sal'];

				if(!empty($horaEn) && !empty($horaSal)){
					$hora = date("H:i:s"); 
					$data = array('hora_en' => $hora,
								  'fecha'   => $hoy,
								  'id_emp'  => $id_aux_emp );
					$data_final = $bd->insertar('control',$data);
					if($data_final){
						return '00';
					}else{
						return '88';
					}
				}

				if($tipo == 1){

					if(!empty($horaEn)){
						return 4;
					}

					$hora = date("H:i:s"); 
					$data = array('hora_en' => $hora,
								  'fecha'   => $hoy,
								  'id_emp'  => $id_aux_emp );
					$data_final = $bd->insertar('control',$data);
					if($data_final){
						return  6;
					}else{
						return 8;
					}
				}

				if($tipo == 0){

					if(!empty($horaSal)){
						return 5;
					}
					$hora = date("H:i:s");
					$data = array('hora_sal' => $hora);
					$condicion = "id_emp=$id_aux_emp";
					$data_final = $bd->modificar('control',$data, $condicion);
					if($data_final){
						return 7;
					}else{
						return 9;
					}
				}
			}else{
				$hora = date("H:i:s"); 
				$data = array('hora_en' => $hora,
							  'fecha'   => $hoy,
							  'id_emp'  => $id_aux_emp );
				$data_final = $bd->insertar('control',$data);
				if($data_final){
					return '00';
				}else{
					return '88';
				}
			}
		}else{
			return 0;
		}
	}
}
?>