<?php 
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/turno_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/usuario_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/busqueda_modelo.php");
    
    session_start();
    $error="";
    

    if(isset($_SESSION['username'])){
        $idUsuario= getIdByUsername($_SESSION['username']);
        if(puedeSolicitarTurno($idUsuario)){
            $centroMedicos = consultarCentrosMedicos();
                
            if(isset($_POST['enviar'])){

                $idCentroMedico = $_POST['centro-medico'];
                $fechaTurno = ($_POST['fecha-turno'] != "") ? $_POST['fecha-turno'] : null;
                $idHorario = isset($_POST['horario']) ? $_POST['horario'] : null;
                
                if(isset($idCentroMedico) && isset( $fechaTurno) && isset($idUsuario) && isset($idHorario)  ){
                    $returnCrearTurno=crearTurno($idCentroMedico,$fechaTurno,$idUsuario,$idHorario);
                    if ($returnCrearTurno == true){
                        header("location: ./turno.php");
                        exit();
                    } else if(isset($returnCrearTurno[1])) {
                        $error = "<p class='text-danger'>" . $returnCrearTurno[1] . "<p>";
                    }
                } else {
                    $error = "<p class='text-danger'>Campos incompletos<p>";  
                }
            }
        }
    } else {
        header("location: ./turno.php");
        exit();
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("Vistas/head.html") ?>
    <script src="StaticContent/js/turno.js"></script>
</head>
<body>
    <a class="btn btn-danger" href="./index.php?destruirSesion=true">Cerrar sesion</a>
    <a class="btn btn-primary" href="./index.php">Ir al Inicio</a>

     <h1 class="text-center">Solicitar Turno</h1>
     <div class="container">
        <form action="./solicitar-turno.php" method="POST">
            <label for="fecha-turno">Elija una Fecha </label>
            <input class="form-control col-xs-12" type="date" name="fecha-turno" id="fecha-turno" >
            <label for="centro-medico">Elija un Centro Medico: </label>
            <select name="centro-medico" id="centro-medico" class="form-control col-xs-12" placeholder="Elija un centro">
                    <?php 
                        foreach ($centroMedicos as $centroMedico) {
                        echo "<option value='" . $centroMedico['idCentroMedico'] . "'>" . $centroMedico['nombreCentroMedico'] . "</option>";
                    }?>

            </select>
            <input type='hidden' name='cantidadDeMedicos' value="<?php echo $cantidadDeMedicos   ?>" id='cantidadDeMedicos' >
            <input type='hidden' name='turnosMaximosDiarios' value="<?php echo $turnosMaximosDiarios   ?>" id='turnosMaximosDiarios' > 
            <label for="hora">Elija la Hora </label>
            <select name="horario" id="horario" class="form-control col-xs-12"> 
            </select>
            <input id="submit-button" name="enviar" class="btn btn-success" type="submit">
            <a href="./solicitar-turno.php" class="btn btn-danger">Limpiar</a>
            <?php echo $error; ?> 
        </form>
    </div>
</body>
</html>