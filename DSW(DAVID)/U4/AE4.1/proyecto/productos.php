<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$categoria_id = $_GET['categoria_id'];

$stmt = $conn->prepare("SELECT * FROM Productos WHERE categoria_id = :categoria_id");
$stmt->bindParam(':categoria_id', $categoria_id);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (isset($_SESSION['carrito'][$producto_id])) {
        $_SESSION['carrito'][$producto_id] += $cantidad;
    } else {
        $_SESSION['carrito'][$producto_id] = $cantidad;
    }

    echo "Producto añadido al carrito.";
}
?>

<h1>Productos</h1>
<ul>
    <?php foreach ($productos as $producto): ?>
        <li>
            <?= htmlspecialchars($producto['nombre']) ?> (Stock: <?= $producto['cantidad_stock'] ?>)
            <form method="POST">
                <input type="hidden" name="producto_id" value="<?= $producto['codigo'] ?>">
                <input type="number" name="cantidad" min="1" max="<?= $producto['cantidad_stock'] ?>" required>
                <button type="submit">Añadir al Carrito</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
<a href="carrito.php">Ver Carrito</a>
