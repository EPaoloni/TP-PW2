<?php

    include_once("helpers/conexion.php");
    include_once("helpers/Query.php");
    include_once("helpers/Logger.php");

    function crearTurno($idCentroMedico,$fechaTurno,$idUsuario,$idHorario){
        $query = new Query();
        $resultado[0] = $query->insert("turno", "(idCentroMedico, fecha,idUsuario,idHorario)", "('$idCentroMedico', '$fechaTurno', '$idUsuario','$idHorario')");
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
    function consultarTurnoPorUsuario($idUsuario){
        $query = new Query();
        $resultado = $query->consulta("nombreCentroMedico,fecha,time_format(hora, '%H:%i') as hora", 
                                        "Turno 
                                            INNER JOIN Usuario ON  turno.idUsuario=Usuario.idUsuario 
                                            INNER JOIN horario ON turno.idHorario=horario.idHorario 
                                            INNER JOIN centroMedico ON turno.idCentroMedico=centroMedico.idCentroMedico ",
                                        "Usuario.idUsuario=" . $idUsuario );
        return $resultado;
    }
    function consultarTurnosPorFecha($fecha,$idCentro){
        $query = new Query();
        $fecha="$fecha";
        $resultado = $query->consulta("", 
                                        "Turno 
                                            INNER JOIN horario ON turno.idHorario=horario.idHorario 
                                            INNER JOIN centroMedico ON turno.idCentroMedico=centroMedico.idCentroMedico ",
                                        "turno.idCentroMedico=$idCentro AND fecha='$fecha'" );
        return $resultado;
    }


    

?>