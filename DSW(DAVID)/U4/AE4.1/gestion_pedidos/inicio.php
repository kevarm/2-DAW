<?php
// Inicia sesión para acceder a las variables de sesión
session_start();

// Verifica si la sesión está activa
if (!isset($_SESSION["correo"])) {
    // Si no hay sesión activa, redirige al login
    header("location:login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
   <title>Catálogo</title>
</head>

<body>
	<nav>
		<div class="nav">
			<?php echo $_SESSION["correo"]; ?>
			<div>
				<a href="#">Inicio</a>
				<a href="controlador/controlador_cerrar_sesion.php">Salir</a>	
			</div>
		</div>
	</nav>

   <img class="wave" src="img/wave.png">

   <ul class="carteles">
      <?php
// AQUÍ SE INYECTARÁN LOS CARTELES DESDE LA BD
        require_once "modelo/conexion.php";
        $resultados=getCategory();
        if ($resultados && count($resultados) > 0) {
          foreach ($resultados as $resultado) {
            echo "<li class='producto'>";
            //SIGUEN SIN PODER VERSE LAS IMAGENES
            echo "<a>".htmlspecialchars($resultado['nombre'])."</a>";
            echo "<p>Descripción:".htmlspecialchars($resultado['descripcion'])."</p>";
            echo "</li>";
        }
        }else{
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

	
	