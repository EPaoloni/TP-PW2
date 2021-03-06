<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/login_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/usuario_modelo.php");

$error = "";
if(isset($_POST['enviar'])){

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(validarCredencialesUsuario($username, $password) != null){
            $username=$_SESSION['username'];
            asignarCodigoViajeroSiFechaTurnoExpiro($username);
            header("location: ./index.php");
            exit();
        } else {
            $error = "<p class='text-danger'>Usuario o contraseña inválidos<p>";
        }
    } else {
        $error = "<p class='text-danger'>Complete los campos<p>";
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php include("Vistas/head.html"); ?>

    <link rel="stylesheet" href="StaticContent/css/style-login.css">
</head>
<body>
    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/header.php"); ?>

    <h1 id="login-title" class="text-center">Ingrese sus datos</h1>
    
    <div id="login-container" class="container">
        <form action="login.php" method="post">
            <label for="username">Usuario: </label>
            <input class="form-control col-xs-12" type="text" name="username" id="username" required>
            <label for="password">Contraseña: </label>
            <input class="form-control col-xs-12" type="password" name="password" id="password" required>
            <input id="submit-button" name="enviar" class="btn btn-success" type="submit" value="Iniciar Sesion"> 
        </form>
        <div class="container">
            <?php echo $error; ?>
        </div>
        <div class="container">
            <a href="./registro.php" class="">¿Todavia no esta registrado? Pulse aqui</a>
        </div>
        
    </div>
    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/footer.php"); ?>
</body>
</html>