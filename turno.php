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
        if(isset($_POST['enviar'])){
            $cancelar = isset($_POST['cancelar']) ? $_POST['cancelar'] : false ;
            if($cancelar){
                eliminarTurno($idUsuario);
                header("Refresh:0");
                exit();
            }
        }

        
        $turnos = $query->consulta("", "Turno INNER JOIN Usuario ON  turno.idUsuario=Usuario.idUsuario ", "Usuario.idUsuario=" . $idUsuario );
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("Vistas/head.html") ?>
</head>
<body>

    <a class="btn btn-danger" href="#">Cerrar sesion</a>
    <a class="btn btn-primary" href="./index.php">Ir al Inicio</a>
    
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
                            <form action='./turno.php' method='POST'>
                                <input type=hidden name='cancelar' value='true'>
                                <input id='submit-button' name='enviar' class='btn btn-danger' type='submit' value='Cancelar'>
                            </form>
                            </div>
                            ";
                        }
                    } else {
                        echo " <h5> Al parecer no tiene ningun turno asigando </h5>
                            <a href='solicitar-turno.php' class='btn btn-danger'>Presione aqui para solicitar turno</a>";
                    }
                    
        ?>
    </div>        
</body>
</html>