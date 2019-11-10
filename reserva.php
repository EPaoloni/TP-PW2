<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/modelos/registro_modelo.php");

    session_start();
    $username= $_SESSION['username'];
    $idOrigen = $_GET['origen'];
    $idDestino = $_GET['destino'];
    $fechaDesde = $_GET['fechaDesde'];
    $fechaHasta = $_GET['fechaHasta'];
    $idVuelo= $_GET['idVuelo'];
    $idNave= $_GET['id_nave'];
    $cantidadPasajeros = $_GET['cantidadPasajeros'];

    $query = new Query();
    $result = $query->consulta("nombreEstacion", "estacion", "idEstacion = '$idOrigen'");
    $nombreOrigen = $result[0]['nombreEstacion'];
    $result = $query->consulta("nombreEstacion", "estacion", "idEstacion = '$idDestino'");
    $nombreDestino = $result[0]['nombreEstacion'];
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php include("Vistas/head.html") ?>
    <script src="StaticContent/js/reserva.js"></script>

</head>
<body>

    <div class="container">
        <form id="form-confirmar-reserva" action="./Endpoints/confirmarReserva.php" method="get">
            <h3>Numero de vuelo: <?php echo $idVuelo; ?></h3>
            <h3>Fecha de partida: <?php echo $fechaDesde ;?></h3>
            <h3>Origen: <?php echo $nombreOrigen ;?></h3>
            <h3>Destino: <?php echo $nombreDestino ;?></h3>
            <h3>Id de la nave: <?php echo $idNave;?></h3>
            <?php
            for ($i=1; $i < $cantidadPasajeros; $i++) { 
                echo '<input type="hidden" class="hidden-mail-usuario" id="hidden-mail-usuario" name="mailsUsuarios[' . $i . ']" value="">';
            }
            echo '<input type="hidden" name="idVuelo" value="' . $idVuelo .'">';
            echo '<input type="hidden" name="idOrigen" value="' . $idOrigen .'">';
            echo '<input type="hidden" name="idDestino" value="' . $idDestino .'">';
            ?>
            <br><br>
        </form>

        <h2>Datos de los acompañantes</h2>
        <div class="container row">
            <?php for ($i=1; $i < $cantidadPasajeros; $i++) { 
                echo '

                <div class="col-xs-4">
                    <label for="">Nombre del pasajero ' . $i . ':</label>
                    <input class="form-control nombre" type="text" id="nombre' . $i .'" name="nombre" required>
                    <label for="">Apellido del pasajero ' . $i . ':</label>
                    <input class="form-control apellido" type="text" id="apellido' . $i .'" name="apellido" required>
                    <label for="">Mail del pasajero ' . $i . ':</label>
                    <input class="form-control mail" type="text" id="mail' . $i .'" name="mail" required>
                    <label id="label-username-' . $i . '" for="" style="display: none;" >Username ' . $i . ':</label>
                    <input class="form-control username" type="text" id="username-' . $i . '" name="username" style="display: none;" required>
                    <p class="text-danger usuario-no-existente" id="usuario-no-existente' . $i . '" style="display: none;">El usuario no existe, debe crearlo</p>
                    <p class="text-danger error-crear-usuario" id="error-crear-usuario-' . $i . '" style="display: none;">Ocurrio un error al crear el usuario</p>
                    <p class="text-success usuario-creado" id="usuario-creado' . $i . '" style="display: none;">El usuario ha sido creado</p>
                    <button class="btn btn-success boton-crear-usuario" id="boton-crear-usuario' . $i . '" style="display: none;">Crear usuario</button>
                    <input type="hidden" class="posicion-usuario" value="' . $i . '">
                </div>    
                    ';
                    
                }
            ?>
        </div>

        <button id="confirmar-reserva" class="btn btn-primary">Confirmar Reserva</button>
    </div>

</body>
</html>