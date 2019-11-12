<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");

$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$numeroTarjeta = $_GET['numeroTarjeta'];
$fechaCaducidad = $_GET['fechaCaducidad'];
$codigoSeguridad = $_GET['codigoSeguridad'];
$montoPago = $_GET['montoPago'];
$numeroReserva = $_GET['idReserva'];

$_SESSION['idUsuario'] = 1;

$query = new Query();
$resultadoPago = $query->insert("pago",
                                "(numeroUsuario, fechaPago, numeroReserva)",
                                "('" . $_SESSION['idUsuario'] . "' , '" . date('Ymd') . "' , " . $numeroReserva . ");");

if($resultadoPago){
    $resultadoRegistrarPagoReserva = $query->update("reserva",
                                                    "reservaPaga = true",
                                                    "( idReserva= " . $numeroReserva . " );");

    if($resultadoRegistrarPagoReserva){
        header("location: ./listaReservas.php");
    } else {
        $_SESSION['errorPago'] = "Ocurrio un error al registrar el pago";
        header("location: ./vistaPago.php?idReserva=" . $numeroReserva);
    }
} else {
    $_SESSION['errorPago'] = "Ocurrio un error al registrar el pago";
    header("location: ./vistaPago.php?idReserva=" . $numeroReserva);
}

?>