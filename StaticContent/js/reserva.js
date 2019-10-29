$(function(){

    $("#confirmar-reserva").on("click", function(){

        //TODO:
        //Validar campos de formularios, si el usuario existe
        
        //Si tiene mas personas crear los usuarios

        //Consultar codigo medico del usuario

        //Si no tiene codigo medico confirmo la reserva y le digo que saque turno
        if(codigoMedico == null){
            guardarReserva();
            mostrarSolicitarTurno();
        } else {
            if(codigoMedico >= codigoMedicoDelViaje){
                guardarReserva();
            } else {
                mostrarCodigoMedicoInsuficiente();
            }
        }

        //Si tiene y puede viajar, reservo y listo

        //Si tiene y no puede viajar, le digo y listo

        //Si tiene mas personas validar los codigos medicos de ellos, solo si no pueden viajar

    });

    function validarFormularios(){
        //Agarra los mails de los formularios
        var mails = $(".mail").val()
        $.ajax({
            type: "GET",
            url: "Modelos/reserva_modelo.php",
            data: mails,
            success: function (datosQueDevuelve) {
                $("#form-confirmar-reserva").append("error");
            }
        });
        //Consulta por ajax si existen
        //Si existe le pongo un mensaje
    }

    function crearUsuario(){
        //Creo el usuario con los datos de un formulario
    }


    function guardarReserva(){
        //Guardo la reserva en base de datos
    }

    function mostrarSolicitarTurno(){
        //Muestra un mensaje para solicitar turno medico
    }

    function mostrarCodigoMedicoInsuficiente(){
        //Muestra el mensaje, el usuario acepta y se lo manda al home
    }



});