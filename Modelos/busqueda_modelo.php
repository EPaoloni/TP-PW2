<?php

    function destruirSesion(){
        session_destroy();
        header("location: ./index.php");
    }

?>