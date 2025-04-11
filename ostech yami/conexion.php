<?php
class conexion {
    public static function conectar() {
        define('servidor','localhost');
        define('nombre_bd','ostech');
        define('usuario','root');
        define('password','');
        
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

        try {
            $conexion = new PDO("mysql:host=" . servidor . ";dbname=" . nombre_bd, usuario, password, $opciones);
            return $conexion;
        } catch(Exception $e) {
            die("El error de conexión es: " . $e->getMessage());
        }
    }
}
?>
