<?php
session_start();

if($_SESSION["s_usuario"] === null){
    header("location: /home_admin.php");
    exit;
} else {
    if($_SESSION["s_id_rol"] != 1){
        header("location: ../usuarios/home_usuarios.php");
        exit;
    }
}
?>