<?php 
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/turno_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/usuario_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Logger.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/busqueda_modelo.php");
    session_start();
    $query = new Query();
    $log = new Logger();
    
    if(!isset($_SESSION['username'])){
        header("location: ./login.php");
        exit();
    } else {
        $username=$_SESSION['username'];                           
        $idUsuario= getIdByUsername($username);
        
        if(checkCodigoViajero($idUsuario)==0){
            $turnos = consultarTurnoPorUsuario($idUsuario);
        
            if(isset($_POST['enviar'])){
                $cancelar = isset($_POST['cancelar']) ? $_POST['cancelar'] : false ;
                if($cancelar){
                    eliminarTurno($idUsuario);
                    $log->info("Se elimino el turno para el usuario $idUsuario");
                    header("Refresh:0");
                    exit();
                }
            }
        }else {
            header("location: ./index.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("Vistas/head.html") ?>
</head>
<body>

    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/header.php"); ?>
    
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
                            <h5 class='card-title'>Centro Medico: " .  $turno['nombreCentroMedico'].  "  <br>
                                                    Fecha: " . $turno['fecha'] . "<br>
                                                    Hora: " . $turno['hora'] . "<br>
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