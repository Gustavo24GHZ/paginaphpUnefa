<?php 
    session_start();

    $mysql = new mysqli("localhost", "root","", "escuela1bd");

$nombres_est = $_POST['nombres_est'];
$apellidos_est = $_POST['apellidos_est'];
$cedula_est = $_POST['cedula_est'];
$correo_est = $_POST['correo_est'];
$telefono_est = $_POST['telefono_est'];

    if ((isset($nombres_est)) == null OR (isset($apellidos_est))  OR (isset($cedula_est)) OR (isset($correo_est)) OR (isset($telefono_est))) {
    echo '<script>alert("Por favor, complete todos los campos");window.location.href="agregar_estudiante.php";</script>';
    } else {
        $insercion = "INSERT estudiantes SET nombres='$nombres_est', apellidos='$apellidos_est', cedula='$cedula_est', correo='$correo_est', telefono='$telefono_est'";

    $resultado = $mysql->query($insercion);

        if($resultado) {
    echo '<script>alert("Estudiante agregado correctamente");window.location.href="agregar_estudiante.php";</script>';
    } else {
    echo '<script>alert("Error al agregar el estudiante");window.location.href="agregar_estudiante.php";</script>';    

    } 
        }

$mysql->close();

?>
