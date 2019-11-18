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

<div class="container">
    <a class="btn btn-primary" href="./listaPagos.php">Ver pagos de usuarios</a>
    <a class="btn btn-primary" href="./listaReservas.php">ASD</a>
    <a class="btn btn-primary" href="./index.php">ASD</a>
    <a class="btn btn-primary" href="./listaReservas.php">ASD</a>
</div>
    
</body>
</html>