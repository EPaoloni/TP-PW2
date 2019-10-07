<?php

include_once("helpers/validaciones.php");
include_once("modelos/registro_modelo.php");
//TODO: Las validaciones no estan funcionando, toma como que siempre estan seteadas
$error = "";
if(!isset($_POST['enviar'])){

} else {

    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['nombre']) && isset($_POST['apellido'])
                && isset($_POST['password-repetido'])){
        if($_POST['password'] === $_POST['password-repetido']){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];

            if(registrarUsuario($username, $password, $nombre, $apellido)){
                header("location: login.php");
            }

        } else {
            $error = "<p class='text-danger'>Las contraseñas no coinciden<p>";
        }
    } else {
        $error = "<p class='text-danger'>Complete los campos<p>";
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php include("Vistas/header.html"); ?>

</head>
<body>
    <h1 id="login-title" class="text-center">Formulario de registro</h1>
    <div id="login-container" class="container">
        <form action="registro.php" method="post">
            <label for="nombre">Nombre: </label>
            <input class="form-control col-xs-12" type="text" name="nombre" id="nombre" required>
            <label for="apellido">Apellido: </label>
            <input class="form-control col-xs-12" type="text" name="apellido" id="apellido" required>
            <label for="username">Nombre de Usuario: </label>
            <input class="form-control col-xs-12" type="text" name="username" id="username" required>
            <label for="password">Contraseña: </label>
            <input class="form-control col-xs-12" type="password" name="password" id="password" required>
            <label for="password">Repita su contraseña: </label>
            <input class="form-control col-xs-12" type="password" name="password-repetido" id="password-repetido" required>
            <input id="submit-button" name="enviar" class="btn btn-success float-right" type="submit">
        </form>
        <?php echo $error; ?>
    </div>
</body>
</html>