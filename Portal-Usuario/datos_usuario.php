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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Mis estilos -->
    <link rel="stylesheet" href="./styles/datos.css">
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
        $contraseña = "";


        $query =     "SELECT * FROM usuario WHERE usuario='$usuario';";
        $result = pg_query($dbconn,$query);
        $filas = pg_num_rows($result);
        if($filas > 0){
            $row = pg_fetch_array($result, NULL, PGSQL_ASSOC);
            $contraseña = $row['contraseña'];
        }
        echo $contraseña;
    ?>
    
    <div class="d-flex">
        <!-- SIDEBAR -->
        <div id="sidebar-container" class="bg-light shadow border border-right">
            <div class="logo mx-auto">
                <img src="./img/amex-logo-white.png" alt="logo" class="mx-auto d-block">
            </div>
            <div class="menu" >
                <div class="d-block px-3 py-1">
                    <a href="./inicio.php" class="btn bg-primary" style="width:80%">Home</a>
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
                    </div>
                    <div class="collapse navbar-collapse mx-10" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                            <div class="container mx-3">
                                <a class="nav-link dropdown-toggle" id="desplegable" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-gear-fill" id="engranaje"></i> 
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="./datos_usuario.php">Perfil</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li style="background-color: red;" class="active"><a class="dropdown-item" href="./logout.php">Cerrar sesion</a></li>
                                </ul>
                            </div>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </nav>
            <!-- Informacón -->
            <div id="Informacion">
                <!-- DATOS-->
                <section class="bg-gray mb-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 mb-3 mt-2">
                                <div class="card rounded-1">
                                    <div class="card-header bg-light">
                                        <h6 class="font-weight-bold mb-0">DATOS DEL USUARIO</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row my-3">
                                                <div class="col-4" style="background-color:red">
                                                    Nombre:
                                                </div>
                                                <div class="col-8" style="background-color:green">
                                                    <?php echo $nombre ?>
                                                </div>
                                            </div>
                                            <div class="row my-3">
                                                <div class="col-4" style="background-color:red">
                                                    Usuario:
                                                </div>
                                                <div class="col-8" style="background-color:green">
                                                    <?php echo $usuario ?>
                                                </div>
                                            </div>
                                            <div class="row my-3">
                                                <div class="col-4">
                                                    Contraseña:
                                                </div>
                                                <div class="col-8">
                                                    <?php 
                                                        echo  "<input type='password' value= '$contraseña' name='password' id='password' disabled>";
                                                    ?>
                                                    <button class="btn btn-primary" type="button" onclick="mostrarContrasena()">Mostrar Contraseña</button>
                                                    
                                                </div>
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
    <script>
        function mostrarContrasena(){
            var tipo = document.getElementById("password");
            if(tipo.type == "password"){
                tipo.type = "text";
            }else{
                tipo.type = "password";
            }
        }
    </script>
</body>
</html>