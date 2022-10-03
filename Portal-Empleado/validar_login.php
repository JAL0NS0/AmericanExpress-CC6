<?php
    session_start();
    $id = $_POST["id"];
    $pass = $_POST["contraseña"];

    include('DB/db.php');

    $query =     "SELECT * FROM empleado WHERE id='$id' and contraseña='$pass';";
    $result = pg_query($dbconn,$query);
    $filas = pg_num_rows($result);
    if($filas > 0){
        $_SESSION["id"]= $id;
        $row = pg_fetch_array($result, NULL, PGSQL_ASSOC);
        $_SESSION["nombre"]= $row['nombre'];
        if($row['nombre']='Admin'){
            header("Location: admin.php");
        }
            header("Location: inicio.php");
    }else{
        header("Location: index.php?reg=false");
    }
    // Cerramos la conexion
    pg_close($dbconn);
?>


