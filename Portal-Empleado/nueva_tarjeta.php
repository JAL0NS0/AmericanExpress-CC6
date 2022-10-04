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
    <link rel="stylesheet" href="./styles/inicio.css">
    <link href="styles/carga.css" rel="stylesheet" type="text/css">
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

        include('./DB/db.php');
        $nombre = $_SESSION['nombre'];
        $id = $_SESSION['id'];
        
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
                                <a class="btn btn-danger" href="./logout.php">Cerrar sesion</a>
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
                            <div class="col-lg-8 mb-3 mt-2 mx-auto">
                                <div class="card rounded-1">
                                    <div class="card-body">
                                       <div class="container" >
                                        <div class="row">
                                            <form action="./agregar_tarjeta.php" method="post" onsubmit="return validarTarjeta();">
                                                <legend>NUEVA TARJETA</legend>
                                                <div class="mb-1">
                                                    <label for="usuario" class="form-label">Usuario (Portal-Usuario)</label>
                                                    <input type="text" class="form-control" id="usuario" name="usuario" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="num_tarjeta" class="form-label">NumTarjeta</label>
                                                    <input class="form-control" id= "num_tarjeta" name="num_tarjeta" type="number" required minlength="16">
                                                </div> 
                                                <div class="mb-3">
                                                    <label for="num_seguridad" class="form-label">Num_Seguridad</label>
                                                    <input class="form-control" id= "num_seguridad" name="num_seguridad" type="number" required minlength="3">
                                                </div> 
                                                <div class="mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="generar" name="generar">
                                                        <label class="form-check-label" for="generar">GENERAR NUMERO DE TARJETA Y SEGURIDDAD AUTOMATICAMENTE</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fecha_vencimiento" class="form-label">Fecha vencimiento</label>
                                                    <input class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" type="month" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="monto_autorizado" class="form-label">Monto autorizado (Q.)</label>
                                                    <input class="form-control" id= "monto_autorizado" name="monto_autorizado" type="number" required step="0.01">
                                                </div>       
                                                <button type="submit" class="btn btn-primary">INGRESAR</button>   
                                                <div class="col-12 text-center my-2">
                                                    <a href="./inicio.php" class="btn btn-light">CANCELAR</a>
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
    <!-- Mis scripts -->
    <script src="./js/nueva_tajeta.js"></script>
</body>
</html>