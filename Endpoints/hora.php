<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/hora_modelo.php");
    if(empty($_GET)){
        header("location: ../index.php");
        exit();
    }
    $fecha = isset($_GET["fecha"]) ? $_GET["fecha"] : NULL;
    $idCentro =  isset($_GET["centro"])? $_GET["centro"] : NULL;
    if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$fecha)) {
        $selectHoras=imprimirHorasSegunFechaYCentro($fecha,$idCentro);
    }
    echo  $selectHoras ;
?>