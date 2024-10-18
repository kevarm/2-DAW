<?php

function conectarBD() {
    // Configuración de la conexión a la base de datos
    $servidor = "localhost"; // Cambia si es necesario
    $usuario = "tu_usuario"; // Cambia a tu usuario de la base de datos
    $contrasena = "tu_contraseña"; // Cambia a tu contraseña
    $base_datos = "mi_base_datos"; // Nombre de tu base de datos

    // Crear conexión
    $conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);

    // Comprobar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn; // Retorna la conexión
}
?>