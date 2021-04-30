<?php
include 'includes/database.php';
session_start();
if (!isset($_SESSION['rol'])) {
    header('location: login.php');
}
$db = new Database();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convenios Nacionales</title>
</head>

<body>
    <?php
    include 'nav_usuario.php';
    ?>

    <div class="container">
        <?php
        if (isset($_POST['ver'])) {
            $id = $_POST['id'];
            $query = $db->connect()->prepare('SELECT * FROM convenios_nacs WHERE id = :id');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $obj = $query->fetchObject();
        ?>

            <br>
            <div class="col-12 col-md-12">
                <form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="row g-3">
                        <div class="col-sm">
                            <input type="number" value="<?php echo $obj->id; ?>" class="form-control" placeholder="Id" aria-label="Id" style="border: 1px solid red;" name="id" id="id" readonly>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" value="<?php echo $obj->nombre; ?>" class="form-control" placeholder="Nombre" aria-label="Nombre" style="border: 1px solid black;" name="nombre" id="nombre" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="row g-3">
                        <div class="col-sm">
                            <input type="number" value="<?php echo $obj->publico; ?>" class="form-control" placeholder="Publico" aria-label="Id" style="border: 1px solid red;" name="publico" id="publico" readonly>
                        </div>
                        <div class="col-sm">
                            <input type="text" value="<?php echo $obj->ciudad; ?>" class="form-control" placeholder="Ciudad" aria-label="City" style="border: 1px solid black;" name="ciudad" id="ciudad" readonly>
                        </div>
                        <div class="col-sm">
                            <input type="number" value="<?php echo $obj->tipo; ?>" class="form-control" placeholder="tipo" aria-label="Id" style="border: 1px solid red;" name="tipo" id="tipo" readonly>
                        </div>
                    </div> <br>
                    <div class="row g-3">
                        <div class="col-sm">
                            <input type="number" value="<?php echo $obj->universidad; ?>" class="form-control" placeholder="universidad" aria-label="Universidad" style="border: 1px solid red;" name="universidad" id="universidad" readonly>
                        </div>
                        <div class="col-sm-7">
                            <input type="number" value="<?php echo $obj->duracion; ?>" class="form-control" placeholder="Duración" aria-label="Nombre" style="border: 1px solid black;" name="duracion" id="duracion" readonly>
                        </div>
                    </div> <br>
                    <center>
                        <input name="detalle" value="<?php echo $obj->detalle; ?>" class="form-control" id="detalle" cols="65" rows="5" style="border: 1px solid black;" readonly>
                        <br>
                        <div style="float:right; margin-bottom:5px;" class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <form action="" method="post">
                                <a href="convenios_nacs_apli.php">
                                    <button type="button" class="btn btn-primary">Cerrar</button>
                                </a>
                            </form>
                        </div>
                    </center>
                </form>
            </div>
        <?php } ?>

        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped border-dark">
                <thead class="thead-dark">
                    <th width="5%">No</th>
                    <th width="10%">Nombre</th>
                    <th width="25%">Detalle</th>
                    <th width="15%">Público</th>
                    <th width="10%">Ciudad</th>
                    <th width="10%">Universidad</th>
                    <th width="10%">Tipo</th>
                    <th width="5%">Duración</th>
                    <th width="10%" colspan="2"></th>
                </thead>
                <tbody>
                    <?php
                    $query = $db->connect()->prepare('SELECT*FROM convenios_nacs');
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) {
                            echo
                            "<tr>
                        <td>" . $result->id . "</td>
                        <td>" . $result->nombre . "</td>
                        <td>" . $result->detalle . "</td>
                        <td>" . $result->publico . "</td>
                        <td>" . $result->ciudad . "</td>
                        <td>" . $result->universidad . "</td>
                        <td>" . $result->tipo . "</td>
                        <td>" . $result->duracion . "</td>
                        <td>
                                    <form method='POST' action='convenios_nacs_apli.php'>
                                    <input type='hidden' name='id' value='" . $result->id . "'>
                                    <button class='btn btn-outline-success' name='ver'>Ver</button>
                                    </form>
                                    </td>

                                    <td>
                                    <form method='POST' action='convenios_nacs_apli.php'>
                                    <input type='hidden' name='id' value='" . $result->id . "'>
                                    <button class='btn btn-outline-primary' name='aplicar'>Aplicar</button>
                                    </form>
                                    </td>

                        </tr>";
                        }
                    } else {
                        echo "<div class='content alert alert-danger'> No hay ningún registro  </div>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <center>
        <p>&copy; <?php echo date("Y"); ?></p>
    </center>
</body>

</html>