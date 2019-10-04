<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>

    <script src="../StaticContent/jquery-3.4.1.min.js"></script>
    <script src="../StaticContent/bootstrap-4.3.1-dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="../StaticContent/bootstrap-4.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../StaticContent/css/style-login.css">
</head>
<body>
    <h1 id="login-title" class="text-center">Formulario de registro</h1>
    <div id="login-container" class="container">
        <form action="" method="post">
            <label for="username">Usuario: </label>
            <input class="form-control col-xs-12" type="text" name="username" id="username">
            <label for="password">Contraseña: </label>
            <input class="form-control col-xs-12" type="password" name="password" id="password">
            <label for="password">Repita su contraseña: </label>
            <input class="form-control col-xs-12" type="password-repetido" id="password-repetido">
            <input id="submit-button" class="btn btn-success float-right" type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>