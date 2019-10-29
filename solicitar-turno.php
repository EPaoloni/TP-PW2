<?php 
    include_once('helpers/Query.php');
    include_once('modelos/turno_modelo.php');
    session_start();
    $query = new Query();
    
    if(!isset($_SESSION['username'])){
        header("location: ./login.php");
        exit();
    } else {
        $centroMedicos = $query->consulta("", "centroMedico", "");

        if(isset($_POST['enviar'])){
            $idCentroMedico = $_POST['centro-medico'];
            $fechaTurno = ($_POST['fecha-turno'] != "") ? $_POST['fecha-turno'] : "%";
            $username=$_SESSION['username'];
            $idUsuario= $query->consulta("idUsuario",
                                    "usuario INNER JOIN Credencial ON Usuario.numeroCredencialUsuario=Credencial.idCredencial",
                                    "Credencial.username='$username'");
            $idUsuario= $idUsuario[0]['idUsuario'];
            if(isset($idCentroMedico) && isset( $fechaTurno) && isset($idUsuario) ){
                $returnCrearTurno=crearTurno($idCentroMedico,$fechaTurno,$idUsuario);
                if ($returnCrearTurno === true){
                    header("location: ./mis-turnos.php");
                    exit();
                } else {
                    $error = "<p class='text-danger'>Hubo un error<p>";
                }
            } else {
                $error = "<p class='text-danger'>Campos incompletosr<p>";
            }

            
            


           
        }
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
     <h1 class="text-center">Solicitar Turno</h1>
     <div class="container">
        <form action="./solicitar-turno.php" method="POST">
            <label for="centro-medico">Origen: </label>
            <select name="centro-medico" id="centro-medico" class="form-control col-xs-12">                   
                    <?php 
                        foreach ($centroMedicos as $centroMedico) {
                        echo "<option value='" . $centroMedico['idCentroMedico'] . "'>" . $centroMedico['nombreCentroMedico'] . "</option>";
                    }?>

            </select>
            <label for="fecha-turno">Fecha </label>
            <input class="form-control col-xs-12" type="date" name="fecha-turno" id="fecha-turno">
            <input id="submit-button" name="enviar" class="btn btn-success" type="submit">
            <a href="./solicitar-turno.php" class="btn btn-danger">Limpiar</a>
            <?php echo $error; ?> 
</body>
</html>