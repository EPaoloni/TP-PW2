<?php
    include_once('modelos/turno_modelo.php');
    include_once("helpers/Query.php");

    function checkTurnos (){
        $query = new Query();
        $username=$_SESSION['username'];
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
    

?>