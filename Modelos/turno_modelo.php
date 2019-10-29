<?php

    include_once("helpers/conexion.php");
    include_once("helpers/Query.php");
    include_once("helpers/Logger.php");

    function crearTurno($idCentroMedico,$fechaTurno,$idUsuario,$turnosMaximosDiarios){
        $query = new Query();
        $diaLleno=estaDiaLleno($fechaTurno,$turnosMaximosDiarios,$idCentroMedico);
        if($diaLleno){

            $log = new Logger();
            $log->warning("No se pudo solicitar turno porque dia $fechaTurno esta completo");
            $resultado[0]=false;
            $resultado[1]="No se pudo solicitar turno porque dia $fechaTurno esta completo";

        } else {
            $resultado[0] = $query->insert("turno", "(idCentroMedico, fecha,idUsuario)", "('$idCentroMedico', '$fechaTurno', '$idUsuario')");
        }
        return $resultado;
    }
    function getNombreCentroMedico($idCentro){
        $query = new Query();
        $resultado = $query->consulta("nombreCentroMedico", "centroMedico ", "idCentroMedico=$idCentro ");
        $resultado=$resultado[0]['nombreCentroMedico'];
        return $resultado;
    }
    function tieneTurnos($idUsuario){
        $query = new Query();
        $resultado = $query->consulta("", "turno ", "idUsuario=$idUsuario ");
        $resultado = isset($resultado);
        return $resultado;
    }
    function eliminarTurno($idUsuario){
        $query = new Query();
        $resultado = $query->eliminar("turno", "idUsuario=$idUsuario ");
        return $resultado;
    }
    function estaDiaLleno($fechaTurno,$turnosMaximosDiarios,$idCentroMedico){
        $query = new Query();
        $resultadoConsulta = $query->consulta("COUNT(*)","turno", "fecha='$fechaTurno' AND idCentroMedico=$idCentroMedico ");
        $resultadoConsulta=$resultadoConsulta[0]['COUNT(*)'];
        if($resultadoConsulta>$turnosMaximosDiarios){
            $diaLleno=true;
        } else {
            $diaLleno=false;
        }
        return $diaLleno;
    }




    
?>