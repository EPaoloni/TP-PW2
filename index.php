<?php
    include_once('helpers/Query.php');
    $query = new Query();
    $estaciones = $query->consulta("", "estacion", "");

    include_once("Modelos/busqueda_modelo.php");

    
    if(isset($_GET['enviar'])){
        $origen = isset($_GET['origen']) ? $_GET['origen'] : " * ";
        $destino = isset($_GET['destino']) ? $_GET['destino'] : " * ";
        $fechaDesde = isset($_GET['fechaDesde']) ? $_GET['fechaDesde'] : " * ";
        $fechaHasta = isset($_GET['fechaHasta']) ? $_GET['fechaHasta'] : " * ";
        $cantidadPasajeros = $_GET['cantidadPasajeros'];

        $vuelos = $query->consulta("",
                                    "vuelo inner join circuito on vuelo.idCircuito = circuito.idCircuito",
                                    "fechaPartida = '" . $fechaDesde . "' and fechaLlegada = '" . $fechaHasta . "'
                                    and destinoVuelo = '" . $destino . "' and origenVuelo = '" . $origen . "' ;");
        $consultaRealizada = true;

    } else {
        $consultaRealizada = false;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php include("Vistas/head.html") ?>
    <script src="StaticContent/js/busqueda.js"></script>

</head>
<body>

    <a class="btn btn-success" href="./login.php">A login</a>
    <a class="btn btn-success" href="./registro.php">A registro</a>

    <h1 class="text-center">Búsqueda de vuelos</h1>
    <div class="container">
        <form action="./index.php" method="get">
            <label for="origen">Origen: </label>
                <select name="origen" id="origen" class="form-control col-xs-12">                   
                    <?php 
                        foreach ($estaciones as $estacion) {
                        echo "<option value='" . $estacion['idEstacion'] . "'>" . $estacion['nombreEstacion'] . "</option>";
                    }?>

                </select>
            <label for="destino">Destino: </label>
            <select name="destino" id="destino" class="form-control col-xs-12">                   
                    <?php 
                        foreach ($estaciones as $estacion) {
                        echo "<option value='" . $estacion['idEstacion'] . "'>" . $estacion['nombreEstacion'] . "</option>";
                    }?>

                </select>
            
            <label for="ida">Fecha desde: </label>
            <input class="form-control col-xs-12" type="date" name="fechaDesde" id="fechaDesde" required>
            <label for="vuelta">Fecha hasta: </label>
            <input class="form-control col-xs-12" type="date" name="fechaHasta" id="fechaHasta" required>
            <label for="pasajeros">Cantidad de pasajeros: </label>
            <input class="form-control col-xs-12" type="number" name="cantidadPasajeros" id="cantidadPasajeros" required>
            <input id="submit-button" name="enviar" class="btn btn-success" type="submit">
            <a href="./index.php" class="btn btn-danger">Limpiar</a>
        </form>
        
    </div>
    <div class="container">
        <?php

            if($consultaRealizada){
                foreach ($listaDeVuelos as $vuelo) {
                    echo "
                    <div class='card text-center'>
                        <div class='card-header'>
                        Vuelo
                        </div>
                        <div class='card-body'>
                        <h5 class='card-title'>Partida: " . $vuelo['nombreOrigen'] . ", " . $vuelo['fechaPartida'] . ";<br>
                                    Destino: " . $vuelo['nombreDestino'] .", " . $vuelo['fechaLlegada'] . "
                        </h5>
                        <p class='card-text'>Datos de tu vuelo</p>
                        <a href='./reserva.php' class='btn btn-primary'>Reservar(toDO)</a>
                        </div>
                        <div class='card-footer text-muted'>
                        </div>
                    </div>
                    ";
                }
            }
        ?>
    </div>


</body>
</html>