<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Juegos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <h1>Juegos</h1>

  <?php
  require_once "./functions.php";
  ?>

  <main class="container text-center my-4 flex-grow-1">
    <h1>Lista de juegos</h1>
    <div class="row">
      <?php

      $conn = crearConexion("localhost", "gamestore", "root", "");

      if ($conn === null) {
        echo "<div class='alert alert-danger'>Error: No se pudo establecer conexión con la base de datos.</div>";
      }

      $resultado_query = $conn->query('SELECT * FROM Juegos');

      while ($row = $resultado_query->fetch(PDO::FETCH_OBJ)) {
        echo "<div class='col-md-4 mb-4'>
                <div class='card'>
                  <div class='card-body'>
                    <h5 class='card-title'>{$row->Nombre}</h5>
                    <h6 class='card-subtitle mb-2 text-muted'>{$row->Genero}</h6>
                    <p class='card-text'>ID: {$row->ID}</p>
                    <a href='detalle.php?id={$row->ID}' class='btn btn-primary'>Ver juego</a>
                  </div>
                </div>
              </div>";
      }

      $conn = null;

      ?>
    </div>
  </main>
</body>

</html>
