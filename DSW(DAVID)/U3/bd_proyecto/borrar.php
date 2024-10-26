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