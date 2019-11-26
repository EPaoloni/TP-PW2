<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/busqueda_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/usuario_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/turno_modelo.php");

    $error = "";
    session_start();

    if(isset($_GET['destruirSesion'])){
        destruirSesion();
    }


    $estaciones = consultarEstaciones();
    
    if(isset($_GET['enviar'])){
        $origen = $_GET['origen'];
        $destino = $_GET['destino'];
        $fechaDesde = ($_GET['fechaDesde'] != "") ? $_GET['fechaDesde'] : "%";
        $fechaHasta = ($_GET['fechaHasta'] != "") ? $_GET['fechaHasta'] : "%";
        $cantidadPasajeros = $_GET['cantidadPasajeros'];

        $circuitosRequeridos = consultarCircuitos($origen, $destino);

        if($circuitosRequeridos == null){
            $error = "<p class='text-danger'>No disponemos de vuelos con la ruta que buscaste</p>";
        }else{

            $listaDeVuelos = consultarVuelosPorCircuitos($circuitosRequeridos, $fechaDesde, $fechaHasta);

            if($listaDeVuelos == null){
                $error = "<p class='text-danger'>No disponemos de vuelos con la ruta que buscaste</p>";
            }
        }
        
        $consultaRealizada = true;

    } else {
        $consultaRealizada = false;
    }

    
    if(isset($_SESSION['reservaFallida'])){
        if($_SESSION['reservaFallida']){
            $error = '<p class="text-danger">Ha ocurrido un error con la reserva</p>';
            $_SESSION['reservaFallida'] = false;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php include("Vistas/head.html") ?>
    <script src="StaticContent/js/busqueda.js"></script>

</head>
<body>

    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/header.php"); ?>

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
            <input class="form-control col-xs-12" type="number" name="cantidadPasajeros" id="cantidadPasajeros" value="1">
            <input id="submit-button" name="enviar" class="btn btn-success mt-2" type="submit">
            <a href="./index.php" class="btn btn-danger mt-2">Limpiar</a>
        </form>
        
    </div>
    <div class="container">
        <?php
            if($error != ""){
                echo $error;
            }else if($consultaRealizada){
                if($listaDeVuelos != null){
                    echo '<div class="card-columns mt-4">';
                    foreach ($listaDeVuelos as $vuelo) {

                        if(isset($_SESSION['username'])){
                            $redirectReserva = "./reserva.php?origen="  . $origen
                            . "&destino=" . $destino
                            . "&fechaDesde=" . $vuelo['fechaPartida']
                            . "&fechaHasta=" . $vuelo['fechaLlegada']
                            . "&idVuelo="   .$vuelo['idVuelo']
                            . "&cantidadPasajeros=" . $cantidadPasajeros
                            . "&id_nave=" . $vuelo['id_nave'] . " ";
                        } else {
                            $redirectReserva = "./login.php";
                        }

                        echo "
                        <div class='card text-center'>
                            <div class='card-header'>
                            Vuelo
                            </div>
                            <div class='card-body'>
                            <h5 class='card-title'> Numero de vuelo: " . $vuelo['idVuelo'] . "<br>
                                                    Codigo de circuito: " . $vuelo['circuitoVuelo'] . "<br>
                                                    Fecha de partida: " . $vuelo['fechaPartida'] . "<br>
                                                    Fecha de llegada: " . $vuelo['fechaLlegada'] . "<br>
                                                    Numero de la nave: " . $vuelo['id_nave'] . "
                            </h5>
                            <p class='card-text'>Datos de tu vuelo</p>
                            <a href='" . $redirectReserva . "' class='btn btn-primary'>Reservar</a>
                            </div>
                            <div class='card-footer text-muted'>
                            </div>
                        </div>
                            ";
                    }
                    echo '</div>';
                }
            }
        ?>
    </div>

    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/footer.php"); ?>
</body>
</html>