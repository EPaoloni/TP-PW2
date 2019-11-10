<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");
    $query = new Query();
    $estaciones = $query->consulta("", "estacion", "");

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Logger.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/busqueda_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/usuario_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/turno_modelo.php");
    
    $error = "";

    session_start();

    if(isset($_GET['destruirSesion'])){
        destruirSesion();
    }
    
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

    <?php if(isset($_SESSION['username'])){ ?>

    <a class="btn btn-danger" href="./index.php?destruirSesion=true">Cerrar sesion</a>

    <?php 
            $idUsuario=getIdByUsername($_SESSION['username']);
            if(checkCodigoViajero($idUsuario)==0){
                if(tieneTurnos($idUsuario)){    ?>

    <a class="btn btn-secondary" href="./turno.php">Mi Turno</a>

    <?php } else{ ?>
    <a class="btn btn-primary" href="./solicitar-turno.php">Solicitar Turno</a>
    <?php } } } else { ?>
        
    <a class="btn btn-success" href="./login.php">A login</a>
    <a class="btn btn-success" href="./registro.php">A registro</a>
    
    <?php } ?>

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
                            <a href='" . $redirectReserva . "' class='btn btn-primary'>Reservar(toDO)</a>
                            </div>
                            <div class='card-footer text-muted'>
                            </div>
                            ";
                    }
                }
            }
        ?>
    </div>


</body>
</html>