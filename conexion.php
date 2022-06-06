<?php

    //DATOS DE CONEXIÓN HACIA LA BDD
    define('SERVERNAME', 'localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DBNAME', 'cliente');

    //creación de la conexión a la base de datos con mysql
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

    //Controlar la conexión
    if($con -> connect_error){
        die('Conexión Fallida:' .$conn-> connect_error);
    }
?>