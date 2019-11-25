<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/tour_modelo.php");
    session_start();
    
    $error="";
    $origen=1;
    $destino=1;
    $listaDeTour=getListaTour();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("Vistas/head.html") ?>
</head>
<body>
    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/header.php"); ?>
    <h2 class="text-center text-success">Nuestros Tours</h2>
    <div class="container">
        <?php
            if($error != ""){
                echo $error;
            }else if($listaDeTour != null){
                    echo '<div class="card-columns mt-4">';
                    foreach ($listaDeTour as $tour) {
                        if(isset($_SESSION['username'])){
                            $redirectReserva = "./reserva.php";
                        } else {
                            $redirectReserva = "./login.php";
                        }
                        echo "
                        <div class='card text-center'>
                            <div class='card-header'>
                            Tour
                            </div>
                            <div class='card-body'>
                            <h5 class='card-title'> Numero de vuelo: " . $tour['idVuelo'] . "<br>
                                                    Codigo de circuito: " . $tour['circuitoVuelo'] . "<br>
                                                    Fecha de partida: " . $tour['fechaPartida'] . "<br>
                                                    Fecha de llegada: " . $tour['fechaLlegada'] . "<br>
                                                    Numero de la nave: " . $tour['id_nave'] . "
                            </h5>
                            <p class='card-text'>Datos de tu tour</p>
                            <form action='" . $redirectReserva . "'>
                                <label>Selecciona la cantidad de pasajeros</label>
                                <input type='number' name='cantidadPasajeros' value='1'>
                                <input type='hidden' name='origen' value='" . $origen . "'>
                                <input type='hidden' name='destino' value='" . $destino . "'>
                                <input type='hidden' name='fechaDesde' value='" . $tour['fechaPartida'] . "'>
                                <input type='hidden' name='fechaHasta' value='" . $tour['fechaLlegada'] . "'>
                                <input type='hidden' name='idVuelo' value='" . $tour['idVuelo'] . "'>
                                <input type='hidden' name='id_nave' value='" . $tour['id_nave'] . "'>
                                <input type='submit' class='btn btn-primary' value='Reservar'>
                            </form>
                            </div>
                            <div class='card-footer text-muted'>
                            </div>
                        </div>
                            ";
                    }
                    echo '</div>';
            }
        ?>
    </div>

    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/footer.php"); ?>
</body>
</html>