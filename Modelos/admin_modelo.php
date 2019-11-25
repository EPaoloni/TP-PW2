<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Logger.php");

    consultarPagosRegistrados();
    
    function checkIsAdmin(){
        session_start();
        $isAdmin = $_SESSION['isAdmin'];
        if(!$isAdmin){
            header("./index.php");
            exit;
        }
    }

    //Test OK
    function consultarPagosRegistrados(){
        $query = new Query();
        $result = $query->consulta("*", "pago INNER JOIN reserva ON pago.numeroReserva = reserva.idReserva", "");

        return $result;
    }

?>