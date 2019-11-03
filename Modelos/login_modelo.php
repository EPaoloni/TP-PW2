<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/conexion.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");

    function validarCredencialesUsuario($username, $password){
        
        $query = new Query();
        $resultado = $query->consulta("usuario.idUsuario, usuario.mail", "usuario INNER JOIN Credencial ON Usuario.numeroCredencialUsuario=Credencial.idCredencial",
                                                    "username = '$username' and pass = '$password'");
        if($resultado>0){
            
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['emailUsuario'] = $resultado[0]['mail'];
        }
        return $resultado;
    }

?>