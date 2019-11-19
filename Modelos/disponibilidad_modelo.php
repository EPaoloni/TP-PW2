<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");

    //Test OK
    function consultarCantidadLugaresDisponiblesCabina($idCabina, $idVuelo, $idOrigen, $idDestino){
        $query = new Query();
        //Obtengo todas las reservas de un vuelo entre destinos
        $cantidadReservasCabinaVuelo = $query->consulta("reserva.idReserva, COUNT(idUsuario) as 'cantidadAcompaniantes'",
                                    "reserva INNER JOIN acompaniante_reserva ON reserva.idReserva = acompaniante_reserva.idReserva",
                                    "idVuelo = '$idVuelo' and idCabina = '$idCabina' and idOrigenReserva >= '$idOrigen' and idDestinoReserva <= '$idDestino'
                                    GROUP BY idReserva");
        
        $capacidadTotal = consultaCapacidadCabinaPorVuelo($idCabina, $idVuelo, $idOrigen, $idDestino);

        if($cantidadReservasCabinaVuelo == null){
            return $capacidadTotal;
        }
        
        //Sumo la cantidad de reservas para contar a los titulares
        $cantidadLugaresOcupados = array_key_last($cantidadReservasCabinaVuelo) + 1;

        //Le agrego los acompañantes
        foreach ($cantidadReservasCabinaVuelo as $acompaniantes) {
            $cantidadLugaresOcupados += $acompaniantes['cantidadAcompaniantes'];
        }

        

        $cantidadLugaresDisponibles = $capacidadTotal - $cantidadLugaresOcupados;
        
        return $cantidadLugaresDisponibles;
    }

    //Test OK
    function consultaCapacidadCabinaPorVuelo($idCabina, $idVuelo, $idOrigen, $idDestino){
        
        $condicionesConsulta = obtenerCondicionesConsultaSegunSentido($idVuelo, $idCabina, $idDestino, $idOrigen);

        $query = new Query();
        $result = $query->consulta("modeloNave_cabinas.capacidad",
                                    "((modeloNave_cabinas INNER JOIN modeloNave ON modeloNave.id = modeloNave_cabinas.modeloNave)
                                    INNER JOIN naves ON modeloNave.id = naves.modelo)
                                    INNER JOIN vuelo ON naves.id = vuelo.id_nave",
                                    $condicionesConsulta);
        $capacidadCabina = $result[0]['capacidad'];

        return $capacidadCabina;
    }

    //Test OK
    function consultarLugaresOcupadosCabina($idOrigen, $idDestino, $idVuelo, $capacidadTotal, $idCabina){

        $condicionesConsulta = obtenerCondicionesConsultaSegunSentido($idVuelo, $idCabina, $idDestino, $idOrigen);

        $query = new Query();
        $lugaresOcupados = $query->consulta("lugaresSeleccionados",
                                    "reserva INNER JOIN vuelo ON reserva.idVuelo = vuelo.idVuelo",
                                    $condicionesConsulta);

        $arrayLugaresOcupados = array_fill (0, $capacidadTotal, false );
        foreach ($lugaresOcupados as $lugaresEnReserva) {
            $numerosDeLugares = explode(",", $lugaresEnReserva['lugaresSeleccionados']);
            foreach ($numerosDeLugares as $numero) {
                $arrayLugaresOcupados[$numero] = true;
            }
        }

        return $arrayLugaresOcupados;
    }

    function obtenerCondicionesConsultaSegunSentido($idVuelo, $idCabina, $idDestino, $idOrigen){
        $condicionesConsulta = "idVuelo = '$idVuelo' and idCabina = '$idCabina' ";

        if(isVueloHaciaLaTierra($idVuelo)){
            $condicionesConsulta .= " and idDestino > '$idDestino' and idOrigen < '$idOrigen'";
        } else {
            $condicionesConsulta .= " and idDestino < '$idDestino' and idOrigen > '$idOrigen'";
        }

        return $condicionesConsulta;
    }

?>