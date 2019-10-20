<?php

    include_once("helpers/conexion.php");
    include_once("Modelos/login_modelo.php");

    function registrarUsuario($username, $password, $nombre, $apellido){

        if(usuarioExiste($username)){
            return "Usuario Existente";
        }
        $result=registrarCredencial($username, $password);
        if ($result){
        	$idCredencial=getIdCredencial($username);

            $conexion = getConexion();

        	$sql = "INSERT INTO usuario(nombre, apellido,credencial)
                    VALUES( '" . $nombre . "', '" . $apellido . "', '" . $idCredencial . "'  );";
        	$result = mysqli_query($conexion, $sql);

        	mysqli_close($conexion);

        } else {
        	$result=false;
        	echo "<h2> Fallo el registro</h2>";
        }
        

        
        return $result;
    }

    function registrarCredencial($username, $password){
        $conexion = getConexion();

        $sql = "INSERT INTO credencial(username, pass)
                        VALUES('" . $username . "', '" . $password . "');";
        $result = mysqli_query($conexion, $sql);


        mysqli_close($conexion);

        return $result;
    }

    function getIdCredencial($username){

        $conexion = getConexion();

        $sql = "SELECT id FROM Credencial WHERE username = '" . $username . "' ;";
        $result = mysqli_query($conexion, $sql);
        $idBuscada= mysqli_fetch_assoc($result);

        mysqli_close($conexion);

        return $idBuscada['id'];
    }

?>