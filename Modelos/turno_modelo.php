<?php

    include_once("helpers/conexion.php");
    include_once("helpers/Query.php");

    function crearTurno($idCentroMedico,$fechaTurno,$idUsuario){
        $query = new Query();
        $resultado = $query->insert("turno", "(idCentroMedico, fecha,idUsuario)", "('$idCentroMedico', '$fechaTurno', '$idUsuario')");
        return $resultado;
    }
    function getNombreCentroMedico($idCentro){
        $query = new Query();
        $resultado = $query->consulta("nombreCentroMedico", "centroMedico ", "idCentroMedico=$idCentro ");
        $resultado=$resultado[0]['nombreCentroMedico'];
        return $resultado;
    }



    
?>