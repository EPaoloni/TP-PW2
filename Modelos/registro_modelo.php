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

            $query = new Query();
            $resultado = $query->insert("usuario", "(nombre, apellido, credencial)", "('$nombre', '$apellido', '$idCredencial')");
            
            return $resultado;
        } else {
        	echo "<h2> Fallo el registro</h2>";
        }
        

        
        return $result;
    }

    function registrarCredencial($username, $password){
        
        
        $query = new Query();
        $resultado = $query->insert("credencial", "(username, pass)", "('$username', '$password')");

        return $resultado;
    }

    function getIdCredencial($username){

        $query = new Query();
        $resultado = $query->consulta("credencial.id", "Credencial", "username = '$username'");

        return $resultado['id'];
    }

    function usuarioExiste($username){
        
        $query = new Query();
        $resultado = $query->consulta("usuario.id", "usuario INNER JOIN credencial ON Usuario.credencial=Credencial.id", "username = '$username'");

        if($resultado == null){
            return false;
        } else {
            return true;
        }
    }

?>