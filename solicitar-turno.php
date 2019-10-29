<?php 
    include_once('helpers/Query.php');
    include_once('modelos/turno_modelo.php');
    include_once("helpers/Logger.php");
    session_start();
    $query = new Query();
    $log = new Logger();
    
    $error="";

    if(!isset($_SESSION['username'])){
        header("location: ./login.php");
        exit();
    } else {
        $username=$_SESSION['username'];
        $idUsuario= $query->consulta("idUsuario",
                                    "usuario INNER JOIN Credencial ON Usuario.numeroCredencialUsuario=Credencial.idCredencial",
                                    "Credencial.username='$username'");
        $idUsuario= $idUsuario[0]['idUsuario'];
        if(tieneTurnos($idUsuario)){
            header("location: ./turno.php");
            exit();
        } else {
            $centroMedicos = $query->consulta("", "centroMedico", "");

            if(isset($_POST['enviar'])){

                $idCentroMedico = $_POST['centro-medico'];
                $fechaTurno = ($_POST['fecha-turno'] != "") ? $_POST['fecha-turno'] : null;
                $turnosMaximosDiarios = $_POST['turnosMaximosDiarios'];
                $cantidadDeMedicos = $_POST['cantidadDeMedicos'];
                
                if(isset($idCentroMedico) && isset( $fechaTurno) && isset($idUsuario) && isset($cantidadDeMedicos) && isset($turnosMaximosDiarios)  ){
                    $returnCrearTurno=crearTurno($idCentroMedico,$fechaTurno,$idUsuario,$turnosMaximosDiarios);

                    if ($returnCrearTurno == true){
                        header("location: ./turno.php");
                        die();

                    } else if(isset($returnCrearTurno[1])) {
                        $error = "<p class='text-danger'>" . $returnCrearTurno[1] . "<p>";
                    }
                } else {
                    $error = "<p class='text-danger'>Campos incompletos<p>";
                    $log->error("Ocurrio un error al crear Turno debido a campos incompletos  \t Los campos son idCentroMedico = $idCentroMedico , fechaTurno = $fechaTurno, idUsuario = $idUsuario ");
                }
            }
        }
        
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

     <h1 class="text-center">Solicitar Turno</h1>
     <div class="container">
        <form action="./solicitar-turno.php" method="POST">
            <label for="centro-medico">Origen: </label>
            <select name="centro-medico" id="centro-medico" class="form-control col-xs-12">                   
                    <?php 
                        foreach ($centroMedicos as $centroMedico) {
                        echo "<option value='" . $centroMedico['idCentroMedico'] . "'>" . $centroMedico['nombreCentroMedico'] . "</option>";
                        $cantidadDeMedicos=$centroMedico['cantidadDeMedicos'];
                        $turnosMaximosDiarios=$centroMedico['turnosMaximosDiarios'];

                    }?>

            </select>
            <input type='hidden' name='cantidadDeMedicos' value="<?php echo $cantidadDeMedicos   ?>" id='cantidadDeMedicos' >
            <input type='hidden' name='turnosMaximosDiarios' value="<?php echo $turnosMaximosDiarios   ?>" id='turnosMaximosDiarios' > 

            <label for="fecha-turno">Fecha </label>
            <input class="form-control col-xs-12" type="date" name="fecha-turno" id="fecha-turno">
            <label for="hora">Hora </label>
            <select name="hora" id="hora" class="form-control col-xs-12">  
                <option value='08:00' id='800'>08:00</option>
                <option value='08:10' id='810'>08:10</option>
                <option value='08:15' id='815' class="ankara">08:15</option>
                <option value='08:20' id='820'>08:20</option>
                <option value='08:30' id='830'>08:30</option>
                <option value='08:40' id='840'>08:40</option>
                <option value='08:45' id='845' class="ankara">08:45</option>
                <option value='08:50' id='850'>08:50</option>

                <option value='09:00' id='900'>09:00</option>
                <option value='09:10' id='910'>09:10</option>
                <option value='09:15' id='915' class="ankara">09:15</option>
                <option value='09:20' id='920'>09:20</option>
                <option value='09:30' id='930'>09:30</option>
                <option value='09:40' id='940'>09:40</option>
                <option value='09:45' id='945' class="ankara">09:45</option>
                <option value='09:50' id='950'>09:50</option>

                <option value='10:00' id='1000'>10:00</option>
                <option value='10:10' id='1010'>10:10</option>
                <option value='10:15' id='1015' class="ankara">10:15</option>
                <option value='10:20' id='1020'>10:20</option>
                <option value='10:30' id='1030'>10:30</option>
                <option value='10:40' id='1040'>10:40</option>
                <option value='10:45' id='1045' class="ankara">10:45</option>
                <option value='10:50' id='1050'>10:50</option>

                <option value='11:00' id='1100'>11:00</option>
                <option value='11:10' id='1110'>11:10</option>
                <option value='11:15' id='1115' class="ankara">11:15</option>
                <option value='11:20' id='1120'>11:20</option>
                <option value='11:30' id='1130'>11:30</option>
                <option value='11:40' id='1140'>11:40</option>
                <option value='11:45' id='1145' class="ankara">11:45</option>
                <option value='11:50' id='1150'>11:50</option>

                <option value='14:00' id='1400'>14:00</option>
                <option value='14:10' id='1410'>14:10</option>
                <option value='14:15' id='1415' class="ankara">14:15</option>
                <option value='14:20' id='1420'>14:20</option>
                <option value='14:30' id='1430'>14:30</option>
                <option value='14:40' id='1440'>14:40</option>
                <option value='14:45' id='1445' class="ankara">14:45</option>
                <option value='14:50' id='1450'>14:50</option>

                <option value='15:00' id='1500'>13:00</option>
                <option value='15:10' id='1510'>13:10</option>
                <option value='15:15' id='1515' class="ankara">13:15</option>
                <option value='15:20' id='1520'>13:20</option>
                <option value='15:30' id='1530'>13:30</option>
                <option value='15:40' id='1540'>13:40</option>
                <option value='15:45' id='1545' class="ankara">13:45</option>
                <option value='15:50' id='1550'>13:50</option>
            </select>
            <input id="submit-button" name="enviar" class="btn btn-success" type="submit">
            <a href="./solicitar-turno.php" class="btn btn-danger">Limpiar</a>
            <?php echo $error; ?> 
        </form>
    </div>
    <script src="StaticContent/js/turno.js"></script>
</body>
</html>