<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
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
        background: rgb(218, 185, 124);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
        text-align: center;
        box-shadow: none;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
        text-align: left;
    }

    input,
    button {
        width: 80%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    input:focus {
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

    .error {
        color: red;
        font-size: 14px;
        margin-bottom: 10px;
        text-align: center;
    }
</style>

<body>
    <header id="header">
        <h1>El Pajar</h1>
        <nav>
            <a href="index.php#inicio">Contenido principal</a>
            <a href="index.php#servicios">Servicios</a>
            <a href="index.php#contacto">Contacto</a>
            <a href="iniciarSesion.php">Iniciar sesión</a>
        </nav>
    </header>

    <div class="form-container">
        <h2>Iniciar Sesión</h2>
        <form action="iniciarSesion.php" method="POST">
            <label for="emailUsuario">Correo Electrónico:</label>
            <input type="email" id="emailUsuario" name="emailUsuario" placeholder="Ingrese su correo electrónico" required>

            <label for="contrasenaUsuario">Contraseña:</label>
            <input type="password" id="contrasenaUsuario" name="contrasenaUsuario" placeholder="Ingrese su contraseña" required>

            <button type="submit" class="btn-iniciar">Iniciar Sesión</button>
        </form>

        <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['emailUsuario'], $_POST['contrasenaUsuario'])) {
        include 'conexion.php';
        $conexion = conectarBaseDeDatos();
        
        // Verificar si la conexión fue exitosa
        if (!$conexion) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        $email = $_POST['emailUsuario'];
        $contraseña = $_POST['contrasenaUsuario'];
        
        // Consulta SQL
        $sql = "SELECT contrasenaUsuario, rol, usuarioID FROM usuario WHERE emailUsuario = ?";
        $stmt = $conexion->prepare($sql);

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt === false) {
            die("Error en la consulta SQL: " . $conexion->error);
        }

        // Preparar y ejecutar la consulta
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($contraseñaDB, $rol, $usuarioID);
            $stmt->fetch();
        
            // Verificar la contraseña
            if ($contraseña === $contraseñaDB) {
                session_start();
                $_SESSION['emailUsuario'] = $email;
                $_SESSION['rol'] = $rol;
                $_SESSION['usuarioID'] = $usuarioID;
                echo "Inicio de sesión exitoso. Rol: $rol";
            } else {
                echo "<p class='error'>Contraseña incorrecta.</p>";
            }
        } else {
            echo "<p class='error'>Correo no registrado.</p>";
        }
        
        $stmt->close();
        $conexion->close();
    } else {
        echo "<p class='error'>Por favor, completa todos los campos.</p>";
    }
}
?>

    </div>
</body>

</html>