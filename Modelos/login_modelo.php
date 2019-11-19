<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/conexion.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Logger.php");

    function validarCredencialesUsuario($username, $password){
        
        $query = new Query();
        $resultado = $query->consulta("usuario.idUsuario, usuario.mail", "usuario INNER JOIN Credencial ON Usuario.numeroCredencialUsuario=Credencial.idCredencial",
                                                    "username = '$username' and pass = '$password'");
        if($resultado>0){
            session_start();
            //TODO: cargar en sesion todo el usuario
            $_SESSION['username'] = $username;
            $_SESSION['emailUsuario'] = $resultado[0]['mail'];
        } else {
            // Log del error
            $log = new Logger();
            $log->warning("Fallo en el login con el usuario: $username");
        }

        return $resultado;
    }

?>