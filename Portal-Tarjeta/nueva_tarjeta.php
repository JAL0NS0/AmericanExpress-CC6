<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <title>Portal Tarjeta</title>
    <!-- CSS bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Mis estilos -->
    <link rel="stylesheet" href="./styles/index.css">
    <link href="styles/carga.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="loader"></div>
    <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>
    <?php include("DB/db.php");
        session_start()
    ?>    
    <nav class="navbar bg-light">
        <div class="container logo">
            <img src="./img/amex-logo-white.png" class="centrar" alt="logo" height="100">
        </div>
    </nav>

    <div class="container my-4">
        <center>
        <div class="col-4 py-4">
            <legend>CREAR NUEVA TARJETA</legend>
                    <div class="mb-3" >
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario">
                    </div>

                    <div class="mb-3">
                        <label for="tarjeta" class="form-label">Fecha de Vencimiento</label>
                        <input type="number" class="form-control" id="vencimiento" name="vencimiento">
                    </div>

                    <div class="mb-3">
                        <label for="tarjeta" class="form-label">Monto</label>
                        <input type="number" class="form-control" id="m_autorizado" name="m_autorizado">
                    </div>
        </div>
        </center>
     
    </div>
    
    
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>