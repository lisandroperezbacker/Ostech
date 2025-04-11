<?php
session_start();

if($_SESSION["s_email"] === null){
    header("location: ../login.html");
    exit;
} else {
    if($_SESSION["s_id_rol"] != 1){
        header("location: ../usuarios/home_usuarios.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h1>¡Hola, administrador!</h1>
</body>
</html>
