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