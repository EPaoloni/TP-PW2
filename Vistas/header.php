<?php   include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/turno_modelo.php");
        include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/usuario_modelo.php");?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5 py-3 navbar-default navbar-static-top">
    <a class="navbar-brand" href="./index.php">
        <img src="StaticContent/img/space-rocket_icon.png" class="d-inline-block align-top"  id="img-rocket">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="navbar-brand" href="./index.php">Gaucho Rocket</a>
            <span class="sr-only">(current)</span>
        </li>	
    <?php   if(isset($_SESSION['username'])){ ?>
        <li class="nav-item active">
        <a class="nav-link align-self-center my-2 my-sm-0" href="./listaReservas.php">Mis Reservas</a>
        </li>	
    <?php } ?>				
    </ul>
    
    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/botones-header.php"); ?>
    </div>
</nav>