<?php
session_start(); // Iniciar sesión para manejar el carrito

if (!isset($_SESSION["correo"])) {
    // Si no hay sesión activa, redirige al login
    header("location:login.php");
    exit;
}

require_once __DIR__ . '\modelo\conexion.php';

$id = $_SESSION['id'];


if (isset($_POST['codigo'], $_POST['cantidad'])) {
    $codigoProducto = $_POST['codigo'];
    $cantidadSolicitada = (int)$_POST['cantidad'];
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
            //Almaceno las variables que obtenemos por POST
            $nombre = ($_POST['nombre']);
            $cantidad = intval($_POST['cantidad']);
            $id_producto = ($_POST['codigo']);


            if (isset($_SESSION['carrito'][$nombre])) {
                $_SESSION['carrito'][$nombre]['cantidad'] += $cantidad;
            } else {
                $_SESSION['carrito'][$nombre] = [
                    'cantidad' => $cantidad,
                    'id_producto' => $id_producto 
                ];
            }

            echo "Producto añadido correctamente. <br><br> <a href='carrito.php'>Ver carrito</a><br>";
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
            echo "<a href='carrito.php?accion=enviar'>Confirmar pedido</a></div>";
        } else {
            echo "<h1>Carrito vacío</h1><a href='inicio.php'>Volver a productos</a>";
        }

        //Vaciar carrito
        if (isset($_GET['accion']) && $_GET['accion'] === 'vaciar') {
            unset($_SESSION['carrito']);
            header("Location:inicio.php");
        }


        //Aquí iría la lógica de la BD para almacenar los pedidos y actualizar Stock

        if (isset($_GET['accion']) && $_GET['accion'] === 'enviar') {
            $conn = createConnection();

            if ($conn === null) {
                echo "<p>Error: No se pudo conectar a la base de datos.</p>";
                exit();
            } else {  
                try {
                    //Actualización del Stock (no he añadido controles porque ya en el input sólo se puede seleccionar como máximo el máximo del Stock)
                        $conn->beginTransaction();
                        $stmtDetalle = $conn->prepare("UPDATE producto SET CantidadStock= CantidadStock-:cantidad WHERE (codigo=:id_producto)");
                        foreach ($_SESSION['carrito'] as $nombre => $item) {
                            $stmtDetalle->execute([
                                'id_producto' => $item['id_producto'], 
                                'cantidad' => $item['cantidad']
                            ]);
                        }
                        $conn->commit();

                    // Insertar el pedido en la tabla `pedido`
                    $conn->beginTransaction();
                    $stmt = $conn->prepare("INSERT INTO pedido (FechaPedido, EstadoEnvio, Restaurante) VALUES (NOW(), 1, :id)");
                    if (!$stmt->execute(['id' => $id])) {
                        throw new Exception("Error al ejecutar la consulta: " . implode(", ", $stmt->errorInfo()));
                    }
                    $pedido_id = $conn->lastInsertId();
                    $conn->commit();
                } catch (Exception $e) {
                    $conn->rollBack(); // Revertir cambios si hay un error
                    echo "Error al realizar el pedido: " . $e->getMessage();
                }
                // Insertar el pedido en la tabla `pedidoproducto`
                try {
                    $conn->beginTransaction();
                    $stmtDetalle = $conn->prepare("INSERT INTO pedidoproducto (cantidad, pedido, producto) VALUES (:cantidad,:pedido_id ,:producto)");

                    foreach ($_SESSION['carrito'] as $nombre => $item) {
                        $cantidad = $item['cantidad'];      
                        $producto = $item['id_producto'];   
                        $pedido = $pedido_id;
                        $stmtDetalle->execute([
                            'pedido_id' => $pedido,
                            'producto' => $item['id_producto'], 
                            'cantidad' => $item['cantidad']
                        ]);
                    }
                    $conn->commit(); // Confirmar transacción

                    // Vaciar el carrito
                    unset($_SESSION['carrito']);
                    header("Location: inicio.php");
                } catch (Exception $e) {
                    $conn->rollBack(); // Revertir cambios si hay un error
                    echo "Error al realizar el pedido: " . $e->getMessage();
                }
                //Lógica para restar el stock del pedido aceptado
                // try {
                //     $conn->beginTransaction(); // Iniciar transacción

                //     // Restar la cantidad del pedido del stock del producto
                //     $stmt = $conn->prepare("UPDATE producto SET producto.CantidadStock=producto.CantidadStock-:item['cantidad'] where producto.Codigo=producto.:item['id_producto]");
                //     if (!$stmt->execute(['id' => $id])) {
                //         throw new Exception("Error al ejecutar la consulta: " . implode(", ", $stmt->errorInfo()));
                //     }
                //     $conn->commit(); // Confirmar cambios
                // } catch (Exception $e) {
                //     $conn->rollBack(); // Revertir cambios si hay un error
                //     echo "Error al realizar el pedido: " . $e->getMessage();
                // }
            }
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