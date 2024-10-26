<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi update</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

  <?php
    if (!isset($_GET['id'])) {
      echo "<script>console.log(Error: 'No existe el producto con este ID')</script>";
      header('Location: listado.php');
      exit();
    }

    $id_producto = $_GET['id'];
  ?>

  <?php
    require_once __DIR__."/base/functions.php";
    enableErrorLog();
  ?>

  <nav class="navbar navbar-expand-lg p-3 mb-2 bg-secondary text-white">
    <div class="container-fluid">
      <ul class="navbar-nav d-flex justify-content-center w-100">
        <li class="nav-item">
          <a class="nav-link text-white active" aria-current="page" href="./index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active" aria-current="page" href="./listado.php">Mis productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="crear.php">Crear un producto</a>
        </li>
      </ul>
    </div>
  </nav>

  <main class="flex-grow-1 container mt-4 mb-4">
    <h1 class="mb-4"> -- Editar producto -- </h1>

    <?php

      $conn = createConnection("localhost", "proyecto", "root", "");

      if ($conn == null) {
        echo "<script>console.log('Error: No se pudo establecer conexión con la base de datos.')</script>";
      }

      $resultado_query = $conn->query("select * from productos where id = $id_producto");

      $product = [];
      while($row = $resultado_query->fetch(PDO::FETCH_OBJ)) {
        $product['nombre'] = $row->nombre;
        $product['nombre_corto'] = $row->nombre_corto;
        $product['descripcion'] = $row->descripcion;
        $product['precio'] = $row->pvp;
        $product['familia'] = $row->familia;
      }

      $conn = null;
    ?>

    <form method="post" class="container p-4 border rounded bg-light shadow-sm">
      <legend class="mb-4 text-center">Introduce los datos del producto</legend>

      <div class="form-group mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" id="nombre" name="nombre" class="form-control" value="<?= $product['nombre']?>" required>
      </div>

      <div class="form-group mb-3">
        <label for="nombre_corto" class="form-label">Nombre corto</label>
        <input type="text" id="nombre_corto" name="nombre_corto" class="form-control" value="<?= $product['nombre_corto']?>" required>
      </div>

      <div class="form-group mb-3">
        <label for="precio" class="form-label">Precio (€)</label>
        <input type="number" step="0.01" id="precio" name="precio" class="form-control" value="<?= $product['precio']?>" required>
      </div>

      <div class="form-group mb-3">
        <label for="familia" class="form-label">Familia</label>
        <select id="familia" name="familia" class="form-select" required>
          <?php
            $conn = createConnection("localhost", "proyecto", "root", "");

            if ($conn == null) {
              echo "<script>console.log('Error: No se pudo establecer conexión con la base de datos.')</script>";
            }
      
            $resultado_query = $conn->query("select * from familias");

            while($row = $resultado_query->fetch(PDO::FETCH_OBJ)) {
              $cod = htmlspecialchars($row->cod);
              $nombre = htmlspecialchars($row->nombre);
          
              $selected = ($cod == $product['familia']) ? 'selected' : '';
          
              echo "<option value='{$cod}' {$selected}>
                      {$nombre}
                    </option>";
            }
      
            $conn = null;
          ?>
        </select>
      </div>

      <div class="form-group mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea id="descripcion" name="descripcion" class="form-control" rows="4" required><?= $product['descripcion']?></textarea>
      </div>

      <div class='d-flex justify-content-center mt-4 gap-2'>
        <input class='btn btn-success' type="submit" value="Modificar producto">
        <input class='btn btn-danger' type="reset" value="Resetear formulario">
        <a class='btn btn-primary' href="listado.php#<?php echo $id_producto; ?>">Volver a mis productos</a>
      </div>
    </form>

    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $id_producto;
        $nombre = $_POST['nombre'];
        $nombre_corto = $_POST['nombre_corto'];
        $precio = $_POST['precio'];
        $familia = $_POST['familia'];
        $descripcion = $_POST['descripcion'];

        // Creación de la conexión
        $conn = createConnection("localhost", "proyecto", "root", "");

        if ($conn == null) {
          echo "<script>console.log('Error: No se pudo establecer conexión con la base de datos.')</script>";
        }

        try {
          $reg = $conn->exec("UPDATE `productos` SET `nombre` = '".$nombre."', `nombre_corto` = '".$nombre_corto."', `descripcion` = '".$descripcion."', `pvp` = '".$precio."', `familia` = '".$familia."' WHERE `id` = '".$id."'");

          if ($reg == 1) {
            echo "<p class='alert alert-success mt-4' role='alert'>El producto se ha modificado con éxito</p>";
          }

        } catch (PDOException $ex) {
          if ($ex->getCode() == "23000") {
            echo "<p class='alert alert-danger mt-4' role='alert'>
                    Este nombre corto ya está en uso. Por favor, introduce otro nombre corto.
                  </p>";
          } else {
            echo "<p class='alert alert-danger mt-4' role='alert'>";
            echo "Error en la base de datos: " . $ex->getMessage() . "<br>";
            echo "Código de error: " . $ex->getCode() . "<br>";
            echo "</p>";
          }
        }
        
        $conn = null;
      }
    ?>
    </body>
    </html>