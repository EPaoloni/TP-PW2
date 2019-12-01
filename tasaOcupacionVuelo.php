<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/admin_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/tasaOcupacion_modelo.php");
    checkIsAdmin();
    $error="";
    if(isset($_GET['submit-form'])){
        $idVuelo=isset($_GET['input-vuelo'])? $_GET['input-vuelo'] : null; 
        $listaVuelosOcupacion = getListadoVueloOcupacion($idVuelo);
        if($listaVuelosOcupacion == null){
            $error="<p class='text-danger'> No existe ese Modelo </p>";
        }
    }else {
        $listaVuelosOcupacion = getListadoVuelosOcupacion();
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("Vistas/head.html"); ?>
</head>
<body>
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/header.php"); ?>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-lg-2">
        </div>
        <div class="col col-lg-4">
            <form class="form-row align-items-center" action="#" >
                    <div class="form-group">
                    <h2 class="text-success"  >Buscar por vuelo</h2>
                        <label for="input-vuelo">N° de vuelo:</label>
                        <input type="txt" class="form-control" id="input-vuelo" name="input-vuelo">
                        <input type="submit" name="submit-form" class="btn btn-primary mb-2 mt-4" value="Aceptar">
                        <?php echo $error;?>
                    </div>
                </form>
        </div>
        <div class="col col-lg-2">
        </div>
    </div>
</div>
<div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Vuelo</th>
                <th scope="col">Tasa de ocupacion</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($listaVuelosOcupacion<>null){
                foreach ($listaVuelosOcupacion as $vuelo ) {
            ?>

            <tr>
                <th scope="row"><?php echo $vuelo['idVuelo'] ?></th>
                <th><?php echo $vuelo['tasa']   ?>%</th>
               
            </tr>
        
            <?php      
               }
            }
            ?>
        </tbody>
    </table>
    <a href="./tasaOcupacionVuelo.php" class="btn btn-success mb-2 mt-4">Buscar todos</a>
</div>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/footer.php"); ?>
</body>
</html>