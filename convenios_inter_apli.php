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
    <title>Convenios internacionales</title>
</head>

<body>
    <?php
    include 'nav_usuario.php';
    ?>
    <h3 class="mt-5">Convenios Internacionales UDeM </h3>
    <hr>
    <div class="container">

        <br>
        <div class="table-responsive">
            <table class="table table-bordered border-dark">
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
                                    <button class='btn btn-outline-success' name='aplicar'>Aplicar</button>
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

    <!-- Fin container -->
    <footer class="footer">
        <div class="container"> <span class="text-muted">
            </span> </div>
    </footer>


    <script src="dist/js/bootstrap.min.js"></script>
</body>

</html>