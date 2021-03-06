<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/reserva_modelo.php");

    session_start();

    $idVuelo = $_GET['idVuelo'];
    $idOrigen = $_GET['idOrigen'];
    $idDestino = $_GET['idDestino'];
    $montoReserva = $_GET['montoReserva'];
    $idCabina = $_GET['idCabina'];
    $mailUsuarios = [];
    $acompaniantes = [];
    if(isset($_GET['mailsUsuarios'])){
        array_push($mailUsuarios, $_GET['mailsUsuarios']);
    }
    foreach ($mailUsuarios as $mailUsuario) {
        $acompaniantes[] = consultarIdUsuarioConMail($mailUsuario[1]);
    }
    $titular = consultarIdUsuarioConMail($_SESSION['emailUsuario']);
    
    $resultado = guardarReserva($idVuelo, $idOrigen, $idDestino, $titular, $acompaniantes, $montoReserva, $idCabina);
    
    if($resultado){
        header('location: /TP-PW2/listaReservas.php');
    } else {
        $_SESSION['reservaFallida'] = true;
        header('location: /TP-PW2/');
    }

    function consultarIdUsuarioConMail($mail){
        $query = new Query();
        $idUsuario = $query->consulta("idUsuario", "usuario", "mail = '$mail'");
        return $idUsuario;
    }

?>