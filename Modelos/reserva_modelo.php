<?php
    
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Logger.php");


    function guardarReserva($idVuelo, $idOrigen, $idDestino, $titular, $acompaniantes, $montoReserva, $idCabina){
        $logger = new Logger();

        $query = new Query();
        $existeReserva = $query->consulta("idReserva", "reserva", "idTitular = '" . $titular[0]['idUsuario'] . "' and idVuelo = '" . $idVuelo . "'");

        if($existeReserva != null){
            $logger->warning("Se quiso hacer una reserva repetida con el usuario: " . $titular[0]['idUsuario'] . " para el vuelo: " . $idVuelo);
            return false;
        }
        $insertReserva = $query->insert("reserva", "(idVuelo, idTitular, idOrigenReserva, idDestinoReserva, montoReserva, reservaPaga, lugaresSeleccionados, idCabina, reservaCaida)",
                                         "('" . $idVuelo . "', '" . $titular[0]['idUsuario'] . "','" . $idOrigen . "','" . $idDestino . "', '" . $montoReserva . "', false, '', " . $idCabina . ", false)");
        
        if($insertReserva){
            if(count($acompaniantes) > 0){

                $idReserva = $query->consulta("idReserva", "reserva", "idTitular = '" . $titular[0]['idUsuario'] . "' and idVuelo = '" . $idVuelo . "'");

                foreach ($acompaniantes as $acompaniante) {
                    $resultado = $query->insert("acompaniante_reserva", "(idReserva, idUsuario, reservaPaga)", "(" . $idReserva[0]['idReserva'] . ", " . $acompaniante[0]['idUsuario'] . " , false)");
                    if(!$resultado){
                        $logger->error("Ocurrio un error al insertar un acompañante de reserva");
                        return false;
                    }
                }
            }
            return true;
        } else {
            $logger->error("Ocurrio un error al insertar una reserva");
            return false;
        }
    }
    function getReservaById($idReserva){
        $query = new Query();
        $resultado = $query->consulta("", "reserva", "idReserva = $idReserva");
        return $resultado[0];
    }

    function consultarCantidadDeAcompaniantesReserva($idReserva){
        $query = new Query();
        $cantidadAcompaniantes = $query->consulta("COUNT(idUsuario)", "acompaniante_reserva", "idReserva = $idReserva");

        return $cantidadAcompaniantes[0]['COUNT(idUsuario)'];
    }

?>