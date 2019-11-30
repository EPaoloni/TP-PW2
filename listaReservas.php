<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");

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
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>  
    <?php include("Vistas/head.html"); ?>
</head>
<body>
    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/header.php"); ?>
    <link rel="stylesheet" href="StaticContent/css/style-table-reserva.css">

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
                    echo "<td> <span class='text-success'>Reserva Paga</span> </td>";
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