$(document).ready(function(){

  	$("#emp").hide();
  	$("#usu").hide();
    $("#inBus").hide();
    $("#conEntSal").hide();

    $("#per").click(function(){
       $("#emp").show();
       $("#inBus").show();
       $("#usu").hide();
       $("#conEntSal").hide();
    });
    
    $("#usuario").click(function(){
       $("#usu").show();
       $("#emp").hide();
       $("#inBus").hide();
       $("#conEntSal").hide();
    });
    $("#entsal").click(function(){
       $("#conEntSal").show();
       $("#usu").hide();
       $("#emp").hide();
       $("#inBus").hide();
    });
});