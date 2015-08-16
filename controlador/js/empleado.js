function registrarEmpleado(){

	var noms = $("#noms").val();
	var apes = $("#apes").val();
	var cedu = $("#cedu").val();
	var fechaNa = $("#fe_na").val();
	var fechaIn = $("#fe_in").val();
	var sexo = "M";

    if($("#sex2").is(':checked')){
    	sexo="F";
    }

    var direc = $("#direc").val();
    var tele  = $("#tele").val();
    var cell  = $("#cell").val();
    var correo = $("#correo").val();
    var cargo  = $("#cargo").val();
    var turno  = $("#turno").val();


    if ($.trim(noms) == '' || $.trim(apes) == '' || $.trim(cedu) == '' || $.trim(fechaNa) == '' || $.trim(fechaIn) == '' ||
    	$.trim(direc) == '' || $.trim(tele) == '' || $.trim(cell) == '' || $.trim(correo) == '' || $.trim(cargo) == 0 || 
    	$.trim(turno) == 0) {
    	alert("ERROR... Existen Campos vacios");
    	return;
    }

    $.ajax( {
		type : 'POST',
		url  : "../controlador/trans/tEmpleado.php",
		data :	{ accion: "registrarEmpleado", noms:noms,apes:apes,cedu:cedu,fechaNa:fechaNa,fechaIn:fechaIn,direc:direc,
				tele:tele,cell:cell,correo:correo,cargo:cargo,turno:turno,sexo:sexo},
		error : function(xhr, ajaxOptions, thrownError) {
			alert("Ups... Algo esta mal :(   registrarEmpleado");
		},
		beforeSend: function(data){
           // $("#prueba").html("<p align='center'><img src='img/Preloader_10.gif'></img></p>");
        },
		success : function(data) {
			var data = JSON.parse(data);
			if(data){
				console.log(data);
					alert("Datos del empleado guardado exitosamente");
					limpiarFormEmp();
					return;
			}else{
				alert("ERROR... Los datos no se pudieron guardar");
				return;
			}
		}
	});
}

function limpiarFormEmp(){

	$("#noms").val('');
	$("#apes").val('');
	$("#cedu").val('');
	$("#fe_na").val('');
	$("#fe_in").val('');
    $("#direc").val('');
    $("#tele").val('');
    $("#cell").val('');
    $("#correo").val('');
    $("#cargo").val('');
    $("#turno").val('');
}

function buscarEmpleado(){

	var cedula = $("#inBus").val();

	if ($.trim(cedula) == '') {
		alert("ERROR... Debe introducir una cedula");
		limpiarFormEmp();
		return;
	}

	$.ajax( {
		type : 'POST',
		url  : "../controlador/trans/tEmpleado.php",
		data :	{ accion: "buscarEmpleado", cedula:cedula},
		error : function(xhr, ajaxOptions, thrownError) {
			alert("Ups... Algo esta mal :(   buscarEmpleado");
		},
		beforeSend: function(data){
           // $("#prueba").html("<p align='center'><img src='img/Preloader_10.gif'></img></p>");
        },
		success : function(data) {
			var data = JSON.parse(data);
			if(data){
				console.log(data);
					alert("Empleado encontrado");
					llenarInputs(data);
			}else{
				alert("ERROR... El empleado con la cedula "+cedula+" No pudo ser encontrado");
				limpiarFormBus();
				limpiarFormEmp();
				return;
			}
		}
	});

}

function llenarInputs(data){

	$("#noms").val(data[0]['nombres']);
	$("#apes").val(data[0]['apellidos']);
	$("#cedu").val(data[0]['cedula']);
	$("#fe_na").val(data[0]['fecha_na']);
	$("#fe_in").val(data[0]['fecha_ing']);
    $("#direc").val(data[0]['direcion']);
    $("#tele").val(data[0]['telefono']);
    $("#cell").val(data[0]['celular']);
    $("#correo").val(data[0]['correo']);
    $("#cargo").val(data[0]['cargo']);
    $("#turno").val(data[0]['turno']);
    $("#idEmp").val(data[0]['id_emp']);

    if(data[0]['sexo']=="M"){
    	$("#sex1").attr('checked',true);
    }else{
		$("#sex2").attr('checked',true);
    }
}

function limpiarFormBus(){
	$("#inBus").val('');
}

function actualizarDatosEmp(){

	var noms = $("#noms").val();
	var apes = $("#apes").val();
	var cedu = $("#cedu").val();
	var fechaNa = $("#fe_na").val();
	var fechaIn = $("#fe_in").val();
	var sexo = "M";

    if($("#sex2").is(':checked')){
    	sexo="F";
    }

    var direc = $("#direc").val();
    var tele  = $("#tele").val();
    var cell  = $("#cell").val();
    var correo = $("#correo").val();
    var cargo  = $("#cargo").val();
    var turno  = $("#turno").val();
    var idEmp  = $("#idEmp").val();

    if ($.trim(noms) == '' || $.trim(apes) == '' || $.trim(cedu) == '' || $.trim(fechaNa) == '' || $.trim(fechaIn) == '' ||
    	$.trim(direc) == '' || $.trim(tele) == '' || $.trim(cell) == '' || $.trim(correo) == '' || $.trim(cargo) == 0 ||
    	$.trim(turno) == 0) {

    	alert("ERROR... Existen campos vacios, no se podra hacer la actualización de datos del empleado");
    	return;
    }

    if (confirm("Esta seguro de actualizar los datos del empleado?")) {
    	$.ajax( {
			type : 'POST',
			url  : "../controlador/trans/tEmpleado.php",
			data :	{ accion: "actualizarDatosEmp",noms:noms,apes:apes,cedu:cedu,fechaNa:fechaNa,fechaIn:fechaIn,
					direc:direc,tele:tele,cell:cell,correo:correo,cargo:cargo,turno:turno,idEmp:idEmp},
			error : function(xhr, ajaxOptions, thrownError) {
				alert("Ups... Algo esta mal :(   actualizarDatosEmp");
			},
			beforeSend: function(data){
	           // $("#prueba").html("<p align='center'><img src='img/Preloader_10.gif'></img></p>");
	        },
			success : function(data) {
				var data = JSON.parse(data);
				if(data){
					console.log(data);
						alert("Datos del empleado actualizados exitosamente");
						limpiarFormBus();
						limpiarFormEmp();
						return;
						//llenarInputs(data);
				}else{
					alert("ERROR... No se pudo realizar la actualizacion de datos del empleado");
					return;
				}
			}
		});
    }

}

function eliminarDatosEmp() {
	var idEmp  = $("#idEmp").val();
	
	if ($.trim(idEmp) == '') {
		alert("ERROR... no se puede realizar esta accion aun, debe realizar una busqueda primero");
		return;
	}
	
	if (confirm("Esta seguro de eliminar a este Empleado?")) {
			$.ajax( {
			type : 'POST',
			url  : "../controlador/trans/tEmpleado.php",
			data :	{ accion: "eliminarDatosEmp",idEmp:idEmp},
			error : function(xhr, ajaxOptions, thrownError) {
				alert("Ups... Algo esta mal :(   eliminarDatosEmp");
			},
			beforeSend: function(data){
			   // $("#prueba").html("<p align='center'><img src='img/Preloader_10.gif'></img></p>");
			},
			success : function(data) {
				var data = JSON.parse(data);
				if(data){
					console.log(data);
						alert("Los datos del empleado han sido eliminados exitosamente");
						limpiarFormBus();
						limpiarFormEmp();
						return;
				}else{
					alert("ERROR... El empleado no se pudo eliminar");
					return;
				}
			}
		});
	}
}

function listarEmpleados(){
	$.ajax( {
		type : 'POST',
		url : "../controlador/trans/tEmpleado.php",
		data :	{ accion: "listarEmpleados"},
		error : function(xhr, ajaxOptions, thrownError) {
			alert("Ups... Algo esta mal :(");
		},
		success : function(data) {
			var data = eval("(" + data + ")");
			if(data){
				$('#tbl_empList').html("");
				var fila="<tr>"+
								"<th>#</th>"+
								"<th>Nombres</th>"+
								"<th>Apellidos</th>"+
								"<th>Cedula</th>"+
								"<th>Fecha de Nacimiento</th>"+
								"<th>Fecha de Ingreso</th>"+
								"<th>Direccion</th>"+
								"<th>Telefono</th>"+
								"<th>Correo</th>"+
								"<th>Celular</th>"+
								"<th>Sexo</th>"+
							"</tr>";
				$('#tbl_empList').append(fila);

				for(var i=0; i<data.length; i++){

					var fila="<tr id='user_"+data[i]['id_usu']+"'>"+
								"<td>"+(i+1)+"</td>"+
								"<td>"+data[i]['nombres']+"</td>"+
								"<td>"+data[i]['apellidos']+"</td>"+
								"<td>"+data[i]['cedula']+"</td>"+
								"<td>"+data[i]['fecha_na']+"</td>"+
								"<td>"+data[i]['fecha_ing']+"</td>"+
								"<td>"+data[i]['direcion']+"</td>"+
								"<td>"+data[i]['telefono']+"</td>"+
								"<td>"+data[i]['correo']+"</td>"+
								"<td>"+data[i]['celular']+"</td>"+
								"<td>"+data[i]['sexo']+"</td>"+
							"</tr>";
					$('#tbl_empList').append(fila);
				}
			}
		}
	});
} 