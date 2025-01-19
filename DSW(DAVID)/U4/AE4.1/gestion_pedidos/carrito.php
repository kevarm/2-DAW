<?php
session_start(); // Iniciar sesión para manejar el carrito

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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar que se hayan recibido los datos necesarios
            $nombre = ($_POST['nombre']);
            $cantidad = intval($_POST['cantidad']);
            print_r($_POST);

            // Verificar si el producto ya está en el carrito
            if (isset($_SESSION['carrito'][$nombre])) {
                // Sumar la cantidad al producto existente
                $_SESSION['carrito'][$nombre]['cantidad'] += $cantidad;
            } else {
                // Agregar un nuevo producto al carrito
                $_SESSION['carrito'][$nombre] = [
                    'cantidad' => $cantidad
                ];
            }

            echo "Producto añadido al carrito correctamente.<br><br> <a href='carrito.php'>Ver carrito</a><br>";
            echo "<a href='inicio.php'>Volver a catálogo</a>";
            exit;
        }
        // Mostrar el contenido del carrito
        if (!empty($_SESSION['carrito'])) {
            echo "<h1>Tu carrito</h1><ul>";
            foreach ($_SESSION['carrito'] as $nombre => $item) {
                echo "<li>Nombre: " . $nombre . " - Cantidad: " . $item['cantidad'] . "</li>";
            }
            echo "<br></ul><div class='enlaces2'><a href='inicio.php'>Seguir comprando</a>";
            echo "<a href='carrito.php?accion=vaciar'>Vaciar carrito</a>";
            echo "<a href='pedidos.php'>Confirmar pedido</a></div>";
        } else {
            echo "<h1>Carrito vacío</h1><a href='inicio.php'>Volver a productos</a>";
        }

        //Vaciar carrito
        if (isset($_GET['accion']) && $_GET['accion'] === 'vaciar') {
            unset($_SESSION['carrito']);
            header("Location:inicio.php");
        }

       
            //Aquí iría la lógica de la BD para almacenar los pedidos
            // $conn = createConnection();
            // if ($conn === null) {
            //     echo "<p>Error: No se pudo conectar a la base de datos.</p>";
            //     exit();
            // }else{
            //     try {
            //         $conn->beginTransaction(); // Iniciar transacción
                
            //         // Insertar el pedido en la tabla `pedido`
            //         $idRestaurante = $_SESSION['id'];
            //         $stmt = $conn->prepare("INSERT INTO pedido (FechaPedido,EstadoEnvio,Restaurante) VALUES (NOW(),1,:idRestaurante)");
            //         $stmt->execute(['id' => $idRestaurante]);
                
            //         // Insertar los detalles del pedido en la tabla `detalle_pedido`
            //         $stmtDetalle = $conn->prepare("INSERT INTO pedidoproducto (cantidad, pedido, producto) VALUES (:cantidad, :producto, :cantidad)");
                
            //         foreach ($_SESSION['carrito'] as $nombre => $item) {
            //             $stmtDetalle->execute([
            //                 'pedido_id' => $pedidoId,
            //                 'producto' => $nombre,
            //                 'cantidad' => $item['cantidad']
            //             ]);
            //         }
                
            //         $conn->commit(); // Confirmar transacción
                
            //         // Vaciar el carrito
            //         unset($_SESSION['carrito']);
            //         header("Location: inicio.php");
            //     } catch (Exception $e) {
            //         $conn->rollBack(); // Revertir cambios si hay un error
            //         echo "Error al realizar el pedido: " . $e->getMessage();
            // }
            //     }
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