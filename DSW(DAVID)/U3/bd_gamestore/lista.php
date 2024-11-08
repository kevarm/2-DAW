<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Document</title>
</head>

<body>
<style>
        /* Estilos básicos para la tabla */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para el encabezado */
        thead {
            background-color: #4CAF50;
            color: white;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-size: 1.1em;
            font-weight: bold;
        }

        /* Estilos para filas alternas */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }



        /* Estilo para celdas de la última columna */
        td:last-child {
            text-align: center;
            font-weight: bold;
            color: #333;
        }
    </style>
    <?php
    require_once __DIR__ . "/conexion.php";

    $conn = conexion("localhost", "gamestore", "root", "");

    if ($conn == null) {
        echo "<script>console.log('Error: No se pudo establecer conexión con la base de datos.')</script>";
    }

    $resultado_query = $conn->query(
        "Select * from juegos,calificaciones
        where calificaciones.juego_id=juegos.id;"
    );

    echo "<table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Género</th>
                    <th>Comentarios</th>
                    <th>Puntuación media</th>
                </tr>
            </thead>
            "
            ;

    while ($row = $resultado_query->fetch(PDO::FETCH_OBJ)) {
        echo "
                <tr>
                      <td>{$row->nombre}</td>
                      <td>{$row->genero}</td>
                      <td>{$row->comentarios}</td>
                      <td>{$row->notas}</td>
                </tr>
                
                 ";
    }

    echo "</table>";

    $conn = null;


    ?>

</body>

</html>