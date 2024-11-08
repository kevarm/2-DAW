<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prueba</title>
</head>
<body>
  <h1>Prueba</h1>

  <?php
    if (!file_exists("./functions.php")) {
      die("Error:No existe el archivo.");
    }

    require_once "./functions.php";

    $conn = crearConexion("localhost", "gamestore", "root", "");

    if ($conn === null) {
      echo "<div class='alert alert-danger'>Error: No se pudo establecer conexión con la base de datos.</div>";
    }

    $conn = null;

  ?>

  <h1>Tienda Online</h1>

  <a type="button" href="./juegos.php">Ver lista de juegos</a>

</body>
</html>
