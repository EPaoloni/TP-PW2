<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/conexion.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Modelos/turno_modelo.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/helpers/Query.php");

    function asignarCodigoViajeroSiFechaTurnoExpiro ($username){
        $query = new Query();
        $resultadoConsulta= $query->consulta("codigoViajero,idUsuario",
                                    "usuario INNER JOIN Credencial ON Usuario.numeroCredencialUsuario=Credencial.idCredencial",
                                    "Credencial.username='$username'");
        $codigoViajero= $resultadoConsulta[0]['codigoViajero'];
        $idUsuario= $resultadoConsulta[0]['idUsuario'];
        if($codigoViajero==0){
            $tieneTurno=tieneTurnos($idUsuario);
            if($tieneTurno){
                $turno=consultarTurnoPorUsuario($idUsuario);
                $date_now =  date("Y/m/d");
                $fechaTurno=$turno[0]['fecha'];
                if ($date_now > $fechaTurno) {
                    asignarCodigoViajero($idUsuario);
                }
            }
        } 
    }
    function asignarCodigoViajero ($idUsuario){
        $query = new Query();
        $random=random_int(1,3);
        $result=$query->update("usuario","codigoViajero=$random","idUsuario=$idUsuario");
        eliminarTurno($idUsuario);
        return $result;
    }
    function checkCodigoViajero($idUsuario){
        $query = new Query();
        $result=$query->consulta("codigoViajero","usuario ","idUsuario='$idUsuario'");
        return $result[0]['codigoViajero'];
    }
    function getIdByUsername($username){
        $query = new Query();
        $idUsuario= $query->consulta("idUsuario",
                                    "usuario INNER JOIN Credencial ON Usuario.numeroCredencialUsuario=Credencial.idCredencial",
                                    "Credencial.username='$username'");
        return $idUsuario[0]['idUsuario'];
    }
    function getUsernameById($id){
        $query = new Query();
        $result= $query->consulta("Credencial.username",
                                    "usuario INNER JOIN Credencial ON Usuario.numeroCredencialUsuario=Credencial.idCredencial",
                                    "usuario.idUsuario='$id'");
        return $result[0]['username'];
    }

    

?>