function verificarEmpUsuExisten(){

	var cedula = $("#ceduEmpe").val();
	var usu    = $("#user").val();
	var pass   = $("#pass").val();
	var tipo   = $("#tipo").val();

	if ($.trim(cedu) == '' || $.trim(usu) == '' || $.trim(pass) == '' || $.trim(tipo) == '-') {
		alert("ERROR... Existen Campos vacios");
		//console.log(cedula+' '+usu+' '+pass);
		return;
	}

	$.ajax( {
		type : 'POST',
		url  : "../controlador/trans/tUsuario.php",
		data :	{ accion: "verificarEmpUsuExisten", cedula:cedula,usu:usu},
		error : function(xhr, ajaxOptions, thrownError) {
			alert("Ups... Algo esta mal :(   verificarEmpUsuExisten");
		},
		beforeSend: function(data){
           // $("#prueba").html("<p align='center'><img src='img/Preloader_10.gif'></img></p>");
        },
		success : function(data) {

			var data = JSON.parse(data);

			if(data == 'E001'){
				alert("No se puede crear el usuario, posiblemente esté en uso por otro empleado");
				return;
			}else if(data == 'E002'){
				guadarDatosUsuario(usu,pass,cedula,tipo);
				return;
			} else if(data == 'E003'){
				alert("La cedula introducida no coincide con ningun empleado");
				return;
			}
		}
	});
}

function guadarDatosUsuario(user,pass,cedu,tipo){

	$.ajax( {
		type : 'POST',
		url  : "../controlador/trans/tUsuario.php",
		data :	{ accion: "guadarDatosUsuario", user:user,pass:pass,cedu:cedu,tipo:tipo},
		error : function(xhr, ajaxOptions, thrownError) {
			alert("Ups... Algo esta mal :(   guadarDatosUsuario");
		},
		beforeSend: function(data){
           // $("#prueba").html("<p align='center'><img src='img/Preloader_10.gif'></img></p>");
        },
		success : function(data) {

			var data = JSON.parse(data);

			if(data){
				alert("El usuario fue creado exitosamente..!");
				limpiarFormUsu();
				return;
			}else {
				alert("ERROR... No se pudieron guardar los datos");
				return;
			}
		}
	});

}

function limpiarFormUsu(){

	$("#ceduEmpe").val('');
	$("#user").val('');
	$("#pass").val('');
	$("#tipo").val('-');
	$("#usuAux").val('');

}

function buscarUsuario(){

	var usu_aux = $("#usuAux").val();

	if($.trim(usu_aux) === ''){
		limpiarFormUsu();
		return false;
	}

	$.ajax( {
		type : 'POST',
		url  : "../controlador/trans/tUsuario.php",
		data :	{ accion: "buscarUsuario", usu_aux:usu_aux},
		error : function(xhr, ajaxOptions, thrownError) {
			alert("Ups... Algo esta mal :(   buscarUsuario");
		},
		beforeSend: function(data){
           // $("#prueba").html("<p align='center'><img src='img/Preloader_10.gif'></img></p>");
        },
		success : function(data) {

			var data = JSON.parse(data);
			if(data){
				alert("Usuario: "+usu_aux+". Encontrado");
				mostrarDatosUsuForm(data);
				return;
			}else {
				alert("ERROR...El usuario "+usu_aux+" No se pudo encontrar el sistema");
				return;
			}
		}
	});
}

function mostrarDatosUsuForm(data){

	$("#ceduEmpe").val(data[0]['cedula']);
	$("#ceduEmpe").attr('disabled', true);
	$("#btnVeri").attr('disabled', true);
	$("#user").val(data[0]['usuario']);
	$("#pass").val(data[0]['clave']);
	$("#tipo").val(data[0]['tipo']);
	$("#hideUsu").val(data[0]['id_usu']);
}

function actualizarDatosUsuario(user_aux){

	var idUsu_aux = $("#hideUsu").val();
	var usu    = $("#user").val();
	var pass   = $("#pass").val();
	var tipo   = $("#tipo").val();

	if ($.trim(idUsu_aux) == '') {
		alert("ERROR... No se puede realizar la actualización, no existe un usuario");
		return;
	}

	if ($.trim(usu) == '' || $.trim(pass) == '' || $.trim(tipo) == '-') {

		alert("ERROR... Existen campos vacios o sin seleccionar");
		return;
	}

	if (confirm("Esta seguro de actualizar los datos del usuario?")) {
		$.ajax( {
			type : 'POST',
			url  : "../controlador/trans/tUsuario.php",
			data :	{ accion: "actualizarDatosUsuario", idUsu_aux:idUsu_aux,usu:usu,pass:pass,tipo:tipo},
			error : function(xhr, ajaxOptions, thrownError) {
				alert("Ups... Algo esta mal :(   actualizarDatosUsuario");
			},
			beforeSend: function(data){
	           // $("#prueba").html("<p align='center'><img src='img/Preloader_10.gif'></img></p>");
	        },
			success : function(data) {

				var data = JSON.parse(data);
				if(data){
					alert("Datos del usuario:" +user_aux+" actualizado exitosamente");
					limpiarFormUsu();
					return;
				}else {
					alert("ERROR... No se pudo actualizar los datos del usuario");
					return;
				}
			}
		});
	}
}

function eliminarDatosUsuario(user_delete){
	console.log(user_delete);
	var idUsu_aux = $("#hideUsu").val();

	if ($.trim(idUsu_aux) == '') {
		alert("ERROR FATAL... NO SE PODRA REALIZAR ESTA ACCION");
		return;
	}

	if (confirm("Esta seguro de eliminar a este usuario?")) {
			$.ajax( {
			type : 'POST',
			url  : "../controlador/trans/tUsuario.php",
			data :	{ accion: "eliminarDatosUsuario", idUsu_aux:idUsu_aux},
			error : function(xhr, ajaxOptions, thrownError) {
				alert("Ups... Algo esta mal :(   eliminarDatosUsuario");
			},
			beforeSend: function(data){
			   // $("#prueba").html("<p align='center'><img src='img/Preloader_10.gif'></img></p>");
			},
			success : function(data) {
	
				var data = JSON.parse(data);
				if(data){
					alert("Datos del usuario:" +user_delete+" Fueron eliminados exitosamente del sistema");
					limpiarFormUsu();
					return;
				}else {
					alert("ERROR... No se pudo actualizar los datos del usuario");
					return;
				}
			}
		});
	}
}

function listarUsuarios(){
	$.ajax( {
		type : 'POST',
		url : "../controlador/trans/tUsuario.php",
		data :	{ accion: "listarUsuarios"},
		error : function(xhr, ajaxOptions, thrownError) {
			alert("Ups... Algo esta mal :(");
		},
		success : function(data) {
			var data = eval("(" + data + ")");
			if(data){
				$('#tbl_usu').html("");
				var fila="<tr>"+
								"<th>#</th>"+
								"<th>Usuario</th>"+
								"<th>Tipo</th>"+
							"</tr>";
				$('#tbl_usu').append(fila);

				for(var i=0; i<data.length; i++){

					var tipo=data[i]['tipo'];
					var aprob=data[i]['aprob'];

					if (tipo == 1) {
						tipo = 'Administador';
					}
					else
						tipo = 'Usuario';
					var fila="<tr id='user_"+data[i]['id_usu']+"'>"+
								"<td>"+(i+1)+"</td>"+
								"<td>"+data[i]['usuario']+"</td>"+
								"<td>"+tipo+"</td>"+
							"</tr>";
					$('#tbl_usu').append(fila);
				}
			}
		}
	});
}