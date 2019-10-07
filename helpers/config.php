<?php

function getConfigAsArray(){
    return parse_ini_file('Config/config.ini', true);
}

