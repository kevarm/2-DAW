<?php
// Inicia sesión para acceder a las variables de sesión
session_start();

// Verifica si la sesión está activa
if (!isset($_SESSION["correo"])) {
    // Si no hay sesión activa, redirige al login
    header("location:login.php");
    exit;
}

require_once __DIR__ . '\modelo\conexion.php';
if (isset($_GET["id"])) {
    $id_pedidoProducto = $_GET['id'];
} else {
    echo "No se está recogiendo la id del pedido";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <title>Pedidos</title>
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

    <ul class="pedidos">
        <?php
        $conn = createConnection();
        if ($conn === null) {
            echo "<p>Error: No se pudo conectar a la base de datos.</p>";
            exit();
        }

        $query_pedido = "SELECT * FROM pedidoproducto WHERE pedido = :id_pedidoProducto";
        $stmt_pedido = $conn->prepare($query_pedido);
        $stmt_pedido->bindParam(':id_pedidoProducto', $id_pedidoProducto, PDO::PARAM_STR);
        $stmt_pedido->execute();
        $pedidos = $stmt_pedido->fetchAll(PDO::FETCH_ASSOC);

        if ($pedidos === false) {
            echo "No se encontró el pedido seleccionado.";
            exit();
        } else { 
            foreach ($pedidos as $pedido) {
                echo "<li class='pedido'>";
                echo "<p>Cantidad: " .$pedido['Cantidad'] . "</p>";
                echo "<p>Producto: " . $pedido['Producto'] . "</p>";
                echo "</li>";
            }
            echo "<a>Eliminar pedido</a>";
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