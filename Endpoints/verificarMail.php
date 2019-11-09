<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");

    if(isset($_GET['mail'])){
        $mail = $_GET['mail'];
    
        $query = new Query();
        $resultado = $query->consulta("idUsuario", "usuario", "mail = '$mail'");

        if($resultado != ""){
            echo true;
        } else {
            echo false;
        }
    } else {
        echo false;
    }

?>