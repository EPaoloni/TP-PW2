<?php

    include_once("helpers/conexion.php");
    include_once("Modelos/login_modelo.php");

    function registrarUsuario($username, $password, $nombre, $apellido){

        if(usuarioExiste($username)){
            return "Usuario Existente";
        }
        
        $conexion = getConexion();

        $sql = "INSERT INTO usuario(username, pass, nombre, apellido)
                    VALUES('" . $username . "', '" . $password . "', '" . $nombre . "', '" . $apellido . "');";
        $result = mysqli_query($conexion, $sql);


        mysqli_close($conexion);
        return $result;
    }

?>