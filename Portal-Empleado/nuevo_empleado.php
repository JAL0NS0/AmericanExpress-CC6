<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Empleado</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- CSS bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Mis estilos -->
    <link href="styles/carga.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./styles/ingresar_usuario.scss">
</head>
<body>
    <div class="loader"></div>
    <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>

    <div class="container mt-4">
        <div class="row text-center">
            <div class="col-4 titulo mx-auto">
                <h2>NUEVO EMPLEADO</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mx-auto">
                <div >
                    <form class="row g-3 needs-validation" action="guardar_usuario.php" method="POST" novalidate>
                        <div class="col-12">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="col-12">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" required>
                        </div>
                        <div class="col-12">
                            <label for="contraseña" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                        </div>
                        <div class="col-12">
                            <label for="confirmar" class="form-label">Confirmar contraseña</label>
                            <input type="password" class="form-control" id="confirmar" name="confirmar" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">Button</button>
                            <a href="index.php" class="btn btn-light">CANCELAR</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script> 
     <!--Mis scripts  -->
</body>
</html>