<?php
//VERIFICAR SESIÓN INICIADA Y EL TIPO DE ROL
session_start();
if (!isset($_SESSION['rol'])) {
    header('location: login.php');
} else {
    if ($_SESSION['rol'] != 1) {
        header('location: login.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Administrador</title>

</head>

<body>
    <?php
    include 'nav_admin.php';
    ?>
    <div class="container" style="margin-top: 5%;">
        <div class="row">
            <div class="col-sm-4">
                <div class="card border-warning mb-3" style="max-width: 18rem;">
                    <div class="card-header bg-warning text-black fw-bold"> <a href=""><i class="fa fa-plus-circle" style="color:white;"></i></a> Tareas pendientes</div>
                    <div class="card-body">
                        <p class="card-text"><i class="fa fa-square-o"></i> Revisar solicitutes</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card  border-success mb-3" style="max-width: 18rem;">
                    <div class="card-header text-white bg-success fw-bold"><a href=""><i class="fa fa-plus-circle" style="color:white;"></i></a> Tareas Completadas</div>
                    <div class="card-body">
                        <p class="card-text"><i class="fa fa-check-square-o"></i> Cambiar fechas de aplicación </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card  border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header text-white bg-dark fw-bold"><a href=""><i class="fa fa-plus-circle" style="color:white;"></i></a> Tareas en Proceso</div>
                    <div class="card-body">
                        <p class="card-text"> <i class="fa fa-minus-square-o"></i> Enviar carta a decanatura</p>
                    </div>
                </div>
            </div>
        </div> <br>
        <div class="row">
            <div class="col-sm-4">
                <div class="card border-danger mb-3" style="max-width: 18rem;">
                    <div class="card-header text-white bg-danger fw-bold"><a href=""><i class="fa fa-plus-circle" style="color:white;"></i></a> Por verificar</div>
                    <div class="card-body">
                        <p class="card-text"><li>Verificar documentos</li></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-secondary mb-3" style="max-width: 18rem;">
                    <div class="card-header text-white bg-secondary fw-bold"><a href=""><i class="fa fa-plus-circle" style="color:white;"></i></a> Otros</div>
                    <div class="card-body">
                        <p class="card-text"><li> </li></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-secondary mb-3" style="max-width: 18rem;">
                    <div class="card-header text-white bg-secondary fw-bold"><a href=""><i class="fa fa-plus-circle" style="color:white;"></i></a> Notificar</div>
                    <div class="card-body">
                        <p class="card-text"><li>Enviar correos de notificación</li></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>