<?php

    session_start();
    $username= $_SESSION['username'];
    $origen = $_GET['origen'];
    $destino = $_GET['destino'];
    $fechaDesde = $_GET['fechaDesde'];
    $fechaHasta = $_GET['fechaHasta'];
    $idVuelo= $_GET['idVuelo'];
    $cantidadPasajeros = $_GET['cantidadPasajeros'];

    //TODO: Traer el nombre de la estacion origen y destino




    ?>

    <div class="container">
        <form id="form-confirmar-reserva" action="" method="post">
            <h3>Numero de vuelo: <?php echo $idVuelo; ?></h3>
            <h3>Fecha de partida: <?php echo $fechaDesde ;?></h3>
            <h3>Origen: <?php echo $origen ;?></h3>
            <h3>Matricula: <?php //Poner matricula?></h3>
            <?php for ($i=0; $i < $cantidadPasajeros - 1; $i++) { 
                echo '
                <form action="">
                    <label for="">Nombre</label>
                    <input type="text">
                    <label for="">Apellido</label>
                    <input type="text">
                    <label for="">Mail</label>
                    <input type="text" class="mail">
                </form>  ';
            }
            ?>
        </form>

        <button id="confirmar-reserva">Confirmar</button>
    </div> 