<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Producto</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #4EDCE3;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Contenedor principal */
        .detalle-contenedor {
            background-color: #26A69A;
            color: #fff;
            width: 60%;
            max-width: 700px;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Título */
        .detalle-contenedor h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        /* Encabezado */
        .detalle-header {
            background-color: #00796B;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 18px;
            border-radius: 8px 8px 0 0;
            font-weight: bold;
        }

        /* Estilo de la información */
        .detalle-info p {
            margin: 8px 0;
            font-size: 16px;
        }

        .detalle-info p span {
            font-weight: bold;
        }

        /* Botón de volver */
        .volver-btn {
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
        }
    </style>
</head>
<body>

<div class="detalle-contenedor">
    <div class="detalle-header">
        Detalle Producto
    </div>

    <div class="detalle-info">
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
                echo "<h1>{$row->nombre}</h1>";
                echo "<p><span>Código:</span> {$row->id}</p>";
                echo "<p><span>Nombre Corto:</span> {$row->nombre_corto}</p>";
                echo "<p><span>Codigo Familia:</span> {$row->familia}</p>";
                echo "<p><span>PVP (€):</span> {$row->pvp}</p>";
                echo "<p><span>Descripción:</span> {$row->descripcion}</p>";
            }

            $conn = null;
        ?>
    </div>

    <a href="listado.php" class="volver-btn">Volver</a>
</div>

</body>
</html>

