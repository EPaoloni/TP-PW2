<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/reserva_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");

    function getCabinaMasVendida(){
        $reservas=traerTodasLasReservasPagas();
        $contadorCabina1=0;
        $contadorCabina2=0;
        $contadorCabina3=0;
        foreach($reservas as $reserva){
            $cantidadDePasajeros=consultarCantidadDeAcompaniantesReserva($reserva['idReserva']) + 1;
            if($reserva['idCabina'] == 1){
                $contadorCabina1= $contadorCabina1 + $cantidadDePasajeros;
            }
            if($reserva['idCabina'] == 2){
                $contadorCabina2= $contadorCabina2 + $cantidadDePasajeros;
            }
            if($reserva['idCabina'] == 3){
                $contadorCabina3= $contadorCabina3 + $cantidadDePasajeros;
            }
        }
        if($contadorCabina1>$contadorCabina2){
            if($contadorCabina1>$contadorCabina3){
                return "La cabina " . getCabinaById(1)['nombreCabina'] . " fue la más vendida, con un total de ". $contadorCabina1 . " ventas";
            }else{
                if($contadorCabina1==$contadorCabina3){
                    return "La cabina " . getCabinaById(1)['nombreCabina'] . " y la cabina ". getCabinaById(3)['nombreCabina'] . " fueron las más vendidas, con un total de ". $contadorCabina1 . " ventas";
                }else{
                    return "La cabina " . getCabinaById(3)['nombreCabina'] . " fue la más vendida, con un total de ". $contadorCabina3 . " ventas";
                }
            }
        }else{
            if($contadorCabina1==$contadorCabina2){
                if($contadorCabina1>$contadorCabina3){
                    return "La cabina " . getCabinaById(1)['nombreCabina'] . " y la cabina ". getCabinaById(2)['nombreCabina'] . " fueron las más vendidas, con un total de ". $contadorCabina1 . " ventas";
                }else{
                    if($contadorCabina1==$contadorCabina3){
                        return "La cabina " . getCabinaById(1)['nombreCabina'] . ", " . getCabinaById(2)['nombreCabina'] . ", y la cabina ". getCabinaById(3)['nombreCabina'] . "tuvieron la misma cantidad de ventas. Un total de ". $contadorCabina1 . " ventas";
                    }else{
                        return "La cabina " . getCabinaById(3)['nombreCabina'] . " fue la más vendida, con un total de ". $contadorCabina3 . " ventas";
                    }
                }
            }else{
                if($contadorCabina2>$contadorCabina3){
                    return "La cabina " . getCabinaById(2)['nombreCabina'] . " fue la más vendida, con un total de ". $contadorCabina2 . " ventas";
                }else{
                    if($contadorCabina2=$contadorCabina3){
                        return "La cabina " . getCabinaById(2)['nombreCabina'] . " y la cabina ". getCabinaById(3)['nombreCabina'] . " fueron las más vendidas, con un total de ". $contadorCabina2 . " ventas";
                    }else{
                        return "La cabina " . getCabinaById(3)['nombreCabina'] . " fue la más vendida, con un total de ". $contadorCabina3 . " ventas";
                    }
                }
            }
        }
        
    }
    function getCabinaById($idCabina){
        $query = new Query();
        $result = $query->consulta("", "cabinas", "idCabina=$idCabina");
        return $result[0];
    }
    
?>
