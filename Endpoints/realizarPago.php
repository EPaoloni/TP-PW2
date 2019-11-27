<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/factura_modelo.php");
session_start();
$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$numeroTarjeta = $_GET['numeroTarjeta'];
$fechaCaducidad = $_GET['fechaCaducidad'];
$codigoSeguridad = $_GET['codigoSeguridad'];
$montoPago = $_GET['montoPago'];
$numeroReserva = $_GET['idReserva'];


$query = new Query();
$resultadoPago = $query->insert("pago",
                                "(numeroUsuario, fechaPago, numeroReserva)",
                                "(" . $_SESSION['idUsuario'] . " , '" . date('Ymd') . "' , " . $numeroReserva . ");");

if($resultadoPago){
    $resultadoRegistrarPagoReserva = $query->update("reserva",
                                                    "reservaPaga = true",
                                                    "( idReserva= " . $numeroReserva . " );");
    
    if($resultadoRegistrarPagoReserva){
        $resultadoGenerarFactura = generarFactura($_SESSION['idUsuario'],$_SESSION['username'],$numeroReserva,date('Ymd'));
        if($resultadoGenerarFactura){
            header("location: /TP-PW2/listaReservas.php");
        } else {
            $_SESSION['errorPago'] = "Ocurrio un error al registrar la factura";
            header("location: /TP-PW2/vistaPago.php?idReserva=" . $numeroReserva);
        }
        
    } else {
        $_SESSION['errorPago'] = "Ocurrio un error al registrar el pago de la reserva";
        header("location: /TP-PW2/vistaPago.php?idReserva=" . $numeroReserva);
    }
} else {
    $_SESSION['errorPago'] = "Ocurrio un error al registrar el pago";
    header("location: /TP-PW2/vistaPago.php?idReserva=" . $numeroReserva);
}

?>