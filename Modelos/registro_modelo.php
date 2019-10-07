<?php

    include_once("helpers/conexion.php");

    function registrarUsuario($username, $password, $nombre, $apellido){
        
        $conexion = getConexion();

        $sql = "INSERT INTO usuario(username, pass, nombre, apellido)
                    VALUES('" . $username . "', '" . $password . "', '" . $nombre . "', '" . $apellido . "');";
        $result = mysqli_query($conexion, $sql);

        mysqli_close($conexion);
        return $result;
    }

?>