<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Datos</title>
    <!-- CSS bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
    <?php 
        $nombre = $_POST["nombre"];
        $usuario = $_POST["usuario"];
        $contraseña = $_POST["contraseña"];
        session_start();

        include('DB/db.php');

        $query =     "SELECT * FROM usuario WHERE usuario='$usuario';";
        $result = pg_query($dbconn,$query);
        $filas = pg_num_rows($result);
        if($filas > 0){
            header("Location: nuevo_usuario.php?exist=true");
        }else{
            $query =     "INSERT INTO usuario (nombre, usuario,contraseña) VALUES ('$nombre', '$usuario','$contraseña');";
            $result = pg_query($dbconn,$query);
            $cmdtuples = pg_affected_rows($result);
            if($cmdtuples==0){
                echo "ERROR EN LA BASE DE DATOS";
                header("Location: ");
                ?>
                    <a href="nuevo_usuario.php" class="btn btn-primary">Volver</a>
                <?php
            }else{
                echo "USUARIO CREADO CORRECTAMENTE";
                ?>
                    <a href="index.php" class="btn btn-primary">Ingresar</a>
                <?php
            }
        }
        // Cerramos la conexion
        pg_close($dbconn);
    ?>
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script> 
</body>
</html>