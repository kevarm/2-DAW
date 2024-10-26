<?php

    require_once __DIR__."/conexion.php";

        // Creación de la conexión
        $conn = conectar("localhost", "proyecto", "root", "");

        if ($conn == null) {
          echo "<script>console.log('Error: No se pudo establecer conexión con la base de datos.')</script>";
        }
        
        $id_producto = $_GET['id'];

        $resultado_query = $conn->query("select * from productos where id = $id_producto");

        while($row = $resultado_query->fetch(PDO::FETCH_OBJ)) {
            echo "<div>
                      <p>Nombre: {$row->nombre}</p>
                      <p>Combre corto: {$row->nombre_corto}</p>
                      <p>Familia: {$row->familia}</p>
                      <p>Precio (€): {$row->pvp}</p>
                      <p>Descripción: {$row->descripcion}</p>
                    </div>
                 ";
        }

        $conn = null;
