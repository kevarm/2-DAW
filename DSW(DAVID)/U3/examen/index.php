<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Bienvenido</h1>


    <?php
    if (!file_exists("./function.php")) {
        die("Error:No existe el archivo.");
    }

    require_once "./function.php";

    $conn = crearConexion("localhost", "gamestore", "root", "");

    if ($conn === null) {
        echo "<div>Error: No se pudo establecer conexión con la base de datos.</div>";
    }

    $conn = null;

    ?>

    <h1>Tienda Online</h1>

    <a type="button" href="./finanzasplus.php">Ver lista de productos</a>
    ?>
</body>

</html>