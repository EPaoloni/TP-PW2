<?php 
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/disponibilidad_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/busqueda_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");

    function getListadoVuelosOcupacion(){
        $query=new Query();
        $vuelos=$query->consulta("", "vuelo INNER JOIN naves ON Vuelo.id_nave=naves.id", "");
        $tasaOcupacionDeVuelos=array();
        foreach ($vuelos as $vuelo) {
            $tasaOcupacionVuelo=0;
            $tasaOcupacionCabina=0;
            $resultado = $query->consulta("estacionesCircuito", 
                                                "vuelo INNER JOIN circuito ON vuelo.circuitoVuelo = circuito.idCircuito",
                                                "idVuelo ='" . $vuelo['idVuelo'] . "'");
            $estacionesCircuito = explode(",", $resultado[0]['estacionesCircuito']);
            $cabinas=$query->consulta("","cabinas INNER JOIN modelonave_cabinas ON idCabina=tipoCabina","modeloNave=" . $vuelo['modelo']);
            foreach ($estacionesCircuito as $estacion) {
                $idOrigen=$estacion;
                $idDestino=next($estacionesCircuito);
                if($idDestino!=null){
                    $lugaresOcupados=0;
                    foreach ($cabinas as $cabina) {
                        $capacidadCabina=consultaCapacidadCabinaPorVuelo($cabina['idCabina'],$vuelo['idVuelo']);
                        $lugaresDisponibles=consultarCantidadLugaresDisponiblesCabina($cabina['idCabina'], $vuelo['idVuelo'], $idOrigen, $idDestino);
                        $lugaresOcupados=$lugaresOcupados+($capacidadCabina-$lugaresDisponibles);
                        echo $lugaresDisponibles . "<br>";
                    }
                    $tasaOcupacionCabinas=$tasaOcupacionCabina+($lugaresOcupados/count($cabinas));
                }
            }
            $tasaOcupacionVuelo=$tasaOcupacionCabinas/count($estacionesCircuito);

            array_push($tasaOcupacionDeVuelos,array('idVuelo'=> $vuelo['idVuelo'],'tasa'=>$tasaOcupacionVuelo,'idModelo'=>$vuelo['modelo']) );
        }
        return $tasaOcupacionDeVuelos;
    }
    
    function getListadoModeloOcupacion(){
        $query=new Query();
        $modelos=$query->consulta("", "modelonave", "");
        $tasaVuelos=getListadoVuelosOcupacion();
        $tasaOcupacionModelos=array();
        foreach ($modelos as $modelo ) {
            $tasaOcupacionModelo=0;
            $contadorTasaVuelos=0;
            foreach ($tasaVuelos as $tasaVuelo) {
                if ($tasaVuelo['modelo']==$modelo['idModelo']) {
                    $contadorTasaVuelos++;
                    $tasaOcupacionModelo=$tasaOcupacionModelo+$tasaVuelo['tasa'];
                }
            }
            $tasaOcupacionModelo=$tasaOcupacionModelo/$contadorTasaVuelos;
            array_push($tasaOcupacionModelos,array('idModelo'=>$modelo['idModelo'],'nombreModelo'=>$modelo['nombreModelo'] ,'tasa'=>$tasaOcupacionModelo));
        }
        return $tasaOcupacionModelos;
    }
    
       
?>