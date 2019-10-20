<?php

    include_once("helpers/conexion.php");

    function validarCredencialesUsuario($username, $password){
        
        $conexion = getConexion();

        $sql = "SELECT usuario.id FROM usuario INNER JOIN Credencial ON  Usuario.credencial=Credencial.id WHERE username = '" . $username . "' and pass = '" . $password . "' ;";
        $result = mysqli_query($conexion, $sql);

        $affectedRows = mysqli_affected_rows($conexion);

        $usuarioCorrecto = ($affectedRows > 0) ? true : false;

        mysqli_close($conexion);

        return $usuarioCorrecto;
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