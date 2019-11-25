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
?>