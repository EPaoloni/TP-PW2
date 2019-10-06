<?php



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
        <form action="" method="post">
            <label for="username">Usuario: </label>
            <input class="form-control col-xs-12" type="text" name="username" id="username">
            <label for="password">Contraseña: </label>
            <input class="form-control col-xs-12" type="password" name="password" id="password">
            <input id="submit-button" class="btn btn-success float-right" type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>