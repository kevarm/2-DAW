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

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuarioID'])) {
    echo "Por favor, inicie sesión para ver la carta.";
    exit;
}

// Usuario autenticado
$usuarioID = $_SESSION['usuarioID'];

// Recibir parámetros de búsqueda y filtro
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
$categoriaId = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Manejar la acción de añadir al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productoID'], $_POST['cantidad'])) {
    $productoID = $_POST['productoID'];
    $cantidad = $_POST['cantidad'];

    // Verificar si el producto tiene suficiente stock
    $query = "SELECT stockProductos FROM productos WHERE productoID = :productoID";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['productoID' => $productoID]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($producto && $producto['stockProductos'] >= $cantidad) {
        // Verificar si el producto ya está en el carrito
        $query = "SELECT cantidad FROM carrito WHERE usuarioID = :usuarioID AND productoID = :productoID";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['usuarioID' => $usuarioID, 'productoID' => $productoID]);
        $carritoItem = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($carritoItem) {
            // Actualizar la cantidad del producto en el carrito
            $nuevaCantidad = $carritoItem['cantidad'] + $cantidad;
            $query = "UPDATE carrito SET cantidad = :cantidad WHERE usuarioID = :usuarioID AND productoID = :productoID";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['cantidad' => $nuevaCantidad, 'usuarioID' => $usuarioID, 'productoID' => $productoID]);
        } else {
            // Insertar nuevo producto en el carrito
            $query = "INSERT INTO carrito (usuarioID, productoID, cantidad) VALUES (:usuarioID, :productoID, :cantidad)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['usuarioID' => $usuarioID, 'productoID' => $productoID, 'cantidad' => $cantidad]);
        }

        // Actualizar el stock del producto
        $nuevoStock = $producto['stockProductos'] - $cantidad;
        $query = "UPDATE productos SET stockProductos = :nuevoStock WHERE productoID = :productoID";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['nuevoStock' => $nuevoStock, 'productoID' => $productoID]);

        echo "Producto añadido al carrito correctamente.";
    } else {
        echo "No hay suficiente stock disponible para este producto.";
    }
}

// Construir la consulta SQL para listar productos
$sql = "SELECT * FROM productos";
$conditions = [];

if ($busqueda) {
    $conditions[] = "nombreProducto LIKE :busqueda";
}

if ($categoriaId) {
    $conditions[] = "categoriaId = :categoriaId";
}

if ($conditions) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$stmt = $pdo->prepare($sql);

if ($busqueda) {
    $stmt->bindValue(':busqueda', '%' . $busqueda . '%');
}

if ($categoriaId) {
    $stmt->bindValue(':categoriaId', $categoriaId, PDO::PARAM_INT);
}

$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de Productos</title>
    <style>
        /* Estilos para el header */
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

        /* Estilos generales */
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
            padding-top: 80px; /* Para evitar que el contenido quede oculto tras el header */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .productos {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .producto {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            width: 200px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .producto h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .carrito-actions {
            margin-top: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .carrito-actions input[type="number"] {
            width: 60px;
            margin-bottom: 10px;
        }

        .carrito-actions button {
            padding: 5px 10px;
            font-size: 14px;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }

        .carrito-actions button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header id="header">
        <h1>El Pajar</h1>
        <nav>
            <a href="index.php#inicio">Contenido principal</a>
            <a href="index.php#servicios">Servicios</a>
            <a href="index.php#contacto">Contacto</a>
            <a href="iniciarSesion.php">Iniciar sesión</a>
        </nav>
    </header>

    <!-- Mostrar los productos -->
    <div class="productos">
        <?php if ($productos): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="producto">
                    <h3><?php echo htmlspecialchars($producto['nombreProducto']); ?></h3>
                    <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                    <p>Precio: €<?php echo number_format($producto['precioProducto'], 2); ?></p>
                    <p>Stock: <?php echo $producto['stockProductos']; ?></p>
                    <form method="POST" action="">
                        <div class="carrito-actions">
                            <input type="number" name="cantidad" min="1" max="<?php echo $producto['stockProductos']; ?>" value="1">
                            <input type="hidden" name="productoID" value="<?php echo $producto['productoID']; ?>">
                            <button type="submit">Añadir al carrito</button>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se encontraron productos.</p>
        <?php endif; ?>
    </div>

</body>
</html>
