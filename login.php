<?php
include_once 'includes/database.php';
include 'estilo.php';

session_start();
//VERIFICA SESIONES INICIADAS
if (isset($_GET['cerrar_sesion'])) {
    session_unset();
    session_destroy();
}

//VERIFICA EL ROL
if (isset($_SESSION['rol'])) {
    switch ($_SESSION['rol']) {
        case 1:
            header('location: admin.php');
            break;
        case 2:
            header('location: estudiante.php');
            break;
        case 3:
            header('location: docente.php');
            break;
        default:
            break;
    }
}


if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $db = new Database();
    $query = $db->connect()->prepare('SELECT*FROM usuarios WHERE usuario = :usuario AND clave = :clave ');
    $query->execute(['usuario' => $usuario, 'clave' => $clave]);

    $query2 = $db->connect()->prepare('SELECT*FROM usuarios WHERE usuario = :usuario');
    $query2->execute(['usuario' => $usuario]);

    if ($query->rowCount() > 0) {
        $row = $query->fetch(PDO::FETCH_NUM);
        if ($row == true) {
            //Validamos el rol
            $rol = $row[2];
            $_SESSION['rol'] = $rol;
        } else {
            echo '<p class="badge bg-primary text-wrap text-center" style="margin-left: 42.5%;">Usuario o contraseña incorrectos </p>';
        }
    } else {
        echo '<p class="badge bg-primary text-wrap text-center" style="margin-left: 42.5%;">El usuario no existe </p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Login</title>
</head>

<body>
    <form action="#" method="POST" style="border-radius: 5px; border: 3px double black; background: linear-gradient(to right, #12c2e9, #c471ed, #f64f59);">
        <div style="border: 3px double black; background-color: white; border-radius: 5px">
            <center>
                <br>
                <input type="text" name="usuario" placeholder="Usuario" minlength="5" required><br /> <br>
                <input type="password" name="clave" placeholder="Clave" maxlength="12" required><br />
                <br>
                <input type="submit" class="btn btn-danger fw-bold" value="Iniciar Sesión">
                <br> <br>
            </center>
        </div>
    </form>
</body>

</html>