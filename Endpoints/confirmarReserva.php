<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/reserva_modelo.php");

    session_start();

    $idVuelo = $_GET['idVuelo'];
    $mailUsuarios = [];
    $acompaniantes = [];
    if(isset($_GET['mailsUsuarios'])){
        array_push($mailUsuarios, $_GET['mailsUsuarios']);
    }
    foreach ($mailUsuarios as $mailUsuario) {
        $acompaniantes[] = consultarIdUsuarioConMail($mailUsuario[1]);
    }
    $titular = consultarIdUsuarioConMail($_SESSION['emailUsuario']);
    
    $resultado = guardarReserva($idVuelo, $titular, $acompaniantes);
    
    echo $resultado;

    function consultarIdUsuarioConMail($mail){
        $query = new Query();
        $idUsuario = $query->consulta("idUsuario", "usuario", "mail = '$mail'");
        return $idUsuario;
    }

?>