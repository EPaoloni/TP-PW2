$(function(){

    $("#confirmar-reserva").on("click", function(){

        //TODO:
        validarUsuarios();

        enviarFormularioReserva();
    });

    function validarUsuarios(){
        
        var camposMail = $(".mail")
        var dataJson = "";
        $.each(camposMail, function (index, mail) { 
            valorMail = $(mail).val();
            dataJson = {"mail": valorMail};
            $.ajax({
                type: "GET",
                url: "/TP-PW2/Endpoints/verificarMail.php",
                data: dataJson
            })
            .done(function(data){
                if(data){
                    $("#usuario-no-existente" + (index + 1) ).hide();
                    $("#boton-crear-usuario" + (index + 1) ).hide();
                    //Ver si mostrar algun mensaje si el usuario existe
                } else {
                    $("#usuario-no-existente" + (index + 1) ).fadeIn();
                    $("#boton-crear-usuario" + (index + 1) ).fadeIn();
                }
            });
        });
    }

    function enviarFormularioReserva(){

    }

    $(".boton-crear-usuario").on("click", function(){
        var datosUsuario = "";
        var indexFormulario = $(this).siblings(".posicion-usuario").val();

        crearUsuario(datosUsuario, indexFormulario);
    });

    function crearUsuario(datosUsuario, indexFormulario){
            $.ajax({
                type: "GET",
                url: "/TP-PW2/Modelos/reserva_modelo.php",
                data: datosUsuario
            })
            .success(function(usuarioCreado){
                if(usuarioCreado){
                    $("#usuario-creado" + indexFormulario).append("usuario creado");
                }
            });
    }

});