<?php
include 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = conectarBaseDeDatos();
    if ($conn) {
        $emailUsuario = $_POST['emailUsuario'];
        $contrasenaUsuario = password_hash($_POST['contrasenaUsuario'], PASSWORD_DEFAULT); 
        $nombreCompleto = $_POST['nombreCompleto'] ?? null;
        $telefono = $_POST['telefono'] ?? null;
        $rol = $_POST['rol'];

        $query = "INSERT INTO usuario (emailUsuario, contrasenaUsuario, nombreCompleto, telefono, rol) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Error en la consulta SQL: " . $conn->error);
        }

        $stmt->bind_param("sssss", $emailUsuario, $contrasenaUsuario, $nombreCompleto, $telefono, $rol);

        if ($stmt->execute()) {
            echo "Registro exitoso.";
        } else {
            echo "Error al registrar: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        die("Error al conectar con la base de datos.");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al archivo CSS -->

</head>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form-container {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
        text-align: left;
        /* Para alinear las etiquetas a la izquierda */
    }

    input,
    select,
    button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    input:focus,
    select:focus {
        border-color: #007BFF;
        outline: none;
    }

    button {
        background-color: #007BFF;
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>

<body>
    <header id="header">
        <h1>El Pajar</h1>
        <nav>
            <a href="index.php#inicio">Contenido principal</a>
            <a href="index.php#servicios">Servicios</a>
            <a href="index.php#contacto">Contacto</a>
            <a href="">Registro</a>
        </nav>
    </header>

    <div class="centrado">
        <h2>Registro de cliente</h2>
    </div>
    <div class="centrado">
        <form action="registro.php" method="POST">
            <!-- Campo emailUsuario -->
            <label for="emailUsuario">Correo Electrónico:</label>
            <input type="email" id="emailUsuario" name="emailUsuario" placeholder="Ingrese su correo electrónico" required>

            <!-- Campo contrasenaUsuario -->
            <label for="contrasenaUsuario">Contraseña:</label>
            <input type="password" id="contrasenaUsuario" name="contrasenaUsuario" placeholder="Ingrese su contraseña" required>

            <!-- Campo nombreCompleto -->
            <label for="nombreCompleto">Nombre Completo:</label>
            <input type="text" id="nombreCompleto" name="nombreCompleto" placeholder="Ingrese su nombre completo">

            <!-- Campo telefono -->
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" placeholder="Ingrese su número de teléfono">

            <!-- Campo rol -->
            <label for="rol">Rol:</label>
            <select id="rol" name="rol">
                <option value="cliente" selected>Cliente</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit" class="btn-registrar">Registrar</button>
        </form>
    </div>


</body>

</html>