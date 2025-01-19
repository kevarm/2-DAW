<?php
// Inicia sesión para acceder a las variables de sesión
session_start();

// Verifica si la sesión está activa
if (!isset($_SESSION["correo"])) {
    // Si no hay sesión activa, redirige al login
    header("location:login.php");
    exit;
}

if (isset($_GET["codigo"])) {
    $categoryId = $_GET['codigo'];
} else {
    echo "No se está recogiendo la id de la categoría";
}

require_once __DIR__ . '\modelo\conexion.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <title>Productos</title>
</head>

<body>
    <nav>
        <div class="nav">
            <?php echo $_SESSION["correo"]; ?>
            <div class="enlaces">
                <a href="inicio.php">Inicio</a>
                <a href="carrito.php">Carrito</a>
                <a href="pedidos.php">Mis pedidos</a>
                <a href="modelo/controlador_cerrar_sesion.php">Salir</a>
            </div>
        </div>
    </nav>

    <img class="wave" src="img/wave.png">

    <ul class="productos">
        <?php

        $conn = createConnection();
        if ($conn === null) {
            echo "<p>Error: No se pudo conectar a la base de datos.</p>";
            exit();
        }

        $resultados = getProducts($conn, $categoryId);
        if ($resultados && count($resultados) > 0) {
            foreach ($resultados as $resultado) {
                echo "<li class='producto'>";
                echo "<h3>" . $resultado['Nombre'] . "</h3>";
                echo "<p>Peso: " . $resultado['Peso'] . "</p>";
                echo "<p>Stock: " . $resultado['CantidadStock'] . "</p>";
                echo "<p>Descripción: " . htmlspecialchars($resultado['Descripcion']) . "</p>";
                echo "</li>";
                echo "<form action='carrito.php' method='POST' style='display:inline'>";
                echo "<input type='hidden' name='nombre' value='" . $resultado['Nombre'] . "'>";
                echo "<label for='cantidad'>Cantidad:</label>";
                echo "<input type='number' name='cantidad' value='1' min='1' max='" . $resultado['CantidadStock'] . "' required>";
                echo "<button type='submit'>Añadir al carrito</button>";
                echo "</form>";
            }
        } else {
            echo "<p>No hay resultados disponibles.</p>";
        }
        ?>
    </ul>


    <script src="js/fontawesome.js"></script>
    <script src="js/main.js"></script>
    <script src="js/main2.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.js"></script>

</body>

</html>