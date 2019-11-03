$(function(){

    $("#confirmar-reserva").on("click", function(){

        //TODO:
        if(validarUsuarios()){
            enviarFormularioReserva();
        }

    });

    function validarUsuarios(){
        
        var camposMail = $(".mail")
        var dataJson = "";
        var banderaUsuariosExistentes = true;
        $.each(camposMail, function (index, mail) { 
            valorMail = $(mail).val();
            dataJson = {"mail": valorMail};
            $.ajax({
                type: "GET",
                url: "/TP-PW2/Endpoints/verificarMail.php",
                data: dataJson,
                async: false
            })
            .done(function(data){
                if(data){
                    $("#usuario-no-existente" + (index + 1) ).hide();
                    $("#boton-crear-usuario" + (index + 1) ).hide();
                } else {
                    $("#usuario-no-existente" + (index + 1) ).fadeIn();
                    $("#boton-crear-usuario" + (index + 1) ).fadeIn();
                    banderaUsuariosExistentes = false;
                }
            });
        });

        return banderaUsuariosExistentes;
    }

    function enviarFormularioReserva(){
        var camposHiddenMail = $(".hidden-mail-usuario");
        $.each(camposHiddenMail, function (index, valueOfElement) { 
            $(this).val($("#mail" + (index+1)).val());
        });

        $("#form-confirmar-reserva").submit();
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