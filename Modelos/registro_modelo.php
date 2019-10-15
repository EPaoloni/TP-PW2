<?php

    include_once("helpers/conexion.php");

    function registrarUsuario($username, $password, $nombre, $apellido){
        
        $conexion = getConexion();

        $sql = "INSERT INTO usuario(nombre, apellido)
                    VALUES( '" . $nombre . "', '" . $apellido . "');";
        $result = mysqli_query($conexion, $sql);

        mysqli_close($conexion);

        if ($result){
            $result=registrarCredencialPorUsuario($username, $password, $nombre, $apellido);
        }
        return $result;
    }

    function registrarCredencialPorUsuario($username, $password, $nombre, $apellido){
        $idUsuario= getIdUsuario($nombre, $apellido);
        $conexion = getConexion();

        $sql = "INSERT INTO credencial(username, pass,usuario)
                        VALUES('" . $username . "', '" . $password . "', '" . $idUsuario . "' );";
        $result = mysqli_query($conexion, $sql);


        mysqli_close($conexion);

        return $result;
    }

    function getIdUsuario($nombre, $apellido){

        $conexion = getConexion();

        $sql = "SELECT id FROM usuario WHERE nombre = '" . $nombre . "' AND  apellido =  '" . $apellido . "' ;";
        $result = mysqli_query($conexion, $sql);
        $idBuscada= mysqli_fetch_assoc($result);

        mysqli_close($conexion);

        return $idBuscada['id'];
    }

?>