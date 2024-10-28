<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once __DIR__."/conexion.php";

        $conn= conexion("localhost", "gamestore", "root", "");

        if ($conn == null) {
            echo "<script>console.log('Error: No se pudo establecer conexión con la base de datos.')</script>";
          }
        
        $resultado_query= $conn->query('SELECT j.nombre AS nombre_juego, 
        j.genero, 
        AVG(c.puntos) AS puntuacion, c.comentario
 FROM juegos j 
 LEFT JOIN calificaciones c ON j.id = c.id_juego 
 GROUP BY j.id;
 ORDER BY j.nombre;');

        while($row = $resultado_query->fetch(PDO::FETCH_OBJ)) {
            echo "<div>
                      <p>Nombre: {$row->nombre_juego}</p>
                      <p>Género: {$row->genero}</p>
                      <p>Comentarios: {$row->comentario}</p>
                      <p>Puntuación media: {$row->puntuacion}</p>
                    </div>
                 ";
        }

        $conn=null;


    ?>
    
</body>
</html>