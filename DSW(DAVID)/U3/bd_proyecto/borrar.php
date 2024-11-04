<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>.volver-btn {
            display: inline-block;
            background-color: #0097A7;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
            font-weight: bold;
            font-size: 16px;
            display: block;
            width: 100px;
            margin: 20px auto 0;
        }

        .volver-btn:hover {
            background-color: #006064;
        }</style>
</head>
<body>
<?php
	
  $id_producto = $_GET['id'];

      require_once __DIR__."/conexion.php";
      $conn = conectar("localhost", "proyecto", "root", "");

      if ($conn == null) {
          echo "<script>console.log('Error: No se pudo establecer conexión con la base de datos.')</script>";
        }

        try {
          $reg = $conn->exec("DELETE FROM productos WHERE `productos`.`id` = '".$id_producto."'");

          if ($reg == 1) {
            echo "<p>El producto se ha eliminado con éxito</p>";
          }

        } catch (PDOException $ex) {
          echo "<p>";
          echo "Error en la base de datos: " . $ex->getMessage() . "<br>";
          echo "Código de error: " . $ex->getCode() . "<br>";
          echo "</p>";
        }
      
        $conn = null;
      

?>
</div>

<a href="listado.php" class="volver-btn">Volver</a>
</div>
</body>
</html>