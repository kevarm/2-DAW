<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finanzas Plus</title>
</head>
<body>
    <?php
    if (!file_exists("./function.php")) {
        die("Error:No existe el archivo.");
      }
  
      require_once "./function.php";
    ?>

<main>
    <h1>Lista de productos</h1>
    <div>
      <?php

      $conn = crearConexion("localhost", "finanzasplus", "root", "");

      if ($conn === null) {
        echo "<div>Error: No se pudo establecer conexión con la base de datos.</div>";
      }

      $media_puntuacion = 0;
    $total_calificaciones = 0;


      $resultado_query = $conn->query('SELECT * FROM productos');

      while ($row = $resultado_query->fetch(PDO::FETCH_OBJ)) {
        echo "<div>
                  <div>
                    <h3>Nombre: {$row->nombre}</h3>
                    <h4>Tipo: {$row->tipo}</h4>
                    <h4>ID: {$row->id}</h4>";
                    $calificaciones_query = $conn->query("SELECT AVG(calificacion) as media FROM opiniones WHERE producto_id = '$row->id'");
                    $calificacion_media_row = $calificaciones_query->fetch(PDO::FETCH_OBJ);

                    if ($calificacion_media_row->media !== null) {
                        $media_puntuacion = round($calificacion_media_row->media, 2);
                        echo "<p>Puntuación Media: {$media_puntuacion}</p>";
                      } else {
                        echo "<p>Puntuación Media: No hay calificaciones aún.</p>";
                      }

                    $resultado_query2 = $conn->query("SELECT comentario FROM opiniones WHERE producto_id = '$row->id'");
                    echo "<h4>Comentario:</h4>";
                    echo
                    "
                        <div>
                            <a href='update.php?id={$row->id}'>Actualizar</a>
                            <a href='borrar.php?id={$row->id}'>Borrar</a>
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