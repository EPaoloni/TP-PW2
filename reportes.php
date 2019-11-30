<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/admin_modelo.php");

checkIsAdmin();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("Vistas/head.html"); ?>
</head>
<body>
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/header.php"); ?>

<div class="container">
    <a class="btn btn-primary" href="./listaPagos.php">Ver pagos de usuarios</a>
    <a class="btn btn-primary" href="./cabinaMasVendida.php">Cabina Mas Vendida</a>
    <a class="btn btn-primary" href="./tasaOcupacionVuelo.php">Tasa de ocupación por viaje </a>
    <a class="btn btn-primary" href="./tasaOcupacionEquipo.php">Tasa de ocupación equipo</a>
</div>
    
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/footer.php"); ?>
</body>
</html>