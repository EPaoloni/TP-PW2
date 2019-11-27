<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/reserva_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/cabina_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/busqueda_modelo.php");

    function generarFactura($idUsuario,$username,$numeroReserva,$fechaPago){
        $query = new Query();
        $reserva=getReservaById($numeroReserva);
        $nombreCabina=getCabinaById($reserva['idCabina'])['nombreCabina'];
        $cantidadDePasajeros = consultarCantidadDeAcompaniantesReserva($numeroReserva) + 1;
        $vuelo = consultarVueloPorId($reserva['idVuelo']);
        $origen = consultarEstacioneById($reserva['idOrigenReserva'])['nombreEstacion'];
        $destino = consultarEstacioneById($reserva['idDestinoReserva'])['nombreEstacion'];

        $resultado = $query->insert("factura",
                                    "(idTitular,username,fechaPartida,fechaLlegada,nombreOrigen,nombreDestino,cantPasajeros,nombreCabina,fechaPago,montoAbonado)",
                                    "(" . $idUsuario . ",'" . $username . "','" . $vuelo['fechaPartida'] . "','" .  $vuelo['fechaLlegada'] . "','" . $origen . "','" . $destino . "'," . $cantidadDePasajeros . ",'" . $nombreCabina . "','" . $fechaPago . "'," . $reserva['montoReserva'] . ");");
        return $resultado;
    }
    function getFacturas(){
        $query = new Query();
        $resultado=$query->consulta("","factura","");
        return $resultado;
    }
?>