<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/busqueda_modelo.php");

    session_start();

    $username = $_SESSION['username'];

    $query = new Query();

    $idTitular = $query->consulta("idUsuario",
                                    "usuario inner join credencial on usuario.numeroCredencialUsuario = credencial.idCredencial",
                                    "username = '$username'");

    //TODO: Consultar si el usuario es acompañante de una reserva
    $reservas = $query->consulta("*",
                    "reserva",
                    "idTitular = '" . $idTitular[0]['idUsuario'] . "'");


    $error = "";

    if(isset($_SESSION['errorCodigoDeViajero'])){
        $error = $_SESSION['errorCodigoDeViajero'];
        unset($_SESSION['errorCodigoDeViajero']);
    }
    if(isset($_SESSION['errorCheckin'])){
        $error = $_SESSION['errorCheckin'];
        unset($_SESSION['errorCheckin']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>  
    <?php include("Vistas/head.html"); ?>
    <link rel="stylesheet" href="StaticContent/css/style-table-reserva.css">
</head>
<body>
    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/header.php"); ?>

<div class="container">
    <p class="text-danger"><?php echo $error; ?></p>
</div>

        
<?php
    if($reservas != null){
       echo "<table class='table table-bordered'>
                <thead class='thead-light'>
                    <tr>
                        <th>Número</th>
                        <th>Estado</th>
                    </tr>
                </thead>";
        foreach ($reservas as $reserva) {
            // echo "<div class='container row>'";
            echo  "<tbody><td>". $reserva['idReserva'] . "</td>";
            if($idTitular[0]['idUsuario'] == $reserva['idTitular']){
                if($reserva['reservaPaga']){
                    $vuelo = consultarVueloPorId($reserva['idVuelo']);
                    $fechaActual = date('Y-m-d H:i:s');
                    $fechaInicioCheckin = date("Y-m-d H:i:s", strtotime('-48 hour', strtotime($vuelo['fechaPartida'])));
                    $fechaFinCheckin = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($vuelo['fechaPartida'])));
                    if($fechaActual > $fechaInicioCheckin && $fechaActual < $fechaFinCheckin){
                        echo "<td><a class='btn btn-primary' href='checkin.php?numeroReserva=" . $reserva['idReserva'] . "'>Checkin</a></td>";
                    } else {
                        echo "<td> <span class='text-success'>Reserva Paga</span> </td>";
                    }
                } else  if($reserva['reservaCaida']){
                    echo "<td> <span class='text-danger'>Reserva caida por codigo de viajero</span> </td>";
                } else{
                    echo "<td><a class='btn btn-primary' href='vistaPago.php?idReserva=" . $reserva['idReserva'] . "'>Pagar</a></td>";
                }
            }
            
        }
        echo "</div>";
            echo "</tbody></table>";
    }else{
        echo "<h4>No tenés reservas realizadas</h1>";
    }
?>    
    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/footer.php"); ?>
</body>
</html>