<?php
include('config.php');

function getConexion(){

    $config = getConfigAsArray();

    $servername = $config['database']['hostname'];
    $username = $config['database']['username'];
    $dbname = $config['database']['database'];
    $password = $config['database']['password'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

?>