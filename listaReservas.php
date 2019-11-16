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
?>

<!DOCTYPE html>
<html lang="en">
<head>  
    <?php include("Vistas/head.html"); ?>
</head>
<body>


<?php
    foreach ($reservas as $reserva) {
        echo "<div class='container row>'";
        echo "<h1>Numero de reserva: " . $reserva['idReserva'] . "</h1>";
        if($idTitular[0]['idUsuario'] == $reserva['idTitular']){
            echo "<a class='btn btn-primary' href='realizarPago.php?idReserva=" . $reserva['idReserva'] . "'>Pagar</a>";
        }
        echo "</div>";
    }

?>    


</body>
</html>