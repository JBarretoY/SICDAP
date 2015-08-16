function iniciarSesion(){

	var usuario = $("#user").val();
	var pass    = $("#pass").val();

	if ($.trim(usuario) == '' || $.trim(pass) == '') {
		alert("ERROR... Existen campos vacios");
		return;
	}

	$.ajax( {
		type : 'POST',
		url : "controlador/trans/tSesion.php",
		data :	{ accion: "iniciarSesion", usuario:usuario,pass:pass},
		error : function(xhr, ajaxOptions, thrownError) {
			alert("Ups... Algo esta mal :(   iniciarSesion");
		},
		beforeSend: function(data){
           // $("#prueba").html("<p align='center'><img src='img/Preloader_10.gif'></img></p>");
        },
		success : function(data) {
			var data = JSON.parse(data);
			if(data){
				moverDirectorioSesionAct();
			}else{
				alert("ERROR... los datos introducidos son correctos ó el usuario no existe");
				limpiarFormSesion();
			}
		}
	});
}

function cerrarSesion(){

	$.ajax( {
		type : 'POST',
		url : "../controlador/trans/tSesion.php",
		data :	{ accion: "cerrarSesion"},
		error : function(xhr, ajaxOptions, thrownError) {
			alert("Ups... Algo esta maaaaaaaaaaaaal :( cerrarSesion");
		},
		success : function(data) {
			console.log(data);
			var data = eval("(" + data + ")");
			if(data){
				moverDirectorioCerrado();
			} else{
				alert("no se pudo cerrar la sesion");
				//alert(data);
			}
		}
	});
}

function moverDirectorioSesionAct(){
	window.location='vista/';
}

function moverDirectorioCerrado(){
	window.location='../';
}

function limpiarFormSesion(){

	$("#user").val('');
	$("#pass").val('');
}