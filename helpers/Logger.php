<?php

class Logger{
    private $nombreDelArchivo;

    public function __construct($nombreDelArchivo = "app.log") {
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $this->nombreDelArchivo = $nombreDelArchivo;
    }

    public function info($mensaje) {
        $this->escribirArchivo($mensaje, "info");
    }
    public function warning($mensaje) {
        $this->escribirArchivo($mensaje, "warning");
    }
    public function error($mensaje) {
        $this->escribirArchivo($mensaje, "error");
    }

    
    private function escribirArchivo($mensaje, $nivel) {
        file_put_contents("./logs/" . $this->nombreDelArchivo, date('d/M/Y - H:i:s') . " [" . strtoupper($nivel) . "]" . " - " . $mensaje . "\n", FILE_APPEND);
    }
}

?>