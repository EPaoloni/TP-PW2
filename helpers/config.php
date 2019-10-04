<?php

function getConfigAsArray(){
    return parse_ini_file('config.ini', true);
}

