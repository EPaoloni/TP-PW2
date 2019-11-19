<?php 

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Logger.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");

    function consultarEstaciones(){
        $query = new Query();
        $estaciones = $query->consulta("", "estacion", "1=1 ORDER BY idEstacion");
        return $estaciones;
    }

    function consultarCircuitos($origen, $destino){
        $logger = new Logger();
        $logger->info("Se va a realizar una consulta a circuito con los siguientes parametros: origen = $origen, destino = $destino");

        $query = new Query();
        $circuitosRequeridos = $query->consulta("idCircuito",
                                                "circuito",
                                                "`estacionesCircuito` LIKE '%{$origen}%{$destino}%'");
        return $circuitosRequeridos;
    }

    function consultarVuelosPorCircuitos($circuitosRequeridos, $fechaDesde, $fechaHasta){

        $logger = new Logger();
        $logger->info("Se van a realizar consultas a vuelos con los siguientes parametros: fechaDesde = $fechaDesde, fechaHasta = $fechaHasta, circuito = " . $circuitoRequerido['idCircuito']);

        $listaDeVuelos = null;
        $query = new Query();

        foreach ($circuitosRequeridos as $circuitoRequerido) {
            $vuelos = $query->consulta("",
                                        "vuelo inner join circuito on vuelo.circuitoVuelo = circuito.idCircuito",
                                        "fechaPartida LIKE '" . $fechaDesde . "' and fechaLlegada LIKE '" . $fechaHasta . "'
                                        and circuitoVuelo = '" . $circuitoRequerido['idCircuito'] . "' ;");

            if($vuelos != null){
                if($listaDeVuelos == null){
                    $listaDeVuelos = $vuelos;
                } else {
                    $listaDeVuelos = array_merge($listaDeVuelos, $vuelos);
                }
            }
        }
        return $listaDeVuelos;
    }

    function consultarVueloPorId($idVuelo){
        $query = new Query();
        $result = $query->consulta("*", "vuelo", "idVuelo = '$idVuelo'");

        return $result[0];
    }
?>