<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/pago_modelo.php");

session_start();

$numeroDeReserva= $_GET['idReserva'];

verificarCodigosDeViajero($numeroDeReserva);

$montoReserva = obtenerMontoReserva($numeroDeReserva);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("Vistas/head.html"); ?>
</head>
<body>
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/header.php"); ?>

<?php 
    if(isset($_SESSION['errorPago'])){
        echo "<p class='text-danger'>" . $_SESSION['errorPago'] . "</p>";
        $_SESSION['errorPago'] = ""; 
    }
?>
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