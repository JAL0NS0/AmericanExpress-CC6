<?php 
    include("../DB/db.php");
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];

    $query= "INSERT INTO public.tienda(nombre, id)
            VALUES ( '$nombre',$id);";
    $result = pg_query($dbconn,$query); 

    if($result){
        echo "Se ingresò exitosamente";
         ?>
            <a href="./tiendas.php">REGRESAR</a>
         <?php
    }else{
        echo "Hubo un error";
        ?>
            <a href="./nueva_tienda.php?res=falso">REGRESAR</a>
        <?php
    }
?>