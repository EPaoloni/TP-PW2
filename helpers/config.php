<?php

function getConfigAsArray(){
    return parse_ini_file($_SERVER["DOCUMENT_ROOT"] . "/TP-PW2/Config/config.ini", true);
}

