<?php
    include_once("helpers/conexion.php");

    function usuarioValido($username, $password){
        
        $conexion = getConexion();

        $sql = "SELECT usuario.id FROM usuario INNER JOIN Credencial ON  Usuario.id=Credencial.usuario WHERE username = '" . $username . "' and pass = '" . $password . "' ;";
        $result = mysqli_query($conexion, $sql);

        $affectedRows = mysqli_affected_rows($conexion);

        $usuarioCorrecto = ($affectedRows > 0) ? true : false;

        mysqli_close($conexion);

        return $usuarioCorrecto;
    }

?>