<?php
function conectarBaseDeDatos()
{
    // Configuración de la conexión
    $servidor = "localhost"; 
    $usuario = "root"; 
    $contraseña = "1234"; 
    $baseDeDatos = "elpajar";

    // Crear la conexión
    $conexion = new mysqli($servidor, $usuario, $contraseña, $baseDeDatos);
    $conexion->set_charset("utf8"); // Asegúrate de usar el charset adecuado
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error al conectar con la base de datos: " . $conexion->connect_error);
    }

    if (!$conexion) {
        die("Error al conectar con la base de datos");
    }

    return $conexion;
}
