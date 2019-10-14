<?php

    include_once("helpers/validaciones.php");
//TODO: Las validaciones no estan funcionando, toma como que siempre estan seteadas
$error = "";
if(!isset($_POST['enviar'])){

} else {

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(usuarioValido($username, $password)){
            header("location: Vistas/welcome.html");
        } else { 
            // Log del error
            date_default_timezone_set("America/Argentina/Buenos_Aires");
            file_put_contents("./logs/app.log", date('d/M/Y - H:i:s') . " - Fallo en el login con el usuario: $username\n", FILE_APPEND);
            
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