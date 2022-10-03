<?php 
    include("../DB/db.php");
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $contraseña = $_POST["contraseña"];

    $query= "INSERT INTO public.empleado(
        nombre, \"contraseña\", id)
        VALUES ('$nombre', '$contraseña',$id);";
    echo $query;
    $result = pg_query($dbconn,$query); 

    if($result){
        echo "Se ingresò exitosamente";
         ?>
            <a href="./empleados.php">REGRESAR</a>
         <?php
    }else{
        echo "Hubo un error";
        ?>
            <a href="./nuevo_empleado.php">REGRESAR</a>
        <?php
    }
?>