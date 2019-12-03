<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/modelos/registro_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/modelos/disponibilidad_modelo.php");

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
    $result = $query->consulta("modelo",
                                "vuelo INNER JOIN naves ON vuelo.id_nave = naves.id",
                                "idVuelo = '$idVuelo'");
    $modeloNave = $result[0]['modelo'];
    $cabinasNave = $query->consulta("idCabina, nombreCabina",
                                "cabinas INNER JOIN modeloNave_cabinas ON idCabina = tipoCabina",
                                "modeloNave_cabinas.modeloNave = '$modeloNave'" );
    $preciosCabinas = $query->consulta("idCabina, precio",
                                        "precioCabina", "");

    $error = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php include("Vistas/head.html") ?>
    <link rel="stylesheet" href="StaticContent/css/style-reserva.css">
    <script src="StaticContent/js/reserva.js"></script>


</head>
<body>
    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/header.php"); ?>

    
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <h2 class="text-success">Haz tu reserva</h2>
            </div>
            <div class="w-100"></div>
            <form id="form-confirmar-reserva" action="./Endpoints/confirmarReserva.php" method="get">
                <div>
                    <h3 class="text-secondary ">Numero de vuelo:</h3><h3 class="text-info"> <?php echo $idVuelo; ?></h3>
                </div>
                <div>
                    <h3 class="text-secondary ">Fecha de partida:</h3><h3 class="text-info"> <?php echo $fechaDesde ;?></h3>
                </div>
                    <h3 class="text-secondary ">Origen:</h3><h3 class="text-info"> <?php echo $nombreOrigen ;?></h3>
                <div>
                    <h3 class="text-secondary ">Destino:</h3><h3 class="text-info"> <?php echo $nombreDestino ;?></h3>
                </div>
                <div class="">
                    <h3 class="text-secondary ">Id de la nave:</h3><h3 class="text-info"> <?php echo $idNave;?></h3>
                </div>
                <div class="mt-4 mb-2">
                    <select class="custom-select" name="idCabina" id="select-cabina">
                        <?php
                            $hayLugarEnElVuelo = false;
                            foreach ($cabinasNave as $cabina) {
                                $cantidadLugaresDisponibles = consultarCantidadLugaresDisponiblesCabina($cabina['idCabina'], $idVuelo, $idOrigen, $idDestino);
                                if($cantidadLugaresDisponibles >= $cantidadPasajeros + 1){
                                    echo "<option value='" . $cabina['idCabina'] . "' name='tipoCabina' class='form-control' >" . $cabina['nombreCabina'] . "</option>";
                                    $hayLugarEnElVuelo = true;
                                } else {
                                    echo "<option value='" . $cabina['idCabina'] . "' name='tipoCabina' class='form-control' disabled>" . $cabina['nombreCabina'] . "</option>";
                                }
                            }
                            if(!$hayLugarEnElVuelo){
                                $error = "<h5 class='text-danger'>No tenemos disponibilidad para ninguna cabina en el vuelo seleccionado</h5>";
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <h3 class="text-secondary">Precio total: <input id="precio-total" class="form-control-plaintext text-info" name="montoReserva" readonly></h3>
                </div>

                <?php
                for ($i=1; $i < $cantidadPasajeros; $i++) { 
                    echo '<input type="hidden" class="hidden-mail-usuario" id="hidden-mail-usuario" name="mailsUsuarios[' . $i . ']" value="">';
                }
                echo '<input type="hidden" name="idVuelo" value="' . $idVuelo .'">';
                echo '<input type="hidden" name="idOrigen" value="' . $idOrigen .'">';
                echo '<input type="hidden" name="idDestino" value="' . $idDestino .'">';
                foreach ($preciosCabinas as $precioCabina) {
                    echo '<input type="hidden" id="precio-cabina-' . $precioCabina['idCabina'] . '" value="' . $precioCabina['precio'] .'">';
                }
                ?>
                <br><br>
            </form>
            <div class="w-100"></div>
            <?php   if($cantidadPasajeros>1){ ?>
                <h2 class="text-primary">Datos de los acompañantes</h2>
            <?php } ?>
            <div class="container row justify-content-center">
                <?php for ($i=1; $i < $cantidadPasajeros; $i++) { 
                    echo '

                    <div class="col-xs-4 mr-2 ml-2 mb-4">
                        <label for="" class="text-secondary">Nombre del pasajero ' . $i . ':</label>
                        <input class="form-control nombre" type="text" id="nombre' . $i .'" name="nombre" required>
                        <label for="" class="text-secondary">Apellido del pasajero ' . $i . ':</label>
                        <input class="form-control apellido" type="text" id="apellido' . $i .'" name="apellido" required>
                        <label for="" class="text-secondary">Mail del pasajero ' . $i . ':</label>
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
            
            <button id="confirmar-reserva" class="btn btn-primary m-2">Confirmar Reserva</button>
            <?php echo $error; ?>
        </div>
    </div>
    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/footer.php"); ?>
</body>
</html>