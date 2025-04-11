<?php
session_start();
include_once 'conexion.php';

$objeto = new conexion();
$conexion = $objeto->conectar();

// Datos recibidos
$email = isset($_POST['email']) ? $_POST['email'] : '';
$contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';

// Encriptación (igual que en la base de datos)
$pass = md5($contraseña);

// Consulta segura con parámetros PDO
$consulta = "SELECT usuarios.id_rol AS id_rol, rol.descripcion AS rol 
             FROM usuarios 
             JOIN rol ON usuarios.id_rol = rol.id 
             WHERE usuarios.email = :email AND usuarios.contraseña = :pass";

$resultado = $conexion->prepare($consulta);
$resultado->bindParam(':email', $email, PDO::PARAM_STR);
$resultado->bindParam(':pass', $pass, PDO::PARAM_STR);
$resultado->execute();

$data = [];

if ($resultado->rowCount() > 0) {
    $fila = $resultado->fetch(PDO::FETCH_ASSOC);

    $_SESSION["s_email"] = $email;
    $_SESSION["s_id_rol"] = $fila["id_rol"];
    $_SESSION["s_rol_descripcion"] = $fila["rol"];

    $respuesta = [
        "status" => "success",
        "rol" => $fila["rol"],
        "redirect" => $fila["id_rol"] == 1 ? "admin/home_admin.php" : "usuarios/home_usuarios.php"
    ];
} else {
    $_SESSION["s_email"] = null;
    $respuesta = null;
}

echo json_encode($respuesta);
$conexion = null;
?>
