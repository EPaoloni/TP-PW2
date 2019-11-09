<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/conexion.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Logger.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/turno_modelo.php");

    
    function imprimirHorasSegunFechaYCentro($fecha,$idCentro){
        $query = new Query();
        $result="";
        $listaHorarios=$query->consulta("idHorario,time_format(hora, '%H:%i') as hora", "horario", "");
        $horasOcupadas=consultarTurnosPorFecha($fecha, $idCentro);
        foreach ($listaHorarios as $horario) {
            $horarioHabilitado=true;
            foreach ($horasOcupadas as $horaOcupada){
                if($horaOcupada['idHorario']==$horario['idHorario']){
                    $result= $result . "<option value='" . $horario['idHorario'] . "' disabled>" . $horario['hora']  . " </option>";
                    $horarioHabilitado=false;
                }
            }
            if($horarioHabilitado){
                $result= $result . "<option value='" . $horario['idHorario'] . "'>" . $horario['hora'] . "</option>";
            }  
        }
        return $result;
    }
    function imprimirHoras(){
        $query = new Query();
        $result="";
        $listaHorarios=$query->consulta("idHorario,time_format(hora, '%H:%i') as hora", "horario", "");
        foreach ($listaHorarios as $horario){
            $result= $result . "<option class='hora' value='" . $horario['idHorario'] . "'>" . $horario['hora'] . "</option>";
       }
       return $result;
    }
        
?>