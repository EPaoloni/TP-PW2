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

    $lugaresSeleccionados;

    $capacidadTotalCabina = consultaCapacidadCabinaPorVuelo($reserva['idCabina'], $reserva['idVuelo']);
    $arrayLugaresOcupados = consultarLugaresOcupadosCabina($reserva['idOrigenReserva'], $reserva['idDestinoReserva'], $reserva['idVuelo'], $capacidadTotalCabina, $reserva['idCabina']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("Vistas/head.html"); ?>
</head>
<body>

    <div class="container">
        
    <?php foreach ($arrayLugaresOcupados as $lugarOcupado) { ?>

        <div class="col-xs-1 <?php echo ($lugarOcupado) ? 'ocupado' : 'libre';?>"><?php echo ($lugarOcupado) ? 'ocupado' : 'libre';?> </div>
    
    <?php } ?>

    </div>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/footer.php"); ?>
</body>
</html>