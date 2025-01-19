<?php
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
    echo "Por favor, inicie sesión para ver su carrito.";
    exit;
}

// Usuario autenticado
$usuarioID = $_SESSION['usuarioID'];

if (isset($_POST['carritoID'])) {
    $carritoID = $_POST['carritoID'];

    $query = "
        SELECT c.cantidad, p.productoID, p.stockProductos
        FROM carrito c
        INNER JOIN productos p ON c.productoID = p.productoID
        WHERE c.carritoID = :carritoID
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['carritoID' => $carritoID]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($producto) {
        // Actualizar el stock del producto
        $nuevoStock = $producto['stockProductos'] + $producto['cantidad'];
        $updateQuery = "
            UPDATE productos
            SET stockProductos = :nuevoStock
            WHERE productoID = :productoID
        ";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->execute([
            'nuevoStock' => $nuevoStock,
            'productoID' => $producto['productoID']
        ]);

        // Eliminar el producto del carrito
        $deleteQuery = "DELETE FROM carrito WHERE carritoID = :carritoID";
        $deleteStmt = $pdo->prepare($deleteQuery);
        $deleteStmt->execute(['carritoID' => $carritoID]);

        // Redirigir de nuevo al carrito
        header("Location: carrito.php");
        exit;
    } else {
        echo "Producto no encontrado en el carrito.";
        exit;
    }
}

$query = "
    SELECT c.carritoID, p.productoID, p.nombreProducto, p.descripcion, p.precioProducto, c.cantidad, c.fechaAgregado
    FROM carrito c
    INNER JOIN productos p ON c.productoID = p.productoID
    WHERE c.usuarioID = :usuarioID
";
$stmt = $pdo->prepare($query);
$stmt->execute(['usuarioID' => $usuarioID]);
$productosCarrito = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Procesar la acción de hacer pedido
if (isset($_POST['hacerPedido'])) {
    $queryRestID = "
        SELECT restauranteDelUsuarioId FROM usuario WHERE usuarioID = :usuarioID
    ";
    $stmtRestID = $pdo->prepare($queryRestID);
    $stmtRestID->execute(['usuarioID' => $usuarioID]);
    $restauranteID = $stmtRestID->fetchColumn();

    if ($restauranteID) {
        // Registrar el pedido
        $fechaPedido = date('Y-m-d');

        $insertPedidoQuery = "
            INSERT INTO pedidosParaElRestaurante (restID, fechaPedidoRestaurante, enviado)
            VALUES (:restauranteID, :fechaPedido, 0)
        ";
        $insertPedidoStmt = $pdo->prepare($insertPedidoQuery);
        $insertPedidoStmt->execute(['restauranteID' => $restauranteID, 'fechaPedido' => $fechaPedido]);

        $pedidoRestauranteId = $pdo->lastInsertId();

  // Insertar productos del carrito en la tabla productosPedidos
foreach ($productosCarrito as $producto) {
    echo "Pedido ID: $pedidoRestauranteId<br>";  
    
    echo "Producto ID: " . $producto['productoID'] . " | Cantidad: " . $producto['cantidad'] . "<br>";
    
    $precioFinal = $producto['precioProducto'] * $producto['cantidad'];
    echo "Precio Final: $precioFinal<br>";  
    
    $insertProductosPedidosQuery = "
        INSERT INTO productosPedidos (pedidoID, productoPedidoId, cantidadDelProducto, PrecioProductoFinal)
        VALUES (:pedidoID, :productoPedidoId, :cantidadDelProducto, :PrecioProductoFinal)
    ";
    $insertProductosPedidosStmt = $pdo->prepare($insertProductosPedidosQuery);

    // Ejecutar la consulta de inserción
    $insertProductosPedidosStmt->execute([
        'pedidoID' => $pedidoRestauranteId,  
        'productoPedidoId' => $producto['productoID'], 
        'cantidadDelProducto' => $producto['cantidad'],  
        'PrecioProductoFinal' => $precioFinal
    ]);
}

        // Vaciar el carrito después de hacer el pedido
        $deleteCarritoQuery = "DELETE FROM carrito WHERE usuarioID = :usuarioID";
        $deleteCarritoStmt = $pdo->prepare($deleteCarritoQuery);
        $deleteCarritoStmt->execute(['usuarioID' => $usuarioID]);

        // Mostrar un alert con el mensaje de éxito
        echo "<script>alert('Pedido realizado con éxito');</script>";
    } else {
        echo "Error: No se ha encontrado un restaurante asociado a este usuario.";
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <style>
        #header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #333;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            transition: top 0.2s;
            box-sizing: border-box;
        }

        #header h1 {
            margin: 0;
        }

        #header nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }

        #header nav a:hover {
            text-decoration: underline;
        }

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        body {
            background-image: url(https://media.traveler.es/photos/6437e879dc7ebb09ac6b4ea3/master/w_1600%2Cc_limit/El%2520Serbal.jpeg);
            background-repeat: no-repeat;
            background-size: cover;
            padding-top: 80px; 
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .carrito {
            width: 90%;
            max-width: 800px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        .carrito h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .producto {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .producto:last-child {
            border-bottom: none;
        }

        .producto-info {
            flex-grow: 1;
        }

        .producto-info h3 {
            margin: 0 0 5px;
            font-size: 16px;
        }

        .producto-acciones button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
        }

        .producto-acciones button:hover {
            background-color: #c82333;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
        }

        .hacer-pedido button {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            font-size: 18px;
            border-radius: 4px;
        }

        .hacer-pedido button:hover {
            background-color: #218838;
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

    <!-- Carrito -->
    <div class="carrito">
        <h2>Tu carrito de compras</h2>
        <?php foreach ($productosCarrito as $producto): ?>
            <div class="producto">
                <div class="producto-info">
                    <h3><?php echo htmlspecialchars($producto['nombreProducto']); ?></h3>
                    <p>Descripción: <?php echo htmlspecialchars($producto['descripcion']); ?></p>
                    <p>Precio: $<?php echo number_format($producto['precioProducto'], 2); ?></p>
                    <p>Cantidad: <?php echo $producto['cantidad']; ?></p>
                </div>
                <div class="producto-acciones">
                    <form method="post">
                        <input type="hidden" name="carritoID" value="<?php echo $producto['carritoID']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="total">
            <p>Total: $<?php echo number_format(array_sum(array_map(function ($producto) {
                return $producto['precioProducto'] * $producto['cantidad'];
            }, $productosCarrito)), 2); ?></p>
        </div>

        <div class="hacer-pedido">
            <form method="post">
                <button type="submit" name="hacerPedido">Hacer pedido</button>
            </form>
        </div>
    </div>

</body>
</html>
