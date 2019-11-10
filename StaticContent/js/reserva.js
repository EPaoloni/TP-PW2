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
                    $("#username-" + (index + 1) ).hide();
                    $("#error-crear-usuario-" + (index + 1) ).hide();
                    $("#username-" + (index + 1) ).removeAttr("required");
                    $("#label-username-" + (index + 1) ).hide();
                } else {
                    $("#error-crear-usuario-" + (index + 1) ).hide();
                    $("#usuario-no-existente" + (index + 1) ).fadeIn();
                    $("#boton-crear-usuario" + (index + 1) ).fadeIn();
                    $("#username-" + (index + 1) ).fadeIn();
                    $("#username-" + (index + 1) ).attr("required", true);
                    $("#label-username-" + (index + 1) ).fadeIn();
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
        var formActual = $(this).parent();

        crearUsuario(formActual.children('[name="username"]').val(), formActual.children('[name="mail"]').val(), formActual.children('[name="nombre"]').val(), formActual.children('[name="apellido"]').val(), formActual);
    });

    function crearUsuario(username, mail, nombre, apellido, formActual){
        var dataJson  = { "username" : username, "mail" : mail, "nombre" : nombre, "apellido" : apellido };
        $.ajax({
            type: "GET",
            url: "./Endpoints/crearUsuarioDesdeReserva.php",
            data: dataJson,
            async: false
        })
        .done(function(data){
            if(data){
                formActual.children(".error-crear-usuario").hide();
                formActual.children(".usuario-no-existente").hide();
                formActual.children(".boton-crear-usuario").hide();
                formActual.children(".error-crear-usuario").hide();
                formActual.children(".usuario-creado").show();
            } else {
                formActual.children(".error-crear-usuario").fadeIn();
            }
        });
    }

});

$(document).on("keydown", "form", function(event) { 
    return event.key != "Enter";
});