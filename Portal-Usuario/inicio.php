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
                echo "<a href='login.php'>INICIAR SESION</a>";
                die();
            }
        }else{
            echo "Usted no tiene autorización para entrar a esta pagina, inicie sesión";
            echo "<a href='login.php'>INICIAR SESION</a>";
            die();
        }  

        $nombre = $_SESSION['nombre'];
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
                            12345678901234
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
            <div id="Información">
                <!-- VALORES -->
                <section class="pt-3 bg-mix">
                    <div class="container">
                        <div class="card">
                            <div class="card-body p-1">
                                <div class="row">
                                    <div class="col-lg-4 stat my-3 d-flex">
                                        <div class="mx-auto">
                                            <h6>Monto autorizado</h6>
                                            <h3 class="text-success">$50,000</h3>
                                            <h6>50.50%</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 stat my-1 d-flex">
                                        <div class="mx-auto">
                                            <h5>Monto disponible</h5>
                                            <h2>$50,000</h2>
                                            <h5>50.50%</h5>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 my-3 d-flex">
                                        <div class="mx-auto">
                                            <h6>Saldo a pagar</h6>
                                            <h3 class="text-danger">$50,000</h3>
                                            <h6>50.50%</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- TABLA -->
                <section class="bg-gray">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 my-3">
                                <div class="card rounded-1">
                                    <div class="card-header bg-light">
                                        <h6 class="font-weight-bold mb-0">Número de usuarios de paga</h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>

                                                <th scope="col">#</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Descripción</th>
                                                <th scope="col">Consumo</th>
                                                <th scope="col">Abono</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                                <tr>
                                                <th scope="row">1</th>
                                                <td>01/10/2022</td>
                                                <td>CEMACO</td>
                                                <td>200.00</td>
                                                <td></td>
                                                </tr>
                                                <tr>
                                                <th scope="row">2</th>
                                                <td>01/10/2022</td>
                                                <td>SUPER DEL BARRIO</td>
                                                <td>150.00</td>
                                                <td></td>
                                                </tr>
                                                <tr>
                                                <th scope="row">3</th>
                                                <td>01/10/2022</td>
                                                <td colspan="1" class="">PAGO DE TAREJETA</td>
                                                <td></td>
                                                <td>300.00</td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="table-dark">
                                                <tr>
                                                <th scope="row"></th>
                                                <td>01/10/2022</td>
                                                <td colspan="1" class="">TOTAL</td>
                                                <td>350.00</td>
                                                <td>300.00</td>
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