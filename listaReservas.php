<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");

    session_start();

    $username = $_SESSION['username'];

    $query = new Query();

    $idTitular = $query->consulta("idUsuario",
                                    "usuario inner join credencial on usuario.numeroCredencialUsuario = credencial.idCredencial",
                                    "username = '$username'");

    $reservas = $query->consulta("*",
                    "reserva inner join acompaniante_reserva on reserva.idReserva = acompaniante_reserva.idReserva",
                    "idTitular = '" . $idTitular[0]['idUsuario'] . "'");

    foreach ($reservas as $reserva) {
        echo "<h1>Numero de reserva: " . $reserva['idReserva'] . "</h1>";
    }

?>