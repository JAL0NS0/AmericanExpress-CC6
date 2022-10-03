<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/carga.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <title>Home-AMERICAN EXPRESS</title>
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
        $usuario = $_SESSION['usuario'];
        $query =     "SELECT numero, m_autorizado, m_disponible FROM public.tarjeta WHERE usuario='$usuario';";
        $result = pg_query($dbconn,$query);
        $filas = pg_num_rows($result);

        if(!$result){
            echo 'ocurrio un error';
            header("Location: index.php?reg=false");
            die();
        }else{
            $row = pg_fetch_array($result, NULL, PGSQL_ASSOC);
            $tarjeta_numero = $row['numero'];
            $m_autorizado = floatval($row['m_autorizado']);
            $m_disponible = floatval($row['m_disponible']);
            $saldo = $m_autorizado-$m_disponible;
        }
    ?>
    
    <div class="d-flex">
        <!-- SIDEBAR -->
        <div id="sidebar-container" class="bg-light shadow border border-right">
            <div class="logo mx-auto">
                <img src="./img/amex-logo-white.png" alt="logo" class="mx-auto d-block">
            </div>
            <div class="menu" >
                <div class="d-block px-3 py-1">
                    <a href="#" class="btn bg-primary" style="width:80%">Home</a>
                </div>
                <a href="#" class="d-block px-3 py-1">
                    <img src="./img/tarjeta/The_Gold_Elite_Credit_Card_American_Express.png" alt="">
                </a>
            </div>
        </div>
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
                        <div id="tarjeta">
                            <?php 
                                echo $tarjeta_numero;
                            ?>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                            <div class="container mx-3">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li style="background-color: red;"><a class="dropdown-item" href="./logout.php">Cerrar sesion</a></li>
                                </ul>
                            </div>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </nav>
            <!-- Informacón -->
            <div id="Informacion">
                <!-- VALORES -->
                <section class="pt-3 bg-mix">
                    <div class="container">
                        <div class="card">
                            <div class="card-body p-1">
                                <div class="row">
                                    <div class="col-lg-4 stat my-3 d-flex">
                                        <div class="mx-auto">
                                            <h6>Monto autorizado</h6>
                                            <h3 class="text-success">
                                                <?php 
                                                    echo "Q.".number_format($m_autorizado, 2);
                                                ?>
                                            </h3>
                                            <h6>
                                                <?php 
                                                    echo number_format($m_autorizado/$m_autorizado*100, 0)."%";
                                                ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 stat my-1 d-flex">
                                        <div class="mx-auto">
                                            <h5>Monto disponible</h5>
                                            <h2>
                                                <?php 
                                                    echo "Q.".number_format($m_disponible, 2);
                                                ?>
                                            </h2>
                                            <h5>
                                                <?php 
                                                    echo number_format($m_disponible/$m_autorizado*100, 0)."%";
                                                ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 my-3 d-flex">
                                        <div class="mx-auto">
                                            <h6>Saldo a pagar</h6>
                                            <h3 class="text-danger">
                                                <?php 
                                                    echo "Q.".number_format($saldo, 2);
                                                ?>
                                            </h3>
                                            <h6>
                                                <?php 
                                                    echo number_format($saldo/$m_autorizado*100, 0)."%";
                                                ?>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- TABLA -->
                <section class="bg-gray mb-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 mb-3 mt-2">
                                <div class="card rounded-1">
                                    <div class="card-header bg-light">
                                        <h6 class="font-weight-bold mb-0">Historial de Tarjeta</h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Descripción</th>
                                                <th scope="col">Consumo (Q)</th>
                                                <th scope="col">Abono (Q)</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                                <?php
                                                    /* OBTENER DATOS DE LOS CONSUMOS */
                                                    $query =     "  SELECT c.fecha, s.nombre, c.monto
                                                                    FROM consumo as c, tienda as s, tarjeta as t
                                                                    WHERE c.tienda_id=s.id and c.numero_tarjeta = t.numero AND c.numero_tarjeta='$tarjeta_numero'
                                                                    ORDER BY fecha DESC;";
                                                    $consumos = pg_query($dbconn,$query);
                                            
                                                    if($consumos){
                                                        $fila_consumo = pg_fetch_array($consumos, NULL, PGSQL_ASSOC);
                                                    }

                                                    /*OBTENER DATOS DE LOS ABONOS */
                                                    $query =     "  SELECT a.fecha,a.id::varchar(20), a.monto
                                                                    FROM abono as a, empleado as e, tarjeta as t
                                                                    WHERE a.empleado_id=e.id AND a.numero_tarjeta=t.numero AND a.numero_tarjeta='$tarjeta_numero' 
                                                                    ORDER BY fecha DESC;";
                                                    $abonos = pg_query($dbconn,$query);
                                            
                                                    if($abonos){
                                                        $fila_abono = pg_fetch_array($abonos, NULL, PGSQL_ASSOC);
                                                    }
                                                    $numeroFila=0;
                                                    $total_consumo=0;
                                                    $total_abono=0;
                                                    
                                                    /* Ordenar y desplegar ABONOS Y CONSUMOS */
                                                   /** Mientras exista un abono o un consumo */ 
                                                    while(($fila_consumo or $fila_abono)){
                                                        $numeroFila= $numeroFila+1;
                                                        /**Si existen abmos */
                                                        if($fila_consumo and $fila_abono){
                                                            /**comparar fecha para ordenar */
                                                            /**Si abono es antes se imprime y se pasa al siguiente abono */
                                                            if( strtotime( $fila_abono['fecha']) >= strtotime($fila_consumo['fecha']) ){
                                                                /*echo "fecha: ".$fila_abono['fecha']." Monto: ".$fila_abono['monto']."<br>";*/
                                                                
                                                                echo "<tr>
                                                                <th scope='row'> $numeroFila</th> 
                                                                <td> ". $fila_abono['fecha'] ." </td>
                                                                <td>Pago de Tarjeta</td>
                                                                <td></td>
                                                                <td> ". $fila_abono['monto'] ."</td>
                                                                </tr>
                                                                <tr>";
                                                                $total_abono=$total_abono+$fila_abono['monto'];

                                                                $fila_abono = pg_fetch_array($abonos, NULL, PGSQL_ASSOC);
                                                            }/**Si consumo es antes se imprime y se pasa al siguiente consumo */
                                                            else{
                                                                /**echo "fecha: ". $fila_consumo['fecha']."  Tienda: ".$fila_consumo['nombre']."  Monto: ".$fila_consumo['monto']."<br>";*/

                                                                echo "<tr>
                                                                <th scope='row'> ".$numeroFila. "</th>
                                                                <td> ".$fila_consumo['fecha'] ."</td>
                                                                <td> ".$fila_consumo['nombre'] ."</td>
                                                                <td> ".$fila_consumo['monto'] ."</td>
                                                                <td></td>
                                                                </tr>
                                                                <tr>";
                                                                $total_consumo = $total_consumo+$fila_consumo['monto'];
                                                                $fila_consumo = pg_fetch_array($consumos, NULL, PGSQL_ASSOC);
                                                            }
                                                        } /**Si solo hay abonos */
                                                        else if($fila_abono){
                                                            /*echo "fecha: ".$fila_abono['fecha']." Monto: ".$fila_abono['monto']."<br>";*/
                                                            echo "<tr>
                                                                <th scope='row'> $numeroFila</th> 
                                                                <td> ". $fila_abono['fecha'] ." </td>
                                                                <td>Pago Tarjeta</td>
                                                                <td></td>
                                                                <td> ". $fila_abono['monto'] ."</td>
                                                                </tr>
                                                                <tr>";
                                                                $total_abono=$total_abono+$fila_abono['monto'];
                                                            $fila_abono = pg_fetch_array($abonos, NULL, PGSQL_ASSOC);
                                                        }/**Si solo hay consumos */
                                                        else if($fila_consumo){
                                                            /**echo "fecha: ". $fila_consumo['fecha']."  Tienda: ".$fila_consumo['nombre']."  Monto: ".$fila_consumo['monto']."<br>";*/
                                                            echo "<tr>
                                                                <th scope='row'> ".$numeroFila. "</th>
                                                                <td> ". $fila_consumo['fecha'] ."</td>
                                                                <td> ".$fila_consumo['nombre'] ."</td>
                                                                <td> ".$fila_consumo['monto'] ."</td>
                                                                <td></td>
                                                                </tr>
                                                                <tr>";
                                                                $total_consumo = $total_consumo+$fila_consumo['monto'];
                                                            $fila_consumo = pg_fetch_array($consumos, NULL, PGSQL_ASSOC);
                                                        }   
                                                    }
                            
                                                ?>
                                                
                                            </tbody>
                                            <tfoot class="table-dark">
                                                <tr>
                                                <th scope="row"></th>
                                                <td><?php echo date('Y-m-d h:i:s', time()) ?></td>
                                                <td colspan="1" class="">TOTAL</td>
                                                <td><?php echo number_format($total_consumo, 2) ?></td>
                                                <td><?php echo number_format($total_abono, 2)?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
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