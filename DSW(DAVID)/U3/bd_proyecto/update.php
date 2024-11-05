<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi update</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Form container */
        form {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Form title */
        h1 {
            font-size: 24px;
            margin-bottom: 1.5rem;
            color: #333;
            text-align: center;
        }

        /* Labels */
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #333;
        }

        /* Input fields */
        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        /* Textarea styling */
        textarea {
            resize: vertical;
        }

        /* Buttons styling */
        input[type="submit"],
        input[type="reset"],
        a {
            display: inline-block;
            text-decoration: none;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 0.5rem 0;
        }

        /* Hover effects for buttons */
        input[type="submit"]:hover {
            background-color: #28a745;
        }

        input[type="reset"]:hover {
            background-color: #dc3545;
        }

        a {
            background-color: #6c757d;
        }

        a:hover {
            background-color: #5a6268;
        }

        /* Success and error messages */
        .message {
            padding: 10px;
            margin-top: 1rem;
            border-radius: 4px;
            text-align: center;
            font-weight: bold;
        }

        .message.success {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>

  <?php
    if (!isset($_GET['id'])) {
      echo "<script>console.log(Error: 'No existe el producto con este ID')</script>";
      exit();
    }

    $id_producto = $_GET['id'];
  ?>

  <?php
    require_once __DIR__."/conexion.php";
  ?>

  <form method="post">
    <h1>Actualizar producto</h1>

    <?php
      $conn = conectar("localhost", "proyecto", "root", "");

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

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" value="<?= $product['nombre']?>" required>

    <label for="nombre_corto">Nombre corto</label>
    <input type="text" id="nombre_corto" name="nombre_corto" value="<?= $product['nombre_corto']?>" required>

    <label for="precio">Precio (€)</label>
    <input type="number" step="0.01" id="precio" name="precio" value="<?= $product['precio']?>" required>

    <label for="familia">Familia</label>
    <select id="familia" name="familia" required>
      <?php
        $conn = conectar("localhost", "proyecto", "root", "");

        if ($conn == null) {
          echo "<script>console.log('Error: No se pudo establecer conexión con la base de datos.')</script>";
        }

        $resultado_query = $conn->query("select * from familias");

        while($row = $resultado_query->fetch(PDO::FETCH_OBJ)) {
          $cod = htmlspecialchars($row->cod);
          $nombre = htmlspecialchars($row->nombre);
          $selected = ($cod == $product['familia']) ? 'selected' : '';
          echo "<option value='{$cod}' {$selected}>{$nombre}</option>";
        }

        $conn = null;
      ?>
    </select>

    <label for="descripcion">Descripción</label>
    <textarea id="descripcion" name="descripcion" rows="4" required><?= $product['descripcion']?></textarea>

    <input type="submit" value="Modificar producto">
    <input type="reset" value="Limpiar">
    <a href="listado.php#<?php echo $id_producto; ?>">Volver a mis productos</a>

    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $id_producto;
        $nombre = $_POST['nombre'];
        $nombre_corto = $_POST['nombre_corto'];
        $precio = $_POST['precio'];
        $familia = $_POST['familia'];
        $descripcion = $_POST['descripcion'];

        $conn = conectar("localhost", "proyecto", "root", "");

        if ($conn == null) {
          echo "<script>console.log('Error: No se pudo establecer conexión con la base de datos.')</script>";
        }

        try {
          $reg = $conn->exec("UPDATE `productos` SET `nombre` = '".$nombre."', `nombre_corto` = '".$nombre_corto."', `descripcion` = '".$descripcion."', `pvp` = '".$precio."', `familia` = '".$familia."' WHERE `id` = '".$id."'");

          if ($reg == 1) {
            echo "<p class='message success'>El producto se ha modificado con éxito</p>";
          }

        } catch (PDOException $ex) {
          if ($ex->getCode() == "23000") {
            echo "<p class='message error'>Este nombre corto ya está en uso. Por favor, introduce otro nombre corto.</p>";
          } else {
            echo "<p class='message error'>Error en la base de datos: " . $ex->getMessage() . "<br>Código de error: " . $ex->getCode() . "</p>";
          }
        }

        $conn = null;
      }
    ?>
  </form>
  
</body>

</html>


