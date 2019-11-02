<?php
    include_once("modelos/hora_modelo.php");
    if(empty($_GET)){
        header("location: index.php");
        exit();
    }
    $fecha = isset($_GET["fecha"]) ? $_GET["fecha"] : NULL;
    $idCentro =  isset($_GET["centro"])? $_GET["centro"] : NULL;
    $selectHoras=imprimirHorasSegunFechaYCentro($fecha,$idCentro);
    echo  $selectHoras ;
?>