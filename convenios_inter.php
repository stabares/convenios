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
    <title>Convenios internacionales</title>
</head>

<body>
    <?php
    include 'nav_admin.php';
    ?>

    <div class="container">
        <?php
        if (isset($_POST['eliminar'])) {

            //Consulta SQL
            $query = $db->connect()->prepare('DELETE FROM `convenios_inter` WHERE `id`=:id');
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
        if (isset($_POST['insertar'])) {
            // Informacion enviada por el formulario 
            $nombre = $_POST['nombre'];
            $detalle = $_POST['detalle'];
            $publico = $_POST['publico'];
            $pais = $_POST['pais'];
            $ciudad = $_POST['ciudad'];
            $universidad = $_POST['universidad'];
            $tipo = $_POST['tipo'];
            $duracion = $_POST['duracion'];

            //Consulta SQL
            $query = $db->connect()->prepare('insert into convenios_inter(nombre,detalle,publico,pais,ciudad,universidad,tipo,duracion) values(:nombre,:detalle,:publico,:pais,:ciudad,:universidad,:tipo,:duracion)');

            $query->bindParam(':nombre', $nombre, PDO::PARAM_STR, 25);
            $query->bindParam(':detalle', $detalle, PDO::PARAM_STR, 25);
            $query->bindParam(':publico', $publico, PDO::PARAM_INT);
            $query->bindParam(':pais', $pais, PDO::PARAM_STR, 25);
            $query->bindParam(':ciudad', $ciudad, PDO::PARAM_STR, 25);
            $query->bindParam(':universidad', $universidad, PDO::PARAM_INT);
            $query->bindParam(':tipo', $tipo, PDO::PARAM_INT);
            $query->bindParam(':duracion', $duracion, PDO::PARAM_INT);
            $query->execute();
        }
        ?>

        <?php
        if (isset($_POST['actualizar'])) {
            // Informacion enviada por el formulario 
            $id = trim($_POST['id']);
            $nombre = trim($_POST['nombre']);
            $detalle = trim($_POST['detalle']);
            $publico = trim($_POST['publico']);
            $pais = trim($_POST['pais']);
            $ciudad = trim($_POST['ciudad']);
            $universidad = trim($_POST['universidad']);
            $tipo = trim($_POST['tipo']);
            $duracion = trim($_POST['duracion']);

            //Consulta SQL
            $query = $db->connect()->prepare('UPDATE convenios_inter
            SET `nombre`= :nombre, `detalle` = :detalle, `publico` = :publico, `pais` = :pais, `ciudad` = :ciudad, `universidad` = :universidad, `tipo` = :tipo, `duracion` = :duracion 
            WHERE `id` = :id');

            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->bindParam(':nombre', $nombre, PDO::PARAM_STR, 25);
            $query->bindParam(':detalle', $detalle, PDO::PARAM_STR, 25);
            $query->bindParam(':publico', $publico, PDO::PARAM_INT);
            $query->bindParam(':pais', $pais, PDO::PARAM_STR, 25);
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
        <h3 class="mt-5">Convenios Internacionales UDeM </h3>
        <hr>
        <div class="row">
            <!-- Insertar Registros-->
            <?php
            if (isset($_POST['formInsertar'])) { ?>
                <div class="col-12 col-md-12">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="form-group col">
                                <label for="nombre">Nombre</label>
                                <input name="nombre" type="text" class="form-control" placeholder="nombre" style="border: 1px solid red;">
                            </div>
                            <div class="form-group col">
                                <label for="detalle">Detalle</label>
                                <input name="detalle" type="text" class="form-control" id="detalle" placeholder="detalle">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="publico">Publico</label>
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
                            <div class="form-group col">
                                <label for="pais">Pais</label>
                                <select required name="pais" class="form-control" id="pais">
                                    <option value="Argentina">Argentina</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Brasil">Brasil</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Chile">Chile</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="ciudad">Ciudad</label>
                                <input name="ciudad" type="text" class="form-control" placeholder="ciudad">
                            </div>
                            <div class="form-group col">
                                <label for="duracion">Duración</label>
                                <input name="duracion" type="number" class="form-control" id="duracion" placeholder="duracion">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="universidad">Universidad</label>
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
                            <div class="form-group col">
                                <label for="tipo">Tipo</label>
                                <select required name="tipo" class="form-control" id="tipo">
                                <?php
                                    $query = $db->connect()->prepare('SELECT * FROM tipo');
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {                                            
                                            echo "<option value= " .$result->id. ">" . $result->nombre . "</option>";                                         
                                       }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <button name="insertar" type="submit" class="btn btn-primary  btn-block">Guardar</button>
                        </div>
                    </form>
                </div>
            <?php }  ?>
            <!-- Fin Insertar Registros-->

            <?php
            if (isset($_POST['editar'])) {
                $id = $_POST['id'];
                $query = $db->connect()->prepare('SELECT * FROM convenios_inter WHERE id = :id');
                $query->bindParam(':id', $id, PDO::PARAM_INT);
                $query->execute();
                $obj = $query->fetchObject();
            ?>
                <div class="col-12 col-md-12">
                    <form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                        <input value="<?php echo $obj->id; ?>" name="id" type="hidden">
                        <div class="row">
                            <div class="form-group col">
                                <label for="nombre">Nombre</label>
                                <input value="<?php echo $obj->nombre; ?>" name="nombre" type="text" class="form-control" placeholder="nombre">
                            </div>
                            <div class="form-group col">
                                <label for="detalle">Detalle</label>
                                <input value="<?php echo $obj->detalle; ?>" name="detalle" type="text" class="form-control" id="detalle" placeholder="detalle">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="publico">Publico</label>
                                <select required name="publico" class="form-control" id="publico">
                                    <option value="<?php echo $obj->publico; ?>"><?php echo $obj->publico; ?></option>
                                    <?php
                                    $query = $db->connect()->prepare('SELECT * FROM publico');
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {                                            
                                            echo "<option value= " .$result->id. ">" . $result->nombre . "</option>";                                         
                                       }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="pais">Pais</label>
                                <select required name="pais" class="form-control" id="pais">
                                    <option value="<?php echo $obj->pais; ?>"><?php echo $obj->pais; ?></option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Brasil">Brasil</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Chile">Chile</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="ciudad">Ciudad</label>
                                <input value="<?php echo $obj->ciudad; ?>" name="ciudad" type="text" class="form-control" placeholder="ciudad">
                            </div>
                            <div class="form-group col">
                                <label for="duracion">Duracion</label>
                                <input value="<?php echo $obj->duracion; ?>" name="duracion" type="number" class="form-control" id="duracion" placeholder="duracion">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="universidad">Universidad</label>
                                <select required name="universidad" class="form-control" id="universidad">
                                    <option value="<?php echo $obj->universidad; ?>"><?php echo $obj->universidad; ?></option>
                                    <?php
                                    $query = $db->connect()->prepare('SELECT * FROM universidad');
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {                                            
                                            echo "<option value= " .$result->id. ">" . $result->nombre . "</option>";                                         
                                       }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="tipo">Tipo</label>
                                <select required name="tipo" class="form-control" id="tipo">
                                    <option value="<?php echo $obj->tipo; ?>"><?php echo $obj->tipo; ?></option>
                                    <?php
                                    $query = $db->connect()->prepare('SELECT * FROM tipo');
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {                                            
                                            echo "<option value= " .$result->id. ">" . $result->nombre . "</option>";                                         
                                       }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <button name="actualizar" type="submit" class="btn btn-primary  btn-block">Actualizar Registro</button>
                        </div>
                    </form>
                </div>
            <?php } ?>
            <div class="col-12 col-md-12">
                <!-- Contenido -->

                <div style="float:right; margin-bottom:5px;">
                    <form action="" method="post">
                        <button class="btn btn-primary" name="formInsertar">Nuevo registro</button>
                        <a href="convenios_inter.php">
                            <button type="button" class="btn btn-primary">Cancelar</button>
                        </a>
                    </form>
                </div> <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped border-dark">
                        <thead class="thead-dark">
                            <th width="5%">Id</th>
                            <th width="10%">Nombre</th>
                            <th width="15%">Detalle</th>
                            <th width="10%">Público</th>
                            <th width="10%">País</th>
                            <th width="10%">Ciudad</th>
                            <th width="10%">Universidad</th>
                            <th width="10%">Tipo</th>
                            <th width="5%">Duración</th>
                            <th width="10%" colspan="2"></th>
                        </thead>
                        <tbody>
                            <?php
                            $query = $db->connect()->prepare('SELECT * FROM convenios_inter');
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {
                                    echo "<tr>
                                    <td>" . $result->id . "</td>
                                    <td>" . $result->nombre . "</td>
                                    <td>" . $result->detalle . "</td>
                                    <td>" . $result->publico . "</td>
                                    <td>" . $result->pais . "</td>
                                    <td>" . $result->ciudad . "</td>
                                    <td>" . $result->universidad . "</td>
                                    <td>" . $result->tipo . "</td>
                                    <td>" . $result->duracion . "</td>

                                    <td>
                                    <form method='POST' action='convenios_inter.php'>
                                    <input type='hidden' name='id' value='" . $result->id . "'>
                                    <button class='btn btn-outline-primary' name='editar'>Editar</button>
                                    </form>
                                    </td>

                                    <td>
                                    <form  onsubmit=\"return confirm('Realmente desea eliminar el registro?');\" method='POST' action='convenios_inter.php'>
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
    </div>
    </div>
    </div>
    <!-- Fin container -->
    <footer class="footer">
        <div class="container"> <span class="text-muted">
            </span> </div>
    </footer>

   
    <script src="dist/js/bootstrap.min.js"></script>
</body>

</html>