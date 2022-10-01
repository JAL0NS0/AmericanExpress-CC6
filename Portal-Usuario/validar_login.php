<?php
    session_start();
    $nombre = $_POST["usuario"];
    $pass = $_POST["contraseña"];

    include('DB/db.php');

    $query =     "SELECT * FROM usuario WHERE usuario='$nombre' and contraseña='$pass';";
    $result = pg_query($dbconn,$query);
    $filas = pg_num_rows($result);
    if($filas > 0){
        $_SESSION["nombre"]= $nombre;
            header("Location: inicio.php");
    }else{
        header("Location: index.php?reg=false");
    }
    // Cerramos la conexion
    pg_close($dbconn);
?>


