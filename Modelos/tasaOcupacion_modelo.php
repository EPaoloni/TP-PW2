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
            $capacidadTotal=$query->consulta("SUM(capacidad) as capacidad","modelonave_cabinas","modeloNave=" . $vuelo['modelo']);
            $capacidadTotal=$capacidadTotal[0]['capacidad'];
            $resultado = $query->consulta("estacionesCircuito", 
                                                "vuelo INNER JOIN circuito ON vuelo.circuitoVuelo = circuito.idCircuito",
                                                "idVuelo ='" . $vuelo['idVuelo'] . "'");
            $estacionesCircuito = explode(",", $resultado[0]['estacionesCircuito']);
            $cabinas=$query->consulta("","cabinas INNER JOIN modelonave_cabinas ON idCabina=tipoCabina","modeloNave=" . $vuelo['modelo']);

            $idOrigen=reset($estacionesCircuito);
            $idDestino=end($estacionesCircuito);
            $lugaresOcupados=0;
            foreach ($cabinas as $cabina) {
                $capacidadCabina=consultaCapacidadCabinaPorVuelo($cabina['idCabina'],$vuelo['idVuelo']);
                $lugaresDisponibles=consultarCantidadLugaresDisponiblesCabina($cabina['idCabina'], $vuelo['idVuelo'], $idOrigen, $idDestino);
                $lugaresOcupados=$lugaresOcupados+($capacidadCabina-$lugaresDisponibles);
            }
            $promedioLugaresOcupados=$lugaresOcupados/count($cabinas);
            $tasaOcupacionVuelo=($promedioLugaresOcupados/$capacidadTotal)*100;

            array_push($tasaOcupacionDeVuelos,array('idVuelo'=> $vuelo['idVuelo'],'tasa'=>$tasaOcupacionVuelo,'idModelo'=>$vuelo['modelo']) );
        }
        return $tasaOcupacionDeVuelos;
    }
    
    function getListadoModelosOcupacion(){
        $query=new Query();
        $modelos=$query->consulta("", "modelonave", "");
        $tasaVuelos=getListadoVuelosOcupacion();
        $tasaOcupacionModelos=array();
        foreach ($modelos as $modelo ) {
            $tasaOcupacionModelo=0;
            $contadorTasaVuelos=0;
            $tasaModelo=0;
            foreach ($tasaVuelos as $tasaVuelo) {
                if ($tasaVuelo['idModelo']==$modelo['id']) {
                    $contadorTasaVuelos++;
                    $tasaModelo=$tasaModelo+$tasaVuelo['tasa'];
                }
            }
            if($tasaModelo == 0 || $contadorTasaVuelos==0){
                $tasaOcupacionModelo=0;
            }else{
                $tasaOcupacionModelo=$tasaModelo/$contadorTasaVuelos;
            }
            array_push($tasaOcupacionModelos,array('idModelo'=>$modelo['id'],'nombreModelo'=>$modelo['nombreModelo'] ,'tasa'=>$tasaOcupacionModelo));
        }
        return $tasaOcupacionModelos;
    }

    function getModeloOcupacion($idModelo){
        $query=new Query();
        $modelo=$query->consulta("", "modelonave", "id=$idModelo");
        $modelo=$modelo[0];
        if($modelo==null){
            return $modelo;
        }
        $tasaVuelos=getListadoVuelosOcupacion();
        $tasaOcupacionModelos=array();
        $tasaOcupacionModelo=0;
        $tasaModelo=0;
        $contadorTasaVuelos=0;
        foreach ($tasaVuelos as $tasaVuelo) {
            if ($tasaVuelo['idModelo']==$idModelo) {
                $contadorTasaVuelos++;
                $tasaModelo=$tasaModelo+$tasaVuelo['tasa'];
            }
        }
        if($tasaModelo == 0 || $contadorTasaVuelos==0){
            $tasaOcupacionModelo=0;
        }else{
            $tasaOcupacionModelo=$tasaModelo/$contadorTasaVuelos;
        }
        
        array_push($tasaOcupacionModelos,array('idModelo'=>$idModelo,'nombreModelo'=>$modelo['nombreModelo'] ,'tasa'=>$tasaOcupacionModelo));
        return $tasaOcupacionModelos;
    }

    function getVueloOcupacion($idVuelo){
        $query=new Query();
        $vuelo=$query->consulta("", "vuelo INNER JOIN naves ON Vuelo.id_nave=naves.id", "idVuelo=$idVuelo");
        $vuelo=$vuelo[0];
        if($vuelo==null){
            return $vuelo;
        }
        $tasaOcupacionDeVuelos=array();
        $tasaOcupacionVuelo=0;
        $tasaOcupacionCabina=0;
        $capacidadTotal=$query->consulta("SUM(capacidad) as capacidad","modelonave_cabinas","modeloNave=" . $vuelo['modelo']);
        $capacidadTotal=$capacidadTotal[0]['capacidad'];
        $resultado = $query->consulta("estacionesCircuito", 
                                            "vuelo INNER JOIN circuito ON vuelo.circuitoVuelo = circuito.idCircuito",
                                            "idVuelo ='" . $vuelo['idVuelo'] . "'");
        $estacionesCircuito = explode(",", $resultado[0]['estacionesCircuito']);
        $cabinas=$query->consulta("","cabinas INNER JOIN modelonave_cabinas ON idCabina=tipoCabina","modeloNave=" . $vuelo['modelo']);

        $idOrigen=reset($estacionesCircuito);
        $idDestino=end($estacionesCircuito);
        $lugaresOcupados=0;
        foreach ($cabinas as $cabina) {
            $capacidadCabina=consultaCapacidadCabinaPorVuelo($cabina['idCabina'],$vuelo['idVuelo']);
            $lugaresDisponibles=consultarCantidadLugaresDisponiblesCabina($cabina['idCabina'], $vuelo['idVuelo'], $idOrigen, $idDestino);
            $lugaresOcupados=$lugaresOcupados+($capacidadCabina-$lugaresDisponibles);
        }
        $promedioLugaresOcupados=$lugaresOcupados/count($cabinas);
        $tasaOcupacionVuelo=($promedioLugaresOcupados/$capacidadTotal)*100;

        array_push($tasaOcupacionDeVuelos,array('idVuelo'=> $vuelo['idVuelo'],'tasa'=>$tasaOcupacionVuelo,'idModelo'=>$vuelo['modelo']) );
        
        return $tasaOcupacionDeVuelos;
    }
       
?>