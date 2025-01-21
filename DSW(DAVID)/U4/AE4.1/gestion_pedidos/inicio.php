<?php
// Inicia sesión para acceder a las variables de sesión
session_start();

// Verifica si la sesión está activa
if (!isset($_SESSION["correo"]) && isset($_SESSION['id'])) {
  // Si no hay sesión activa, redirige al login
  header("location:login.php");
  exit;
}


require_once __DIR__ . '\modelo\conexion.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <title>Categorías</title>
</head>

<body>
  <nav>
    <div class="nav">
      <?php echo $_SESSION["correo"];
      ?>
      <div class="enlaces">
        <a href="inicio.php">Inicio</a>
        <a href="carrito.php">Carrito</a>
        <a href="pedidos.php">Mis pedidos</a>
        <a href="modelo/controlador_cerrar_sesion.php">Salir</a>
      </div>
    </div>
  </nav>

  <img class="wave" src="img/wave.png">

  <ul class="carteles">
    <?php

    $conn = createConnection();
    if ($conn === null) {
      echo "<p>Error: No se pudo conectar a la base de datos.</p>";
      exit();
    }

    $resultados = getCategory($conn);
    //print_r( $resultados);
    // Array ( [0] => Array ( [Codigo] => 1 [Nombre] => Entrantes [Descripcion] 
    // => Platos pequeños para comenzar la comida ) [1] => Array ( [Codigo] => 2 [Nombre] => Platos Principales [Descripcion] => Comidas completas y sustanciosas ) [2] => Array ( [Codigo] => 3 [Nombre] => Postres [Descripcion] => Dulces y opciones para finalizar la comida ) [3] => Array ( [Codigo] => 4 [Nombre] => Bebidas [Descripcion] => Incluye refrescos, jugos y bebidas alcohólicas ) [4] => Array ( [Codigo] => 5 [Nombre] => Ensaladas [Descripcion] => Platos frescos y saludables con vegetales ) [5] => Array ( [Codigo] => 6 [Nombre] => Sopas [Descripcion] => Platos líquidos y reconfortantes para el inicio de la comida ) [6] => Array ( [Codigo] => 7 [Nombre] => Pescados [Descripcion] => Platos a base de pescado y mariscos ) [7] => Array ( [Codigo] => 8 [Nombre] => Carnes [Descripcion] => Platos a base de carne roja o blanca ) [8] => Array ( [Codigo] => 9 [Nombre] => Pizza [Descripcion] => Platos de pizza con una variedad de ingredientes ) [9] => Array ( [Codigo] =>
    //  10 [Nombre] => Pastas [Descripcion] => Platos a base de pasta con diferentes salsas ) );
    if ($resultados && count($resultados) > 0) {
      foreach ($resultados as $resultado) {
        echo "<li class='producto'>";
        echo "<a href='producto.php?codigo=" . htmlspecialchars($resultado['Codigo']) . "'>" . htmlspecialchars($resultado['Nombre']) . "</a>";
        echo "<p>Descripción: " . htmlspecialchars($resultado['Descripcion']) . "</p>";
        echo "</li>";
      }
    } else {
      echo "<p>No hay resultados disponibles.</p>";
    }
    ?>
  </ul>


  <script src="js/fontawesome.js"></script>
  <script src="js/main.js"></script>
  <script src="js/main2.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/bootstrap.bundle.js"></script>

</body>

</html>