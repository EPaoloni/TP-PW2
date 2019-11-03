<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/modelos/registro_modelo.php");

    session_start();
    $username= $_SESSION['username'];
    $origen = $_GET['origen'];
    $destino = $_GET['destino'];
    $fechaDesde = $_GET['fechaDesde'];
    $fechaHasta = $_GET['fechaHasta'];
    $idVuelo= $_GET['idVuelo'];
    $idNave= $_GET['id_nave'];
    $cantidadPasajeros = $_GET['cantidadPasajeros'];

    if(isset($_POST['enviar'])){
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $mail=$_POST['mail'];

        echo $mail . $apellido . $nombre;
    }

    //TODO: Traer el nombre de la estacion origen y destino




    ?>

    <div class="container">
        <form id="form-confirmar-reserva" action="reserva.php" method="post">
            <h3>Numero de vuelo: <?php echo $idVuelo; ?></h3>
            <h3>Fecha de partida: <?php echo $fechaDesde ;?></h3>
            <h3>Origen: <?php echo $origen ;?></h3>
            <h3>Id de la nave: <?php echo $idNave;?></h3>
            <br><br>

            <h2>Datos de los pasajeros</h2>
            <?php for ($i=0; $i < $cantidadPasajeros - 1; $i++) { 
                echo '

                <div class="container">
                    <label for="">Nombre del pasajero '. ($i+1) . ':</label>
                    <input type="text" name="nombre" required>
                    <label for="">Apellido del pasajero '. ($i+1) . ':</label>
                    <input type="text" name="apellido" required>
                    <label for="">Mail del pasajero '. ($i+1) . ':</label>
                    <input type="text" name="mail" class="mail" required>
                </div>    
                    ';
                     
                }
            echo "<a href='reserva_modelo.php?idvuelo=$idVuelo' class='btn btn-primary'>Guardar reserva</a>";
            //echo '<input type="hidden" name="cantidadDeUsuarioNoRegistrado" value="' . $i .'">';
            ?>
        
        </form>

        
    </div> 