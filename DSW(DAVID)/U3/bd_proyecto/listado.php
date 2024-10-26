<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado</title>
</head>
<body>
    <h1>Gestión de productos</h1>
    <a type="button" href="crear.php">Crear</a>
    <br>

     <?php

    require_once __DIR__."/conexion.php";

        // Creación de la conexión
        $conn = conectar("localhost", "proyecto", "root", "");

        if ($conn == null) {
          echo "<script>console.log('Error: No se pudo establecer conexión con la base de datos.')</script>";
        }

        $resultado_query = $conn->query('select * from productos');

        while($row = $resultado_query->fetch(PDO::FETCH_OBJ)) {
          echo "<div>
                    <p>Código: {$row->id}</p>  
                      <h3>Nombre: {$row->nombre}</h3>
                      <a href='detalle.php?id={$row->id}'>Ver Detalle</a>
                      <a href='update.php?id={$row->id}'>Modificar</a>
                      <a href='borrar.php?id={$row->id}'>Eliminar</a>
                </div>";
          }

        // Cerrar la conexión
        $conn = null;
      ?>
      </body>
</html>