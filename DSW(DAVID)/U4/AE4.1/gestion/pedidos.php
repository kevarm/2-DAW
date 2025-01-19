<?php
// Iniciar sesión y conexión a la base de datos
session_start();

$host = "localhost";  
$dbname = "elPajar";
$username = "root";  
$password = "1234";      

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

if (!isset($_SESSION['usuarioID'])) {
    echo "Por favor, inicie sesión para ver sus pedidos.";
    exit;
}

$usuarioID = $_SESSION['usuarioID'];

// Verificar si se quiere eliminar un pedido
if (isset($_POST['eliminarPedidoID'])) {
    $pedidoRestauranteId = $_POST['eliminarPedidoID'];

    // Eliminar los productos del pedido
    $deleteProductosQuery = "DELETE FROM productosPedidos WHERE pedidoID = :pedidoID";
    $deleteProductosStmt = $pdo->prepare($deleteProductosQuery);
    $deleteProductosStmt->execute(['pedidoID' => $pedidoRestauranteId]);

    // Eliminar el pedido
    $deletePedidoQuery = "DELETE FROM pedidosParaElRestaurante WHERE pedidoRestauranteId = :pedidoRestauranteId";
    $deletePedidoStmt = $pdo->prepare($deletePedidoQuery);
    $deletePedidoStmt->execute(['pedidoRestauranteId' => $pedidoRestauranteId]);

    echo "<script>alert('El pedido ha sido eliminado con éxito');</script>";
}

// Obtener todos los pedidos realizados por el usuario
$query = "
    SELECT p.pedidoRestauranteId, p.fechaPedidoRestaurante, p.enviado, r.nombreRestaurante
    FROM pedidosParaElRestaurante p
    INNER JOIN restaurantes r ON p.restID = r.restauranteId
    WHERE p.restID IN (SELECT restauranteDelUsuarioId FROM usuario WHERE usuarioID = :usuarioID)
";
$stmt = $pdo->prepare($query);
$stmt->execute(['usuarioID' => $usuarioID]);
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Si se quiere ver los detalles de un pedido
if (isset($_POST['verDetallesPedidoID'])) {
    $pedidoRestauranteId = $_POST['verDetallesPedidoID'];

    $detalleQuery = "
        SELECT pp.productoPedidoId, pr.nombreProducto, pp.cantidadDelProducto, pp.PrecioProductoFinal
        FROM productosPedidos pp
        INNER JOIN productos pr ON pp.productoPedidoId = pr.productoID
        WHERE pp.pedidoID = :pedidoID
    ";
    $detalleStmt = $pdo->prepare($detalleQuery);
    $detalleStmt->execute(['pedidoID' => $pedidoRestauranteId]);
    $productosDetalles = $detalleStmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url(https://media.traveler.es/photos/6437e879dc7ebb09ac6b4ea3/master/w_1600%2Cc_limit/El%2520Serbal.jpeg);
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        h2 {
            text-align: center;
            font-family: 'Arial', sans-serif;
            font-size: 28px;
            line-height: 1.6;
            color: #000000;
            background-color: rgb(218, 185, 124);
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            display: inline-block;
            padding: 5px 10px;
        }

        p {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #000000;
            background-color: rgb(218, 185, 124);
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }

        #header nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }

        #header nav a:hover {
            text-decoration: underline;
        }

        main {
            margin-top: 100px;
            padding: 20px;
            flex: 1; 
        }

        section {
            padding: 100px 0;
        }

        button.eliminarBtn {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        button.eliminarBtn:hover {
            background-color: darkred;
        }

        table {
            width: 100%; 
            border-collapse: collapse;
            margin-top: 20px;
            background-color: whitesmoke;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); 
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        button.detalleBtn {
            background-color: green;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        button.detalleBtn:hover {
            background-color: darkgreen;
        }

        .container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-height: 100vh;
        }
    </style>
</head>
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
    <main>
        <div class="container">
            <h2>Mis Pedidos</h2>

            <?php if (empty($pedidos)): ?>
                <p>No has realizado pedidos aún.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Restaurante</th>
                            <th>Fecha del Pedido</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedidos as $pedido): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($pedido['nombreRestaurante']); ?></td>
                                <td><?php echo htmlspecialchars($pedido['fechaPedidoRestaurante']); ?></td>
                                <td><?php echo $pedido['enviado'] ? 'Enviado' : 'Pendiente'; ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="eliminarPedidoID" value="<?php echo $pedido['pedidoRestauranteId']; ?>">
                                        <button type="submit" class="eliminarBtn">Eliminar Pedido</button>
                                    </form>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="verDetallesPedidoID" value="<?php echo $pedido['pedidoRestauranteId']; ?>">
                                        <button type="submit" class="detalleBtn">Ver Detalles</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <?php if (isset($productosDetalles)): ?>
                <h3>Detalles del Pedido</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productosDetalles as $producto): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($producto['nombreProducto']); ?></td>
                                <td><?php echo $producto['cantidadDelProducto']; ?></td>
                                <td><?php echo number_format($producto['PrecioProductoFinal'], 2); ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
