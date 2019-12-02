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
    <link rel="stylesheet" href="StaticContent/css/style-pago.css">
    <script src="StaticContent/js/pago.js"></script>
</head>
<body>
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/header.php"); ?>

<?php 
    if(isset($_SESSION['errorPago'])){
        echo "<p class='text-danger'>" . $_SESSION['errorPago'] . "</p>";
        $_SESSION['errorPago'] = ""; 
    }
?>
<form action="./Endpoints/realizarPago.php" class="container" id="form-pago">

    <label for="">Nombre:</label>
    <input type="text" name="nombre" class="form-control">

    <label for="">Apellido:</label>
    <input type="text" name="apellido" class="form-control">

    <label for="">N° de tarjeta:</label>
    <input type="text" name="numeroTarjeta" class="form-control border" id="numero-tarjeta">

    <label for="">Fecha de caducidad:</label>
    <input type="text" name="fechaCaducidad" class="form-control" id="fecha-caducidad">

    <label for="">Codigo de seguridad:</label>
    <input type="number" name="codigoSeguridad" class="form-control">

    <div class="form-group row">
        <label for="" class="col-sm-6 col-form-label">Monto total a abonar:</label>
        <input type="text" name="montoPago" class="form-control col-sm-3" id="" value="<?php echo"$montoReserva";?>" readonly>
        <input type="submit" id="boton-pagar" class="btn btn-primary float-right col-sm-2" value="Pagar">
    </div>


    <input type="hidden" name="idReserva" value="<?php echo $numeroDeReserva ; ?>">

</form>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/footer.php"); ?>
</body>
</html>