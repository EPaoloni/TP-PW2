<?php
    include_once('helpers/Query.php');
    $query = new Query();
    $estaciones = $query->consulta("", "estacion", "");

    include_once('helpers/Logger.php');
    
    $error = "";
    
    if(isset($_GET['enviar'])){
        $origen = $_GET['origen'];
        $destino = $_GET['destino'];
        $fechaDesde = ($_GET['fechaDesde'] != "") ? $_GET['fechaDesde'] : "%";
        $fechaHasta = ($_GET['fechaHasta'] != "") ? $_GET['fechaHasta'] : "%";
        $cantidadPasajeros = $_GET['cantidadPasajeros'];

        $logger = new Logger();
        $logger->info("Se van a realizar consultas a vuelos con los siguientes parametros: origen = $origen, destino = $destino, fechaDesde = $fechaDesde, fechaHasta = $fechaHasta");

        $circuitosRequeridos = $query->consulta("idCircuito",
                                                "circuito",
                                                "`estacionesCircuito` LIKE '%{$origen}%{$destino}%'");

        if($circuitosRequeridos == null){
            $error = "<p class='text-danger'>No disponemos de vuelos con la ruta que buscaste</p>";
        }else{

            $listaDeVuelos = null;

            foreach ($circuitosRequeridos as $circuitoRequerido) {
                $vuelos = $query->consulta("",
                                            "vuelo inner join circuito on vuelo.circuitoVuelo = circuito.idCircuito",
                                            "fechaPartida LIKE '" . $fechaDesde . "' and fechaLlegada LIKE '" . $fechaHasta . "'
                                            and circuitoVuelo = '" . $circuitoRequerido['idCircuito'] . "' ;");

                if($vuelos != null){
                    if($listaDeVuelos == null){
                        $listaDeVuelos = $vuelos;
                    } else {
                        $listaDeVuelos = array_merge($listaDeVuelos, $vuelos);
                    }
                }
            }

            if($listaDeVuelos == null){
                $error = "<p class='text-danger'>No disponemos de vuelos con la ruta que buscaste</p>";
            }
        }
        

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
            <input class="form-control col-xs-12" type="date" name="fechaDesde" id="fechaDesde">
            <label for="vuelta">Fecha hasta: </label>
            <input class="form-control col-xs-12" type="date" name="fechaHasta" id="fechaHasta">
            <label for="pasajeros">Cantidad de pasajeros: </label>
            <input class="form-control col-xs-12" type="number" name="cantidadPasajeros" id="cantidadPasajeros">
            <input id="submit-button" name="enviar" class="btn btn-success" type="submit">
            <a href="./index.php" class="btn btn-danger">Limpiar</a>
        </form>
        
    </div>
    <div class="container">
        <?php

            if($error != ""){
                echo $error;
            }else if($consultaRealizada){
                if($listaDeVuelos != null){
                    foreach ($listaDeVuelos as $vuelo) {
                        echo "
                        <div class='card text-center'>
                            <div class='card-header'>
                            Vuelo
                            </div>
                            <div class='card-body'>
                            <h5 class='card-title'>Codigo de circuito: " . $vuelo['circuitoVuelo'] . "<br>
                                                    Fecha de partida: " . $vuelo['fechaPartida'] . "<br>
                                                    Fecha de llegada: " . $vuelo['fechaLlegada'] . "<br>
                                                    Matricula de la nave: " . $vuelo['matricula'] . "
                            </h5>
                            <p class='card-text'>Datos de tu vuelo</p>
                            <a href='./reserva.php' class='btn btn-primary'>Reservar(toDO)</a>
                            </div>
                            <div class='card-footer text-muted'>
                            </div>
                        </div>
                        <div class='card-body'>
                        <h5 class='card-title'>Partida: " . $vuelo['nombreOrigen'] . ", " . $vuelo['fechaPartida'] . ";<br>
                                    Destino: " . $vuelo['nombreDestino'] .", " . $vuelo['fechaLlegada'] . "
                        </h5>
                        <p class='card-text'>Datos de tu vuelo</p>
                        ";
                        session_start();
                        if(isset($_SESSION['username'])){

                            echo "<a href='./reserva.php?origen="  . $_GET['origen']
                                                     . "&destino=" . $_GET['destino']
                                                     . "&fechaDesde=" . $_GET['fechaDesde']
                                                     . "&fechaHasta=" . $_GET['fechaHasta']
                                                     . "&cantidadPasajeros=" . $_GET['cantidadPasajeros']
                        . "' class='btn btn-primary'>Reservar(toDO)</a>
                        </div>
                        <div class='card-footer text-muted'>
                        </div>
                        </div>
                        ";
                        }

                  
                }
            }
        ?>
    </div>


</body>
</html>