<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/usuario_modelo.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/busqueda_modelo.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/reserva_modelo.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");


function verificarCodigosDeViajero($numeroDeReserva){
    $query = new Query();
    $idTitular = $query->consulta("idTitular",
                                    "reserva",
                                    "idReserva = " . $numeroDeReserva);

    $idAcompaniantes = $query->consulta("idUsuario",
                                        "acompaniante_reserva",
                                        "idReserva = " . $numeroDeReserva);

    $idPasajeros[] = $idTitular[0]['idTitular'];

    if($idAcompaniantes != null){
        foreach ($idAcompaniantes as $idAcompaniante) {
            $idPasajeros[] = $idAcompaniante['idUsuario'];
        }
    }
    $reserva = getReservaById($numeroDeReserva);
    $idVuelo = $reserva['idVuelo'];
    $vuelo = consultarVueloPorId($idVuelo);
    $codigoViajeroRequerido = $vuelo['codigoViajeroRequerido'];
    foreach ($idPasajeros as $idPasajero) {
        $codigoViajeroPasajero = checkCodigoViajero($idPasajero);
        if($codigoViajeroPasajero == 0){
            $_SESSION['errorCodigoDeViajero'] = "Alguno de los pasajeros no tiene asignado un codigo de viajero en la reserva numero: $numeroDeReserva";
            header("location: ./listaReservas.php");
        }
        if($codigoViajeroRequerido > $codigoViajeroPasajero){
            $_SESSION['errorCodigoDeViajero'] = "Alguno de los pasajeros no cumple con el codigo de viajero requerido para la nave en la reserva numero: $numeroDeReserva";
            $query = new Query();
            $updateRealizado = $query->update("reserva", "reservaCaida = true", "idReserva = $numeroDeReserva");
            header("location: ./listaReservas.php");
        }
    }
}

function obtenerMontoReserva($numeroDeReserva){
    $query = new Query();
    $resultado= $query->consulta("montoReserva",
    "Reserva",
    "idReserva = '$numeroDeReserva'");

    return $resultado[0]['montoReserva'];
}
?>