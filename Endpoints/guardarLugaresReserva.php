<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");

    $numeroReserva = $_GET['numeroReserva'];
    $arrayLugaresSeleccionados = $_GET['lugaresSeleccionados'];

    $lugaresSeleccionados = "";

    foreach ($arrayLugaresSeleccionados as $lugar) {
        if($lugar == end($arrayLugaresSeleccionados)){
            $lugaresSeleccionados .= $lugar;
        } else {
            $lugaresSeleccionados .= "$lugar,";
        }
    }
    
    $query = new Query();
    $resultado = $query->update("reserva", "lugaresSeleccionados = '$lugaresSeleccionados'", "idReserva = $numeroReserva");

    if(!$resultado){
        $_SESSION['errorGuardarLugares'] = "Ocurrio un error al guardar los lugares";
    }


    header("location: /TP-PW2/listaReservas.php");

?>