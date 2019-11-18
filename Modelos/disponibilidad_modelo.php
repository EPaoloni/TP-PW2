<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");

    //Paso test
    function consultaCapacidadCabinaPorVuelo($idCabina, $idVuelo, $idOrigen, $idDestino){
        $query = new Query();
        $result = $query->consulta("modeloNave_cabinas.capacidad",
                                    "((modeloNave_cabinas INNER JOIN modeloNave ON modeloNave.id = modeloNave_cabinas.modeloNave)
                                    INNER JOIN naves ON modeloNave.id = naves.modelo)
                                    INNER JOIN vuelo ON naves.id = vuelo.id_nave",
                                    "idVuelo = '$idVuelo' and tipoCabina = '$idCabina'");
        $capacidadCabina = $result[0]['capacidad'];
    }

?>