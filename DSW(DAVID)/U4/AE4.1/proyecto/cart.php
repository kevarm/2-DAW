<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario']) || !isset($_SESSION['carrito'])) {
    header("Location: categorias.php");
    exit;
}

$carrito = $_SESSION['carrito'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar el pedido
    $usuario_id = $_SESSION['usuario']['codigo'];
    $conn->beginTransaction();
    try {
        $stmt = $conn->prepare("INSERT INTO Pedidos (restaurante_id) VALUES (:restaurante_id)");
        $stmt->bindParam(':restaurante_id', $usuario_id);
        $stmt->execute();
        $pedido_id = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO PedidosProductos (pedido_id, producto_id, cantidad) VALUES (:pedido_id, :producto_id, :cantidad)");

        foreach ($carrito as $producto_id => $cantidad) {
            $stmt->execute([
                ':pedido_id' => $pedido_id,
                ':producto_id' => $producto_id,
                ':cantidad' => $cantidad
            ]);
        }

        $conn->commit();
        unset($_SESSION['carrito']);
        echo "Pedido realizado.";
    } catch (Exception $e) {
        $conn->rollBack();
        echo "Error al realizar el pedido: " . $e->getMessage();
    }
    exit;
}
?>

<h1>Carrito</h1>
<ul>
    <?php foreach ($carrito as $producto_id => $cantidad): ?>
        <li>Producto <?= $producto_id ?>: <?= $cantidad ?> unidades</li>
    <?php endforeach; ?>
</ul>
<form method="POST">
    <button type="submit">Confirmar Pedido</button>
</form>
