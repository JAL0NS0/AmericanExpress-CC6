<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/carga.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <title>Tarjetas-AMERICAN EXPRESS</title>
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
                                            <div class="col-5"><label for="num_tarjeta">Número:</label><input type="number" class="mx-2" name="num_tarjeta" id="num_tarjeta"></div>
                                            <div class="col-5"><label for="nombre">Nombre:</label><input type="text" class="mx-2" name="nombre" id="nombre"></div>
                                            <div class="col-2"><button onclick="buscar();" class="btn btn-primary">Buscar</button></div>
                                        </div>
                                        <div class="row text-center">
                                            <?php
                                                if(isset($_GET["num"]) and isset($_GET['nom'])){
                                                    $numero_tarjeta = $_GET["num"];
                                                    $nombre_tarjeta = $_GET["nom"];
                                                    
                                                    $query= "SELECT t.numero,t.vencimiento,t.num_seg,t.m_autorizado,t.m_disponible, u.usuario
                                                            FROM tarjeta as t, usuario as u 
                                                            WHERE t.numero = '$numero_tarjeta' 
                                                                and u.nombre='$nombre_tarjeta';";
                                                    $result=pg_query($dbconn,$query);
                                                    $filas = pg_num_rows($result);
                                                    if($filas > 0){
                                                        $row = pg_fetch_array($result, NULL, PGSQL_ASSOC);
                                                        $num_seguridad = $row["num_seg"];
                                                        $vencimiento = $row["vencimiento"];
                                                        $m_autorizado = $row["m_autorizado"];
                                                        $m_disponible = $row["m_disponible"];
                                                        $usuario = $row["usuario"];
                                                        $saldo = floatval($m_autorizado)-floatval($m_disponible);

                                                        $_SESSION['numero_tarjeta']=$numero_tarjeta;
                                                        $_SESSION['nombre_tarjeta']=$nombre_tarjeta;
                                                        $_SESSION['m_disponible']=$m_disponible;
                                                        $_SESSION['saldo']=$saldo;

                                                        echo "<div class='container mx-auto my-4'>
                                                                <div class='row my-1'>
                                                                    <div class='col-4'>Número de tarjeta:</div>
                                                                    <div class='col-8'>$numero_tarjeta</div>
                                                                </div>
                                                                <div class='row my-1'>
                                                                    <div class='col-4'>Nombre propietario:</div>
                                                                    <div class='col-8'>$nombre_tarjeta</div>
                                                                </div>

                                                                <div class='row my-1'>
                                                                    <div class='col-4'>Nombre usuario:</div>
                                                                    <div class='col-8'>$usuario</div>
                                                                </div>";
                                                        if(!strncasecmp($nombre, 'Admin', 5)){
                                                            echo "<div class='row my-1'>
                                                                        <div class='col-4'>Numero de seguridad:</div>
                                                                        <div class='col-8'>$num_seguridad</div>
                                                                    </div>";
                                                        };                                                        
                                                        echo "  
                                                                <div class='row my-1'>
                                                                    <div class='col-4'>Fecha de vencimiento:</div>
                                                                    <div class='col-8'>$vencimiento</div>
                                                                </div>
                                                                <div class='row my-1'>
                                                                    <div class='col-4'>Monto Autorizado</div>
                                                                    <div class='col-8'>$m_autorizado</div>
                                                                </div>
                                                                <div class='row my-1'>
                                                                    <div class='col-4'>Monto Disponible:</div>
                                                                    <div class='col-8'>$m_disponible</div>
                                                                </div>
                                                                <div class='row my-1'>
                                                                    <div class='col-4'>Saldo:</div>
                                                                    <div class='col-8'>$saldo</div>
                                                                </div>
                                                            </div>";

                                                        echo "<div class='row my-1 text-center'>
                                                                    <div class='col-4 mx-auto text-center'><a href='nuevo_abono.php' class='btn btn-success'>REALIZAR ABONO</a></div>
                                                                </div>";
                                                    }else{
                                                        echo "<div class='container mx-auto my-4'>
                                                                <div class='row text-center'>
                                                                    <div class='col-12 mx-auto text-center'>No existe información de la tarjeta</div>
                                                                </div>
                                                            </div>";
                                                    }
                                                }
                                            ?>
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
    <script src="./js/tarjetas.js"></script>
</body>
</html>