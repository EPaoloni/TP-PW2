<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/admin_modelo.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/factura_modelo.php");


checkIsAdmin();
$errorFechas="";
$errorUsername="";
if(isset($_GET['submit-form-fechas'])){
    $fechaDesde = isset($_GET['inputFechaDesde']) ? $_GET['inputFechaDesde'] : null ;
    $fechaHasta = isset($_GET['inputFechaHasta']) ? $_GET['inputFechaHasta'] : null ;
    if($_GET['inputFechaDesde']!= null && $_GET['inputFechaHasta']!= null ){
        $listaFacturas = getFacturasByFechas($fechaDesde,$fechaHasta);
    }else{
        $listaFacturas=getFacturas();;
        $errorFechas="<p class='text-danger text-justify'>Ocurrio un error porque alguno de los campos esta vacio</p>";
    }
} else{
    if(isset($_GET['submit-form-username'])){
        $username=isset($_GET['inputUsername']) ? $_GET['inputUsername'] : null ;
        if($_GET['inputUsername'] != null){
            $listaFacturas = getFacturasByUsername($username);
        }else{
            $listaFacturas=getFacturas();;
            $errorUsername="<p class='text-danger text-justify'>Ocurrio un error porque el campo esta vacio </p>";
        }
    }else{
        $listaFacturas = getFacturas();
    }
} 



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("Vistas/head.html"); ?>
</head>
<body>
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/header.php"); ?>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-lg-4">
            <form class="form-row align-items-center" action="./listaPagos.php" >
                <div class="form-group">
                <h2 class="text-success"  >Buscar por Fechas</h2>
                    <label for="inputFechaDesde">Fecha desde:</label>
                    <input type="date" class="form-control" id="inputFechaDesde" name="inputFechaDesde">
                    <label for="inputFechaHasta">Fecha hasta:</label>
                    <input type="date" class="form-control" id="inputFechaHasta" name="inputFechaHasta">
                    <input type="submit" name="submit-form-fechas" class="btn btn-primary mb-2 mt-4" value="Aceptar">
                    <?php echo $errorFechas;?>
                </div>
            </form>
        </div>
        <div class="col col-lg-2">
        </div>
        <div class="col col-lg-4">
            <form class="form-row align-items-center" action="./listaPagos.php" >
                <div class="form-group">
                    <h2 class="text-success"  >Buscar por Username</h2>
                    <label for="inputUsername">Username: </label>
                    <input type="txt" class="form-control" id="inputUsername" name="inputUsername">
                    <input type="submit" name="submit-form-username" class="btn btn-primary mb-2 mt-4" value="Aceptar">
                    <?php echo $errorUsername;?> 
                </div>
            </form>
        </div>
    </div>
</div>
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
    <a href="./listaPagos.php" class="btn btn-success mb-2 mt-4">Buscar todos</a>
    <btn class="btn btn-primary mb-2 mt-4" onclick="window.print()"> Imprimir</btn>
</div>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/footer.php"); ?>
</body>
</html>