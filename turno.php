<?php 
    include_once('helpers/Query.php');
    include_once('modelos/turno_modelo.php');
    session_start();
    $query = new Query();
    
    
    if(!isset($_SESSION['username'])){
        header("location: ./login.php");
        
        exit();
    } else {
        
        $username=$_SESSION['username'];
        $idUsuario= $query->consulta("idUsuario",
                                    "usuario INNER JOIN Credencial ON Usuario.numeroCredencialUsuario=Credencial.idCredencial",
                                    "Credencial.username='$username'");
        $idUsuario= $idUsuario[0]['idUsuario'];
        $turnos = $query->consulta("", "Turno INNER JOIN Usuario ON  turno.idUsuario=Usuario.idUsuario ", "Usuario.idUsuario=" . $idUsuario );
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php include("Vistas/head.html") ?>
    <script src="StaticContent/js/busqueda.js"></script>

</head>
<body>

    <?php if(isset($_SESSION['username'])){ ?>

    <a class="btn btn-danger" href="#">Cerrar sesion</a>
    <a class="btn btn-primary" href="./index.php">Ir al Inicio</a>

    <?php } else { ?>
        
    <a class="btn btn-success" href="./login.php">A login</a>
    <a class="btn btn-success" href="./registro.php">A registro</a>

    <?php }
     ?>
     <h1 class="text-center">Mis Turnos</h1>

     <div class="container">
        <?php
                if($turnos != null){
                    foreach ($turnos as $turno) {
                        echo "
                        <div class='card text-center'>
                            <div class='card-header'>
                            Turno
                            </div>
                            <div class='card-body'>
                            <h5 class='card-title'>Centro Medico: " .  getNombreCentroMedico($turno['idCentroMedico']) .  "  <br>
                                                    Fecha: " . $turno['fecha'] . "<br>
                            </h5>
                            <a href='#' class='btn btn-danger'>Cancelar</a>
                            </div>
                            ";
                        }
                    }
        ?>
    </div>        
</body>
</html>