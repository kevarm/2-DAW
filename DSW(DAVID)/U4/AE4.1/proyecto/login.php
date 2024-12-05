<?php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    $stmt = $conn->prepare("SELECT codigo, clave FROM Restaurante WHERE correo = :correo");
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();
    $restaurante = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($restaurante && password_verify($clave, $restaurante['clave'])) {
        $_SESSION['usuario'] = [
            'correo' => $correo,
            'codigo' => $restaurante['codigo']
        ];
        header("Location: categorias.php");
        exit;
    } else {
        echo "Credenciales incorrectas.";
    }
}
?>
<form method="POST">
    <input type="email" name="correo" placeholder="Correo electrónico" required>
    <input type="password" name="clave" placeholder="Clave" required>
    <button type="submit">Iniciar Sesión</button>
</form>
