<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/admin_modelo.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/usuario_modelo.php");

checkIsAdmin();

$pagosRegistrados = consultarPagosRegistrados();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("Vistas/head.html"); ?>
</head>
<body>

<div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">id cliente</th>
                <th scope="col">Username</th>
                <th scope="col">Fecha partida</th>
                <th scope="col">Fecha llegada</th>
                <th scope="col">Origen</th>
                <th scope="col">Destino</th>
                <th scope="col">Cant. Acompañantes</th>
                <th scope="col">Cabina</th>
                <th scope="col">Fecha de pago</th>
                <th scope="col">Monto abonado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($pagosRegistrados<>null){
                foreach ($pagosRegistrados as $pago ) {
                    $username = getUsernameById($pago['idTitular']);
                    $fechaDesde = "asd";
                    $fechaHasta = "asd";
                    $cantidadAcompaniantes = "asd";
            ?>

            <tr>
                <th scope="row"><?php echo $pago['idTitular'] ?></th>
                <td><?php echo $username ?></td>
                <td><?php echo $fechaDesde ?></td>
                <td><?php echo $fechaHasta ?></td>
                <td><?php echo $pago['idOrigenReserva'] ?></td>
                <td><?php echo $pago['idDestinoReserva'] ?></td>
                <td><?php echo $cantidadAcompaniantes ?></td>
                <td><?php echo $pago['idCabina'] ?></td>
                <td><?php echo $pago['fechaPago'] ?></td>
                <td><?php echo $pago['montoReserva'] ?></td>
            </tr>

            <?php      
                }
            }
            ?>
        </tbody>
    </table>
</div>
    
</body>
</html>