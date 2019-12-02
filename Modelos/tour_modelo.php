<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Logger.php");

    function getListaTour(){
        $query=new Query();
        $resultado= $query->consulta("",
                                    "vuelo INNER JOIN circuito ON vuelo.circuitoVuelo=circuito.idCircuito",
                                    "circuitoVuelo=7");
        return $resultado;
    }

    function consultarCircuitosTour(){
        $query = new Query();
        $resultado = $query->consulta("estacionesCircuito",
                                        "vuelo inner join circuito on circuitoVuelo = idCircuito",
                                        "idCircuito = 7");

        $circuitoTour = explode(",", $resultado[0]['estacionesCircuito']);
        return $circuitoTour;
    }
?>