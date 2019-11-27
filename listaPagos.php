<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/admin_modelo.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/factura_modelo.php");


checkIsAdmin();

$listaFacturas = getFacturas();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("Vistas/head.html"); ?>
</head>
<body>
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/header.php"); ?>
<div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">N° Factura</th>
                <th scope="col">Id cliente</th>
                <th scope="col">Username</th>
                <th scope="col">Fecha partida</th>
                <th scope="col">Fecha llegada</th>
                <th scope="col">Origen</th>
                <th scope="col">Destino</th>
                <th scope="col">Cant. de Pasajeros</th>
                <th scope="col">Cabina</th>
                <th scope="col">Fecha de pago</th>
                <th scope="col">Monto abonado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($listaFacturas<>null){
                foreach ($listaFacturas as $factura ) {
                    $idFactura=$factura['idFactura'];
                    $idTitular=$factura['idTitular'];
                    $username = $factura['username'];
                    $fechaDesde = $factura['fechaPartida'];
                    $fechaHasta = $factura['fechaLlegada'];
                    $origen = $factura['nombreOrigen'];
                    $destino = $factura['nombreDestino'];
                    $cantidadDePasajeros = $factura['cantPasajeros'];
                    $nombreCabina = $factura['nombreCabina'];
                    $fechaPago = $factura['fechaPago'];
                    $montoAbonado= $factura['montoAbonado'];
                   
                    
            ?>

            <tr>
                <th scope="row"><?php echo $idFactura ?></th>
                <th><?php echo $idTitular ?></th>
                <td><?php echo $username ?></td>
                <td><?php echo $fechaDesde ?></td>
                <td><?php echo $fechaHasta ?></td>
                <td><?php echo $origen ?></td>
                <td><?php echo $destino ?></td>
                <td><?php echo $cantidadDePasajeros ?></td>
                <td><?php echo $nombreCabina ?></td>
                <td><?php echo $fechaPago ?></td>
                <td><?php echo $montoAbonado ?></td>
            </tr>
        
            <?php      
               }
            }
            ?>
        </tbody>
    </table>
    <btn class="btn btn-primary" onclick="window.print()"> Imprimir</btn>
</div>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/footer.php"); ?>
</body>
</html>