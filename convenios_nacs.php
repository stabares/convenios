<?php
include 'includes/database.php';
session_start();
if (!isset($_SESSION['rol'])) {
    header('location: login.php');
} else {
    if ($_SESSION['rol'] != 1) {
        header('location: login.php');
    }
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
    include 'nav_admin.php';
    ?>

    <div class="container">
        <?php
        if (isset($_POST['eliminar'])) {

            //Consulta SQL - DELETE
            $query = $db->connect()->prepare('DELETE FROM `convenios_nacs` WHERE `id`=:id');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $id = trim($_POST['id']);
            $query->execute();

            if ($query->rowCount() > 0) {
                $count = $query->rowCount();
                echo "<div class='content alert alert-primary' > 
                    Gracias: $count registro ha sido eliminado  </div>";
            }
        }
        ?>
        <?php
        // INSERTAR DATOS
        if (isset($_POST['insertar'])) {
            // Informacion enviada por el formulario 
            $nombre = $_POST['nombre'];
            $detalle = $_POST['detalle'];
            $publico = $_POST['publico'];
            $ciudad = $_POST['ciudad'];
            $universidad = $_POST['universidad'];
            $tipo = $_POST['tipo'];
            $duracion = $_POST['duracion'];

            //Consulta SQL
            $query = $db->connect()->prepare('insert into convenios_nacs(nombre,detalle,publico,ciudad,universidad,tipo,duracion) values(:nombre,:detalle,:publico,:ciudad,:universidad,:tipo,:duracion)');

            $query->bindParam(':nombre', $nombre, PDO::PARAM_STR, 25);
            $query->bindParam(':detalle', $detalle, PDO::PARAM_STR, 25);
            $query->bindParam(':publico', $publico, PDO::PARAM_INT);
            $query->bindParam(':ciudad', $ciudad, PDO::PARAM_STR, 25);
            $query->bindParam(':universidad', $universidad, PDO::PARAM_INT);
            $query->bindParam(':tipo', $tipo, PDO::PARAM_INT);
            $query->bindParam(':duracion', $duracion, PDO::PARAM_INT);
            $query->execute();
        }
        ?>

        <?php
        //ACTUALIZAR DATOS
        if (isset($_POST['actualizar'])) {
            // Informacion enviada por el formulario 
            $id = trim($_POST['id']);
            $nombre = trim($_POST['nombre']);
            $detalle = trim($_POST['detalle']);
            $publico = trim($_POST['publico']);
            $ciudad = trim($_POST['ciudad']);
            $universidad = trim($_POST['universidad']);
            $tipo = trim($_POST['tipo']);
            $duracion = trim($_POST['duracion']);

            //Consulta SQL
            $query = $db->connect()->prepare('UPDATE convenios_nacs
            SET `nombre`= :nombre, `detalle` = :detalle, `publico` = :publico, `ciudad` = :ciudad, `universidad` = :universidad, `tipo` = :tipo, `duracion` = :duracion 
            WHERE `id` = :id');

            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->bindParam(':nombre', $nombre, PDO::PARAM_STR, 25);
            $query->bindParam(':detalle', $detalle, PDO::PARAM_STR, 25);
            $query->bindParam(':publico', $publico, PDO::PARAM_INT);
            $query->bindParam(':ciudad', $ciudad, PDO::PARAM_STR);
            $query->bindParam(':universidad', $universidad, PDO::PARAM_INT);
            $query->bindParam(':tipo', $tipo, PDO::PARAM_INT);
            $query->bindParam(':duracion', $duracion, PDO::PARAM_INT);

            $query->execute();

            if ($query->rowCount() > 0) {
                $count = $query->rowCount();
                echo "<div class='content alert alert-primary' > 
                    Gracias: $count registro ha sido actualizado  </div>";
            }
        }
        ?>

        <!-- ---------------------------------------------------------------------------------------------------- -->
        <h3 class="mt-5">Convenios Nacionales UdeM</h3>
        <hr>
        <div class="row">
            <!-- Insertar Registros-->
            <?php if (isset($_POST['formInsertar'])) { ?>
                <div class="col-12 col-md-12">
                    <form method="POST" action="">
                        <div class="row g-3">
                            <div class="col-sm">
                                <input type="number" class="form-control" placeholder="Id" aria-label="Id" style="border: 1px solid red;" name="id" id="id" readonly>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" placeholder="Nombre" aria-label="Nombre" style="border: 1px solid black;" name="nombre" id="nombre" required>
                            </div>
                        </div>
                        <br>
                        <div class="row g-3">
                            <div class="col-sm">
                                <select required name="publico" class="form-control" id="publico">
                                    <?php
                                    $query = $db->connect()->prepare('SELECT * FROM publico');
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                            echo "<option value= " . $result->id . ">" . $result->nombre . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm">
                                <input type="text" required class="form-control" placeholder="Ciudad" aria-label="City" style="border: 1px solid black;" name="ciudad" id="ciudad">
                            </div>
                            <div class="col-sm">
                                <select required name="universidad" class="form-control" id="universidad">
                                    <?php
                                    $query = $db->connect()->prepare('SELECT * FROM universidad');
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                            echo "<option value= " . $result->id . ">" . $result->nombre . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> <br>
                        <div class="row g-3">
                            <div class="col-sm">
                                <select required name="tipo" class="form-control" id="tipo">
                                    <?php
                                    $query = $db->connect()->prepare('SELECT * FROM tipo');
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                            echo "<option value= " . $result->id . ">" . $result->nombre . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" required class="form-control" placeholder="Duración" aria-label="Nombre" style="border: 1px solid black;" name="duracion" id="duracion">
                            </div>
                        </div> <br>
                        <center>
                            <textarea name="detalle" required id="detalle" cols="65" rows="5" placeholder="Detalle" style="border: 1px solid black;"></textarea>
                            <br><br>
                            <div class="form-group">
                                <button name="insertar" type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </center>
                    </form>
                </div>
            <?php }  ?>

            <!-- ----------------------------------------------------------------------------------------------------- -->
            <?php
            if (isset($_POST['editar'])) {
                $id = $_POST['id'];
                $query = $db->connect()->prepare('SELECT * FROM convenios_nacs WHERE id = :id');
                $query->bindParam(':id', $id, PDO::PARAM_INT);
                $query->execute();
                $obj = $query->fetchObject();
            ?>

                <div class="col-12 col-md-12">
                    <form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                        <div class="row g-3">
                            <div class="col-sm">
                                <input required type="number" value="<?php echo $obj->id; ?>" class="form-control" placeholder="Id" aria-label="Id" style="border: 1px solid red;" name="id" id="id" readonly>
                            </div>
                            <div class="col-sm-7">
                                <input required type="text" value="<?php echo $obj->nombre; ?>" class="form-control" placeholder="Nombre" aria-label="Nombre" style="border: 1px solid black;" name="nombre" id="nombre">
                            </div>
                        </div>
                        <br>
                        <div class="row g-3">
                            <div class="col-sm">
                                <select required name="publico" class="form-control" id="publico">
                                    <option value="<?php echo $obj->publico; ?>"><?php echo $obj->publico; ?></option>
                                    <?php
                                    $query = $db->connect()->prepare('SELECT * FROM publico');
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                            echo "<option value= " . $result->id . ">" . $result->nombre . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm">
                                <input type="text" value="<?php echo $obj->ciudad; ?>" class="form-control" placeholder="Ciudad" aria-label="City" style="border: 1px solid black;" name="ciudad" id="ciudad">
                            </div>
                            <div class="col-sm">
                                <select required name="universidad" class="form-control" id="universidad">
                                    <option value="<?php echo $obj->universidad; ?>"><?php echo $obj->universidad; ?></option>
                                    <?php
                                    $query = $db->connect()->prepare('SELECT * FROM universidad');
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                            echo "<option value= " . $result->id . ">" . $result->nombre . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> <br>
                        <div class="row g-3">
                            <div class="col-sm">
                                <select required name="tipo" class="form-control" id="tipo">
                                    <option value="<?php echo $obj->tipo; ?>"><?php echo $obj->tipo; ?></option>
                                    <?php
                                    $query = $db->connect()->prepare('SELECT * FROM tipo');
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                            echo "<option value= " . $result->id . ">" . $result->nombre . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-7">
                                <input type="number" required value="<?php echo $obj->duracion; ?>" class="form-control" placeholder="Duración" aria-label="Nombre" style="border: 1px solid black;" name="duracion" id="duracion">
                            </div>
                        </div> <br>
                        <center>
                            <input name="detalle"  required value="<?php echo $obj->detalle; ?>" class="form-control" id="detalle" cols="65" rows="5"  style="border: 1px solid black;">
                            <br><br>
                            <div class="form-group">
                                <button name="actualizar" type="submit" class="btn btn-primary">Actualizar Registro</button>
                            </div>
                        </center>
                    </form>
                </div>
            <?php } ?>

            <!-- ---------------------------------------------------------------------------------------------- -->
            <div class="col-12 col-md-12">
                <div style="float:right; margin-bottom:5px;" class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <form action="" method="post">
                        <button class="btn btn-primary" name="formInsertar">Nuevo registro</button>
                        <a href="convenios_nacs.php">
                            <button type="button" class="btn btn-primary">Cancelar</button>
                        </a>
                    </form>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered border-dark">
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
                                    <form method='POST' action='convenios_nacs.php'>
                                        <input type='hidden' name='id' value='" . $result->id . "'>
                                        <button class='btn btn-outline-primary' name='editar'>Editar</button>
                                    </form>
                                    </td>

                                    <td>
                                    <form  onsubmit=\"return confirm('Realmente desea eliminar el registro?');\" method='POST' action='convenios_nacs.php'>
                                    <input type='hidden' name='id' value='" . $result->id . "'>
                                    <button class='btn btn-outline-danger' name='eliminar'>Eliminar</button>
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