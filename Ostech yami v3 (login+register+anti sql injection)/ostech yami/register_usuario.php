<?php
include_once 'conexion.php';

$objeto = new conexion();
$conexion = $objeto->conectar();

// Datos recibidos desde el formulario
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$contraseña = isset($_POST['contraseña']) ? trim($_POST['contraseña']) : '';

// Encriptar la contraseña (igual que en login)
$pass = md5($contraseña);

// Puedes asignar un rol por defecto, por ejemplo: 2 = usuario común
$id_rol = 2;

// Verificar que no exista el usuario previamente
$verificar = "SELECT id FROM usuarios WHERE email = :email";
$stmt = $conexion->prepare($verificar);
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    // Usuario ya existe
    $respuesta = [
        "status" => "error",
        "message" => "El correo ya está registrado."
    ];
} else {
    // Insertar el nuevo usuario
    $insertar = "INSERT INTO usuarios (nombre, apellido, telefono, email, contraseña, id_rol) 
                 VALUES (:nombre, :apellido, :telefono, :email, :pass, :id_rol)";
    
    $stmt = $conexion->prepare($insertar);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pass', $pass);
    $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $respuesta = [
            "status" => "success",
            "message" => "Registro exitoso. Ahora puedes iniciar sesión."
        ];
    } else {
        $respuesta = [
            "status" => "error",
            "message" => "Error al registrar el usuario."
        ];
    }
}

echo json_encode($respuesta);
$conexion = null;
?>
