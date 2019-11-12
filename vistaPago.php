<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");

$numeroDeReserva= $_GET['idReserva'];

$query = new Query();
$resultado= $query->consulta("montoReserva",
"Reserva",
"idReserva = '$numeroDeReserva'");

$montoReserva = $resultado[0]['montoReserva'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("Vistas/head.html"); ?>
</head>
<body>

<form action="./realizarPago.php" class="container">

    <label for="">Nombre:</label>
    <input type="text" name="nombre" class="form-control">

    <label for="">Apellido:</label>
    <input type="text" name="apellido" class="form-control">

    <label for="">N° de tarjeta:</label>
    <input type="number" name="numeroTarjeta" class="form-control">

    <label for="">Fecha de caducidad:</label>
    <input type="number" name="fechaCaducidad" class="form-control">

    <label for="">Codigo de seguridad:</label>
    <input type="number" name="codigoSeguridad" class="form-control">

    <label for="">Monto total a abonar:</label>
    <input type="text" name="montoPago" id="" value="<?php echo"$montoReserva";?>" readonly>

    <input type="submit" class="btn btn-primary float-right" value="Pagar">

    <input type="hidden" name="idReserva" value="<?php echo $numeroDeReserva ; ?>">

</form>
    
</body>
</html>