<?php
    
    
    include_once("modelos/registro_modelo.php");

    session_start();
    $username= $_SESSION['username'];
    $idVuelo= $_GET['idvuelo'];

    $idCredencial= getIdCredencial($username);

    $query = new Query();
    $resultado = $query->insert("reserva", "(idCredencial, idVuelo)", "('$idCredencial', '$idVuelo')");

     if($resultado){
         echo "Su reserva ha sido guardada correctamente.";
     }

?>