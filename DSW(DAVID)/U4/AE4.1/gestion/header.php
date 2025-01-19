<header id="header">
    <h1>El Pajar</h1>
    <nav>
    <a href="index.php#inicio">Contenido principal</a>
            <a href="index.php#servicios">Servicios</a>
            <a href="index.php#contacto">Contacto</a>
            <a href="iniciarSesion.php">Iniciar sesión</a>

        <?php
        session_start(); 

        // Verifica si el usuario está autenticado y si su rol es 'admin'
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
            echo '<a href="registro.php">Registro De cliente</a>';
        }
        ?>
    </nav>
</header>
