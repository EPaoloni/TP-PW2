<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/disponibilidad_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/reserva_modelo.php");

    session_start();

    $numeroReserva = $_GET['numeroReserva'];

    $reserva = getReservaById($numeroReserva);
    $cantidadAcompaniantes = consultarCantidadDeAcompaniantesReserva($numeroReserva);

    if($reserva['reservaCaida'] || !$reserva['reservaPaga']){
        $_SESSION['errorCheckin'] = "La reserva esta caida o no se ha pagado";
        header("location: /TP-PW2/listaReservas.php");
    }

    $lugaresSeleccionados = consultarLugaresSeleccionadosReserva($numeroReserva);

    $capacidadTotalCabina = consultaCapacidadCabinaPorVuelo($reserva['idCabina'], $reserva['idVuelo']);
    $arrayLugaresOcupados = consultarLugaresOcupadosCabina($reserva['idOrigenReserva'], $reserva['idDestinoReserva'], $reserva['idVuelo'], $capacidadTotalCabina, $reserva['idCabina']);

    $error = "";

    if(isset($_SESSION['errorGuardarLugares'])){
        $error = $_SESSION['errorGuardarLugares'];
        unset($_SESSION['errorGuardarLugares']);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("Vistas/head.html"); ?>
    <link rel="stylesheet" href="StaticContent/css/style-checkin.css">
    <script src="StaticContent/js/checkin.js"></script>
</head>
<body>
    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/header.php"); ?>

    <input id="cantidad-acompaniantes" type="hidden" value="<?php echo $cantidadAcompaniantes + 1; ?>">

    <form action="/TP-PW2/Endpoints/guardarLugaresReserva.php" method="GET">
        <div class="container row" id="container-asientos">

            <input type="hidden" name="numeroReserva" value="<?php echo $numeroReserva ?>">

            <?php 
            $i = 1;
            foreach ($arrayLugaresOcupados as $lugarOcupado) { 
                if( in_array(($i), $lugaresSeleccionados) ) { ?>

                    <div class="col-xs-1 propio">
                        <input type="checkbox" name="lugaresSeleccionados[]" value="<?php echo $i; ?>" checked>
                    </div>
            <?php                
                } else {
            ?>
                    <div class="col-xs-1 <?php echo ($lugarOcupado) ? 'ocupado' : 'libre';?>">
                        <input type="checkbox" name="lugaresSeleccionados[]" value="<?php echo $i; ?>" <?php echo ($lugarOcupado) ? 'checked disabled' : '';?>>
                    </div>
            <?php 
                }
                $i++; 
            }
            ?>
        </div>
        <div class="container">
            <p class="text-danger"><?php echo $error; ?></p>
        </div>
        <div class="container row" id="container-botones">
            <input id="boton-guardar" type="submit" class="btn btn-primary" value="Guardar">
        </div>

    </form>
    

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/footer.php"); ?>
</body>
</html>