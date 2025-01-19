<?php
// Inicia sesión para acceder a las variables de sesión
session_start();

// Verifica si la sesión está activa
if (!isset($_SESSION["correo"])) {
    // Si no hay sesión activa, redirige al login
    header("location:login.php");
    exit;
}
$id = $_SESSION['id'];
$correo = $_SESSION['correo'];

require_once __DIR__ . '\modelo\conexion.php';

$conn = createConnection();

if ($conn === null) {
    echo "Fallo en la conexión.";
    exit();
}

$query_restaurante = "SELECT Identificador FROM Restaurante WHERE Correo = :correo";
$stmt_restaurante = $conn->prepare($query_restaurante);
$stmt_restaurante->bindParam(':correo', $correo, PDO::PARAM_STR);
$stmt_restaurante->execute();
$restaurante = $stmt_restaurante->fetch(PDO::FETCH_ASSOC);

if ($restaurante === false) {
    echo "No se encontró un restaurante asociado con este usuario.";
    exit();
}

$id = $restaurante['Identificador'];

$query_pedidos = "SELECT * FROM Pedido WHERE restaurante = :id ORDER BY FechaPedido DESC";
$stmt_pedidos = $conn->prepare($query_pedidos);
$stmt_pedidos->bindParam(':id', $id, PDO::PARAM_STR);
$stmt_pedidos->execute();
$pedidos = $stmt_pedidos->fetchAll(PDO::FETCH_ASSOC);
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
        if (count($pedidos) > 0): ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-4">
                <?php foreach ($pedidos as $pedido): ?>
                    <div class="col">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h5>Pedido <?php echo htmlspecialchars($pedido['Codigo']); ?></h5>
                                <p>Fecha: <?php echo htmlspecialchars($pedido['FechaPedido']); ?></p>
                                <p>Estado: <?php echo htmlspecialchars($pedido['EstadoEnvio']); ?></p>
                                <a href="pedidoProducto.php?id=<?php echo htmlspecialchars($pedido['Codigo']); ?>" class="btn btn-primary">Detalles</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-muted mt-4">No tienes pedidos realizados para este restaurante.</p>
        <?php endif; ?>
    </ul>


    <script src="js/fontawesome.js"></script>
    <script src="js/main.js"></script>
    <script src="js/main2.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.js"></script>

</body>

</html>