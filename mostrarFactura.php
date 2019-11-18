<!doctype html>
<html>
<head>

<?php include("Vistas/head.html"); 



?>
<script src="StaticContent/js/reserva.js"></script>
    <link href="StaticContent/css/style-factura.css" rel="stylesheet">
   <!-- <script src="js/popper.min.js"></script> -->

</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="StaticContent/img/logo.jpg" style="width:100%; max-width:150px;">
                            <h5 style="width: 300px">
                            GauchoRocket S.A. <br>
                            Sargento Gómez 1644, Hurlingham - (C.P. 1686)
                            </h5>
                            </td>
                            <td>
                                Factura C<br>
                                N°: 1 <br>
                                Fecha de emisión: <?php echo date("d-m-Y"); ?><br>
                                CUIT: 30-66211347-2<br>
                                Ing. brutos: 30BRR  662113470<br>
                                Inicio actividades: 12/06/2018
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Datos Cliente<br>
                </td>

                <td>
                    
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Apellido y nombre del cliente: Bla<br> <!--Obtener dato de BD -->
                                Dirección: <br> <!--Obtener dato de BD -->
                                CP:  <br> <!--Obtener dato de BD -->
                            </td>

                         
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">

                <td>
                    Conceptos
                </td>
                
                <td>
                    Precio
                </td>
            </tr>
            
            <tr class="item">

                <td>
                    <?php echo "Vuelo desde ... hasta ..., correspondiente a los viajeros ... "?> <!--Obtener dato de BD -->
                </td>
                
                <td>
                    $<?php echo "500"?> <!--Obtener dato de BD -->
                </td>
            </tr>
            <tr class="total">

                <td>
                    
                </td>
                
                <td>
                   Total: $<?php echo "500"?> <!--Suma de conceptos -->
                </td>
            </tr>
        </table>
    </div>
    <!-- <script>
   $( document ).ready(function() {
    window.print();
    });
  </script> -->
</body>
</html>