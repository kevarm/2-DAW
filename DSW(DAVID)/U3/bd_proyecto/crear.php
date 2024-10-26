<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
    <style>
        body {
            background-color: #00d0ff;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h2 {
            margin-top: 0;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .buttons {
            display: flex;
            justify-content: space-around;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-create {
            background-color: #007bff;
            color: white;
        }
        .btn-clear {
            background-color: #28a745;
            color: white;
        }
        .btn-back {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body>
<?php
require_once __DIR__."/conexion.php";
$conn = conectar("localhost", "proyecto", "root", "");

if ($conn === null) {
    echo "<script>console.log('Error: No se pudo establecer conexión con la base de datos.')</script>";
}
?>
    <div class="form-container">
        <h2>Crear Producto</h2>
        <form method="post">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="nombre_corto">Nombre Corto</label>
            <input type="text" id='nombre_corto' name='nombre_corto' required>

            <label for="precio">Precio (€)</label>
            <input type="number" id="precio" name="precio" step="0.01" required>

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
                    
                        echo "<option value='{$cod}'>{$nombre}</option>";
                      }
                      $conn = null;
                ?>
            </select>

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4"></textarea>

            <div class="buttons">
                <button type="submit" class="btn-create">Crear</button>
                <button type="reset" class="btn-clear">Limpiar</button>
                <button type="button" class="btn-back" onclick="window.history.back()">Volver</button>
            </div>
        </form>
    </div>

    <?php
        

      if ($conn == null) {
        echo "<script>console.log('Error: No se pudo establecer conexión con la base de datos.')</script>";
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $nombre_corto = $_POST['nombre_corto'];
        $precio = $_POST['precio'];
        $familia = $_POST['familia'];
        $descripcion = $_POST['descripcion'];

        // Creación de la conexión
        $conn = conectar("localhost", "proyecto", "root", "");

        if ($conn == null) {
          echo "<script>console.log('Error: No se pudo establecer conexión con la base de datos.')</script>";
        }

        $resultado_query = $conn->query("SELECT id FROM productos");

        $ids = [];
        while ($row = $resultado_query->fetch(PDO::FETCH_OBJ)) {
          $ids[] = (int)$row->id;
        }

        $count = 1;
        while (in_array($count, $ids)) {
          $count++;
        }

        try {
          $reg = $conn->exec("INSERT INTO `productos` (`id`, `nombre`, `nombre_corto`, `descripcion`, `pvp`, `familia`) VALUES ('".$count."', '".$nombre."', '".$nombre_corto."', '".$descripcion."', '".$precio."', '".$familia."')");

          if ($reg == 1) {
            echo "<p>El producto se ha creado con éxito</p>";
          }

        } catch (PDOException $ex) {
          if ($ex->getCode() == "23000") {
            echo "<p>
                    Este nombre corto ya está en uso. Por favor, introduce otro nombre corto.
                  </p>";
          } else {
            echo "<p>";
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
