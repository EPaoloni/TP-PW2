$(function(){
    
    $("#container-asientos").children("div").on("click", function(){
        if($(this).hasClass("libre")){
            if($(".propio").length < $("#cantidad-acompaniantes").val()){
                $(this).children("input").prop( "checked", true );
                $(this).removeClass("libre");
                $(this).addClass("propio");
            }
        } else if($(this).hasClass("propio")){
            $(this).children("input").prop( "checked", false );
            $(this).removeClass("propio");
            $(this).addClass("libre");
        }
    });

    $("#boton-guardar").on("click", function(){
        if($(".propio").length != $("#cantidad-acompaniantes").val()){
            event.preventDefault();
            alert("Por favor, seleccioná los lugares para todos los pasajeros");
        }
    });


});