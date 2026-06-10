<?php
    session_start();

    $mysql = new mysqli("localhost", "root","", "escuela1bd");

    $consulta = "SELECT * FROM estudiantes";
    $resultado = $mysql->query($consulta);
    $filas= $resultado->fetch_all(MYSQLI_ASSOC);

    if (isset($_POST['busqueda'])) {
        $termino_busqueda = $mysql->real_escape_string($_POST['busqueda']);


    $consulta_buscar = "SELECT * FROM estudiantes WHERE (nombres LIKE '%$termino_busqueda%')";

    $resultado_busqueda = $mysql->query($consulta_buscar);
    $filas_busqueda= $resultado_busqueda->fetch_all(MYSQLI_ASSOC);

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/estilos.css">

</head>
<body style="background-color: lightgray;">
            <ul class="nav justify-content-end bg-primary">
        <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="estudiantes.php">Estudiantes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">Profesores</a>
        </li>
        <li class="nav-item">
            <a href="../logout.php" class="nav-link text-white">Cerrar Sesion(<?php echo $_SESSION['nombre_usu'];?>)</a>
        </li>
        </ul>

        <div class="container text-center mt-3">
            <h1>Lista de Estudiantes</h1>
        </div>

        <div class="container mt-4">

            <div class="card">
                <div class="card-header">
                <div class="container text-center">
                        <div class="row">
                            <div class="col">
                            <a href="agregar_estudiante.php"><button class="btn btn-primary">Agregar Estudiante</button></a>
                        </div>
                        <div class="col">
                            <form action="estudiantes.php" method="post">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="escribe para buscar..." name="busqueda" aria-describedby="basic-addon1">
                                    <button class="btn btn-success" type="submit">Buscar</button>
                                </div>
                            </form>
                        </div>
                        <div class="col">
                        <?php echo $_POST['busqueda']; ?>
                        </div>
                    </div>
</div>

                </div>
                <div class="card-body table_scroll">
                    <table class="table table-sm text-center">
                        <thead>
                            <tr class="table-primary text-white">
                                <th>#</th>
                                <th>NOMBRES</th>
                                <th>APELLIDOS</th>
                                <th>CEDULA</th>
                                <th>TELEFONO</th>
                                <th>CORREO</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            if (isset($_POST['busqueda'])) {
                            $num = 1;
                            foreach ($filas_busqueda as $fila_busqueda) {
                            ?>

                            <tr>
                                <td><?php echo $num++; ?></td>
                                <td><?php echo $fila_busqueda['nombres']; ?></td>
                                <td><?php echo $fila_busqueda['apellidos']; ?></td>
                                <td><?php echo $fila_busqueda['cedula']; ?></td>
                                <td><?php echo $fila_busqueda['telefono']; ?></td>
                                <td><?php echo $fila_busqueda['correo']; ?></td>
                                <td>
                                    <button type="button"class="btn  btn-warning">Editar</button>
                                </td>
                            </tr>
                            <?php
                        }
                            }else {
                            
                            $num = 1;
                            foreach ($filas as $fila) {
                            ?>

                            <tr>
                                <td><?php echo $num++; ?></td>
                                <td><?php echo $fila['nombres']; ?></td>
                                <td><?php echo $fila['apellidos']; ?></td>
                                <td><?php echo $fila['cedula']; ?></td>
                                <td><?php echo $fila['telefono']; ?></td>
                                <td><?php echo $fila['correo']; ?></td>
                                <td>
                                    <button type="button"class="btn  btn-warning">Editar</button>
                                </td>
                            </tr>

                            <?php
                            }
                            
                            }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>