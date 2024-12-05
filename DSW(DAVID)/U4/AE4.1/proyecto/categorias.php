<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM Categorias");
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Categorías</h1>
<ul>
    <?php foreach ($categorias as $categoria): ?>
        <li>
            <a href="productos.php?categoria_id=<?= $categoria['codigo'] ?>">
                <?= htmlspecialchars($categoria['nombre']) ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
