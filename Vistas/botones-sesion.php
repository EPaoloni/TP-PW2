<?php   $uri = $_SERVER['REQUEST_URI'];
        if(isset($_SESSION['username'])){ 
        $idUsuario=getIdByUsername($_SESSION['username']);
        //TODO Cambiar metodo a puedeSolicitarTurno($idUsuario)
            if(checkCodigoViajero($idUsuario)==0){
                if(tieneTurnos($idUsuario)){    ?>
                <a class="btn btn-success text-center align-self-center my-2 my-sm-0 botones-navbar" href="./turno.php">Mi Turno</a>
<?php } else{ ?>
                <a class="btn btn-primary text-center align-self-center my-2 my-sm-0 botones-navbar" href="./solicitar-turno.php">Solicitar Turno</a>
<?php } }?>
                <a class="btn btn-danger text-center align-self-center my-2 my-sm-0 botones-navbar" href="./index.php?destruirSesion=true">Cerrar sesion</a> 
<?php } else{ if(!(strpos($uri, 'login.php') !== false)) {
        ?>
            <a class="btn btn-info text-center align-self-center my-2 my-sm-0 botones-navbar" href="./login.php">Inicia sesión</a>   
<?php }
    if(!(strpos($uri, 'registro.php') !== false)){ ?>
            <a class="btn btn-info text-center align-self-center my-2 my-sm-0 botones-navbar" href="./registro.php">Regístrate</a>  
<?php } }?>