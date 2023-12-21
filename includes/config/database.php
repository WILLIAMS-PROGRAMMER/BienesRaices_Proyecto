<?php

function conectarDB() :mysqli {
    $db = mysqli_connect( 'localhost', 'root', 'DERLAjnw#1', 'bienesraices_crud');


    $db->set_charset('utf8');

    if(!$db) {
        echo "No se conecto a la base de datos :((((";
        exit;
    }

    return $db; 
}