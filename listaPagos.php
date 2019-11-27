<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/admin_modelo.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/usuario_modelo.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/busqueda_modelo.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/reserva_modelo.php");

checkIsAdmin();

$pagosRegistrados = consultarPagosRegistrados();
$estacionesEnArray= consultarEstaciones();

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
                <th scope="col">id cliente</th>
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
            if($pagosRegistrados<>null){
                foreach ($pagosRegistrados as $pago ) {
                    $username = getUsernameById($pago['idTitular']);
                    $origen = $estacionesEnArray[$pago['idOrigenReserva']-1]['nombreEstacion'];
                    $destino = $estacionesEnArray[$pago['idDestinoReserva']-1]['nombreEstacion'];
                    $vuelo = consultarVueloPorId($pago['idVuelo']);
                    $fechaDesde = $vuelo['fechaPartida'];
                    $fechaHasta = $vuelo['fechaLlegada'];
                    $cantidadAcompaniantes = consultarCantidadDeAcompaniantesReserva($pago['idReserva']) + 1;
            ?>

            <tr>
                <th scope="row"><?php echo $pago['idTitular'] ?></th>
                <td><?php echo $username ?></td>
                <td><?php echo $fechaDesde ?></td>
                <td><?php echo $fechaHasta ?></td>
                <td><?php echo $origen ?></td>
                <td><?php echo $destino ?></td>
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
    <div class="row container-fluid float-right">
        <input type="date" name="" id="fecha-desde-consulta" class="form-inline">
        <input type="date" name="" id="fecha-hasta-consulta" class="form-inline">
        <button class="btn btn-primary" id="btn-filtrar-por-fechas">Filtrar facturas entre fechas</button>
    </div>
    <div class="row container-fluid float-right">
        <input type="text" name="" id="username-input" class="form-inline">
        <button class="btn btn-primary" id="btn-filtrar-por-username">Filtrar por usuario</button>
    </div>
</div>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/footer.php"); ?>
</body>
</html>