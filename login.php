<?php

    include_once("Modelos/login_modelo.php");
    include_once("helpers/Logger.php");

$error = "";
if(!isset($_POST['enviar'])){

} else {

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(validarCredencialesUsuario($username, $password) != null){
            header("location: Vistas/welcome.html");
        } else { 
            // Log del error
            $log = new Logger();
            $log->warning("Fallo en el login con el usuario: $username");
            
            $error = "<p class='text-danger'>Usuario o contraseña inválidos<p>";
        };
    } else {
        $error = "<p class='text-danger'>Complete los campos<p>";
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php include("Vistas/header.html"); ?>

    <link rel="stylesheet" href="StaticContent/css/style-login.css">
</head>
<body>
    <h1 id="login-title" class="text-center">Ingrese sus datos</h1>
    
    <div id="login-container" class="container">
        <form action="login.php" method="post">
            <label for="username">Usuario: </label>
            <input class="form-control col-xs-12" type="text" name="username" id="username" required>
            <label for="password">Contraseña: </label>
            <input class="form-control col-xs-12" type="password" name="password" id="password" required>
            <input id="submit-button" name="enviar" class="btn btn-success float-right" type="submit">
        </form>
        <?php echo $error; ?>
    </div>
</body>
</html>