<?php

    include_once("helpers/conexion.php");

    function validarCredencialesUsuario($username, $password){
        
        $conexion = getConexion();

        $sql = "SELECT id FROM usuario WHERE username = '" . $username . "' and pass = '" . $password . "' ;";
        $result = mysqli_query($conexion, $sql);

        $idUsuario = mysqli_fetch_assoc($result);

        mysqli_close($conexion);

        return $idUsuario;
    }

    function usuarioExiste($username){
        
        $conexion = getConexion();
        
        $sql = "SELECT id FROM usuario WHERE username = '" . $username . "' ;";
        $result = mysqli_query($conexion, $sql);

        $idUsuario = mysqli_fetch_assoc($result);

        $usuarioExiste = ($idUsuario != null) ? true : false;

        return $usuarioExiste;
    }

?>