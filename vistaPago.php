<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/usuario_modelo.php");

session_start();

$numeroDeReserva= $_GET['idReserva'];


verificarCodigosDeViajero($numeroDeReserva);

function verificarCodigosDeViajero($numeroDeReserva){
    $query = new Query();
    $idTitular = $query->consulta("idTitular",
                                    "reserva",
                                    "idReserva = " . $numeroDeReserva);

    $idAcompaniantes = $query->consulta("idUsuario",
                                        "acompaniante_reserva",
                                        "idReserva = " . $numeroDeReserva);

    $idPasajeros[] = $idTitular[0]['idTitular'];

    if($idAcompaniantes != null){
        foreach ($idAcompaniantes as $idAcompaniante) {
            $idPasajeros[] = $idAcompaniante['idUsuario'];
        }
    }
    //TODO: Sacar
    $codigoViajeroRequerido = 2;
    foreach ($idPasajeros as $idPasajero) {
        $codigoViajeroPasajero = checkCodigoViajero($idPasajero);
        if($codigoViajeroPasajero == 0){
            $_SESSION['errorCodigoDeViajero'] = "Alguno de los pasajeros no tiene asignado un codigo de viajero en la reserva numero: $numeroDeReserva";
            header("location: ./listaReservas.php");
        }
        if($codigoViajeroRequerido > $codigoViajeroPasajero){
            $_SESSION['errorCodigoDeViajero'] = "Alguno de los pasajeros no cumple con el codigo de viajero requerido para la nave en la reserva numero: $numeroDeReserva";
            $query = new Query();
            $updateRealizado = $query->update("reserva", "reservaCaida = true", "idReserva = $numeroDeReserva");
            header("location: ./listaReservas.php");
        }
    }
}

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
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/header.php"); ?>

<?php echo "<p class='text-danger'>" . $_SESSION['errorPago'] . "</p>" ?>
<form action="./Endpoints/realizarPago.php" class="container">

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

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/footer.php"); ?>
</body>
</html>