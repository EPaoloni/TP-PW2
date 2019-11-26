<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/cabina_modelo.php");
session_start();
$cabinaMasVendida=getCabinaMasVendida();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("Vistas/head.html"); ?>
</head>
<body>
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/header.php"); ?>

<div class="container">
    <h2 class="text-success">Cabina más vendida</h2>
    <p> <?php echo $cabinaMasVendida ?> </p>
</div>
    
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Vistas/footer.php"); ?>
</body>
</html>