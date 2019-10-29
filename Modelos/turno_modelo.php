<?php

    include_once("helpers/conexion.php");
    include_once("helpers/Query.php");

    function crearTurno($idCentroMedico,$fechaTurno,$idUsuario){
        $query = new Query();
        $resultado = $query->insert("turno", "(idCentroMedico, fecha,idUsuario)", "('$idCentroMedico', '$fechaTurno', '$idUsuario')");
        return $resultado;
    }


    
?>