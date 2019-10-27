<?php

    include_once("helpers/conexion.php");
    include_once("helpers/Query.php");

    function validarCredencialesUsuario($username, $password){
        
        $query = new Query();
        $resultado = $query->consulta("usuario.idUsuario", "usuario INNER JOIN Credencial ON Usuario.numeroCredencialUsuario=Credencial.idCredencial",
                                                    "username = '$username' and pass = '$password'");
        if($resultado>0){
            
            session_start();
            $_SESSION['username'] = $username;
        }
        return $resultado;
    }

?>