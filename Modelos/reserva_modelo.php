<?php
    
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");

    function guardarReserva($idVuelo, $idOrigen, $idDestino, $titular, $acompaniantes){
        $query = new Query();
        $existeReserva = $query->consulta("idReserva", "reserva", "idTitular = '" . $titular[0]['idUsuario'] . "' and idVuelo = '" . $idVuelo . "'");

        if($existeReserva != null){
            $logger = new Logger();
            $logger->warning("Se quiso hacer una reserva repetida con el usuario: " . $titular[0]['idUsuario'] . " para el vuelo: " . $idVuelo);
            header("location: /TP-PW2/");
            exit;
        }
        $insertReserva = $query->insert("reserva", "(idVuelo, idTitular, idOrigenReserva, idDestinoReserva)", "('" . $idVuelo . "', '" . $titular[0]['idUsuario'] . "','" . $idOrigen . "','" . $idDestino . "')");
        
        $idReserva = $query->consulta("idReserva", "reserva", "idTitular = '" . $titular[0]['idUsuario'] . "' and idVuelo = '" . $idVuelo . "'");

        if($insertReserva){
            if(count($acompaniantes) > 0){
                foreach ($acompaniantes as $acompaniante) {
                    $resultado = $query->insert("acompaniante_reserva", "(idReserva, idUsuario)", "(" . $idReserva[0]['idReserva'] . ", " . $acompaniante[0]['idUsuario'] . ")");
                    if(!$resultado){
                        echo "Error en la insercion de acompaniantes";
                    }
                }
            }
            echo "Reserva realizada";
        }
        
    }

?>