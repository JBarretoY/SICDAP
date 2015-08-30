function verificarCedulaEmp(){
	
	var cedu = $("#ce").val();
	var tipo = $("#tip").val();

	if ($.trim(cedu) == '' || $.trim(tipo) == '') {
		alert("ERROR... Existen campos vacios");
		return;
	}

	if(tipo == 1)
		var tip_aux = 'Entrada';
	else
		tip_aux = 'Salida'

	if(confirm("Esta seguro de enviar estos datos? cedula:"+cedu+" tipo:"+tip_aux)){
			$.ajax( {
			type : 'POST',
			url  : "../controlador/trans/tControlEntSal.php",
			data :	{ accion: "verificarCedulaEmp",cedu:cedu,tipo:tipo},
			error : function(xhr, ajaxOptions, thrownError) {
				alert("Ups... Algo esta mal :(   verificarCedulaEmp");
			},
			beforeSend: function(data){
	           // $("#prueba").html("<p align='center'><img src='img/Preloader_10.gif'></img></p>");
	        },
			success : function(data) {
				var data = JSON.parse(data);
				if(data == 0){
					alert("La cedula introducida no esta registrada en el sistema");
					limpiarFormControl();
					return;
				}
			}
		});
	}
}
function limpiarFormControl(){
	$("#ce").val('');
	$("#tip").val('');
}