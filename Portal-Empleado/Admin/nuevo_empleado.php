<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/carga.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <title>Nueva Tarjeta-AMERICAN EXPRESS</title>
    <!-- CSS bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Mis estilos -->
    <link rel="stylesheet" href="../styles/inicio.css">
    <link href="../styles/carga.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="loader"></div>
    <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>

    <?php
        session_start();

        if(isset($_SESSION['nombre'])){ 
            $nombre = $_SESSION['nombre'];
            if($nombre === null || $nombre = ''){
                echo "Usted no tiene autorización para entrar a esta pagina, inicie sesión";
                echo "<a href='index.php'>INICIAR SESION</a>";
                die();
            }
        }else{
            echo "Usted no tiene autorización para entrar a esta pagina, inicie sesión";
            echo "<a href='index.php'>INICIAR SESION</a>";
            die();
        }  

        include('../DB/db.php');
        $nombre = $_SESSION['nombre'];
        $id = $_SESSION['id'];
        
        $query= "SELECT * FROM empleado;";
        $result = pg_query($dbconn,$query);        
        $filas = pg_num_rows($result);
        $id=1;
        if($filas > 0){
            $query= "SELECT MAX(id) FROM empleado";
            $result = pg_query($dbconn,$query);
            $row = pg_fetch_array($result, NULL, PGSQL_ASSOC);
            $id= intval($row['max'])+1;
        }
    ?>
    
    <div class="d-flex">
        <!--CONTENIDO -->
        <div class="w-100 bg-gray">
            <!--ENCABEZADO -->
            <nav class="navbar navbar-expand-lg bg-light border-bottom" id="encabezado_info">
                <div class="container-fluid">
                    <div class="container text-center" id="nombre_tarjeta">
                        <div id="nombre_cabecera">
                            <?php 
                                echo $nombre;
                            ?>
                        </div>
                    </div>
                    <div class="container text-center" id="cerrar_sesion">
                        <div class="container mx-3">
                                <a class="btn btn-danger" href="../logout.php">Cerrar sesion</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Informacón -->
            <div id="Informacion">
                <!-- TABLA -->
                <section class="bg-gray mb-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 mb-3 mt-2">
                                <div class="card rounded-1">
                                    <div class="card-header bg-light">
                                        <h6 class="font-weight-bold mb-0">NUEVO EMPLEADO</h6>
                                    </div>
                                    <div class="card-body">
                                       <div class="container" >
                                        <div class="row">
                                            <form action="./guardar_empleado.php" method="post">
                                                <?php
                                                    if(isset($_GET["res"])){
                                                        if($_GET["res"]=="false"){
                                                            ?><div class="alert alert-danger" role="alert">Datos incorrectos!
                                                            </div>
                                                            <?php 
                                                        }
                                                    }
                                                ?>
                                                <legend>NUEVO EMPLEADO</legend>
                                                <div class="mb-1">
                                                    <label for="id" class="form-label">ID</label>
                                                    <input type="number" class="form-control" id="id" name="id" value= "<?php echo $id ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nombre" class="form-label">Nombre</label>
                                                    <input class="form-control" id= "nombre" name="nombre" type="text">
                                                </div>  
                                                <div class="mb-3">
                                                    <label for="contraseña" class="form-label">Contraseña</label>
                                                    <input class="form-control" id= "contraseña" name="contraseña" type="password">
                                                </div>        
                                                <button type="submit" class="btn btn-primary">INGRESAR</button>   
                                                <div class="col-12 text-center my-2">
                                                    <a href="../inicio.php" class="btn btn-light">CANCELAR</a>
                                                </div>       
                                            </form> 
                                        </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


        </div>
    </div>
    
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>