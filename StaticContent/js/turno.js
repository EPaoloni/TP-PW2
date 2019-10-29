$(document).ready(function(){
    $(".ankara").hide();
    $("#centro-medico").change(function(){
        var idCentro=  $("#centro-medico").val();
        if(idCentro==1 || idCentro==2){
            $(".ankara").hide();
        }
        if(idCentro==3){
            $(".ankara").show();
        }

    });
});