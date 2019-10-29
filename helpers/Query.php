<?php

include_once("helpers/conexion.php");
include_once("helpers/Logger.php");

class Query{

    public function __constructor(){
    }

    /**
     * -----------------------------------
     * Realiza una consulta a la base de datos definida en conexion.php. Basicamente arma un string concatenando los parametros recibidos.
     * Si no se encontraron registros coincidentes devuelve null.
     * -----------------------------------
     * @param string $columnas Si viene vacio hace un SELECT *.
     * @param string $tablas Lo que va despues del FROM. Si se requiere un INNER JOIN debe venir la sentencia completa.
     * @param string $condiciones Lo que va despues del WHERE, si no se desea ninguna condicion dejar vacio.
     */
    public function consulta($columnas, $tablas, $condiciones){
        $conn = $this->establecerConexion();
        if($columnas == ""){
            $columnas = "*";
        }
        if($condiciones != ""){
            $sql = "SELECT " . $columnas . " FROM " . $tablas . " WHERE " . $condiciones;
        } else {
            $sql = "SELECT " . $columnas . " FROM " . $tablas;
        }
        $result = $conn->query($sql);
    
        if($result === false){
            $log = new Logger();
            $log->error("Ocurrio un error en la base de datos al realizar la consulta: $sql \t El error de la base de datos es: $conn->error");
            $conn->close();
            exit(1);
        }
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $entradas[] = $row;
           }
        } else {
            $entradas = null;
        }
        $result->close();
        $conn->close();

        return $entradas;
    }

        /**
     * -----------------------------------
     * Realiza una consulta a la base de datos definida en conexion.php. Basicamente arma un string concatenando los parametros recibidos.
     * Devuelve true si la insercion es exitosa.
     * -----------------------------------
     * @param string $tabla
     * @param string $columnas Las columnas que se quiere afectar, si no se desea especificar se manda un string vacio.
     * @param string $valores Los valores a insertar, entre parentesis, si son varias entradas poner varios parentesis.
     */
    public function insert($tabla, $columnas, $valores){
        $conn = $this->establecerConexion();

        $sql = "INSERT INTO " . $tabla . $columnas . " VALUES" . $valores;

        $result = $conn->query($sql);

        if($result){
            $insertExitoso = true;
        } else {
            $log = new Logger();
            $log->error("Ocurrio un error en la base de datos al realizar el insert: $sql \t El error de la base de datos es: $conn->error");
            $insertExitoso = false;
        }
        
        $conn->close();

        return $insertExitoso;
    }
    public function eliminar($tabla, $valores){
        $conn = $this->establecerConexion();

        $sql = "DELETE FROM " . $tabla . " WHERE " . $valores;

        $result = $conn->query($sql);

        if($result){
            $deleteExitoso = true;
        } else {
            $log = new Logger();
            $log->error("Ocurrio un error en la base de datos al realizar el DELETE: $sql \t El error de la base de datos es: $conn->error");
            $deleteExitoso = false;
        }
        
        $conn->close();

        return $deleteExitoso;
    }

    private function establecerConexion(){
        $conn = getConexion();
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

}

?>