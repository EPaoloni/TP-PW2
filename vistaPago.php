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
<div class="row justify-content-center">
    <h2 class="text-primary mb-4">Realiza tu pago!</h2>
    <div class="w-100"></div>
    <form action="./Endpoints/realizarPago.php" class="container" id="form-pago">
        <div class="form-group row">
            <label for="" class="text-secondary col-sm-2 col-form-label">Nombre:</label>
            <div class="col-sm-10">
                <input type="text" name="nombre" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="text-secondary col-sm-2 col-form-label">Apellido:</label>
            <div class="col-sm-10">
                <input type="text" name="apellido" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="text-secondary col-sm-2 col-form-label">N° de tarjeta:</label>
            <div class="col-sm-10">
                <input type="text" name="numeroTarjeta" class="form-control border" id="numero-tarjeta">
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="text-secondary col-sm-2 col-form-label">Fecha de caducidad:</label>
            <div class="col-sm-10">
                <input type="text" name="fechaCaducidad" class="form-control" id="fecha-caducidad">
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="text-secondary col-sm-2 col-form-label">Codigo de seguridad:</label>
            <div class="col-sm-10">
                <input type="number" name="codigoSeguridad" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-6 col-form-label text-secondary">Monto total a abonar:</label>
            <input type="text" name="montoPago" class="form-control col-sm-3" id="" value="<?php echo"$montoReserva";?>" readonly>
            <input type="submit" id="boton-pagar" class="btn btn-success float-right col-sm-2 ml-5" value="Pagar">
        </div>
        <input type="hidden" name="idReserva" value="<?php echo $numeroDeReserva ; ?>">
    </form>
</div>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/footer.php"); ?>
</body>
</html>