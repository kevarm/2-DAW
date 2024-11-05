<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #4EDCE3;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-top: 20px;
        }

        /* Botón de crear */
        a[type="button"] {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* Tabla de productos */
        table {
            width: 80%;
            border-collapse: collapse;
            background-color: #333;
            color: #fff;
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #444;
            font-size: 18px;
        }

        td {
            background-color: #333;
            font-size: 16px;
            border-bottom: 1px solid #444;
        }

        /* Botones de acción */
        .detalle-btn, .actualizar-btn, .borrar-btn {
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .detalle-btn {
            background-color: #00BCD4;
        }

        .actualizar-btn {
            background-color: #FFC107;
        }

        .borrar-btn {
            background-color: #F44336;
        }

        /* Hover para botones */
        .detalle-btn:hover {
            background-color: #0097A7;
        }

        .actualizar-btn:hover {
            background-color: #FFA000;
        }

        .borrar-btn:hover {
            background-color: #D32F2F;
        }
    </style>
</head>
<body>
<h1>Gestión de productos</h1>
    <a type="button" href="crear.php">Crear</a>

    <table>
        <thead>
            <tr>
                <th>Detalle</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                require_once __DIR__."/conexion.php";

                // Creación de la conexión
                $conn = conectar("localhost", "proyecto", "root", "");

                if ($conn == null) {
                    echo "<script>console.log('Error: No se pudo establecer conexión con la base de datos.')</script>";
                }

                $resultado_query = $conn->query('select * from productos');

                while($row = $resultado_query->fetch(PDO::FETCH_OBJ)) {
                    echo "<tr>
                            <td><a class='detalle-btn' href='detalle.php?id={$row->id}'>Detalle</a></td>
                            <td>{$row->id}</td>
                            <td>{$row->nombre}</td>
                            <td>
                                <a class='actualizar-btn' href='update.php?id={$row->id}'>Actualizar</a>
                                <a class='borrar-btn' href='borrar.php?id={$row->id}'>Borrar</a>
                            </td>
                          </tr>";
                }

                // Cerrar la conexión
                $conn = null;
            ?>
        </tbody>
    </table>
</body>
</html>