<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/registro_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Logger.php");

    session_start();

    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $mail = $_GET['mail'];
    $username = $_GET['username'];

    $logger = new Logger();
    
    // Le generamos un password al azar
    $password = '1234';

    $resultado = registrarUsuario($username, '1234', $nombre, $apellido, $mail);
    if($resultado){
        echo true;
    } else {
        $logger->error("Se ha intentado crear un usuario desde la reserva con los datos: '$nombre', '$apellido', '$mail', '$username'. El resultado devolvio: '$resultado'.");
        echo $resultado;
    }


?>