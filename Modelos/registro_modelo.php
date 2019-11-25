<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/conexion.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/login_modelo.php");

    function registrarUsuario($username, $password, $nombre, $apellido,$mail){
        
        if(usuarioExiste($username)){
            return "Usuario Existente";
        }
        $password=md5($password);
        $result=registrarCredencial($username, $password);
        
        if ($result){
        	$idCredencial=getIdCredencial($username);

            $query = new Query();
            $resultado = $query->insert("usuario", "(nombreUsuario, apellidoUsuario, numeroCredencialUsuario,mail)", "('$nombre', '$apellido', '$idCredencial', '$mail')");
            if($resultado){
                return $resultado;
            } else {
                // borrarCredencial($idCredencial);
            }
            
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
        $resultado = $query->consulta("idCredencial", "Credencial", "username = '$username'");

        return $resultado[0]['idCredencial'];
    }

    function usuarioExiste($username){
        
        $query = new Query();
        $resultado = $query->consulta("usuario.idUsuario", "usuario INNER JOIN credencial ON Usuario.numeroCredencialUsuario=Credencial.idCredencial", "username = '$username'");
        if($resultado == null){
            return false;
        } else {
            return true;
        }
    }
    // function borrarCredencial($idCredencial){
        
    //     $query = new Query();
    //     $resultado = $query->delete("credencial", "idCredencial='$idCredencial'");
    //     if($resultado == null){
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }

    function registrarUsuarioSinCredencial($nombre, $apellido,$mail){
         if(emailExiste($mail)){
            return "Ya existe mail";
         } else {
            $query = new Query();
            $resultado = $query->insert("usuario", "(nombreUsuario, apellidoUsuario,mail)", "('$nombre', '$apellido','$mail')");
            return $resultado;
        }
     }
     function emailExiste($mail){
        $query = new Query();
        $resultado = $query->consulta("", "usuario", "mail='$mail'");
        return $resultado;
    }

    

?>