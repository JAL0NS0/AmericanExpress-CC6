<?php
    // detalles de la conexion
    $host= "localhost";
    $puerto= "5432";
    $dbnombre= "AMERICAN_EXP";
    $usuario= "postgres";
    $contraseña = "1928";
    $contraseña = "1234";


    //Crear conexión
    $conn_string = "host=$host port=$puerto dbname=$dbnombre user=$usuario password=$contraseña";

    $dbconn = pg_connect($conn_string);

    // Revisamos el estado de la conexion en caso de errores.
    if(!$dbconn) {
        echo "Error: No se ha podido conectar a la base de datos\n";
        die();
    }
?>